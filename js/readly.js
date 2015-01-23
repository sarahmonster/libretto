/**
 * readly.js
 *
 * Handles custom functions, primarily for images
 */

( function( $ ) {
	/* This calculates the size of each image in the entry content,
	 * then gives it a class to overlap the content area if it's wide enough.
	 * Certain images are ignored-—mostly those in galleries or video previews
	 */
	function formatImages() {

		$( '.entry-content img' ).each( function() {
			// Never give overlap class to gallery images or video, unless you want things to implode
			// "Medium" and "large" images are also excluded for logical reasons, as well as smileys
			if ( ! $( this ).hasClass( 'attachment-gallery' ) && ! $( this ).hasClass( 'videopress-poster' )
				&& ! $( this ).parents( '.tiled-gallery-item' ).length && ! $( this ).parents( '.gallery' ).length
				&& ! $( this ).hasClass( 'size-thumbnail' ) && ! $( this ).hasClass( 'size-medium' ) && ! $( this ).hasClass( 'wp-smiley' ) ) {

				// Determine actual, rather than computed, width of image, by creating a new image instance
				var computedImage = $( this );
				var actualImage = new Image();
				actualImage.src = computedImage.attr( 'src' )
				var imageWidth = actualImage.width;

				// If it's big enough, give it the oversized class for the overlap, and remove height & width attributes
				if ( imageWidth > 895 ) {
					// If we're inside a caption, the oversized class should instead be added to our caption.
					// We'll also remove the width property
					if ( $( this).parents( 'figure' ).length ) {
						$( this ).parents( 'figure' ).addClass( 'oversized');
						$( this ).parents( 'figure' ).css( "width", "" );
					} else {
						$( this ).addClass( 'oversized' );
					}
					$( this ).removeAttr( 'width' );
					$( this ).removeAttr( 'height' );
				}
			}
		});

		// Remove height & width attributes from featured images
		$( '.featured-image' ).each( function() {
			$( this ).removeAttr( 'width' );
			$( this ).removeAttr( 'height' );
			console.log( "hi" );
		});
	}

	// Format images on page load
	$( window ).load( function() {
		formatImages();
	});

	// Format images on each subsequent Infinite Scroll load, as well
	$( document ).on( 'post-load', function() {
		formatImages();
	});


	$( document ).ready( function() {

		// Pull out the search bar when clicked
		$( '#site-navigation .search-form .search-submit' ).click( function() {
			var $form = $( this ).parent( 'form' );
			if ( $form.hasClass( 'open' ) ) {
				$form.removeClass( 'open' );
			} else {
				$form.addClass( 'open' );
				$form.find( 'input').focus();
				return false;
			}

		});

	});


} )( jQuery );
