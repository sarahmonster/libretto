<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Readly
 * @since Readly 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php if (have_posts()): ?>

			<?php /* Start the Loop */ ?>
			<?php while (have_posts()): the_post(); ?>

				<?php get_template_part('content', 'search'); ?>

			<?php endwhile; ?>

			<?php readly_content_nav('nav-below'); ?>

		<?php else: ?>

			<?php get_template_part('no-results', 'search'); ?>

		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
