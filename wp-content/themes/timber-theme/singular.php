<?php
/**
 * Singular pages (pages and posts of any type)
 */
$context = Timber::get_context();
$post = Timber::query_post(false, 'CommonPost');
$context['post'] = $post;

if ( post_password_required( $post->ID ) ) {
  Timber::render( 'single-password.twig', $context );
} elseif (get_post_type($post) == 'page') {
  Timber::render('page.twig', $context);
} else {
  Timber::render( array( 'single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig', 'singular.twig' ), $context );
}