<?php

/**
 * Handling common variables from common_config.json file
 * These are to be shared between Gulp, PHP, JS, and SASS
 *
 */


$file = file_get_contents(get_template_directory() . '/common_config.json');
global $common_config;
$common_config = json_decode($file);


// Function for calculating sizes by number of cols
function ar_cols($cols, $additional_gutters = 0) {
  // grid variables from common_config file
  global $common_config;
  $cols_number = $common_config->cols_number;
  $gutter_width = $common_config->gutter_width;
  $col_width = $common_config->col_width;

  $width = $col_width*$cols + $gutter_width*($cols - 1) + $gutter_width*$additional_gutters;

  return $width;
}

