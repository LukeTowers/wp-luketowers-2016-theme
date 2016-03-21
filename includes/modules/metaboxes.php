<?php
//************************************************************************************************
// Section: 		Metaboxes Module
// Description:		Module that manages the metaboxes for this template
//************************************************************************************************

// Register the template metaboxes
function add_template_metaboxes($posttype, $post) {
		
	// Header Options
	add_meta_box(
		'header_options_metabox',				// ID of the metabox
		'Header Options',						// Title of the metabox
		'render_header_options_metabox',		// Callback function to print out the html for the metabox
		array('page', 'post', 'project'),		// "Screen" to display metabox on, i.e. post type
		'side',									// Context of the metabox
		'low'									// Priority of the metabox being displayed
	);
}
add_action('add_meta_boxes', 'add_template_metaboxes', 10, 2);



// Save the header options
function update_theme_metaboxes($post_id) {
	if (empty($post_id)) {
		return $post_id;
	}
	
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
	
	// Check if the nonce is set.
	if (!isset($_POST['header_options_nonce'])) {
		return $post_id;
	}
	$nonce = $_POST['header_options_nonce'];

	// Verify that the nonce is valid.
	if (!wp_verify_nonce($nonce, 'header_options')) {
		return $post_id;
	}
				
	// Initialize the working variable
	$header_options = array();
	
	// Process the header options
	$header_options['header_text']           = (!empty($_POST['header_text'])) ? $_POST['header_text'] : '';
	$header_options['background_attachment'] = (!empty($_POST['background_attachment'])) ? $_POST['background_attachment'] : '';
	$header_options['background_colour']     = (!empty($_POST['background_colour'])) ? $_POST['background_colour'] : '';
	$header_options['background_size']       = (!empty($_POST['background_size'])) ? $_POST['background_size'] : '';
	$header_options['y_correction']          = @$_POST['y_correction'];
	$header_options['transparent_overlay']   = !empty($_POST['transparent_overlay']);
	$header_options['overlay_opacity']       = @$_POST['overlay_opacity'] ?: '';
	$header_options['no_image']              = !empty($_POST['no_image']);
	
	// Update the header options
	update_post_meta($post_id, 'header_options', $header_options);
}
add_action('save_post', 'update_theme_metaboxes', 10);



//************************************************************************************************
// Section: 		Metabox Render Functions
// Description:		Load the files that contain the rendering functions for the metaboxes
//************************************************************************************************

// Header Options
require_once(LUKE_2016_TEMPLATE_PATH . 'includes/modules/metabox-generation/header_options.php');