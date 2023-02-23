<?php
/**
 * Default header template.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
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
<?php get_template_part( 'template-parts/bbs-head', 'none' ); ?>
<!-- asb_head end -->

<!-- wp_head start -->
<?php wp_head(); ?>
<!-- wp_head end -->

</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- PAGE GRID START -->
<div id="page" class="site">

	<header id="masthead" class="header">
		<div class="header_container">

			<a class="header_logo" href="/">
				<img alt="ASB Log logo" src="<?php echo get_template_directory_uri(); ?>/images/logo-asb-log-baked.svg">
			</a>
			<nav id="jsHeaderNav" class="mainNav">

				<?php if ( ! is_user_logged_in() ) : ?>
					<a class="mainNav_iconItem" title="login" href="/wp-login.php">
						<svg class="faIcon userCross" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L353.3 251.6C407.9 237 448 187.2 448 128C448 57.3 390.7 0 320 0C250.2 0 193.5 55.8 192 125.2L38.8 5.1zM264.3 304.3C170.5 309.4 96 387.2 96 482.3c0 16.4 13.3 29.7 29.7 29.7H514.3c3.9 0 7.6-.7 11-2.1l-261-205.6z"/></svg>
					</a>
				<?php else : ?>
					<a class="mainNav_iconItem" title="logout" href="/wp-login.php?action=logout">
						<svg class="faIcon user" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
					</a>
				<?php endif ?>

				<button class="mainNav_iconItem menuToggle" title="Menu" aria-controls="aria_menu-mainNav" aria-label="Main Menu" aria-expanded="false">
					<svg class="faIcon burger" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
					<svg class="faIcon cross" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg>
				</button>

				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'header',
						'menu_class'     => 'menu',
						'menu_id'        => 'aria_menu-mainNav',
					)
				);
				?>

			</nav>

		</div>
	</header>
