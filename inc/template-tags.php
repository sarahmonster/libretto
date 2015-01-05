<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Readly
 */

if ( ! function_exists( 'readly_content_nav' ) ):

	/**
	 * Display navigation to next/previous pages when applicable
	 *
	 */
	function readly_content_nav( $nav_id ) {
		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$nav_class = ( is_single() ) ? 'navigation-post' : 'navigation-paging';
		?>

		<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?><?php if ( 'infinite-scroll' == get_theme_mod( 'page_navigation' ) && !is_single() ) echo ' infinite-scroll' ?>">
			<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'readly' ); ?></h1>

			<?php if ( is_single() ): // navigation links for single posts ?>

				<div class="previous">
					<?php previous_post_link( '%link', '<span class="meta-nav">'._x( 'Previous Article', 'Previous post link', 'readly' ).'</span> %title' ); ?>
				</div>

				<div class="next">
					<?php next_post_link( '%link', '<span class="meta-nav">'._x( 'Next Article', 'Next post link', 'readly' ).'</span> %title' ); ?>
				</div>

			<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ): // navigation links for home, archive, and search pages ?>

				<div class="previous">
				<?php if ( get_next_posts_link() ): ?>
					<?php next_posts_link( __( '<span class="meta-nav">Older posts</span>', 'readly' ) ); ?>
				<?php endif; ?>
				</div>

				<div class="page-number"><?php global $paged; echo $paged; ?> <span>of</span> <?php echo $wp_query->max_num_pages; ?></div>

				<div class="next">
				<?php if ( get_previous_posts_link() ): ?>
					<?php previous_posts_link( __( '<span class="meta-nav">Newer posts</span>', 'readly' ) ); ?>
				<?php endif; ?>
				</div>

		<?php endif; ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
	} // readly_content_nav()
endif;


if ( ! function_exists( 'readly_posted_on' ) ):
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 *
	 */
	function readly_posted_on() {
		printf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>', 'readly' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'F jS, Y' ) ),
			esc_html( get_the_date( 'F jS, Y' ) ),
		);
	}
endif;

/**
 * Determine if a blog has more than one category
 *
 */
function readly_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		// Set a transient with no expiration date
		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' !== $all_the_cool_cats ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Flush out the transients used in readly_categorized_blog
 *
 */
function readly_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Manually delete transient
	delete_transient( 'all_the_cool_cats' );
}

add_action( 'edit_category', 'readly_category_transient_flusher' );
add_action( 'save_post', 'readly_category_transient_flusher' );
