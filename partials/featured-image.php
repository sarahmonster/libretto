<?php 
// First, we'll check to see how big it is. This will determine how we'll display it.
$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
$thumbnail_width = $image_attributes[1];
$thumbnail_height = $image_attributes[2];

// We'll make it super-big if a big image has been uploaded. Otherwise, let's just center it.
if ( $thumbnail_width > 920 ) {
  $thumbnail_class = "readly_big";
} else {
  $thumbnail_class = "aligncenter";
}

// Finally, show the image
the_post_thumbnail( 'full', array( 'class' => $thumbnail_class . ' featured-image' ) );
