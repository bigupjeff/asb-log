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

export { navBackup }
