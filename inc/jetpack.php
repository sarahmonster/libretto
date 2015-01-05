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
    'container' => 'content',
    'footer'    => 'colophon'
  ) );
}

add_action( 'after_setup_theme', 'readly_infinite_scroll_setup' );
