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

	// Colors
	$wp_customize->add_section('readly_colors', array(
		'title' => __('Colors', 'readly'),
		'priority' => 35,
		'capability' => 'edit_theme_options',
		'description' => __('Allows you to customize some colors.', 'readly')
	));
	$wp_customize->add_setting('readly_color', array(
		'default' => '#457690',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'readly_color',
		array(
			'label' => __('Color', 'readly'),
			'section' => 'readly_colors',
			'settings' => 'readly_color',
			'priority' => 10,
		)
	));

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

	// Page navigation
	$wp_customize->add_section('page_navigation', array(
		'title' => __('Page Navigation', 'readly'),
		'priority' => 100,
	));
	$wp_customize->add_setting('page_navigation', array(
		'default' => 'standard',
		'sanitize_callback' => 'sanitize_key',
	));
	$wp_customize->add_control('page_navigation', array(
		'section' => 'page_navigation',
		'type' => 'select',
		'choices' => array(
			'standard' => __('Standard', 'readly'),
			'ajax-fetch' => __('Load More Button', 'readly'),
			'infinite-scroll' => __('Infinite Scroll', 'readly'),
		),
	));
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
	/*
	$color = get_option('readly_color', wpShower::$color);

	echo '<style type="text/css" id="custom-background-css">
a {
	color: '.$color.';
}
.entry-content a {
	-webkit-transition: border-bottom-color 0.2s linear;
	-moz-transition: border-bottom-color 0.2s linear;
	-o-transition: border-bottom-color 0.2s linear;
	transition: border-bottom-color 0.2s linear;
}
.entry-content a:hover {
	border-bottom-color: '.$color.';
}
#masthead .site-title a, #site-navigation a, .sub-menu a, #nav-below a, .entry-title a, #image-navigation a {
	-webkit-transition: color 0.2s linear;
	-moz-transition: color 0.2s linear;
	-o-transition: color 0.2s linear;
	transition: color 0.2s linear;
}
#masthead .site-title a:hover, #nav-below a:hover, .entry-title a:hover, #image-navigation a:hover {
	color: '.$color.';
}
#s, #commentform input[type="text"], #commentform textarea, .password_protected, #social a, a.more-link {
	-webkit-transition: background-color 0.2s linear;
	-moz-transition: background-color 0.2s linear;
	-o-transition: background-color 0.2s linear;
	transition: background-color 0.2s linear;
}
a.more-link span {
	-webkit-transition: border-left-color 0.2s linear;
	-moz-transition: border-left-color 0.2s linear;
	-o-transition: border-left-color 0.2s linear;
	transition: border-left-color 0.2s linear;
}
#s:focus, #commentform input[type="text"]:focus, #commentform textarea:focus, .password_protected:focus {
	background-color: #fff;
}
#social a:hover {
	background-color: '.$color.';
}
a.more-link:hover {
	background-color: '.$color.';
}
a.more-link:hover span {
	border-left-color: '.$color.';
}
.entry-meta a, footer .site-info a, #comments a, .link_post_p a {
	-webkit-transition: color 0.2s linear, border-bottom-color 0.2s linear;
	-moz-transition: color 0.2s linear, border-bottom-color 0.2s linear;
	-o-transition: color 0.2s linear, border-bottom-color 0.2s linear;
	transition: color 0.2s linear, border-bottom-color 0.2s linear;
}
.entry-meta a:hover, footer .site-info a:hover, #comments a:hover, #comments a#cancel-comment-reply-link:hover, .link_post_p a:hover {
	color: '.$color.';
	border-bottom-color: '.$color.';
}
@media only screen and (min-width : 641px) {
	#site-navigation a:hover, .sub-menu a:hover {
		color: '.$color.';
	}
}
html {
	position: relative;'.(is_admin_bar_showing() ? '
	min-height: -moz-calc(100% - 32px);
	min-height: -webkit-calc(100% - 32px);
	min-height: calc(100% - 32px);' : '
	min-height: 100%;').'
}
.hentry .mejs-controls .mejs-time-rail .mejs-time-current {
	background: '.$color.';
}
</style>
<script type="text/javascript">
var hover_color = "'.$color.'";
</script>';
*/
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
