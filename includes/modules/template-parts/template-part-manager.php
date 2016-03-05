<?php
//************************************************************************************************
// Section: 		Template Part Manager
// Description:		Module that manages the template components used by this theme
//************************************************************************************************

$template_component_args = array();

function get_template_component($template_part, $array_of_arguments = array()) {
	// Used to pass arguments to template components
	global $template_component_args;
	$template_component_args = $array_of_arguments;
	
	// Location of the template component
	$part_location = LUKE_2016_TEMPLATE_PATH . 'includes/modules/template-parts/' . $template_part . '.php';
	
	if (file_exists($part_location)) {
		include($part_location);
	}
}