<?php

/* Registering scripts and styles
*/


function themeprefix_script_enqueuer() {
  wp_register_script( 'site', get_template_directory_uri().'/js/scripts.min.js', array( 'jquery', 'modernizr' ), false, true );
  wp_enqueue_script( 'site' );

  wp_register_script( 'modernizr', get_template_directory_uri().'/js/modernizr.min.js', array( ), false, true );
  wp_enqueue_script( 'modernizr' );

  wp_localize_script('site', 'localized_strings', themeprefix_localized_strings());
  wp_localize_script('site', 'script_data', themeprefix_script_data());

  wp_register_style( 'screen', get_stylesheet_directory_uri().'/style.css', '', '', 'screen' );
  wp_enqueue_style( 'screen' );
}

add_action( 'wp_enqueue_scripts', 'themeprefix_script_enqueuer', 10 );