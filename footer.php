<?php
/**
 * The template for displaying the footer.
 *
 * @package Readly
 */
?>

		<footer id="colophon" class="site-footer" role="contentinfo">

			<div class="site-info">
				<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'ryu' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'readly' ), 'WordPress' ); ?></a>
					<?php printf( __( 'Theme: %1$s by %2$s.', 'readly' ), 'Readly', '<a href="https://wordpress.com/themes/" rel="designer">WordPress.com</a>' ); ?>
			</div><!-- .site-info -->

			<?php
			// Prepare social media nav
			if ( has_nav_menu( 'social' ) ): ?>
				<div id="social">
				 <?php wp_nav_menu( array(
						'theme_location' => 'social',
					 	'link_before'    => '<span class="screen-reader-text">',
						'link_after'      => '</span>',
					 	'fallck_cb' => false,
					) );
				 	?>
				</div><!-- #social -->
			<?php endif; ?>

		</footer><!-- #colophon -->

		<?php wp_footer(); ?>

	</body>
</html>
