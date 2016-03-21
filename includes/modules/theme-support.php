<?php
//************************************************************************************************
// Section: 		Theme Support Module
// Description:		Module that manages options that the theme supports
//************************************************************************************************

// Enable featured images
add_theme_support('post-thumbnails');

// Enable custom navigation menus
add_theme_support('menus');

// Enable the seo metabox on Pages, Posts, and Projects
add_theme_support('seo-metabox', array('page', 'post', 'project'));

// Sets up this theme's menus
function register_template_menus() {
	register_nav_menus(
		array(
			'main-menu'	=>	'Main Menu',
			'sitemap'	=>	'Site Map',
		)
	);
}
add_action('init', 'register_template_menus');