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
	
		<?php do_action( 'before' ); ?>
		<header id="masthead" class="site-header" role="banner">
			
			<div class="site-branding">
				<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
				<h2 class="site-description"><?php bloginfo('description'); ?></h2>
			</div>

			<nav id="site-navigation" class="navigation-main" role="navigation">
				<h1 class="menu-toggle"><?php _e('Menu', 'readly'); ?><span>m</span></h1>
				<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e('Skip to content', 'readly'); ?>"><?php _e('Skip to content', 'readly'); ?></a></div>
				<?php wp_nav_menu(array('theme_location' => 'primary', 'fallback_cb' => false)); ?>
			</nav><!-- .site-navigation -->

		</header><!-- #masthead -->

	<div id="content" class="site-content">
