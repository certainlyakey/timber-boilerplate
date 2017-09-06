<?php

/* Registering and managing thumbnail sizes
*/


//Custom post thumbnail sizes
// add_image_size( 'cover', $common_config->cover_width, $common_config->cover_height, true );

// These standard sizes are only for end user usage in rich content area
// Their height should be kept unlimited to prevent incorrect resize that changes image width
update_option( 'thumbnail_size_w', 200 );
update_option( 'thumbnail_crop', '0' );
update_option( 'medium_size_w', 510 );
update_option( 'large_size_w', 1050 );

$content_sizes = array('thumbnail','medium','large');
foreach ($content_sizes as $content_size) {
  update_option( $content_size. '_size_h', 9999 );
}