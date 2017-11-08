<?php

/* Setup Timber environment
*/


add_filter('timber/twig', 'themeprefix_add_to_twig');

function themeprefix_add_to_twig($twig) {
  /* this is where you can add your own functions to twig */
  $twig->addExtension(new Twig_Extension_StringLoader());
  $twig->addFilter(new Twig_SimpleFilter('merge_recursive', 'themeprefix_array_merge_recursive'));
  return $twig;
}

function themeprefix_array_merge_recursive($arr1, $arr2) {
  if ($arr1 instanceof Traversable) {
    $arr1 = iterator_to_array($arr1);
  } elseif (!is_array($arr1)) {
    throw new Twig_Error_Runtime(sprintf('The merge filter only works with arrays or "Traversable", got "%s" as first argument.', gettype($arr1)));
  }
  if ($arr2 instanceof Traversable) {
    $arr2 = iterator_to_array($arr2);
  } elseif (!is_array($arr2)) {
    throw new Twig_Error_Runtime(sprintf('The merge filter only works with arrays or "Traversable", got "%s" as second argument.', gettype($arr2)));
  }
  return array_replace_recursive($arr1, $arr2);
}
