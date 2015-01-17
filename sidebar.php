<?php
/**
 * This "sidebar" for widgets actually appears just above the site footer.
 *
 * @package Readly
 */

// Loop through all possible sidebar areas to determine if they're active or not
$available_sidebars = array( "sidebar-1", "sidebar-2", "sidebar-3", "sidebar-4" );
$active_sidebars = array();

foreach ( $available_sidebars as $sidebar_name ):
  if ( is_active_sidebar( $sidebar_name ) ) {
    $active_sidebars[] = $sidebar_name;
  }
endforeach;

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
