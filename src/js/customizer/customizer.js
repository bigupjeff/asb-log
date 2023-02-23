/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

const customizer = () => {
	
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			document.querySelectorAll( '.site-title a' ).text( to )
		} )
	} )
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			document.querySelectorAll( '.site-description' ).text( to )
		} )
	} )

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( to === 'blank' ) {
				document.querySelectorAll( '.site-title, .site-description' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} )
			} else {
				document.querySelectorAll( '.site-title, .site-description' ).css( {
					clip: 'auto',
					position: 'relative',
				} )
				document.querySelectorAll( '.site-title a, .site-description' ).css( {
					color: to,
				} )
			}
		} )
	} )

}

export { customizer }
