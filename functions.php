<?php
/**
 * Readly functions and definitions
 *
 * @package Readly
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 720; /* 680px wide plus a 40px buffer */
}

if ( ! function_exists( 'readly_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 */
	function readly_setup() {

		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on Readly, use a find and replace
		 * to change 'readly' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'readly', get_template_directory().'/languages' );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add custom image sizes for:
		 * 1. The site logo
		 * 2. Large images that overlap the content area a smidge
		 * 3. Full-page images (primarily used for featured images)
		 */
		add_image_size( 'readly-logo', 200, 200, false );
		add_image_size( 'readly-oversized', 900, 600, false );
		add_image_size( 'readly-fullpage', 1600, 1000, false );

		/**
		 * This theme uses wp_nav_menu() in two locations:
		 * one at the top of the page, and one for social media links in the footer
		 */
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'readly' ),
			'social'  => __( 'Social Media Menu', 'readly' ),
		) );

		/**
		 * Enable support for Post Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside', 'image', 'video', 'quote', 'link', 'audio', 'chat', 'gallery', 'status',
		) );

		/**
		 * Enable support for custom background
		 */
		add_theme_support( 'custom-background', array(
			'default-color' => '#eae9e6',
		) );

		/**
		 * Enable support for site logo
		 */
		add_theme_support( 'site-logo', array(
    	'size' => 'readly-logo',
		) );

		/**
		 * Enable support for proper titles
		 */
	  add_theme_support( 'title-tag' );

	  /**
 		* Use editor admin styles.
 		*/
		add_editor_style( array( 'css/editor-style.css', readly_fonts_url() ) );

		/**
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
		) );

		/**
		 * Add theme support for Jetpack responsive videos
		 */
		add_theme_support( 'jetpack-responsive-videos' );

		/*
		* Add default print styles. TODO: Add proper print styles.
		*/
		add_theme_support( 'print-style' );

	} // readly_setup()
endif;
add_action( 'after_setup_theme', 'readly_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function readly_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'First Footer Sidebar', 'readly' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Second Footer Sidebar', 'readly' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Third Footer Sidebar', 'readly' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Fourth Footer Sidebar', 'readly' ),
		'id'            => 'sidebar-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'readly_widgets_init' );

/**
 * Generate URLs for our custom fonts (via Google)
 */
function readly_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Open Sans, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$libre_baskerville = _x( 'on', 'Libre Baskerville font: on or off', 'readly' );
	$montserrat = _x( 'on', 'Montserrat font: on or off', 'readly' );
	$playfair_display = _x( 'on', 'Playfair Display font: on or off', 'readly' );
	$droid_mono = _x( 'on', 'Droid Sans Mono font: on or off', 'readly' );

	if ( 'off' !== $libre_baskerville || 'off' !== $montserrat || 'off' !== $playfair_display || 'off' !== $droid_mono ):
		$font_families = array();

		if ( 'off' !== $libre_baskerville ) {
			$font_families[] = 'Libre Baskerville:400,700,400italic';
		}

		if ( 'off' !== $playfair_display ) {
			$font_families[] = 'Playfair Display:400,700,900,400italic,700italic,900italic';
		}

		if ( 'off' !== $montserrat ) {
			$font_families[] = 'Montserrat:400,700';
		}

		if ( 'off' !== $droid_mono ) {
			$font_families[] = 'Droid Sans Mono:400';
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	endif;

	return $fonts_url;
}

/**
 * Enqueue scripts and styles
 */
