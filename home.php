<?php

$context = Timber::get_context();

// get queried loop
$timber_posts = Timber::get_posts( false, 'CommonPost' );
$context['posts'] = $timber_posts;

$context['pagination'] = Timber::get_pagination();

$context['blogpage'] = Timber::get_post( get_option( 'page_for_posts', true ), 'CommonPost' );

Timber::render( 'blog.twig', $context );
