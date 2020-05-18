<?php
/**
 * Handling common variables from common_config.json file
 * These are to be shared between Gulp, PHP, JS, and SASS
 */

global $common_config;

$file = file_get_contents( get_template_directory() . '/common_config.json' );
$common_config = json_decode( $file );
