/**
 * readly.js
 *
 * Handles custom functions, primarily for images
 */

jQuery(function() {

	jQuery(window).load(function() {
		/* If image is wider than our content area, give it a class to have it overlap */
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
	});


});
