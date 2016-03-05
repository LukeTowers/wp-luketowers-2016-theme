<?php
//************************************************************************************************
// Section: 		Header Image Module
// Description:		Module that manages the header image component used by this theme
//************************************************************************************************

// Get the options for this instance of the module
global $template_component_args;
/*
	Options are:
		- 'header-image-post' (Integer): set the post id to be used by this component
		- 'class' (String): set the CSS class to be attached to the image
		- 'image_only' (Boolean): specify if only the image is to be returned
		- 'default' (String): URL to an image to be used as a default if one for the current post isn't found
		- 'size' (String|Array(width,height)): size of the image to be used
		- 'content-override' (String): HTML content to insert instead of content 
		- 'no_image' (Boolean): No image is required to display section
		- 'background_colour' (String): Background colour for the section
*/


// Get the ID of the post to use - override by setting the header-image-post argument
$current_post = @$template_component_args['header-image-post'] ?: get_the_ID();

// Get the class to use with the image - override by setting the class argument
$class = @$template_component_args['class'] ?: 'featured-background';

// Detect if a container is not required
if (@$template_component_args['image_only'] === true) {
	$image_only = true;
} else {
	$image_only = false;
}


if (!empty($current_post)) {
	// Load the selected post's header options
	$header_options = get_post_meta($current_post, 'header_options', true);
	
	// Get the no_image option
	$no_image = !(empty($template_component_args['no_image'])) || !(empty($header_options['no_image']));
	
	// Get the background_colour option
	$background_colour = @$header_options['background_colour'] ?: @$template_component_args['background_colour'];
	$background_colour_css = !empty($background_colour) ? " background-color: {$background_colour};" : '';
	
	// Generate only the color span if that is all that is requested.
	if ($no_image) {
		$header_html = '<span class="' . $class . '" style="' . $background_colour_css . '"></span>';
	} else {
		if (has_post_thumbnail($current_post) || !empty($template_component_args['default'])) {
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
			$url = $url ?: @$template_component_args['default']; // Attempt to assign the default image to the url if no others found
			
			if (!empty($url)) {
				// Generate the y correction if necessary
				if (!empty($header_options['y_correction'])) {
					$y_correction = 'background-position: center ' . $header_options['y_correction'] . ';';
				} else { $y_correction = ''; }
							
				// Generate the image html
				$header_html = '<span class="' . $class . '" style="background-image: url(\'' . $url . '\');' . $y_correction . '"></span>';
			}
		}
	}
	
	// If no container is needed, only echo the header html
	if ($no_container) {
		echo $header_html;
	} else {
		echo '<div class="header_featured_container">';
			// Display the overlay
			if (@$header_options['transparent_overlay']) {
				if (!empty($header_options['overlay_opacity'])) {
					$opacity_style = ' style="background-color: rgba(0,0,0,' . $header_options['overlay_opacity'] . ');"';
				} else { $opacity_style = ''; }
				
				echo '<span class="header-overlay"' . $opacity_style . '></span>';
			}
			
			// Display the text
			$header_content = @$template_component_args['content-override'] ?: @$header_options['header_text'];
			if (!empty($header_content)) {
				echo '<div class="featured-text">';
					echo $header_content;
				echo '</div>';
			}
			
			echo $header_html;
		echo '</div>';
	}
}