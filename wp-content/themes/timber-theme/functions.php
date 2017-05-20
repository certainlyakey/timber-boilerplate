<?php

/**
 * Theme functions
 * See descriptions in each `require`d file
 *
 */


$functions_path = get_template_directory() . '/functions/';

// Development functions
$dev_functions_file_path = $functions_path . 'dev-functions.php';
if (file_exists($dev_functions_file_path)) { require_once( $dev_functions_file_path ); }

// Obtain and setup shared variables  
require_once( $functions_path . 'common-variables.php');

// Timber setup
require_once( $functions_path . 'timber/timber-setup.php');
require_once( $functions_path . 'timber/timber-extend-site.php');
require_once( $functions_path . 'timber/timber-extend-post.php');

// Client side PHP data (script localization, AJAX, etc.)
require_once( $functions_path . 'script-data/localized-strings.php');
require_once( $functions_path . 'script-data/script-data.php');

// Basic theme setup
require_once( $functions_path . 'theme-setup/theme-support.php');
require_once( $functions_path . 'theme-setup/register-post-types.php');
require_once( $functions_path . 'theme-setup/register-taxonomies.php');
require_once( $functions_path . 'theme-setup/register-sidebars.php');
require_once( $functions_path . 'theme-setup/register-scripts.php');
require_once( $functions_path . 'theme-setup/register-menus.php');
require_once( $functions_path . 'theme-setup/register-thumbnail-sizes.php');

// Custom theme functions and hooks
require_once( $functions_path . 'frontend-hooks.php');
require_once( $functions_path . 'frontend-functions.php');
require_once( $functions_path . 'admin-hooks.php');

// Plugins dependent functions and hooks
require_once( $functions_path . 'plugins/plugin.php');

// Specific templates related non Twig functions (pre_get_posts, etc.)
require_once( $functions_path . 'templates/archive-post-type.php');