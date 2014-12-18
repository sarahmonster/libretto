<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Readly
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<!--[if lt IE 9]>
			<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
		<![endif]-->

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<header class="nav-bar">
			<div class="site-branding">
				<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
			</div>

			<nav id="site-navigation" class="navigation-main" role="navigation">
				<h1 class="menu-toggle"><?php _e('Menu', 'readly'); ?><span>n</span></h1>
				<div class="screen-reader-text skip-link">
					<a href="#content" title="<?php esc_attr_e('Skip to content', 'readly'); ?>"><?php _e('Skip to content', 'readly'); ?></a>
				</div>
				<?php wp_nav_menu(array('theme_location' => 'primary', 'fallback_cb' => false)); ?>
			</nav><!-- .site-navigation -->
		</header><!-- .header-bar -->

		<header id="masthead" class="site-header" role="banner">
		<?php
		// Show a custom header if one is set
		if ( '' != get_header_image() || has_post_thumbnail() ): ?>
		<div class="header-image">
		<?php if ( has_post_thumbnail() && is_single() ):
			// Show the featured image instead
			the_post_thumbnail( 'full' );
		else: ?>
			<img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" />
		<?php endif; ?>

		<div class="title-block">
		<?php if ( is_home() ): // Show the site title & tagline ?>
			<h1><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
			<h3><?php bloginfo('description'); ?></h3>

		<?php elseif ( is_single() ): // Show the post title and metadata for posts ?>
			<div class="entry-meta">
				<?php readly_posted_on(); ?>
			</div><!-- .entry-meta -->
			<h1><?php the_title(); ?></h1>

		<?php elseif ( is_page() ): // Show the page title for pages ?>
			<h1><?php the_title(); ?></h1>
		<?php endif; ?>

		</div><!-- .title-block -->
		<?php endif; ?>

		</header><!-- #masthead -->