function readly_scripts() {

	// General site stylesheet & JS
	wp_enqueue_style( 'readly-style', get_stylesheet_uri() );
	wp_enqueue_script( 'readly-script', get_template_directory_uri().'/js/readly.js', array( 'jquery' ), '20140331' );

	// Fonts
	wp_enqueue_style( 'readly-fonts', readly_fonts_url(), array(), null );
	wp_enqueue_style( 'readly-custom-icons', get_template_directory_uri().'/readly-icons/icons.css', array(), null );


	// Navigation
	wp_enqueue_script( 'readly-touche', get_template_directory_uri().'/js/touche.min.js', '20150108', true );
	wp_enqueue_script( 'readly-navigation', get_template_directory_uri().'/js/navigation.js', array( 'jquery' ), '20150115', true );
	wp_enqueue_script( 'readly-skip-link-focus-fix', get_template_directory_uri().'/js/skip-link-focus-fix.js', array(), '20130115', true );

	// Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'readly_scripts' );

/**
 * Remove scripts for Jetpack's sharing function
 */
function readly_nix_sharedaddy_script() {
	remove_action( 'wp_head', 'sharing_add_header', 1 );
}
add_action( 'template_redirect', 'readly_nix_sharedaddy_script' );

/**
 * Remove styles for contact form
 */
function readly_remove_jetpack_stylesheets() {
    wp_deregister_style( 'grunion.css' );
}
add_action( 'wp_enqueue_scripts', 'readly_remove_jetpack_stylesheets' );

/**
 * Create a reusable array of available sidebars.
 * Used in sidebar.php and in inc/jetpack.php to adjust footer area according to usage.
 */
function readly_get_active_sidebars() {
  // Loop through all possible sidebar areas to determine if they're active or not
  $available_sidebars = array( "sidebar-1", "sidebar-2", "sidebar-3", "sidebar-4" );
  $active_sidebars = array();

  foreach ( $available_sidebars as $sidebar_name ):
    if ( is_active_sidebar( $sidebar_name ) ) {
      $active_sidebars[] = $sidebar_name;
    }
  endforeach;
  return $active_sidebars;
}

/**
 * The default password form wraps the input box in a label, making it difficult to hide the text.
 * Using a placeholder & intro text means that a label here is largely redundant, and the form looks
 * better if we can fit the password box and the submit button on a single line (on larger screens).
 * This outputs a slightly altered password form that doesn't wrap the label around the input.
 */
function readly_password_form() {
	global $post;
	$label = esc_attr__( 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID ) );
	$password_form = __( "This post is password-protected. To read it, please enter the password below.", 'readly' ) .
		'<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post"><label for="' . $label . '">' . __( 'Password:', 'readly' ) . ' </label><input title="' . __( 'Password', 'readly' ) .'" placeholder="' . __( 'Password', 'readly' ) .'"  name="' . __( 'password', 'readly' ) .'" id="' . $label . '" type="password" size="20" maxlength="20" /><p class="form-submit"><input type="submit"  name="' . __( 'submit', 'readly' ) .'" value="' . esc_attr__( "Submit", 'readly' ) . '" /></p>
    </form>';
	return $password_form;
}
add_filter( 'the_password_form', 'readly_password_form' );

/**
 * Add custom post class for password-protected posts
 * so that we can add an icon specific to these posts
 */
function readly_password_protected_class( $classes ) {
	global $post;
	if ( post_password_required( $post ) ) {
		$classes[] = 'password-protected';
	}
	return $classes;
}
add_filter( 'post_class', 'readly_password_protected_class' );

/**
* Add a custom body class depending on whether or not a background image is being used.
* Depending on whether we're using a header image or not, the masthead is styled a bit differently.
*/
function readly_add_header_class_to_body( $classes ) {
	if ( '' != get_header_image() ):
		$classes[] = "header-image";
	else:
		$classes[] = "empty-header";
	endif;
	return $classes;
}
add_filter( 'body_class','readly_add_header_class_to_body' );

/**
 * Use a bare ellipsis after post excerpts.
 */
function readly_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'readly_excerpt_more' );

/**
 * Add a blockquote tag around the content of a quote post format,
 * if the content of the post doesn't already contain one.
 */
function readly_add_blockquote_to_quote( $content ) {
	if ( is_singular() || is_archive() || is_home() ):
		// Only run on quote post types, and only for those that don't already contain a blockquote
		// Note: we look for "<blockquote" specifically so as to catch instances of blockquotes with additional attributes
		if ( 'quote' === get_post_format() && strpos( $content, '<blockquote' ) === false) {
	    $content = '<blockquote>' . $content . '</blockquote>';
		}
	endif;
	return $content;
}
add_filter( 'the_content', 'readly_add_blockquote_to_quote' );
add_filter( 'get_the_excerpt', 'readly_add_blockquote_to_quote' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
