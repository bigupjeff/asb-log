<?php
// The Top Services Template Part for ASB Log
// 2023 © ASB Log
// Author: Jefferson Real
// URL: https://jeffersonreal.uk


$args = array(
    'post_type' => 'service',
    'post_status' => 'publish',
    'posts_per_page' => '3',
    'meta_key' => 'asb_position',
    'orderby' => 'meta_value',
    'order' => 'ASC',
    'cat' => '6'
);

$loop = new WP_Query( $args );

while ( $loop->have_posts() ) : $loop->the_post();?>

    <?php $icon_id = get_field('asb_icon'); ?>
    <?php $icon_dir = get_attached_file( $icon_id ); ?>

    <div class="service gs_reveal">
        <header class="service_header">
            <div class="service_iconWrap"><?php echo file_get_contents( $icon_dir );?></div>

            <?php
            $title = the_title( '', '', false );
            $url = sanitize_title( $title );
            ?>

            <h3 class="service_title"><a href="/services/#<?php echo $url; ?>"><?php echo $title; ?></a></h3>

        </header>
        <pre class="service_description">

            <?php
            $trim = '45';
            $read_more = '...<a class="readMore" href="/services/#' . $url . '"><i> read more </i><i class="fas fa-angle-double-right"></i></a>';
            echo force_balance_tags( html_entity_decode( wp_trim_words( htmlentities( wpautop(get_the_content()) ), $trim, $read_more ) ) );
            ?>

        </pre>
        <footer class="service_footer">

            <?php
            // ACF Number
            $price = get_field( 'asb_price' );

            // ACF True/False
            if ( get_field('show_homepage_price') && !empty( $price ) ) {
                echo '<span class="service_price">' . '£' . get_field( 'asb_price' ) . '</span>';
            } else {
                echo '<span class="service_price-empty"><a class="readMore" href="/services/#breed-pricelist">See Breed Pricelist</a></span>';
            }
            ?>

        </footer>
    </div>

<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
