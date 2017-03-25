<?php

/* Returns an array with the localized strings for inserting into JS
*/


function themeprefix_localized_strings() {
  $localized_strings = array(
    'load_more' => __('Load more', 'theme_domain'),
  );
  return $localized_strings;
}