<?php
/**
 * ASB Log theme - Template part for displaying service posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package ASB_Log
 */

$icon_id  = get_field( 'asb_icon' );
$icon_dir = get_attached_file( $icon_id );
$title    = the_title( '', '', false );
$url      = sanitize_title( $title );
?>

			<div class="service">

				<header class="service_header">
					<div class="service_iconWrap"><?php echo file_get_contents( $icon_dir ); ?></div>
					<h3 id="<?php echo $url; ?>" class="service_title"><?php echo $title; ?></h3>
				</header>

				<pre class="service_description">
					<?php the_content(); ?>
				</pre>

				<footer class="service_footer">
					<a class="readMore" href="#contactForm"><i>Book Now </i><i class="fas fa-angle-double-right"></i></a>

					<?php
					// ACF Number
					$price = get_field( 'asb_price' );

					// ACF True/False
					if ( get_field( 'show_pricelist_price' ) && ! empty( $price ) ) {
						echo '<span class="service_price">' . '£' . get_field( 'asb_price' ) . '</span>';
					} else {
						echo '<span class="service_price-empty"><a class="readMore" href="/services/#breed-pricelist">See Breed Pricelist</a></span>';
					}
					?>

				</footer>
			</div>
