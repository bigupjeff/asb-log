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

export { navBackup }
