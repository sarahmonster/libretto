<?php
/**
 * The template for displaying image attachments.
 *
 * @package Readly
 */

get_header();

/**
 * Set the content width if it hasn't already been determined
 */
if ( ! isset( $content_width ) ) {
	$content_width = 720; /* 680px wide plus a 40px buffer */
}

?>

<div id="primary" class="content-area image-attachment">
	<div id="content" class="site-content" role="main">

	<?php while ( have_posts() ): the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content">
				<?php
				// We're going to use our custom "oversized" image size here
				$attachment_size = apply_filters( 'readly_attachment_size', 'readly-oversized' );
				$attachment_meta = wp_get_attachment_metadata( $post->ID );
				if ( $attachment_meta['width'] > 890 ) {
					$class = "oversized";
				} else {
					$class = "aligncenter";
				}
				// Output the actual image
				echo wp_get_attachment_image( get_the_ID(), $attachment_size, false, array( 'class' => $class ) );
				?>
				</a>

				<?php if ( has_excerpt() ): ?>
					<div class="entry-caption">
						<?php the_excerpt(); ?>
					</div><!-- .entry-caption -->
				<?php endif; ?>

				<?php // Add prev/next navigation. TODO: improve this so it matches with look & feel of navs in other places ?>
				<nav id="nav-below" class="navigation-image" role="navigation">
					<div class="previous">
					<span class="meta-nav">Previous image</span>
						<?php previous_image_link( false, 'Post title placeholder' ); ?>
					</div><!-- .previous -->
					<div class="next">
						<span class="meta-nav">Next image</span>
							<?php next_image_link( false, 'Post title placeholder' ); ?>
					</div><!-- .next -->
				</nav><!-- .navigation-image -->


				<?php
					the_content();
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'readly' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'readly' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					) );
				?>
			</div><!-- .entry-content -->

			<footer class="entry-meta">
				<?php edit_post_link( __( 'Edit', 'readly' ), '<span class="edit-link">', '</span>' ); ?>
			</footer><!-- .entry-footer -->

		</article><!-- #post-## -->

	<?php
		// If comments are open or we have at least one comment, load up the comment template
		if ( comments_open() || get_comments_number() ):
			comments_template();
		endif;

	// End the loop.
	endwhile;
?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>

