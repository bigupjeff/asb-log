<?php
/**
 * ASB Log theme - 404 error page template
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 * @package ASB_Log
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'We made a dog&rsquo;s dinner out of that!', 'asb-log' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">

				<p><?php esc_html_e( 'It looks like the page you&rsquo;re looking for is missing or the web address is incorrect. Maybe try one of the links below?', 'asb-log' ); ?></p>

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

        <?php get_sidebar(); ?>

	</main>

<!-- 404.php -->
<?php
get_footer();
