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
	$content_width = 920; /* pixels */
}

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
	add_image_size('readly-gallery', 436, 436, true);
	add_image_size('readly-full', 920);

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
    
		if ( 'off' !== $libre_baskerville ) {
		    $font_families = array();
		 
		    if ( 'off' !== $libre_baskerville ) {
		        $font_families[] = 'Libre Baskerville:400,700,400italic';
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

	// Media (TODO: simplify)
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri().'/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

	// Media elements (TODO: simplify)
	wp_enqueue_script( 'wp-mediaelement' );
	wp_enqueue_style( 'wp-mediaelement' );

	// TODO: Replace me with non-inline styles
	$css = '.gallery .gallery-item { max-width: '.get_option('thumbnail_size_w').'px; }';
	wp_add_inline_style( 'readly-style', $css );

	// Fancybox (TODO: review)
	wp_enqueue_style( 'fancybox-style', get_template_directory_uri().'/fancybox/jquery.fancybox.css?v=2.1.5' );
	wp_enqueue_script( 'fancybox', get_template_directory_uri().'/fancybox/jquery.fancybox.js', array( 'jquery' ), '3b1', true );

	// Responsive video (TODO: simplify)
	wp_enqueue_script( 'wpshower-responsive-videos', get_template_directory_uri().'/js/wpshower-responsive-videos.js', array( 'jquery' ), '20140331', true );
	wp_enqueue_script( 'jquery-mousewheel', get_template_directory_uri().'/js/jquery.mousewheel.js', array( 'jquery' ), '3.1.6', true );

	// Infinite Scroll (TODO: review)
	if ( !is_singular() && 'infinite-scroll' == get_theme_mod( 'page_navigation' ) )
		wp_enqueue_script( 'infinite-scroll', get_template_directory_uri().'/js/jquery.infinitescroll.min.js', array( 'jquery' ), '2.0b.110415', true );
}
add_action( 'wp_enqueue_scripts', 'readly_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';
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

// This theme uses its own gallery styles.
add_filter('use_default_gallery_style', '__return_false');

// updated form for password protected posts
function readlyPasswordForm($content) {
	$before = array('>Password: <input name="post_password" id="');
	$after = array('><input name="post_password" placeholder="Password" class="password_protected" id=');
	$content = str_replace($before, $after, $content);
	return $content;
}
add_filter('the_password_form', 'readlyPasswordForm');

// infinite scroll
function readly_infinite_scroll_js() {
	if (is_singular() || 'infinite-scroll' != get_theme_mod('page_navigation')) return;
?>
	<script type="text/javascript">
		jQuery(function() {
			var infinite_scroll = {
				loading: {
					img: "<?php echo get_stylesheet_directory_uri(); ?>/icons/loadmore.svg",
					msgText: "",
					finishedMsg: "<?php _e('The End', 'readly'); ?>"
				},
				'nextSelector': '#nav-below .previous a',
				'navSelector': '#nav-below',
				'itemSelector': 'article',
				'contentSelector': '#content'
			};
			jQuery(infinite_scroll.contentSelector).infinitescroll(infinite_scroll, function(arrayOfNewElems) {
				fixLinks();
				var items = jQuery(arrayOfNewElems);
				items.find('.entry-video').wpShowerResponsiveVideos();
				items.find('audio,video').mediaelementplayer();
			});
		});
	</script>
<?php
}
add_action('wp_footer', 'readly_infinite_scroll_js', 100);

class wpShower {
	public static $color = '#1e83cb';
	private static $gallery = null;

	public static function catchGallery($output) {
		$preg = preg_match_all('/\[gallery(.*?)ids="(.*?)"\]/', $output, $match);
		if ($preg) {
			$disable_fancybox = get_theme_mod('readly_fancybox');
			foreach ($match[0] as $key => $gallery) {
				if (trim($match[2][$key]) == '') {
					continue;
				}
				$attachments = explode(',', $match[2][$key]);
				if (get_post_format(get_the_ID()) == 'gallery' && self::$gallery == null) {
					self::$gallery = $disable_fancybox ? $gallery : $attachments;
					$output = str_replace($gallery, '', $output);
				} elseif (!$disable_fancybox) {
					$output = str_replace($gallery, readly_formatted_gallery($attachments), $output);
				}
			}
		}
		return $output;
	}

	private static function getGallery() {
		$results = self::$gallery;
		self::$gallery = null;
		return $results;
	}

	/**
	 * Function to get the content earlier than it needs to be printed; shortcodes are catched this way
	 */
	public static function filteredContent($content = null) {
		if ($content === null) {
			$content = get_the_content(__('Read More', 'readly'));
			$content = apply_filters('the_content', $content);
		} else {
			global $wp_embed;
			$content = do_shortcode($content);
			$content = $wp_embed->autoembed($content);
		}
		$content = str_replace('<p></p>', '', $content); // TODO: fix it (youtube embed adds empty paragraphs?)
		return str_replace(']]>', ']]&gt;', $content);
	}

	public static function getContentAndAttachments() {
		$content = self::filteredContent();
		return array('content' => $content, 'attachments' => self::getGallery());
	}
}

add_filter('the_content', array('wpShower', 'catchGallery'), 1, 1);

/* Audio & video boxes for posts */
function readly_big_video_box($post) {
	$value = get_post_meta($post->ID, 'readly_big_video', true);
	?>
	<p>
		<textarea id="readly_big_video" name="readly_big_video" rows="4" cols="40" placeholder="<?php _e('Enter your video link, embed code or shortcode here:', 'readly'); ?>"><?php echo $value ?></textarea>
	</p>
	<?php
}

function readly_big_audio_box($post) {
	$value = get_post_meta($post->ID, 'readly_big_audio', true);
	?>
	<p>
		<textarea id="readly_big_audio" name="readly_big_audio" rows="4" cols="40" placeholder="<?php _e('Enter your audio link, embed code or shortcode here:', 'readly'); ?>"><?php echo $value ?></textarea>
	</p>
	<?php
}

function readly_boxes() {
	add_meta_box(
		'readly_big_video_box',
		__('Video', 'readly'),
		'readly_big_video_box',
		'post',
		'normal',
		'high'
	);
	add_meta_box(
		'readly_big_audio_box',
		__('Audio', 'readly'),
		'readly_big_audio_box',
		'post',
		'normal',
		'high'
	);
}

add_action('add_meta_boxes', 'readly_boxes');

/* Save action for posts */
function readly_save_postdata($post_id) {
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return $post_id;

	if (!isset($_POST['post_type'])) {
		return $post_id;
	}

	// First we need to check if the current user is authorised to do this action.
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id))
			return;
	}
	else {
		if (!current_user_can('edit_post', $post_id))
			return;
	}

	if ($_POST['post_type'] == 'post') {
		$media = array('audio' => false, 'video' => false);
		$format = get_post_format(get_the_ID());
		if ($format == 'audio' || $format == 'video') $media[$format] = true;
		foreach ($media as $key => $save) {
			if ($save) {
				$value = isset($_POST['readly_big_'.$key]) ? $_POST['readly_big_'.$key] : '';
				if (!update_post_meta($post_id, 'readly_big_'.$key, $value)) {
					add_post_meta($post_id, 'readly_big_'.$key, $value, true);
				}
			}
			else {
				update_post_meta($post_id, 'readly_big_'.$key, '');
			}
		}
	}
}

