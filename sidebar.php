<?php
/**
 * This "sidebar" for widgets actually appears just above the site footer.
 *
 * @package Readly
 */
?>
</div><!-- #content -->

<?php 
// Sort of hacky code to count the total number of active sidebars
$available_sidebars = array("sidebar-1", "sidebar-2", "sidebar-3", "sidebar-4");
$active_sidebars = 0;

foreach ( $available_sidebars as $sidebar_name ):
  if ( is_active_sidebar( $sidebar_name ) ) {
    $active_sidebars++;
  }
endforeach;

// No sidebars? No content!
if ( 0 == $active_sidebars  ) {
  return;
}
?>

<section id="footer-sidebar" class="clear widget-area sidebar-count-<?php echo $active_sidebars; ?>" role="complementary">
<?php
foreach ( $available_sidebars as $sidebar_name ):
  echo '<div id="'. $sidebar_name .'" class="widget-block">';
    dynamic_sidebar( $sidebar_name );
  echo '</div>';
endforeach;
?>
</section><!-- #secondary -->
