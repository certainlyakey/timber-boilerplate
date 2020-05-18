<?php
/**
* Hooks responsible for everything displayed on frontend
*/

function themeprefix_add_namespaced_body_classes( $classes ) {
  if ( is_array( $classes ) ) {
    foreach ( $classes as $k => $v ) {
      $classes[ $k ] = 'p-' . $v;
    }
  }
  return $classes;
}

add_filter( 'body_class', 'themeprefix_add_namespaced_body_classes' );



function themeprefix_add_slug_to_body_class( $classes ) {
  global $post;

  if ( is_singular() ) {
    $classes[] = sanitize_html_class( $post->post_name );
  };

  return $classes;
}

add_filter( 'body_class', 'themeprefix_add_slug_to_body_class' );