add_action('save_post', 'readly_save_postdata');

function readly_formatted_audio() {
	if (post_password_required()) return;

	$meta = get_post_meta(get_the_ID(), 'readly_big_audio', true);
	$meta = wpShower::filteredContent($meta);
	$local = strpos($meta, 'wp-audio-shortcode') !== false ? true : false;
	?>

	<div class="entry-media entry-audio<?php if (!$local) echo ' entry-audio-embed'; ?>">
		<?php echo $meta; ?>
	</div><!-- .entry-media -->

	<?php
}

function readly_formatted_video() {
	if (post_password_required()) return;

	$meta = get_post_meta(get_the_ID(), 'readly_big_video', true);
	?>

	<div class="entry-media entry-video">
		<div class="video-content">
			<?php echo wpShower::filteredContent($meta); ?>
		</div>
	</div><!-- .entry-media -->

	<?php
}

function readly_formatted_image() {
	if (post_password_required()) return;

	$thumbnail_id = get_post_thumbnail_id(get_the_ID());
	if ($thumbnail_id == '') return;

	$src = wp_get_attachment_image_src($thumbnail_id, 'readly-full');
	if (!isset($src[0])) return;
	?>

	<div class="entry-media entry-image">
		<a href="<?php the_permalink(); ?>"><img src="<?php echo $src[0]; ?>" alt="<?php the_title_attribute(); ?>" /></a>
	</div><!-- .entry-media -->

	<?php
}

function readly_formatted_gallery($attachments, $class = '') {
	if (is_string($attachments)) {
		return '<div class="readly_big">'.wpShower::filteredContent($attachments).'</div>';
	}
	$html = '<div class="template-gallery'.($class != '' ? ' '.$class : '').'">
	<div class="gallery-wrapper">';
	foreach ($attachments as $attachment):
		$image = get_post($attachment);
		$src = wp_get_attachment_image_src($attachment, 'full');
		$thumbnail_link = wp_get_attachment_image_src($attachment, 'readly-gallery');
		$html .= '<a class="fancybox" rel="group" href="'.esc_url($src[0]).'" title="'.esc_attr($image->post_excerpt).'"><img src="'.esc_url($thumbnail_link[0]).'" alt="" /></a>';
	endforeach;
	$html .= '	</div>
</div>';
	return $html;
}
