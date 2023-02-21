/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};

;// CONCATENATED MODULE: ./src/js/frontend/nav-backup.js
/**
 * File nav-backup.js.
 * ASB Log Theme
 * Handles back-to-top button functionality
 *
 * Author - Jefferson Real
 * URL - jeffersonreal.uk
 */

const navBackup = () => {

	/* Scroll to top when arrow up clicked BEGIN*/
	$( window ).scroll( function() {
		var height = $( window ).scrollTop()
		if ( height > 100 ) {
			$( '.navBackToTop' ).fadeIn()
		} else {
			$( '.navBackToTop' ).fadeOut()
		}
	} )
	$( document ).ready( function() {
		$( ".navBackToTop" ).click( function( event ) {
			event.preventDefault()
			$( "html, body" ).animate( { scrollTop: 0 }, "slow" )
			return false
		} )

	} )
	/* Scroll to top when arrow up clicked END*/

}



;// CONCATENATED MODULE: ./src/js/frontend/navigation.js
/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
const navigation = () => {

	const siteNavigation = document.getElementById( 'site-navigation' )

	// Return early if the navigation don't exist.
	if ( ! siteNavigation ) {
		return
	}

	const button = siteNavigation.getElementsByTagName( 'button' )[ 0 ]

	// Return early if the button don't exist.
	if ( typeof button === 'undefined' ) {
		return
	}

	const menu = siteNavigation.getElementsByTagName( 'ul' )[ 0 ]

	// Hide menu toggle button if menu is empty and return early.
	if ( typeof menu === 'undefined' ) {
		button.style.display = 'none'
		return
	}

	if ( ! menu.classList.contains( 'nav-menu' ) ) {
		menu.classList.add( 'nav-menu' )
	}

	// Toggle the .toggled class and the aria-expanded value each time the button is clicked.
	button.addEventListener( 'click', function() {
		siteNavigation.classList.toggle( 'toggled' )

		if ( button.getAttribute( 'aria-expanded' ) === 'true' ) {
			button.setAttribute( 'aria-expanded', 'false' )
		} else {
			button.setAttribute( 'aria-expanded', 'true' )
		}
	} )

	// Remove the .toggled class and set aria-expanded to false when the user clicks outside the navigation.
	document.addEventListener( 'click', function( event ) {
		const isClickInside = siteNavigation.contains( event.target )

		if ( ! isClickInside ) {
			siteNavigation.classList.remove( 'toggled' )
			button.setAttribute( 'aria-expanded', 'false' )
		}
	} )

	// Get all the link elements within the menu.
	const links = menu.getElementsByTagName( 'a' )

	// Get all the link elements with children within the menu.
	const linksWithChildren = menu.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' )

	// Toggle focus each time a menu link is focused or blurred.
	for ( const link of links ) {
		link.addEventListener( 'focus', toggleFocus, true )
		link.addEventListener( 'blur', toggleFocus, true )
	}

	// Toggle focus each time a menu link with children receive a touch event.
	for ( const link of linksWithChildren ) {
		link.addEventListener( 'touchstart', toggleFocus, false )
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		if ( event.type === 'focus' || event.type === 'blur' ) {
			let self = this
			// Move up through the ancestors of the current link until we hit .nav-menu.
			while ( ! self.classList.contains( 'nav-menu' ) ) {
				// On li elements toggle the class .focus.
				if ( self.tagName.toLowerCase() === 'li' ) {
					self.classList.toggle( 'focus' )
				}
				self = self.parentNode
			}
		}

		if ( event.type === 'touchstart' ) {
			const menuItem = this.parentNode
			event.preventDefault()
			for ( const link of menuItem.parentNode.children ) {
				if ( menuItem !== link ) {
					link.classList.remove( 'focus' )
				}
			}
			menuItem.classList.toggle( 'focus' )
		}
	}

}



;// CONCATENATED MODULE: ./src/js/frontend.js
/**
 * Webpack entry point.
 * 
 * @link https://metabox.io/modernizing-javascript-code-in-wordpress/
 */




navBackup()
navigation()

/******/ })()
;
//# sourceMappingURL=frontend.js.map