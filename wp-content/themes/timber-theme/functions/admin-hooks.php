<?php

/* Hooks related to content structure and everything displayed on admin side
*/


//Enable background updates even if there is a git in the root (and there is!)
add_filter( 'automatic_updates_is_vcs_checkout', '__return_false', 1 );



// Remove unnecessary sections from the theme customizer
function themeprefix_edit_customizer($wp_customize) {
  $wp_customize->remove_section("colors");
  $wp_customize->remove_section("custom_css");
  // $wp_customize->remove_section("static_front_page");
}

add_action( "customize_register", "themeprefix_edit_customizer" );