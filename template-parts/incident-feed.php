<?php
// The incident feed Template Part for ASB Log
// 2023 © ASB Log
// Author: Jefferson Real
// URL: https://jeffersonreal.uk

$asb_settings = get_option( 'asb_theme_array' ); // Serialized array of all Options

?>

<?php if ( isset( $asb_settings['asb_incident_feed_title'] ) ): ?>
	<div class="incidentFeed_title">
		<h2><?php echo $asb_settings['asb_incident_feed_title']; ?></h2>
	</div>
<?php endif ?>

<div class="incidentFeed_list">

    <?php
	if ( isset( $asb_settings['asb_incident_feed_count'] ) ) {
		$posts_per_page = $asb_settings['asb_incident_feed_count'];
	} else {
		$posts_per_page = 10;
	}

    $args = array(
        'post_type'      => 'incident',
        'post_status'    => 'publish',
        'posts_per_page' => $posts_per_page,
        'meta_key'       => 'date',
        'orderby'        => array( 'meta_value' => 'ASC' ),
    );

    $loop = new WP_Query( $args );

    while ( $loop->have_posts() ) : $loop->the_post();
		/* ACF custom field data */
		$date                    = get_field( 'date' );
		$time_started            = get_field( 'time_started' );
		$time_stopped            = get_field( 'time_stopped' );
		$what_happened           = get_field( 'what_happened' );
		$how_did_this_affect_you = get_field( 'how_did_this_affect_you' );
		$location                = get_field( 'location' );
		$witness_details         = get_field( 'witness_details' );
		$images                  = get_field( 'images' );
		$video_url               = get_field( 'video_url' );
		$file_attachement        = get_field( 'file_attachement' );

		/* WP post data */
		$title = the_title( '', '', false );
		$url = sanitize_title( $title );
	?>

        <div class="incidentFeed_row">
            <div class="service">

                <header class="service_header">
					<?php if ( !empty( $date ) ) { echo '<span>' . $date . '</span>'; } ?>
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
                    if ( !empty( $started ) ) { echo '<span class="service_price">Time started:' . $started . '</span>'; }
					if ( !empty( $stopped ) ) { echo '<span class="service_price">Time stopped:' . $stopped . '</span>'; }
                    ?>

                </footer>

            </div>
            <div class="incidentFeed_imgWrap">
				<pre>
					<?php
						if ( !empty( $date ) )                    echo $date;
						if ( !empty( $time_started ) )            echo $time_started;
						if ( !empty( $time_stopped ) )            echo $time_stopped;
						if ( !empty( $what_happened ) )           echo $what_happened;
						if ( !empty( $how_did_this_affect_you ) ) echo $how_did_this_affect_you;
						if ( !empty( $location ) )                echo $location;
						if ( !empty( $witness_details ) )         echo $witness_details;
						if ( !empty( $images ) )                  echo $images;
						if ( !empty( $video_url ) )               echo $video_url;
						if ( !empty( $images ) )                  echo $images;
					?>
				</pre>
            </div>
        </div>

    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>

</div>
