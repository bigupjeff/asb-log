<?php
/**
 * ASB Log theme -  sidebar template
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package ASB_Log
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside class="sidebar">

    <div id="contactForm" class="sidebar_widgetWrap">
        <?php get_template_part( 'template-parts/sb-contact', 'none' );?>
    </div>

    <div class="sidebar_widgetWrap">
        <?php get_template_part( 'template-parts/sb-social', 'none' );?>
    </div>

    <div class="sidebar_widgetWrap">
        <?php get_template_part( 'template-parts/sb-subscribe', 'none' );?>
    </div>

    <!-- Pull in widgets enabled via admin if any -->
	<?php dynamic_sidebar( 'sidebar-1' ); ?>

</aside>
