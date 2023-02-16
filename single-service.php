<?php
/**
 * ASB Log theme - Template for displaying all single service posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * @package ASB_Log
 */

get_header();
?>

<main class="site-main">

    <?php while ( have_posts() ) {
        the_post();

        $icon_id          = get_field('asb_icon');
        $icon_dir         = get_attached_file( $icon_id );
        $title            = the_title( '', '', false );
        $url              = sanitize_title( $title );
        $image            = get_field( 'asb_tile_image' );
        $price            = get_field( 'asb_price' );
        $site_title       = get_bloginfo( 'name', 'display' );
        $site_description = get_bloginfo( 'description', 'display' );
        ?>

        <article class="article" id="post-<?php the_ID(); ?>">

            <?php if( !empty( $image ) ): ?>
                <div class="post-thumbnail">
                    <img class="otherServices_img" src="<?php echo $image; ?>" />
                </div>
            <?php endif; ?>

            <header class="entry-header">
                <h1 class="entry-title"><?php echo $title; ?></h1>
            </header>


            <div class="entry-content singleService">
                <div class="service">

                    <header class="service_header service_header-single">
                        <div class="service_iconWrap service_iconWrap-single"><?php echo file_get_contents( $icon_dir );?></div>
                        <div class="singleService_titleWrap singleService_titleWrap-hires">
                            <h3 class="singleService_siteTitle"><?php echo $site_title; ?></h3>
                            <h2 class="singleService_siteDesc"><?php echo $site_description; ?></h2>
                        </div>

                    </header>

                    <div class="service_description service_description-single">
                        <?php the_content(); ?>
                    </div>

                    <footer class="service_footer service_footer-single">
                        <a class="readMore" href="#contactForm"><i>Book Now </i><i class="fas fa-angle-double-right"></i></a>

                        <?php
                        // ACF True/False
                        if ( get_field('show_homepage_price') && !empty( $price ) ) {
                            echo '<span class="service_price">' . '£' . get_field( 'asb_price' ) . '</span>';
                        } else {
                            echo '<span class="service_price-empty"><a class="readMore" href="/services/#breed-pricelist">See Breed Pricelist</a></span>';
                        }
                        ?>

                    </footer>
                </div>
            </div>

            <?php
            if ( get_edit_post_link() ) {
            ?>
                <footer class="entry-footer">

                    <?php edit_post_link(
                        sprintf(
                            wp_kses(
                                /* translators: %s: Name of current post. Only visible to screen readers */
                                __( 'Edit <span class="screen-reader-text">%s</span>', 'asb-log' ),
                                array(
                                    'span' => array(
                                        'class' => array(),
                                    ),
                                )
                            ),
                            wp_kses_post( get_the_title() )
                        ),
                        '<span class="edit-link">',
                        '</span>'
                    ); ?>

                </footer>

            <?php
            } /* if get_edit_post_link() */
            ?>
            <div class="singleService_cta">
                <div class="singleService_titleWrap-lowres">
                    <h3 class="singleService_siteTitle"><?php echo $site_title; ?></h3>
                    <h2 class="singleService_siteDesc"><?php echo $site_description; ?></h2>
                </div>
                <a class="singleService_viewAllLink readMore" href="/services/"><i>All Dog Grooming Services</i><i class="fas fa-angle-double-right"></i></a>
            </div>
        </article>

    <?php
    } /* while have_posts() */


    get_sidebar();
    ?>

</main>

<!-- single-service.php - Post Type: <?php echo get_post_type(); ?> -->
<?php
get_footer();
