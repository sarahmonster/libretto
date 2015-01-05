<?php
/**
 * The template used for displaying individual post pages
 *
 * @package Readly
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php $post_format = get_post_format(); // Save post format as a variable for re-use ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">'.__( 'Pages:', 'readly' ), 'pagelink' => '<span>%</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
		/* translators: used between list items, there is a space after the comma */
		$category_list = get_the_category_list( __( ', ', 'readly' ) );

		/* translators: used between list items, there is a space after the comma */
		$tag_list = get_the_tag_list( '', __( ', ', 'readly' ) );

		if ( !readly_categorized_blog() ): // If blog only has a single category, output only tags
			if ( '' != $tag_list ) {
				$meta_text = __( 'Tagged %2$s', 'readly' );
			} else {
				$meta_text = '';
			}

		else: // Otherwise output categories as well as tags
			if ( '' != $tag_list ) {
				$meta_text = __( 'Posted in %1$s<span class="sep"> &#183; </span>Tagged %2$s', 'readly' );
			} else {
				$meta_text = __( 'Posted in %1$s', 'readly' );
			}
		endif;

		printf(
			$meta_text,
			$category_list,
			$tag_list,
			get_permalink(),
			the_title_attribute( 'echo=0' )
		);
		?>

		<?php edit_post_link( __( 'Edit', 'readly' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
