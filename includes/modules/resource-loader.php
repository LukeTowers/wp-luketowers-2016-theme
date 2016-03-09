<?php
//************************************************************************************************
// Section: 		Theme Resources
// Description:		Loads the required scripts and styles for the theme
//************************************************************************************************

// Functions can hook into 'conditionally_load_resources' to 
// determine if specific resources need to be included
function conditionally_load_resources($wp) {
	// Run functions to check for additional resources to include
	do_action('conditionally_load_resources');
}
add_action('wp', 'conditionally_load_resources');



// Enqueues the template's public styles as set in 'template_admin_styles' filter
function initialize_template_public_styles() {
	// Enqueue Lato Font from Google Fonts
	wp_enqueue_style('font-lato', 'https://fonts.googleapis.com/css?family=Lato:400,400italic,700,700italic');
	
	$stylesheets = apply_filters('template_public_styles', array(
		'font-awesome.min',
	));
	if (!empty($stylesheets)) {
		foreach ($stylesheets as $stylesheet) {
			wp_enqueue_style($stylesheet, LUKE_2016_TEMPLATE_URL . "/includes/css/{$stylesheet}.css");
		}
	}
	wp_enqueue_style('style', LUKE_2016_TEMPLATE_URL . 'style.css');
}
add_action('wp_enqueue_scripts', 'initialize_template_public_styles');


// Enqueues the template's admin styles as set in 'template_admin_styles' filter
function initialize_template_admin_styles() {
	$stylesheets = apply_filters('template_admin_styles', array('editor'));
	if (!empty($stylesheets)) {
		foreach ($stylesheets as $stylesheet) {
			wp_enqueue_style($stylesheet, LUKE_2016_TEMPLATE_URL . "/includes/css/{$stylesheet}.css");
		}
	}
}
add_action('admin_init', 'initialize_template_admin_styles');



// Inludes the template favicons as specified in includes/icons/icons.html on admin and public pages
function template_favicon() {
	include(LUKE_2016_TEMPLATE_PATH . 'includes/icons/icons.html');
}
add_action('wp_head', 'template_favicon');
add_action('admin_head', 'template_favicon');



// Add the front-end theme scripts to <head>
function initialize_template_public_scripts() {
	wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts','initialize_template_public_scripts', 1);



//************************************************************************************************
// Section: 		Resource Removal functions
// Description:		Functions to optimize performance by removing unnecessary resources
//************************************************************************************************

// Remove jquery.migrate.js from site
add_filter('wp_default_scripts', 'dequeue_jquery_migrate');
function dequeue_jquery_migrate(&$scripts){
	$scripts->remove('jquery');
	$scripts->add('jquery', false, array('jquery-core'), '1.10.2');
}