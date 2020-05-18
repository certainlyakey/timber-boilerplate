<?php
/**
 * Singular pages (pages and posts of any type)
 */

$context = Timber::get_context();
$timber_post = Timber::query_post( false, 'CommonPost' );
$context['post'] = $timber_post;

if ( post_password_required( $timber_post->ID ) ) {
  Timber::render( 'single-password.twig', $context );
} elseif ( get_post_type( $timber_post ) === 'page' ) {
  Timber::render( ['page.twig', 'singular.twig'], $context );
} else {
  Timber::render( ['single-' . $timber_post->ID . '.twig', 'single-' . $timber_post->post_type . '.twig', 'single.twig', 'singular.twig'], $context );
}
