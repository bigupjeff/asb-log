<?php
// The Other Services Template Part for ASB Log
// 2023 © ASB Log
// Author: Jefferson Real
// URL: https://jeffersonreal.uk

$asb_settings = get_option( 'asb_theme_array' ); // Serialized array of all Options
$asb_other_services_count = $asb_settings['asb_other_services_count']; // Other Services Count
$asb_title_secondary_services = $asb_settings['asb_title_secondary_services']; // Secondary Services Title

?>

<div class="otherServices_title">
    <h2><?php echo $asb_title_secondary_services; ?></h2>
</div>

<div class="otherServices_list">

    <?php

    $args = array(
        'post_type'      => 'incident',
        'post_status'    => 'publish',
        'posts_per_page' => $asb_other_services_count,
        'meta_key'       => 'date',
        'orderby'        => array( 'meta_value' => 'ASC' ),
    );

    $loop = new WP_Query( $args );

    while ( $loop->have_posts() ) : $loop->the_post();?>

        <div class="otherServices_row gs_reveal">
            <div class="service">
                <header class="service_header">

				<?php
				$date = get_field( 'date' );
				if ( !empty( $date ) ) {
					echo '<p>' . $date . '</p>';
				}
				?>

                    <?php
                    $title = the_title( '', '', false );
                    $url = sanitize_title( $title );
                    ?>

                    <h3 class="service_title"><a href="/services/#<?php echo $url; ?>"><?php echo $title; ?></a></h3>

                </header>
                <pre class="service_description">

                    <?php
                    $trim = '50';
                    $read_more = '...<a class="readMore" href="/services/#' . $url . '"><i> read more </i><i class="fas fa-angle-double-right"></i></a>';
                    echo force_balance_tags( html_entity_decode( wp_trim_words( htmlentities( get_field( 'what_happened' ) ), $trim, $read_more ) ) );
                    ?>

                </pre>

                <footer class="service_footer">

                    <?php
                    // ACF fields
                    $started = get_field( 'time_started' );
					$stopped = get_field( 'time_stopped' );

                    if ( !empty( $started ) ) {
                        echo '<span class="service_price">Time started:' . $started . '</span>';
                    }
					
					if ( !empty( $stopped ) ) {
                        echo '<span class="service_price">Time stopped:' . $stopped . '</span>';
                    }
                    ?>

                </footer>

            </div>
            <div class="otherServices_imgWrap">
                <?php $image = get_field( 'asb_tile_image' ); ?>
                <?php if( !empty( $image ) ): ?>
                    <img class="otherServices_img" src="<?php echo $image; ?>" />
                <?php endif; ?>
            </div>
        </div>

    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>

</div>
