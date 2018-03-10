<?php

/**
 * Handling common variables from common_config.json file
 * These are to be shared between Gulp, PHP, JS, and SASS
 *
 */


$file = file_get_contents(get_template_directory() . '/common_config.json');
global $common_config;
$common_config = json_decode($file);
