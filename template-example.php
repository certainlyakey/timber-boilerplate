<?php
/**
* Template name: Example custom template
*/

$context = Timber::get_context();
$timber_post = Timber::query_post( false, 'CommonPost' );
$context['post'] = $timber_post;

Timber::render( 'custom-templates/example.twig', $context );
