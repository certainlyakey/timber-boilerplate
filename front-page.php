<?php

// front page set in WP settings
$context = Timber::get_context();

// get queried post/page
$frontpage = Timber::query_post( false, 'CommonPost' );
$context['frontpage'] = $frontpage;

Timber::render( 'front-page.twig', $context );
