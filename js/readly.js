/**
 * readly.js
 *
 * Handles custom functions, primarily for images
 */

jQuery(function() {

	/* This calculates the size of each image in the entry content,
	 * then gives it a class to overlap the content area if it's wide enough.
	 * Certain images are ignored—mostly those in galleries or video previews
	 */
	function formatImages() {

		jQuery('.entry-content img').each(function() {
			// Never give overlap class to gallery images or video, unless you want things to implode
			// && ! jQuery(this).parents('.tiled-gallery-item')
			if ( ! jQuery(this).hasClass('attachment-gallery') && ! jQuery(this).hasClass('videopress-poster') ) {

				// Determine actual, rather than computed, width of image, by creating a new image instance
				var computedImage = jQuery('img');
				var actualImage = new Image();
				actualImage.src = computedImage.attr('src')
				var imageWidth = actualImage.width;

				// If it's big enough, give it the oversized class for the overlap, and remove height & width attributes
				if (imageWidth > 895) {
					jQuery(this).addClass('oversized');
					jQuery(this).removeAttr('width');
					jQuery(this).removeAttr('height');
				}
			}
		});
	}

	// Format images on page load
	jQuery(window).load(function() {
		formatImages();
	});

	// Format images on each subsequent Infinite Scroll load, as well
	jQuery(document).on('post-load', function() {
		formatImages();
	});


});
