<?php
/**
 * ASB Log theme - archive template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package ASB_Log
 */

get_header();
?>

    <main class="archive-main">

        	<?php if ( have_posts() ) : ?>

                <div class="topContent">
            		<header class="page-header">
            			<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
            		</header>
                </div>

                <div class="postGrid">

            		<?php
            		/* Start the Loop */
            		while ( have_posts() ) :

            			the_post();
            			get_template_part( 'template-parts/content', get_post_type() );

            		endwhile;

                echo '</div>'; /* postGrid */

        	else :

                echo '<div class="topContent">';
            		get_template_part( 'template-parts/content', 'none' );
                echo '</div>';

        	endif;
        	?>

        <?php get_sidebar(); ?>

    </main>

<!-- archive.php - Post Type: <?php echo get_post_type(); ?>  -->
<?php
get_footer();
