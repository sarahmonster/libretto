/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */

jQuery(function() {

	/* Drop menu down from top of screen */
	jQuery('.menu-toggle').on('click', function() {
		var menu = jQuery(this).parent().find('.menu');
		menu.slideToggle('slow');
		menu.toggleClass('menu-visible');
		jQuery( this ).find( '#menu-icon' ).toggleClass('open');
	});

	/* Open sub-menus if we're using the teeny menu */
	if (jQuery('.menu-toggle').is(':visible')) {
		jQuery('.menu-item-has-children a').on('click', function() {
			jQuery(this).parent().find('.sub-menu').slideToggle('fast');
			return false;
		});
	}
});
