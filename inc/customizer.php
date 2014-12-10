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

}
add_action('customize_register', 'readly_theme_customizer');


/* Sanitize value for blog index option */
function readly_sanitize_blog_index( $content ) {
	if ( 'content' == $content ) {
		return 'content';
	} else {
		return 'excerpt';
	}
}

// Sanitize user-entered social media links 
// TODO: Parse URLS to ensure they're correct? 
function readly_sanitize_social_networks( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function readly_header_output() {
}

add_action('wp_head', 'readly_header_output');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 */
function readly_customize_preview_js() {
	wp_enqueue_script( 'readly_customizer', get_template_directory_uri().'/js/customizer.js', array( 'customize-preview' ), '20140331', true );
}
add_action('customize_preview_init', 'readly_customize_preview_js');
