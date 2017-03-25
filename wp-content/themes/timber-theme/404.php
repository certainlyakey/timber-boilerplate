<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */
$context = Timber::get_context();
// $context['title'] = __('Error','theme_domain') . ' 404 (' . __('page not found','theme_domain') . ')';
// $context['subtitle'] = sprintf(__('Sorry, we couldn\'t find what you\'re looking for', 'theme_domain'), '<a href="' . get_bloginfo('url') . '">', '</a>');
Timber::render( 'message.twig', $context );