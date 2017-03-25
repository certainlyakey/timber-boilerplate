<?php

/* Registering various taxonomies
*/


function themeprefix_register_taxonomies() {
  // register_taxonomy();
}

add_action( 'init', 'themeprefix_register_taxonomies' );