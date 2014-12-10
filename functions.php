<?php
/**
 * Readly functions and definitions
 *
 * @package Readly
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset($content_width) ) {
	$content_width = 720; /* 680px wide plus a 40px buffer */
}

// Adds gallery shortcode defaults of size="medium" and columns="2"  

function readly_gallery_atts( $out, $pairs, $atts ) {
    $atts = shortcode_atts( array(
      'columns' => '3',
      'size' => 'gallery',
    ), $atts );
 
    $out['columns'] = $atts['columns'];
    $out['size'] = $atts['size'];
 
    return $out;
 
}
add_filter( 'shortcode_atts_gallery', 'readly_gallery_atts', 10, 3 );

if ( ! function_exists('readly_setup') ) :
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
	load_theme_textdomain('readly', get_template_directory().'/languages');

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support('automatic-feed-links');

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support('post-thumbnails');

	/**
	 * Add an image size for galleries
	 */
	add_image_size('gallery', 400, 400, true);

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus(array(
		'primary' => __('Primary Menu', 'readly'),
	));

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support('post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'quote', 'status', 'link', 'video'
	));

	/**
	 * Enable support for Infinite Scroll
	 */
	add_theme_support( 'infinite-scroll', array(
    'container' => 'content',
    'footer' 		=> 'page'
	) );

	/**
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );
}
endif; // readly_setup
add_action('after_setup_theme', 'readly_setup');

/**
 * Register widgetized area and update sidebar with default widgets
 */
function readly_widgets_init() {
	register_sidebar( array(
		'name'          => __('First Footer Sidebar', 'readly'),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	));
	register_sidebar( array(
		'name'          => __('Second Footer Sidebar', 'readly'),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	));
	register_sidebar( array(
		'name'          => __('Third Footer Sidebar', 'readly'),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	));
	register_sidebar( array(
		'name'          => __('Fourth Footer Sidebar', 'readly'),
		'id'            => 'sidebar-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	));
}
add_action('widgets_init', 'readly_widgets_init');

/**
 * Generate URLs for our custom fonts (via Google)
 */
function readly_fonts_url() {
    $fonts_url = '';
		 
		/* Translators: If there are characters in your language that are not
		* supported by Open Sans, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$libre_baskerville = _x( 'on', 'Libre Baskerville font: on or off', 'ready' );
		$montserrat = _x( 'on', 'Montserrat font: on or off', 'ready' );
		$playfair_display = _x( 'on', 'Playfair Display font: on or off', 'ready' );
    
		if ( 'off' !== $libre_baskerville || 'off' !== $montserrat || 'off' !== $playfair_display ) {
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

		    $query_args = array(
    			'family' => urlencode( implode( '|', $font_families ) ),
    			'subset' => urlencode( 'latin,latin-ext' ),
				);

				$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		}

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
	wp_enqueue_style( 'custom-icons', 'https://fontastic.s3.amazonaws.com/MpssqMLH2xJjPZ9ercTgGh/icons.css', array(), null );

	// JQuery & JQuery UI
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui', get_template_directory_uri().'/js/jquery-ui-1.10.2.custom.min.js', array(), '20130317' );
	
	// Navigation (TODO: simplify)
	wp_enqueue_script( 'navigation', get_template_directory_uri().'/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri().'/js/skip-link-focus-fix.js', array(), '20130115', true );

	// Comments
	if ( is_singular() && comments_open() && get_option('thread_comments') ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'readly_scripts' );

/**
 * Implement the Custom Header feature.
 */
$args = array(
	'flex-width'    => true,
	'width'         => 980,
	'flex-height'    => true,
	'height'        => 200,
);
add_theme_support( 'custom-header', $args );


function readly_custom_header_fonts() {
    wp_enqueue_style( 'readly-fonts', readly_fonts_url(), array(), null );
}
add_action( 'admin_print_styles-appearance_page_custom-header', 'readly_scripts_styles' );

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

// Editor admin styles
function readly_admin_scripts_styles() {
	wp_enqueue_style( 'readly-admin-style', get_template_directory_uri().'/admin.css' );
	wp_enqueue_script( 'readly-admin', get_template_directory_uri().'/js/admin.js', array(), '20140331', true );
	add_editor_style( array( 'editor-style.css', readly_fonts_url() ) );
}
add_action('admin_enqueue_scripts', 'readly_admin_scripts_styles');

// Customize the password form just a smidge
function readly_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $password_form = __( "This post is password-protected. To read it, please enter the password below.", 'readly' ) .
    '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post"><label for="' . $label . '">' . __( "Password:", 'readly' ) . ' </label><input title="Password" placeholder="Password" name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" /><p class="form-submit"><input type="submit" name="Submit" value="' . esc_attr__( "Submit", 'readly' ) . '" /></p>
    </form>';
    return $password_form;
}
add_filter( 'the_password_form', 'readly_password_form' );

// Add custom post class for password-protected posts
function readly_password_protected_class( $classes ) {
	global $post;
	if ( post_password_required( $post ) ) {
		$classes[] = "password-protected";
	}
	return $classes;
}
add_filter( 'post_class', 'readly_password_protected_class' );
