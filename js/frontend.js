/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};

;// CONCATENATED MODULE: ./src/js/frontend/nav-backup.js
/**
 * Handle back-to-top button functionality
 *
 */

const navBackup = () => {

	const button     = document.querySelector( '.navBackToTop' )
	const doc        = document.documentElement
	const scrollType = window.matchMedia( '( prefers-reduced-motion: reduce )' ) ? 'auto': 'smooth'

	if ( ! button ) return

	const initialise = () => {

		window.onscroll = () => {
			var height = doc.scrollTop
			if ( height > 100 ) {
				button.style.visibility = 'visible'
				button.style.right = '4px'
			} else {
				button.style.right = '-110%'
				button.style.visibility = 'hidden'
			}
		}

		button.addEventListener( 'click', ( event ) => {
			event.preventDefault()
			window.scrollTo( {
				top: 0,
				behavior: scrollType
			} )
		} )
	}

    let docLoaded = setInterval( () => {
        if( document.readyState === 'complete' ) {
            clearInterval( docLoaded )
			initialise()
        }
    }, 100 )
}



;// CONCATENATED MODULE: ./src/js/frontend/navigation.js
/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
const navigation = () => {

	const toggleSelector = '.menuToggle'

	const toggles = document.querySelectorAll( toggleSelector )
	if ( ! toggles ) return

	const toggleIt = ( el ) => {
		el.classList.toggle( 'toggled' )
		if ( el.getAttribute( 'aria-expanded' ) === 'true' ) {
			el.setAttribute( 'aria-expanded', 'false' )
		} else {
			el.setAttribute( 'aria-expanded', 'true' )
		}
	}

	[ ...toggles ].forEach( toggle => {

		const menu = document.querySelectorAll( toggleSelector + ' ~ ul' )
		if ( typeof menu === 'undefined' ) {
			toggle.style.display = 'none'
			return
		}

		toggle.addEventListener( 'click', function() { toggleIt( this ) } )
		toggle.addEventListener( 'mouseenter', function() { toggleIt( this ) } )

		document.addEventListener( 'click', ( event ) => {
			const isMenuClick = toggle.contains( event.target )
			if ( ! isMenuClick ) {
				toggle.classList.remove( 'toggled' )
				toggle.setAttribute( 'aria-expanded', 'false' )
			}
		} )
	} )
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