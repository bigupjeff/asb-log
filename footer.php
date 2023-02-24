<?php
/**
 * Default footer template.
 *
 * @package ASB_Log
 */

$asb_settings = get_option( 'asb_theme_array' );
if ( false !== $asb_settings ) {
	$asb_email_address = $asb_settings['asb_email_address'];
	$asb_phone_number  = $asb_settings['asb_phone_number'];
	$asb_phone_href    = preg_replace( '/\s+/', '', $asb_phone_number ); // Clean for url.
	$asb_facebook_url  = $asb_settings['asb_facebook_url'];
	$asb_instagram_url = $asb_settings['asb_instagram_url'];
}
?>

<footer class="footer">
	<div class="footer_container">

		<div class="footer_block left">

			<?php if ( isset( $asb_email_address ) ) : ?>
				<a class="footer_contact" title="Email Address" href="mailto:<?php echo $asb_email_address; ?>">
					<div class="footer_icon">
						<svg class="faIcon envelope" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
					</div>
					<?php echo $asb_email_address; ?>
				</a>
			<?php endif ?>
			<?php if ( isset( $asb_phone_number ) ) : ?>
				<a class="footer_contact" title="Phone Number" href="tel:<?php echo $asb_phone_href; ?>">
					<div class="footer_icon">
						<svg class="faIcon phone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>
					</div>
					<?php echo $asb_phone_number; ?>
				</a>
			<?php endif ?>

			<div class="footer_social">
				<?php if ( isset( $asb_facebook_url ) ) : ?>
					<a class="footer_socialLink" title="Visit Facebook Profile" target="_blank" href="<?php echo $asb_facebook_url; ?>">
					<svg class="faIcon facebook" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/></svg>
					<span class="screen-reader-text">Visit Facebook Profile</span>
					</a>
				<?php endif ?>
				<?php if ( isset( $asb_instagram_url ) ) : ?>
					<a class="footer_socialLink" title="Visit Instagram Profile" target="_blank" href="<?php echo $asb_instagram_url; ?>">
					<svg class="faIcon instagram" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
					<span class="screen-reader-text">Visit Instagram Profile</span>
					</a>
				<?php endif ?>
			</div>

		</div>

		<div class="footer_block middle">

			<nav class="footerNav">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'menu_class'     => 'menu',
					)
				);
				?>
			</nav>

		</div>

		<div class="footer_block right">
				<div class="footer_qualificationWrap"></div>
		</div>

		<div class="footer_bottomBar">
			<span class="footer_footItem"><a href="https://jeffersonreal.uk">Built by Jefferson</a></span>
			<span class="footer_footItem">&copy; <?php echo date( 'Y' ); ?> ASB Log</span>
		</div>

	</div>
</footer>

</div>
<!-- PAGE GRID END -->

<button class="navBackToTop" title="Back to top">
	<svg class="faIcon circleArrowUp" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM385 231c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-71-71V376c0 13.3-10.7 24-24 24s-24-10.7-24-24V193.9l-71 71c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9L239 119c9.4-9.4 24.6-9.4 33.9 0L385 231z"/></svg>
</button>

<?php wp_footer(); ?>

</body>
</html>
