<?php
/**
 * Readly Theme Customizer
 *
 * @package Readly
 * @since Readly 1.2
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 * @since Readly 1.2
 */
function readly_theme_customizer($wp_customize) {

	// Allow user to select if they'd like to display excerpts, or full post content on index pages
	$wp_customize->add_section( 'readly_layout_section' , array(
    'title'       => __( 'Blog Layout', 'readly' ),
    'priority'    => 30,
    'description' => __( 'Would you like to show excerpts, or full post content on your blog page?', 'readly' )
  ) );

	$wp_customize->add_setting( 'readly_blog_index', array(
    'default'   => 'excerpt',
    'sanitize_callback' => 'readly_sanitize_blog_index'
  ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'readly_blog_index', array(
	  'label'     => __( 'Blog index display', 'readly' ),
	  'section'   => 'readly_layout_section',
	  'settings'  => 'readly_blog_index',
	  'type'      => 'radio',
	  'choices'   => array(
	      'excerpt'   => __( 'Excerpts', 'readly' ),
	      'content'   => __( 'Full content', 'readly' )
	      )
  ) ) );

  // Allow user to change the colour of links throughout the site
	$wp_customize->add_setting( 'readly_link_colour', array(
    'default' => '#932817',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'sanitize_callback' => 'readly_sanitize_hex_colour',
   ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'readly_link_colour', array(
		'label'    => __( 'Link colour', 'readly' ),
		'section'  => 'colors',
		'settings' => 'readly_link_colour',
		'priority' => 10
	) ) );

	// Allow user to enter social network links to display on footer
	$wp_customize->add_section( 'readly_social', array(
		'title' 			=> __( 'Social network links', 'readly' ),
		'priority'  	=> 95,
		'capability' 	=> 'edit_theme_options',
		'description' => __( 'Any social networks you add below will appear in the footer of your theme. Make sure to enter the full URL! (ie "http://twitter.com/yourname")', 'readly' )
	));

	$networks = array(
		'twitter' 	=> __( 'Twitter', 'readly'),
		'facebook' 	=> __( 'Facebook', 'readly'),
		'instagram' => __( 'Instagram', 'readly'),
		'pinterest' => __( 'Pinterest', 'readly'),
		'dribbble' 	=> __( 'Dribbble', 'readly'),
		'google' 		=> __( 'Google+', 'readly'),
		'vimeo' 		=> __( 'Vimeo', 'readly'),
		'flickr' 		=> __( 'Flickr', 'readly')
	);

	$priority = 0;
	foreach ($networks as $key => $value) {
		$priority++;

		$wp_customize->add_setting( 'readly_social['.$key.']', array(
			'default' 					=> '',
			'type' 							=> 'option',
			'capability' 				=> 'edit_theme_options',
			'sanitize_callback' => 'readly_sanitize_social_networks'
		) );

		$wp_customize->add_control( 'readly_social['.$key.']', array(
			'label' 		=> $value,
			'section' 	=> 'readly_social',
			'type' 			=> 'text',
			'priority' 	=> $priority
		) );
	}

	// Set various built-in site settings to be previewed live in the customizer
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action('customize_register', 'readly_theme_customizer');

/* Add CSS in the head for various options set by the customizer */
function readly_add_customizer_css() {
	$link_colour = readly_sanitize_hex_colour( get_theme_mod( 'readly_link_colour' ) );
	?>
	<!-- Custom styles -->
	<style>
		.entry-content a,
		.entry-content a:visited {
			color: <?php echo $link_colour; ?>;
		}
		.title-block h1,
		.title-block h3,
		.title-block h1 a {
			color: #<?php echo get_theme_mod( 'header_textcolor' ); ?>;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'readly_add_customizer_css' );

/* Sanitize value for blog index option */
function readly_sanitize_blog_index( $content ) {
	if ( 'content' == $content ) {
		return 'content';
	} else {
		return 'excerpt';
	}
}

/* Sanitize hex colours */
function readly_sanitize_hex_colour( $colour ) {
if ( '' === $colour )
	return '';
// 3 or 6 hex digits, or the empty string.
if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $colour ) )
	return $colour;
	return null;
}

/* Sanitize user-entered social media links */
// TODO: Parse URLS to ensure they're correct?
function readly_sanitize_social_networks( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function readly_customize_preview_js() {
	wp_enqueue_script( 'readly_customizer', get_template_directory_uri() . '/js/readly-customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'readly_customize_preview_js' );
