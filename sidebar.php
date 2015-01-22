<?php
/**
 * This "sidebar" for widgets actually appears just above the site footer.
 *
 * @package Readly
 */

$active_sidebars = readly_get_active_sidebars();

// No sidebars? No content!
if ( 0 === count( $active_sidebars )  ) {
  return;
}
?>

<section id="footer-sidebar" class="clear widget-area" role="complementary">
  <?php // Otherwise, let's loop through every activated sidebar, and put it in a div
  foreach ( $active_sidebars as $sidebar_name ):
    echo '<div id="'. $sidebar_name .'" class="widget-block">';
    dynamic_sidebar( $sidebar_name );
    echo '</div>';
  endforeach;
  ?>
</section><!-- #secondary -->
