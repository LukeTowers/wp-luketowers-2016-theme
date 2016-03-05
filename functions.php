<?php
/*
Theme Name: LukeTowers Portfolio
Theme URI: http://luketowers.ca/
Author: Luke Towers
Author URI: http://luketowers.ca
Description: WordPress template for personal Portfolio
Version: 0.0.1
Template Prefix: LUKE_2016 (Three letter prefix + year of developement)
*/


//************************************************************************************************
// Section: 		Template Setup
// Description:		
//************************************************************************************************

// Setup template path
define('LUKE_2016_TEMPLATE_PATH', get_template_directory() . '/');

// Setup template url
define('LUKE_2016_TEMPLATE_URL', get_template_directory_uri() . '/');



//************************************************************************************************
// Section: 		Helper Functions Module
// Description:		Module that manages the helper functions for this template
//************************************************************************************************

require_once(LUKE_2016_TEMPLATE_PATH . 'includes/modules/helper-functions.php');



//************************************************************************************************
// Section: 		Theme Support Module
// Description:		Module that manages options that the theme supports
//************************************************************************************************

require_once(LUKE_2016_TEMPLATE_PATH . 'includes/modules/theme-support.php');



//************************************************************************************************
// Section: 		Template Part Manager
// Description:		Module that manages the template components used by this theme
//************************************************************************************************

require_once(LUKE_2016_TEMPLATE_PATH . 'includes/modules/template-parts/template-part-manager.php');



//************************************************************************************************
// Section: 		Theme Resources
// Description:		Loads the required scripts and styles for the theme
//************************************************************************************************

require_once(LUKE_2016_TEMPLATE_PATH . 'includes/modules/resource-loader.php');



///************************************************************************************************
// Section: 		Metaboxes Module
// Description:		Module that manages the metaboxes for this template
//*************************************************************************************************

require_once(LUKE_2016_TEMPLATE_PATH . 'includes/modules/metaboxes.php');