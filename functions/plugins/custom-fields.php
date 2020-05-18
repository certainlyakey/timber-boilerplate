<?php
/** 
* ACF fields registration
*/

// Fields registration
function themeprefix_acf_add_php_fields() {
  global $functions_path;
  $fields_path = $functions_path . 'plugins/fields/';

  // if ( function_exists( 'acf_add_local_field_group' ) ) {
    // Add your field group registration code in a separate file, one group per file
    // require_once( $fields_path . 'fields_group.php' );

    // File naming convention:
    // fields per site — fields_global_* (example: fields_global_analytics.php)
    // fields for a post of a specific post type — fields_posttype_{posttype-name} (example: fields_posttype_pages.php)
    // fields for all posts of a specific post type  — fields_posttype-common_{posttype-name} (example: fields_posttype-common_posts.php)
    // fields of a specific page template or home/front page — fields_page_{page-template-name} (example: fields_page_front-page.php)
    // fields for a term of specific taxonomy — fields_taxonomy_{page-template-name} (example: fields_taxonomy_categories.php)
  // }
}

add_action( 'acf/init', 'themeprefix_acf_add_php_fields' );
