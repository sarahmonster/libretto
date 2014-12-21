/**
 * readly.js
 *
 * Handles custom functions, primarily for images
 */

jQuery(function() {

	/* If image is wider than our content area, give it a class to have it overlap */
	jQuery(window).load(function() {
		jQuery('img').each(function() {
			// Determine actual, rather than computed, width of image, by creating a new image instance
			var computedImage = jQuery('img');
			var actualImage = new Image();
			actualImage.src = computedImage.attr("src")
			var imageWidth = actualImage.width;
			console.log(imageWidth);
			if (imageWidth > 895) {
			 jQuery(this).addClass('oversized');
			}
		});
	});


});
