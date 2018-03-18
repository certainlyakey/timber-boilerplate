<?php

/* Registering theme support
*/


add_theme_support('post-thumbnails');
add_theme_support('menus');
add_theme_support('widgets');
add_theme_support('custom-header');
add_theme_support('title-tag');
add_theme_support( 'html5', array( 'search-form', 'caption', 'gallery' ) );


//Load localization domain
function themeprefix_load_localisation(){
  load_theme_textdomain('theme_domain', get_template_directory() . '/languages');
}

add_action( 'after_setup_theme', 'themeprefix_load_localisation' );