<?php
/**
 * The template for displaying image attachments.
 *
 * @package Readly
 */

get_header();
?>

<div id="primary" class="content-area image-attachment">
	<div id="content" class="site-content" role="main">

	<?php while ( have_posts() ): the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<div class="entry-meta">
				<?php
					printf( __( 'Posted <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> via <a href="%3$s" title="Return to %4$s" rel="gallery">%5$s</a>', 'readly' ),
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() ),
					get_permalink( $post->post_parent ),
					esc_attr( get_the_title( $post->post_parent ) ),
					get_the_title( $post->post_parent )
					);
				?>
				</div><!-- .entry-meta -->

				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header><!-- .entry-header -->

			<div class="entry-content">

				<div class="entry-attachment">
					<div class="attachment">
						<?php
						/**
						* Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
						* or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
						*/
						$attachments = array_values( get_children( array(
							'post_parent'    => $post->post_parent,
							'post_status'    => 'inherit',
							'post_type'      => 'attachment',
							'post_mime_type' => 'image',
							'order'          => 'ASC',
							'orderby'        => 'menu_order ID',
						) ) );
						foreach ( $attachments as $k => $attachment ) {
							if ( $attachment->ID == $post->ID )
								break;
							}
						$k++;

						if ( count( $attachments ) > 1 ): // If gallery has more than one attachment, link to next image
							if ( isset( $attachments[$k] ) ) {
								// get the URL of the next image attachment
								$next_attachment_url = get_attachment_link( $attachments[$k]->ID );
							} else {
								// or get the URL of the first image attachment
								$next_attachment_url = get_attachment_link( $attachments[0]->ID );
							}

						else: // Otherwise link directly to the image file
							$next_attachment_url = wp_get_attachment_url();
						endif;
						?>

						<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment">
						<?php
						$attachment_size = apply_filters( 'readly_attachment_size', array( 1200, 1200 ) ); // Filterable image size.
						$attachment_meta = wp_get_attachment_metadata( $post->ID );
						if ( $attachment_meta['width'] > 920 ) {
							$class = "oversized";
						} else {
							$class = "aligncenter";
						}
						// Output the actual image
						echo wp_get_attachment_image( $post->ID, $attachment_size, false, array( 'class' => $class ) );
						?>
						</a>
					</div><!-- .attachment -->

					<?php if ( ! empty( $post->post_excerpt ) ): // Show caption if set ?>
						<div class="entry-caption">
							<?php the_excerpt(); ?>
						</div><!-- .entry-caption -->
					<?php endif; ?>

				</div><!-- .entry-attachment -->

				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links">'.__( 'Pages:', 'readly' ), 'after' => '</div>' ) ); ?>

			</div><!-- .entry-content -->

			<nav role="navigation" id="image-navigation" class="navigation-image">
				<h1 class="screen-reader-text"><?php _e( 'Image navigation', 'readly' ); ?></h1>
				<div class="previous">
					<span class="meta-nav"><?php previous_image_link( false, __( 'Previous image', 'readly' ) ); ?></span>
					<?php previous_image_link( false ); ?>
				</div>
				<div class="next">
					<span class="meta-nav"><?php next_image_link( false, __( 'Next image', 'readly' ) ); ?></span>
					<?php next_image_link( false ); ?>
				</div>
			</nav><!-- #image-navigation -->

			<footer class="entry-meta">
				<?php if ( comments_open() && pings_open() ): // Comments and trackbacks open ?>
					<?php printf( __( '<a class="comment-link" href="#respond" title="Post a comment">Post a comment</a> or leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'readly' ), get_trackback_url() ); ?>
				<?php elseif ( ! comments_open() && pings_open() ): // Only trackbacks open ?>
					<?php printf( __( 'Comments are closed, but you can leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'readly' ), get_trackback_url() ); ?>
				<?php elseif ( comments_open() && ! pings_open() ): // Only comments open ?>
					<?php _e( 'Trackbacks are closed, but you can <a class="comment-link" href="#respond" title="Post a comment">post a comment</a>.', 'readly' ); ?>
				<?php elseif ( ! comments_open() && ! pings_open() ): // Comments and trackbacks closed ?>
					<?php _e( 'Both comments and trackbacks are currently closed.', 'readly' ); ?>
				<?php endif; ?>
				<?php edit_post_link( __( 'Edit', 'readly' ), ' <span class="edit-link">', '</span>' ); ?>
			</footer><!-- .entry-meta -->
		</article><!-- #post-<?php the_ID(); ?> -->

		<?php
		// If comments are open or we have at least one comment, load up the comment template
		if ( comments_open() || '0' !== get_comments_number() )
			comments_template();
		?>

	<?php endwhile; // end of the loop. ?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
