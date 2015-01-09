/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */

( function( $ ) {

	/* Drop menu down from top of screen */
	$( '.menu-toggle' ).on( 'click', function() {
		var menu = $( this ).parent().find( '.menu' );
		menu.toggleClass( 'menu-visible' );
		$( this ).find( '#menu-icon' ).toggleClass( 'open' );
	});

	/* Open sub-menus if we're using the teeny menu */
	if ( $( '.menu-toggle' ).is( ':visible' ) ) {
		$( '.menu-item-has-children a' ).on( 'click', function() {
			$( this ).parent().find( '.sub-menu' ).slideToggle( 'fast' );
			return false;
		});
	}

	/* Make sure to show the sub-menu on page resize */
	$( window ).resize( function() {
		var menu = $( '.menu-toggle' ).parent().find( '.menu' );
		menu.removeClass ( 'menu-visible' );
		$( '#menu-icon' ).removeClass( 'open' );
	});

} )( jQuery );
