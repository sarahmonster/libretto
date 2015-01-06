<?php
/**
 * The template for displaying content on archive and index pages
 *
 * @package Readly
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
// Determine the post type, so we can adjust the display accordingly
$post_format = get_post_format();

// Only long-form posts will show header data
if ( 'quote' !== $post_format && 'status' !== $post_format && 'link' !== $post_format && 'aside' !== $post_format ):
?>

	<header class="entry-header">

		<div class="entry-meta">
			<?php readly_posted_on(); ?>
			<?php if ( ! post_password_required() && ( comments_open() && '0' !== get_comments_number() ) ): // Show comment count if > 0 ?>
				<span class="sep"> &#183; </span>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'readly' ), __( '1 Comment', 'readly' ), __( '% Comments', 'readly' ) ); ?></span>
			<?php endif; ?>
			<?php edit_post_link( __( 'Edit', 'readly' ), '<span class="sep"> &#183; </span><span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->

		<?php if ( 'link' !== $post_format && 'aside' !== $post_format && 'status' !== $post_format ): // Show title for most formats ?>
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php endif; ?>
	</header><!-- .entry-header -->

<?php endif; // End header output ?>


<?php
// Show the featured image, for posts that have one and aren't already image, video, or gallery posts
if ( has_post_thumbnail() && 'image' !== $post_format && 'gallery' !== $post_format && 'video' !== $post_format ):

	// First, we'll check to see how big the image is. This will determine how we'll display it.
	$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
	$thumbnail_width = $image_attributes[1];
	$thumbnail_height = $image_attributes[2];

	// We'll make it super-big if a large enough image has been uploaded. Otherwise, let's just center it.
	if ( $thumbnail_width > 920 ) {
		$thumbnail_class = "oversized";
	} else {
		$thumbnail_class = "aligncenter";
	}

	// Finally, show the image
	the_post_thumbnail( 'full', array( 'class' => $thumbnail_class . ' featured-image' ) );

endif; // End featured image output ?>

	<div class="entry-content">
		<?php // Output entry content
		if ( 'content' === get_theme_mod( 'readly_blog_index' ) || 'gallery' === $post_format || 'image' === $post_format || 'video' === $post_format || 'audio' === $post_format ):
			the_content( __( 'Read more', 'readly' ) );
		else :
			the_excerpt();
		endif; ?>
	</div><!-- .entry-content -->

<?php if ( 'quote' === $post_format || 'status' === $post_format || 'link' === $post_format || 'aside' === $post_format ): // Show post footers for abbreviated post types ?>
	<footer class="entry-footer">
		<?php readly_posted_on(); ?>
		<?php if ( ! post_password_required() && ( comments_open() && '0' !== get_comments_number() ) ): ?>
			<span class="sep"> &#183; </span>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'readly' ), __( '1 Comment', 'readly' ), __( '% Comments', 'readly' ) ); ?></span>
		<?php endif; ?>
		<?php edit_post_link( __( 'Edit', 'readly' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
<?php endif; ?>

</article><!-- #post-## -->
