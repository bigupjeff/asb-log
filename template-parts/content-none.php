<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ASB_Log
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'asb-log' ); ?></h1>
	</header>

	<div class="page-content">

        <p><?php esc_html_e( 'We couldn&rsquo;t find the content you&rsquo;re looking for. Maybe try one of the links below?', 'asb-log' ); ?></p>

        <div class="row">
            <div class="column">
                <?php wp_nav_menu(
                      array(
                          'theme_location'  => 'menu-1',
                          'container_class' => 'menu-404-container',
                          'menu_class'      => 'menu-404',
                          'menu_id'         => 'menu-404',
                          'link_after'      => ' <i class="fas fa-angle-double-right"></i>'
                      )
                ); ?>
            </div>
            <div class="column">

                <img class="dog-404" alt="A picture of a dog looking guilty" src="<?php echo get_template_directory_uri(); ?>/images/dog-404.png">

            </div>
        </div>

	</div>
</section>
<!-- content-none.php -->
