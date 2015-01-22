<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Readly
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function readly_infinite_scroll_setup() {
  add_theme_support( 'infinite-scroll', array(
    'container'      => 'content',
    'footer'         => 'colophon',
    'footer_widgets' => array( 'readly_has_footer_widgets' ),
  ) );
}
add_action( 'after_setup_theme', 'readly_infinite_scroll_setup' );

/**
* If the social menu or the sidebar widgets are active, switch to click-to-scroll
*/
function readly_has_footer_widgets() {
  if ( has_nav_menu( 'social' ) ):
    return true;
  elseif ( 0 !== count( readly_get_active_sidebars() )  ):
    return true;
  else:
    return false;
  endif;
}
add_filter( 'infinite_scroll_has_footer_widgets', 'readly_has_footer_widgets' );

/**
 * Add theme support for Jetpack responsive videos
 *
 */
add_theme_support( 'jetpack-responsive-videos' );
