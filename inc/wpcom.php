<?php
/**
* WordPress.com-specific functions and definitions.
*
* This file is centrally included from `wp-content/mu-plugins/wpcom-theme-compat.php`.
*
* @package Readly
*/


/**
* Adds support for wp.com-specific theme functions.
*
* @global array $themecolors
*/
function readly_wpcom_setup() {
  global $themecolors;
  // Set theme colors for third party services.
  if ( ! isset( $themecolors ) ):
    $themecolors = array(
      'bg'     => 'eae9e6',
      'text'   => '363431',
      'link'   => '932817',
      'border' => 'd9d6d0',
      'url'    => '787065',
    );
  endif;
}
add_action( 'after_setup_theme', 'readly_wpcom_setup' );
