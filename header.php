<?php
/**
 * The Default header for the ASB Log theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ASB_Log
 */

// Load theme settings variables for this document
$asb_settings = get_option( 'asb_theme_array' ); // Serialized array of all Options
if ( $asb_settings === false ) {
	$asb_settings = [
		"asb_email_address" => "example@email-address.com",
		"asb_phone_number" => "0800 000 000"
	];
}
$asb_email_address = $asb_settings['asb_email_address']; // Email Address
$asb_phone_number = $asb_settings['asb_phone_number']; // Phone Number
$asb_phone_href = preg_replace('/\s+/', '', $asb_phone_number); // Whitespace cleaned for url
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">

<!-- asb_head start -->
<?php get_template_part( 'template-parts/bbs-head', 'none' );?>
<!-- asb_head end -->

<!-- wp_head start -->
<?php wp_head(); ?>
<!-- wp_head end -->

</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- PAGE GRID START -->
<div id="page" class="site">

	<header id="masthead" class="site-header">

        <div class="header_navBox">

			<a class="site-header_logo" href="/">
				<img alt="ASB Log logo" src="<?php echo get_template_directory_uri(); ?>/images/logo-asb-log-baked.svg">
			</a>

    		<nav id="site-navigation" class="main-navigation">
    			<button class="menu-toggle" aria-controls="primary-menu" aria-label="Main Menu" aria-expanded="false"><i class="fas fa-bars"></i><i class="fas fa-times"></i></button>

    			<?php wp_nav_menu(
                      array(
                          'theme_location' => 'menu-1',
                          'menu_id'        => 'primary-menu',
                      )
                ); ?>
    		</nav><!-- #site-navigation -->
        </div>

	</header>
