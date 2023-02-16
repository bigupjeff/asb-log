<?php
// The Footer Template for ASB Log
// 2023 © ASB Log
// Author: Jefferson Real
// URL: https://jeffersonreal.uk

// Load theme settings variables for this document
$asb_settings = get_option( 'asb_theme_array' ); // Serialized array of all Options
$asb_email_address = $asb_settings['asb_email_address']; // Email Address
$asb_phone_number = $asb_settings['asb_phone_number']; // Phone Number
$asb_phone_href = preg_replace('/\s+/', '', $asb_phone_number); // Whitespace cleaned for url
$asb_social_url_facebook = $asb_settings['asb_social_url_facebook']; // Facebook URL
$asb_social_url_instagram = $asb_settings['asb_social_url_instagram']; // Instagram URL
$asb_url_cityguilds = $asb_settings['asb_url_cityguilds']; // City and Guilds URL
?>

<footer id="colophon" class="site-footer">

    <div class="footer_left">
        <div class="footer_contactBox">
            <a class="footer_email" href="mailto:<?php echo $asb_email_address; ?>"><i class="fas fa-envelope"></i> <?php echo $asb_email_address; ?></a>
            <a class="footer_phone" href="tel:<?php echo $asb_phone_href; ?>"><i class="fas fa-phone"></i> <?php echo $asb_phone_number; ?></a>
        </div>
    </div>

    <div class="footer_middle">
        <!-- Create the secondary nav location for WP customizer -->
        <?php wp_nav_menu(
              array(
                  'theme_location' => 'menu-2',
                  'menu_id'        => 'footer-menu',
                  'container_class' => 'footer-navigation'
              )
        ); ?>
	</div>

    <div class="footer_right">
			<div class="footer_qualificationWrap"></div>
            <span class="footer_copyright">&copy; <?php echo date("Y"); ?> ASB Log</span>
    </div>

</footer>

</div>
<!-- PAGE GRID END -->

<a class="nav_backup" title="Back to top" href="#"><i class="fas fa-arrow-circle-up"></i></a>

<?php wp_footer(); ?>

</body>
</html>
