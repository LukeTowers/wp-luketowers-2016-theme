<?php
//************************************************************************************************
// Section: 		Header Image Module
// Description:		Module that manages the header image component used by this theme
//************************************************************************************************

// Todo: need to write custom merge function to only overwrite new values if the new ones aren't blank.

// Get the options for this instance of the module
global $template_component_args;
/*
	Options are:
		- 'header-image-post' (Integer):  set the post id to be used by this component (defaults to get_the_ID() results)
		- 'class'             (String):   set the CSS class to be attached to the image
		- 'container_class'   (String):   set the CSS class to be attached to the container
		- 'overlay_class'     (String):   set the CSS class to be attached to the transparent overlay
		- 'image_only'        (Boolean):  specify if only the featured display element is to be returned instead of it and it's container
		- 'size'              (String|Array(width,height)): size of the image to be used
		- 'include_meta'      (Boolean):  include the <meta itemprop="image" content="image_url"> markup in the results
		- 'defaults' (Array):
			- 'header_text'           (String):   Default HTML content to use if none is found attached to the post
			- 'background_attachment' (String):   Default CSS background attachment to be used if none is found attached to the post
			- 'background_colour'     (String):   Default CSS background colour to be used if none is found attached to the post
			- 'background_size'       (String):   Set the CSS background size for the image if none is found attached to the post
			- 'y_correction'          (String):   Set the CSS background-position-y for the background if none is found attached to the post
			- 'transparent_overlay    (Boolean):  Whether to display a transparent overlay or not
			- 'overlay_opacity'       (String):   Alpha value for RGBA(0,0,0,x) opacity layer
			- 'no_image'              (Boolean):  Specify if the featured display element is returned without image data (saves a db call if only background colour is desired)
			- 'image_url'             (String):   URL to default image to be used if none are found attached to the post
			- 'relative_height'       (String):   Default Ratio of the height of the sizing image relative to the width. Based on data in lai_image_sizing_data()
		- 'overrides' (Array):
			- 'header_text'           (String):   HTML content to be used regardless of anything else
			- 'background_attachment' (String):  CSS background attachment to be used regardless of anything else
			- 'background_colour'     (String):   CSS background colour to be used regardless of anything else
			- 'background_size'       (String):   Set the CSS background size for the image regardless of anything else
			- 'y_correction'          (String):   Set the CSS background-position-y for the background regardless of anything else
			- 'transparent_overlay    (Boolean):  Whether to display a transparent overlay or not
			- 'overlay_opacity'       (String):   Alpha value for RGBA(0,0,0,x) opacity layer
			- 'no_image'              (Boolean):  specify if the featured display element is returned without image data (saves a db call if only background colour is desired)
			- 'image_url'             (String):   URL to image to be used regardless of anything else
			- 'relative_height'       (String):   Overriding Ratio of the height of the sizing image relative to the width. Based on data in lai_image_sizing_data()
*/


// Get the ID of the post to use - override by setting the header-image-post argument
$current_post = @$template_component_args['header-image-post'] ?: get_the_ID();

// Get the classes to use
$class = @$template_component_args['class'] ?: 'featured-background';
$container_class = @$template_component_args['container_class'] ?: 'header_featured_container';
$overlay_class = @$template_component_args['overlay_class'] ?: 'header-overlay';

// Detect if a container is not required
$no_container = !(empty($template_component_args['image_only']));



// Setup the default header options
$default_header_options = array_merge(array(
	'header_text'            => '',
	'background_attachement' => '',
	'background_colour'      => '',
	'background_size'        => '',
	'y_correction'           => '',
	'transparent_overlay'    => false,
	'overlay_opacity'        => '',
	'no_image'               => false,
	'image_url'              => '',
	'relative_height'        => '',
), (array) @$template_component_args['defaults']);

// Setup the overriding header options
$overriding_header_options = @$template_component_args['overrides'] ?: array();

// Setup the post header options
if (!empty($current_post)) {
	$post_header_options = get_post_meta($current_post, 'header_options', true);
	
	// Get the post's header image as long as there is reason to
	if (empty($post_header_options['no_image']) && empty($overriding_header_options['no_image']) && empty(@$overriding_header_options['image_url'] && has_post_thumbnail($current_post))) {
		// If mobile, default to large instead of original size
		if (lai_mobile_visitor() || lai_tablet_visitor()) {
			$default_size = 'large';
		} else {
			$default_size = 'full';
		}
		
		$size = @$template_component_args['size'] ?: $default_size;
		
		// Get the url of the featured image for this post
		$url_array = wp_get_attachment_image_src(get_post_thumbnail_id($current_post), $size);
		$url = @$url_array[0];
		
		if (!empty($url)) {
			$post_header_options['image_url'] = $url;
		}
	}
}
if (empty($post_header_options)) { $post_header_options = array(); }



// Merge the default, post, and overriding header options to get the final version of the options for content generation
$header_options = array_merge($default_header_options, $post_header_options, $overriding_header_options);

// Determine whether to continue with generating anything
if ($header_options['no_image'] || !empty($header_options['image_url'])) {
	
	// Generate the inline background colour CSS to use
	$background_colour_css = !empty($header_options['background_colour']) ? " background-color: {$header_options['background_colour']};": '';
	
	// Just generate the span with the background colour if that is all that's needed
	if ($header_options['no_image'] || empty($header_options['image_url'])) {
		$header_html = '<span class="' . $class . '" style="' . $background_colour_css . '"></span>';
	} else {
		// Generate the inline background position, attachment, and size css
		$background_position_css   = !empty($header_options['y_correction'])    ? " background-position: center {$header_options['y_correction']};" : '';
		$background_attachment_css = !empty($header_options['background_attachment']) ? " background-attachment: {$header_options['background_attachment']};" : '';
		$background_size_css       = !empty($header_options['background_size']) ? " background-size: {$header_options['background_size']};" : '';
		
		$inline_css = $background_colour_css . $background_attachment_css . $background_position_css . $background_size_css;
		
		// Generate the span with the inline css options and image url
		$header_html = '<span class="' . $class . '" style="background-image: url(\'' . $header_options['image_url'] . '\');' . $inline_css . '"></span>';
		
		if (!empty(@$template_component_args['include_meta'])) {
			$header_html .= lai_get_imageObject_schema(get_post_thumbnail_id($current_post));
		}
	}
	
	// If no container is needed, only echo the header html
	if ($no_container) {
		echo $header_html;
	} else {
		echo '<div class="' . $container_class . '">';
			// Output the relative sizing image
			if (!empty($header_options['relative_height'])) {
				echo '<img src="' . lai_image_sizing_data('1', $header_options['relative_height']) . '" class="image-sizer" alt="">';
			}
		
		
			// Display the overlay
			if ($header_options['transparent_overlay']) {
				if (!empty($header_options['overlay_opacity'])) {
					$opacity_style = ' style="background-color: rgba(0,0,0,' . $header_options['overlay_opacity'] . ');"';
				} else { $opacity_style = ''; }
				
				echo '<span class="' . $overlay_class . '"' . $opacity_style . '></span>';
			}
			
			// Display the header content
			if (!empty($header_options['header_text'])) {
				echo '<div class="featured-text">';
					echo $header_options['header_text'];
				echo '</div>';
			}
			
			echo $header_html;
		echo '</div>';
	}
}