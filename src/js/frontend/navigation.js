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

export { navigation }
