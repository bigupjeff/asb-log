<?php
/**
 * ASB Log theme - contact page template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package ASB_Log
 */

 // Load theme settings variables for this document
 $asb_settings = get_option( 'asb_theme_array' ); // Serialized array of all Options
 $asb_email_address = $asb_settings['asb_email_address']; // Email Address
 $asb_phone_number = $asb_settings['asb_phone_number']; // Phone Number
 $asb_phone_href = preg_replace('/\s+/', '', $asb_phone_number); // Whitespace cleaned for url
 $asb_street_address = nl2br($asb_settings['asb_street_address']); // Business Address
 $asb_openstreetmap = esc_url_raw($asb_settings['asb_openstreetmap']); // OSM URL

get_header();
?>

    <main class="site-main site-main-noside">

        <!-- Hidden anchor for contact form -->
        <a id="contactForm" style="visibility:hidden; width:0px;"></a>

    	<?php
    	while ( have_posts() ):
    		the_post();

    		get_template_part( 'template-parts/content', 'page' );

    	endwhile;
    	?>

        <div class="row">
            <div class="column">
                <div class="address">
                    <h4 class="address_title"><?php bloginfo( 'name' ); ?></h4>

                    <address class="address_body">
                        <?php echo $asb_street_address; ?>
                    </address>

                </div>
            </div>
            <div class="column">
                <div class="contactBox">
                    <a class="contactBox_email" href="mailto:<?php echo $asb_email_address; ?>"><i class="fas fa-envelope"></i> <?php echo $asb_email_address; ?></a>
                    <a class="contactBox_phone" href="tel:<?php echo $asb_phone_href; ?>"><i class="fas fa-phone"></i> <?php echo $asb_phone_number; ?></a>
                </div>
            </div>
        </div>

        <!-- Add Openstreetmap Map -->
        <iframe class="openstreetmap" width="1200" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $asb_openstreetmap; ?>"></iframe>

        <section class="reviews">
            <?php get_template_part( 'template-parts/fp-reviews', 'none' );?>
        </section>

    </main>

<?php
get_footer();
