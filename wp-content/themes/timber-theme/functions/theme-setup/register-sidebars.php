<?php

/* Sidebar registration
*/

function themeprefix_widgets_init() {
  register_sidebar(array());
}

add_action( 'widgets_init', 'themeprefix_widgets_init' );
