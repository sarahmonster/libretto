<?php
/**
 * @package Readly
 * @since Readly 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	
	// Determine the post type, so we can adjust the display accordingly
	$post_format = get_post_format();

	
	// All post types except for quotes show header data
	if ( 'quote' != $post_format ):
	?>
	<header class="entry-header">
		<div class="entry-meta">
			<?php readly_posted_on(); ?>

			<?php if (!post_password_required() && (comments_open() && '0' != get_comments_number())): ?>
				<span class="sep"> &#183; </span>
				<span class="comments-link"><?php comments_popup_link(__('Leave a comment', 'readly'), __('1 Comment', 'readly'), __('% Comments', 'readly')); ?></span>
			<?php endif; ?>
			<?php edit_post_link(__('Edit', 'readly'), '<span class="sep"> &#183; </span><span class="edit-link">', '</span>'); ?>
		</div><!-- .entry-meta -->
		<?php if ( 'link' !== get_post_format() ): ?>
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		<?php endif; ?>
	</header><!-- .entry-header -->
	<?php endif; ?>

	
	<?php
	// Readly formats images and whatnot in its own special way. Seems like that special way is by obscuring them entirely. Will probably strip this out.
	if ('audio' == $post_format) readly_formatted_audio();
	elseif ('video' == $post_format) readly_formatted_video();
	elseif ('image' == $post_format) readly_formatted_image();
	elseif ('gallery' == $post_format) {
		$result = wpShower::getContentAndAttachments();
		echo readly_formatted_gallery($result['attachments'], 'readly_big');
	}

	// Show the featured image, for posts that have one and aren't already image, video, or gallery posts 
	if ( has_post_thumbnail() and 'image' != $post_format and 'gallery' != $post_format and 'video' != $post_format ) {
		get_template_part( 'partials/featured-image' );
	}
	?>

	<div class="entry-content">
		<?php
		if ('gallery' == $post_format) {
			echo $result['content'];
		} else {
			the_excerpt(__('Read More<span></span>', 'readly'));
		}
		?>
	</div><!-- .entry-content -->

	<?php if ('post' == get_post_type()): // Hide category and tag text for pages on Search ?>
		<?php if ($post_format == 'quote'): ?>
		<footer class="entry-meta">
			<?php readly_posted_on(); ?>

			<?php if (!post_password_required() && (comments_open() && '0' != get_comments_number())): ?>
				<span class="sep"> &#183; </span>
				<span class="comments-link"><?php comments_popup_link(__('Leave a comment', 'readly'), __('1 Comment', 'readly'), __('% Comments', 'readly')); ?></span>
			<?php endif; ?>

			<?php edit_post_link(__('Edit', 'readly'), '<span class="edit-link">', '</span>'); ?>
		</footer><!-- .entry-meta -->
		<?php endif; ?>
	<?php endif; ?>

	<div class="article-separator">j j j</div>
</article><!-- #post-## -->
