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
	// Show the featured image, for posts that have one and aren't already image, video, or gallery posts 
	if ( has_post_thumbnail() and 'image' != $post_format and 'gallery' != $post_format and 'video' != $post_format ):
		// First, we'll check to see how big it is. This will determine how we'll display it.
		$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
		$thumbnail_width = $image_attributes[1];
		$thumbnail_height = $image_attributes[2];

		// We'll make it super-big if a big image has been uploaded. Otherwise, let's just center it.
		if ( $thumbnail_width > 920 ) {
		  $thumbnail_class = "oversized";
		} else {
		  $thumbnail_class = "aligncenter";
		}

		// Finally, show the image
		the_post_thumbnail( 'full', array( 'class' => $thumbnail_class . ' featured-image' ) );
	endif;
	?>

	<div class="entry-content">
		<?php the_content(__('Read more', 'readly')); ?>
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

</article><!-- #post-## -->
