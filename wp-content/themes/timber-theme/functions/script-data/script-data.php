<?php

/* Returns an array with various PHP/Timber data for inserting into JS
*/


function themeprefix_script_data() {
  $script_data = array(
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
    // 'svg_icon' => Timber::compile_string("{% include 'partials/image-svg-sprite.twig' with {'id': 'icon_id', 'classes': ['c-icon'], 'theme_link': theme_link} %}", array('theme_link' => get_template_directory_uri())),
  );
  return $script_data;
}