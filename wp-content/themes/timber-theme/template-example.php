<?php
/**
 * Template name: Example custom template
 */
$context = Timber::get_context();
$post = Timber::query_post(false, 'CommonPost');
$context['post'] = $post;

Timber::render('custom-templates/example.twig', $context);