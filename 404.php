<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Readly
 * @since Readly 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e('Oops! That page can&rsquo;t be found.', 'readly'); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p><?php _e('Please feel free to <a href="'.esc_url(home_url('/')).'">return to the front page</a> or use the search box to find the information you were looking for. We are very sorry for any inconvenience.', 'readly'); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 .post .error404 .not-found -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>