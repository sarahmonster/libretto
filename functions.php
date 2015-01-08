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

/**
 * Set gallery shortcode defaults
 */
function readly_gallery_atts( $out, $pairs, $atts ) {
	$atts = shortcode_atts( array(
		'columns' => '3',
		'size'    => 'gallery',
	), $atts );

	$out['columns'] = $atts['columns'];
	$out['size'] = $atts['size'];

	return $out;
}
add_filter( 'shortcode_atts_gallery', 'readly_gallery_atts', 10, 3 );

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
		 * Add an image size for galleries
		 */
		add_image_size( 'gallery', 400, 400, true );

		/**
		 * This theme uses wp_nav_menu() in two locations:
		 * one at the top of the page, and one for social media links in the footer
		 */
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'readly' ),
			'social' => __( 'Social Media Menu', 'readly' ),
		) );

		/**
		 * Enable support for Post Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside', 'audio', 'chat', 'gallery', 'image', 'quote', 'status', 'link', 'video',
		) );

		/**
		 * Enable support for custom background
		 */
		add_theme_support( 'custom-background', array(
			'default-color'          => '#eae9e6',
			'default-image'          => '',
			'wp-head-callback'       => '_custom_background_cb',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
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
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Second Footer Sidebar', 'readly' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Third Footer Sidebar', 'readly' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Fourth Footer Sidebar', 'readly' ),
		'id'            => 'sidebar-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
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
	wp_enqueue_script( 'readly-script', get_template_directory_uri().'/js/readly.js', array(), '20140331' );

	// Fonts
	wp_enqueue_style( 'readly-fonts', readly_fonts_url(), array(), null );
	wp_enqueue_style( 'custom-icons', get_template_directory_uri().'/readly-icons/icons.css', array(), null );


	// Navigation
	wp_enqueue_script( 'touche', get_template_directory_uri().'/js/touche.min.js', array(), '20150108', true );
	wp_enqueue_script( 'navigation', get_template_directory_uri().'/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri().'/js/skip-link-focus-fix.js', array(), '20130115', true );

	// Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'readly_scripts' );

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
function remove_jetpack_stylesheets() {
    wp_deregister_style('grunion.css');
}
add_action('wp_enqueue_scripts', 'remove_jetpack_stylesheets');

/**
 * Add a search box to the primary menu, and an RSS link to the social media menu
 */
function readly_add_menu_items( $items, $args ) {
  if ( 'primary' === $args->theme_location ):
  	$items .= '<li>' . get_search_form( false ) . '</li>';
  elseif ( 'social' === $args->theme_location ):
  	$items .= '<li><a href="' . get_feed_link() . '" class="icon-rss"><span>' . __( 'RSS', 'readly' ) . '</span></a>';
  endif;
return $items;
}
add_filter( 'wp_nav_menu_items', 'readly_add_menu_items', 10, 2 );

/**
 * Customize the password form a smidge
 */
function readly_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$password_form = __( "This post is password-protected. To read it, please enter the password below.", 'readly' ) .
		'<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post"><label for="' . $label . '">' . __( 'Password:', 'readly' ) . ' </label><input title="Password" placeholder="Password" name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" /><p class="form-submit"><input type="submit" name="Submit" value="' . esc_attr__( "Submit", 'readly' ) . '" /></p>
    </form>';
	return $password_form;
}
add_filter( 'the_password_form', 'readly_password_form' );

/**
 * Add custom post class for password-protected posts
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
 * Improve excerpt display and output
 */
 function readly_better_excerpt( $text ) { // Fakes an excerpt if needed
	global $post;
	if ( '' === $text ) {
		$text = get_the_content( '' );
		$text = apply_filters( 'the_content', $text );
		$text = str_replace( '\]\]\>', ']]&gt;', $text );
		$text = strip_tags( $text, '<p><img><blockquote><cite><figure><figcaption><a>' ); // Allow certain HTML tags only
		$excerpt_length = 45;
		$words = explode( ' ', $text, $excerpt_length + 1 );
		if ( count( $words ) > $excerpt_length ) {
			array_pop( $words );
			$text = implode( ' ', $words )  . '&hellip;';
		}
	}
	return $text;
}
remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
add_filter( 'get_the_excerpt', 'readly_better_excerpt' );

function readly_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'readly_excerpt_more' );

/**
 * Make sure quote post types use a blockquote
 */
function add_blockquote_to_quote( $content ) {
	if ( is_singular() || is_archive() || is_home() ):
		// Only run on quote post types, and only for those that don't already contain a blockquote
		// Note: we look for "<blockquote" specifically so as to catch instances of blockquotes with additional attributes
		if ( 'quote' === get_post_format() && strpos( $content, '<blockquote' ) === false) {
	    $content = "<blockquote>$content</blockquote>";
		}
	endif;
	return $content;
}
add_filter( 'the_content', 'add_blockquote_to_quote' );
add_filter( 'get_the_excerpt', 'add_blockquote_to_quote' );
