<?php
/**
 * Implement Custom Headers for the site
 *
 * @package Readly
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses readly_header_style()
 * @uses readly_admin_header_style()
 * @uses readly_admin_header_image()
 */
function readly_custom_header_setup() {
  add_theme_support( 'custom-header', apply_filters( 'readly_custom_header_args', array(
    'default-image'          => '',
    'default-text-color'     => 'faf9f5',
    'width'                  => 1600,
    'height'                 => 475,
    'flex-height'            => true,
    'flex-width'             => true,
    'wp-head-callback'       => 'readly_header_style',
  ) ) );
}
add_action( 'after_setup_theme', 'readly_custom_header_setup' );

if ( ! function_exists( 'readly_header_style' ) ) :
  /**
   * Styles the header image and text displayed on the blog
   *
   * @see readly_custom_header_setup().
   */
  function readly_header_style() {
    $header_text_color = get_header_textcolor();

    // If no custom options for text are set, let's bail
    // get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
    if ( HEADER_TEXTCOLOR == $header_text_color ) {
      return;
    }

    // If we get this far, we have custom styles. Let's do this.
    ?>
    <style type="text/css">
    <?php if ( 'blank' === $header_text_color ): // Hide text if user has set to hide ?>
      .site-title,
      .site-description {
        position: absolute;
        clip: rect(1px, 1px, 1px, 1px);
      }
    <?php else: // Otherwise, use whatever the user wants ?>
      .title-block .site-title a,
      .header-image .title-block .site-title a,
      .title-block .site-description,
      .header-image .title-block .site-description {
        color: #<?php echo esc_attr( $header_text_color ); ?>;
      }

    <?php endif; ?>
    </style>
    <?php
    } // readly_header_style()
endif;
