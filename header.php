<?php
/**
 * The Default header for the ASB Log theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package ASB_Log
 */
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

		<a class="site-header_logo" href="/">
			<img alt="ASB Log logo" src="<?php echo get_template_directory_uri(); ?>/images/logo-asb-log-baked.svg">
		</a>
		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-label="Main Menu" aria-expanded="false">
				<i class="fas fa-bars"></i>
				<i class="fas fa-times"></i>
			</button>
			<?php wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			); ?>
		</nav>
		<?php $asb_log_description = get_bloginfo( 'description', 'display' );
		if ( $asb_log_description || is_customize_preview() ) :
		?>
			<span class="site-description">
				<?php echo $asb_log_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</span>
		<?php endif; ?>

	</header>
