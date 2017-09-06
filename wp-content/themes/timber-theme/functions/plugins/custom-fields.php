<?php

/* ACF fields registration
*/


// Fields registration
function themeprefix_acf_add_php_fields() {
  global $functions_path;
  $fields_path = $functions_path . 'plugins/fields/';

  if (function_exists('acf_add_local_field_group')) {
    // Add your field group registration code in a separate file, one group per file
    // require_once( $fields_path . 'field_group.php');
  }
}
add_action('acf/init', 'themeprefix_acf_add_php_fields');