<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Readly
 * @since Readly 1.0
 */
?>

</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">
	
	<div class="site-info">
		<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'ryu' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'readly' ), 'WordPress' ); ?></a>
		<?php printf( __( 'Theme: %1$s by %2$s.', 'readly' ), 'Readly', '<a href="https://wordpress.com/themes/" rel="designer">WordPress.com</a>' ); ?> 
	</div><!-- .site-info -->

<?php

if ( get_option('readly_social') ):
	$options = get_option('readly_social');
	$social = array();
	foreach ( $options as $key => $value ):
		if ($options[$key] != '') {
			$social[$key] = $value;
		}
	endforeach;
endif;

if ( !empty( $social ) ):
	$array = array(
		'twitter' => 'w',
		'facebook' => 'f',
		'instagram' => 'h',
		'pinterest' => 'p',
		'dribbble' => 'd',
		'google' => 'g',
		'vimeo' => 'v',
		'flickr' => '8',
		'rss' => 'r'
	);

?>
	<div id="social">
	<?php foreach ( $social as $social_network_name => $social_network_link ): ?>
		<a href="<?php echo $social_network_link; ?>"><?php echo $array[$social_network_name]; ?></a>
	<?php endforeach; ?>
	</div><!-- #social -->
<?php endif; ?>

</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
