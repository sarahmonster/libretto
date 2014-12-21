<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Readly
 * @since Readly 1.0
 */
?>

<article id="post-0" class="post no-results not-found">
		<h1><?php _e('No results', 'readly'); ?></h1>

	<div class="entry-content">
		<?php if (is_home() && current_user_can('publish_posts')): ?>

			<p><?php printf(__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'readly'), esc_url(admin_url('post-new.php'))); ?></p>

		<?php elseif (is_search()): ?>

			<p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'readly'); ?></p>

		<?php else: ?>

			<p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'readly'); ?></p>

		<?php endif; ?>
	</div><!-- .entry-content -->
</article><!-- #post-0 .post .no-results .not-found -->
