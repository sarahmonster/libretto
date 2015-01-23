<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section
 *
 * @package Readly
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<header class="nav-bar">
			<div class="site-branding">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			</div>

			<nav id="site-navigation" class="navigation-main" role="navigation">
				<div class="menu-toggle"><?php bloginfo( 'name' ); ?>
					<div id="menu-icon">
					  <span></span>
					  <span></span>
					  <span></span>
					</div>
				</div>
				<div class="screen-reader-text skip-link">
					<a href="#content" title="<?php esc_attr_e( 'Skip to content', 'readly' ); ?>"><?php _e( 'Skip to content', 'readly' ); ?></a>
				</div>
				<div class="menu-wrapper">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb' => false ) ); ?>
					<?php get_search_form(); ?>
				</div>
			</nav><!-- .site-navigation -->
		</header><!-- .header-bar -->

		<header id="masthead" class="site-header" role="banner">
		<?php if ( '' != get_header_image() ): //  Display images here only if user has selected a site-wide header image
			if ( has_post_thumbnail() && is_single() ): // If there's a featured image set, show it
				the_post_thumbnail( 'readly-fullpage' );
			else: // Otherwise, display the header image
			?>
				<img src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>" />
			<?php endif; // Check for featured image ?>
		<?php endif; // Check for header image ?>

			<!-- PAGE HEADER -->
			<div class="title-block">
			<?php if ( is_home() ): // Show the site title & tagline ?>
				<?php if ( function_exists( 'jetpack_the_site_logo' ) ) {
					jetpack_the_site_logo();
				}
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h3 class="site-description"><?php bloginfo( 'description' ); ?></h3>

			<?php elseif ( is_single() ): // Show the post title and metadata for posts ?>
				<div class="entry-meta">
					<?php readly_posted_on(); ?>

				</div><!-- .entry-meta -->
				<h1><?php the_title(); ?></h1>

			<?php elseif ( is_page() ): // Show the page title for pages ?>
				<h1><?php the_title(); ?></h1>

			<?php elseif ( is_archive() ): // Show archive title
				echo the_archive_title( '<h1>', '</h1>' );
				echo the_archive_description( '<h3>', '</h3>' );
			?>

			<?php elseif ( is_404() ): // Show "page not found" ?>
				<h1><?php _e( '404 Error', 'readly' ); ?></h1>
				<h3><?php _e( 'Oops! That page can&rsquo;t be found.', 'readly' ); ?></h3>

			<?php elseif ( is_search() ): // Search results ?>
				<h1><?php _e( 'Search results', 'readly' ); ?></h1>
				<h3><?php printf( __( 'You searched for %s', 'readly' ), '<span>' . get_search_query() . '</span>' ); ?></h3>

			<?php elseif ( is_attachment() ): // Show image attachment data ?>
				<div class="entry-meta">
				<?php
					printf( __( 'Posted <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span>', 'readly' ),
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() )
					);
				// Check to see if we have a parent properly set
				if ( $post->post_parent ) {
					printf( __( ' in <a href="%1$s" title="Return to %2$s" rel="gallery">%3$s</a>', 'readly' ),
					get_permalink( $post->post_parent ),
					esc_attr( get_the_title( $post->post_parent ) ),
					get_the_title( $post->post_parent )
					);
				}
				?>
				</div>
				<h1><?php the_title(); ?></h1>

			<?php endif; ?>

			</div><!-- .title-block -->

		</header><!-- #masthead -->
