<?php
//************************************************************************************************
// Section: 		Widget Areas
// Description:		Module that handles the templates widget areas (sidebars)
//************************************************************************************************

// Register Theme Widget Areas
function theme_widgets_init() {
	// Blog Sidebar
	register_sidebar( array(
		'name'          => 'Blog Sidebar',
		'id'            => 'blog-sidebar',
		'before_widget' => '<div class="blog-sidebar-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
}
add_action('widgets_init', 'theme_widgets_init');