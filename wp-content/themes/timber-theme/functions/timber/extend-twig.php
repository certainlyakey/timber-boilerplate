<?php

/* Setup Timber environment
*/


function themeprefix_add_to_twig($twig) {
  
  $twig->addFilter(new Twig_SimpleFilter('merge_recursive', 'themeprefix_array_merge_recursive'));
  $twig->addFilter(new Twig_SimpleFilter('slugify', 'themeprefix_string_slugify'));
  return $twig;
}

add_filter('timber/twig', 'themeprefix_add_to_twig');



function themeprefix_array_merge_recursive($arr1, $arr2) {
  if ($arr1 instanceof Traversable) {
    $arr1 = iterator_to_array($arr1);
  } elseif (!is_array($arr1)) {
    throw new Twig_Error_Runtime(sprintf('The merge_recursive filter only works with arrays or "Traversable", got "%s" as first argument.', gettype($arr1)));
  }
  if ($arr2 instanceof Traversable) {
    $arr2 = iterator_to_array($arr2);
  } elseif (!is_array($arr2)) {
    throw new Twig_Error_Runtime(sprintf('The merge_recursive filter only works with arrays or "Traversable", got "%s" as second argument.', gettype($arr2)));
  }
  return array_replace_recursive($arr1, $arr2);
}



function themeprefix_string_slugify($str) {
  if (gettype($str) === 'string') {
    $result = strtolower(str_replace(' ', '-', $str));
  } else {
    throw new Twig_Error_Runtime(sprintf('The slugify filter only works with strings, got "%s" as first argument.', gettype($str)));
  }
  return $result;
}
