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

    // File naming convention:
    // fields per site — global_*
    // fields for a post of a specific post type — posttype_{posttype-name}
    // fields for all posts of a specific post type  — posttype-common_{posttype-name}
    // fields of a specific page template — page_{page-template-name}
    // fields for a term of specific taxonomy — taxonomy_{page-template-name}
  }
}
add_action('acf/init', 'themeprefix_acf_add_php_fields');