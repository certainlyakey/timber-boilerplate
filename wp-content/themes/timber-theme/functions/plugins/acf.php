<?php

/* Functions related to ACF
*/


// Add options pages

function themeprefix_add_options_pages() {
  if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
      'page_title'  => __('Site Settings','theme_domain'),
      'menu_slug'   => 'site-settings',
      'capability'  => 'edit_posts',
      'redirect'    => false
    ));
    
  }
}

add_action('acf/init', 'themeprefix_add_options_pages');



function themeprefix_acf_global_settings_context( $context ) {

  // make ACF options page fields available in every Twig file
  $context['options'] = get_fields('option');

  return $context;
}

add_filter( 'timber_context', 'themeprefix_acf_global_settings_context' );



// Disable "Custom fields" menu in admin
// add_filter('acf/settings/show_admin', '__return_false');