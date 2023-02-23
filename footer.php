<?php
/**
 * Default footer template.
 *
 * @package ASB_Log
 */

$asb_settings = get_option( 'asb_theme_array' );
if ( false !== $asb_settings ) {
	$asb_email_address        = $asb_settings['asb_email_address'];
	$asb_phone_number         = $asb_settings['asb_phone_number'];
	$asb_phone_href           = preg_replace( '/\s+/', '', $asb_phone_number ); // Clean for url.
	$asb_social_url_facebook  = $asb_settings['asb_social_url_facebook'];
	$asb_social_url_instagram = $asb_settings['asb_social_url_instagram'];
}
?>

<footer id="colophon" class="footer">

	<div class="footer_left">
		<div class="footer_contactBox">
			<?php if ( isset( $asb_email_address ) ) : ?>
				<a class="footer_email" href="mailto:<?php echo $asb_email_address; ?>"><i class="fas fa-envelope"></i> <?php echo $asb_email_address; ?></a>
			<?php endif ?>
			<?php if ( isset( $asb_phone_number ) ) : ?>
				<a class="footer_phone" href="tel:<?php echo $asb_phone_href; ?>"><i class="fas fa-phone"></i> <?php echo $asb_phone_number; ?></a>
			<?php endif ?>
		</div>
	</div>

	<div class="footer_middle">
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

	<div class="footer_right">
			<div class="footer_qualificationWrap"></div>
	</div>

	<div class="footer_bottomBar">
		<span class="footer_footItem"><a href="https://jeffersonreal.uk">Built by Jefferson</a></span>
		<span class="footer_footItem">&copy; <?php echo date("Y"); ?> ASB Log</span>
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
