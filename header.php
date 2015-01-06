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
		<!--[if lt IE 9]>
			<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
		<![endif]-->

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<header class="nav-bar">
			<div class="site-branding">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			</div>

			<nav id="site-navigation" class="navigation-main" role="navigation">
				<h1 class="menu-toggle"><?php bloginfo( 'name' ); ?><span>n</span></h1>
				<div class="screen-reader-text skip-link">
					<a href="#content" title="<?php esc_attr_e( 'Skip to content', 'readly' ); ?>"><?php _e( 'Skip to content', 'readly' ); ?></a>
				</div>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb' => false ) ); ?>
			</nav><!-- .site-navigation -->
		</header><!-- .header-bar -->

	<?php // We style the masthead differently if it contains a header image or not, so we're using a class to simplify things
	if ( '' != get_header_image() ) {
		$header_class = "header-image";
	} else {
		$header_class = "empty";
	}
	?>

		<header id="masthead" class="site-header <?php echo $header_class; ?>" role="banner">
		<?php if ( 'header-image' == $header_class ): //  Display images here only if user has selected a site-wide header image
			if ( has_post_thumbnail() && is_single() ): // If there's a featured image set, show it
				the_post_thumbnail( 'full' );
			else: // Otherwise, display the header image
			?>
				<img src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>" />
			<?php endif; // Check for featured image ?>
		<?php endif; // Check for header image ?>

			<!-- PAGE HEADER -->
			<div class="title-block">
			<?php if ( is_home() ): // Show the site title & tagline ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h3 class="site-description"><?php bloginfo( 'description' ); ?></h3>

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

			<?php elseif ( is_single() ): // Show the post title and metadata for posts ?>
				<div class="entry-meta">
					<?php readly_posted_on(); ?>
				</div><!-- .entry-meta -->
				<h1><?php the_title(); ?></h1>

			<?php elseif ( is_page() ): // Show the page title for pages ?>
				<h1><?php the_title(); ?></h1>

			<?php elseif ( is_category() ): // Show the category name and description for category pages ?>
				<h1><?php printf( __( 'Posted <em>under</em> %s', 'readly' ), strtolower( single_cat_title( '', false ) ) ); ?></h1>
				<?php
				$category_description = category_description();
				if ( ! empty( $category_description ) ) {
					echo apply_filters( 'category_archive_meta', '<h3>'.$category_description.'</h3>' );
				}
				?>

			<?php elseif ( is_404() ): // Show "page not found" ?>
				<h1><?php _e( 'Uh oh!', 'readly' ); ?></h1>
				<h3><?php _e( 'Page not found', 'readly' ); ?></h3>

			<?php elseif ( is_search() ): // Search results ?>
				<h1><?php _e( 'Search results', 'readly' ); ?></h1>
				<h3><?php printf( __( 'You searched for %s', 'readly' ), '<span>' . get_search_query() . '</span>' ); ?></h3>

			<?php elseif ( is_tag() ): // Show the tag name ?>
				<h1><?php printf( __( 'Tagged <em>with</em> %s', 'readly' ), single_tag_title( '', false ) ); ?></h1>
				<?php
				$tag_description = tag_description();
				if ( ! empty( $tag_description ) ) {
					echo apply_filters( 'tag_archive_meta', '<h3>'.$tag_description.'</h3>' );
				}
			?>

			<?php elseif ( is_author() ): // Show author details
				// Queue the first post, so we know what author we're dealing with (if that is the case).
				the_post();
				printf( __( 'Author Archives: %s', 'readly' ), '<span class="vcard"><a class="url fn n" href="'.esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ).'" title="'.esc_attr( get_the_author() ).'" rel="me">'.get_the_author().'</a></span>' );
				// Since we called the_post() above, we need to rewind the loop
				rewind_posts();
			?>

			<?php elseif ( is_day() ): // Daily archives ?>
				<h1><?php echo printf( __( 'Daily Archives: %s', 'readly' ), '<span>'.get_the_date().'</span>' ); ?></h1>

			<?php elseif ( is_month() ): // Monthly archives ?>
				<h1><?php echo printf( __( 'Monthly Archives: %s', 'readly' ), '<span>'.get_the_date( 'F Y' ).'</span>' ); ?></h1>

			<?php elseif ( is_year() ): // Yearly archives ?>
				<h1><?php echo printf( __( 'Yearly Archives: %s', 'readly' ), '<span>'.get_the_date( 'Y' ).'</span>' ); ?></h1>

			<?php elseif ( is_archive() ): // Any miscellaneous archive pages ?>
				<h1><?php echo _e( 'Archives', 'readly' ); ?></h1>

			<?php endif; ?>

			</div><!-- .title-block -->

		</header><!-- #masthead -->
