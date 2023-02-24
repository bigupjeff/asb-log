<?php
/**
 * Incident feed template part
 *
 * @package ASB_Log
 */

$asb_settings = get_option( 'asb_theme_array' ); // Serialized array of theme options.

?>

<?php if ( isset( $asb_settings['asb_incident_feed_title'] ) ) : ?>
	<div class="incidentFeed_title">
		<h2><?php echo $asb_settings['asb_incident_feed_title']; ?></h2>
	</div>
<?php endif ?>

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
while ( $loop->have_posts() ) :
	$loop->the_post();
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
	$incident_id    = get_the_ID();
	$incident_title = the_title( '', '', false );
	$incident_url   = sanitize_title( $incident_title );
	?>

	<div class="incident" id="indcident-<?php echo $incident_id; ?>">

		<div class="incident_header">
			<a href="<?php echo $incident_url; ?>">
				<?php echo $date . ' - ' . $incident_title; ?>
			</a>
		</div>

		<?php if ( is_user_logged_in() && current_user_can( 'edit_posts' ) ) : ?>
			<div class="incident_editBar">
				<a class="incident_editLink button button-outline button-tight" href="/wp-admin/post.php?post=<?php echo $incident_id; ?>&action=edit">Edit</a>
			</div>
		<?php endif ?>

		<?php if ( ! empty( $time_started ) ) : ?>
			<div class="incident_label">
				<span>Time started</span>
			</div>
			<div class="incident_value">
				<span><?php echo $time_started; ?></span>
			</div>
		<?php endif ?>

		<?php if ( ! empty( $time_stopped ) ) : ?>
			<div class="incident_label">
				<span>Time stopped</span>
			</div>
			<div class="incident_value">
				<span><?php echo $time_stopped; ?></span>
			</div>
		<?php endif ?>

		<div class="incident_label">
			<span>What happened?</span>
		</div>
		<div class="incident_value xScroll">
			<?php echo $what_happened; ?>
		</div>

		<?php if ( ! empty( $how_did_this_affect_you ) ) : ?>
			<div class="incident_label">
				<span>How did this affect you?</span>
			</div>
			<div class="incident_value">
				<?php echo $how_did_this_affect_you; ?>
			</div>
		<?php endif ?>

		<?php if ( ! empty( $location ) ) : ?>
			<div class="incident_label">
				<span>Location</span>
			</div>
			<div class="incident_value location">
				<table class="incident_table">
					<tr>
						<td>Address</td>
						<td><?php echo $location['address']; ?></td>
					</tr>
					<tr>
						<td>Latitude</td>
						<td><?php echo $location['lat']; ?></td>
					</tr>
					<tr>
						<td>Longitude</td>
						<td><?php echo $location['lng']; ?></td>
					</tr>
				</table> 
				<div class="incident_map">
					<?php
						$minLong = $location['lng'] + 0.0018;
						$minLat  = $location['lat'] - 0.00075;
						$maxLong = $location['lng'] - 0.0018;
						$maxLat  = $location['lat'] + 0.00075;
					?>
					<iframe
						width="100%"
						height="auto"
						frameborder="0"
						scrolling="no"
						marginheight="0"
						marginwidth="0"
						src="https://www.openstreetmap.org/export/embed.html?bbox=<?php echo "{$minLong}%2C{$minLat}%2C{$maxLong}%2C{$maxLat}"; ?>&amp;layer=mapnik&amp;marker=<?php echo "{$location[ 'lat' ]}%2C{$location[ 'lng' ]}"; ?>"
						style="border: 1px solid black"
					>
					</iframe>
					<small>
						<a href="https://www.openstreetmap.org/#map=17/<?php echo "{$location[ 'lat' ]}/{$location[ 'lng' ]}"; ?>">
							View Larger Map
						</a>
					</small>
				</div>
			</div>
		<?php endif ?>

		<?php if ( ! empty( $witness_details ) ) : ?>
			<div class="incident_label">
				<span>Witness details</span>
			</div>
			<div class="incident_value">
				<pre><?php echo $witness_details; ?></pre>
			</div>
		<?php endif ?>

		<?php if ( ! empty( $images ) ) : ?>
			<div class="incident_label">
				<span>Images</span>
			</div>
			<div class="incident_value">
				<?php
				if ( ! is_array( $images ) ) {
					$images = array( $images );
				}
				foreach ( $images as $image ) {
					?>
					<a target="_blank" class="incident_image" href="<?php echo $image; ?>">
						<img src="<?php echo $image; ?>">
					</a>
				<?php } // foreach ?>
			</div>
		<?php endif ?>

		<?php if ( ! empty( $video_url ) ) : ?>
			<div class="incident_label">
				<span>Video Link</span>
			</div>
			<div class="incident_value">
				<a target="_blank" href="<?php echo $video_url; ?>"><?php echo $video_url; ?></a>
			</div>
		<?php endif ?>

		<?php if ( ! empty( $file_attachement ) ) : ?>
			<div class="incident_label">
				<span>Files</span>
			</div>
			<div class="incident_value">
				<a target="_blank" href="<?php echo $file_attachement; ?>"><?php echo $file_attachement; ?></a>
			</div>
		<?php endif ?>

	</div>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
