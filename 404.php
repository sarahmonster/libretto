<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Readly
 */
get_header();
?>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">

		<article id="post-0" class="post error404 not-found">
			<div class="entry-content">
				<p><?php _e( 'Looks like something got lost along the way. Please use the navigation above or the search box below to find what you were looking for.', 'readly' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->
		</article><!-- #post-0 .post .error404 .not-found -->

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
