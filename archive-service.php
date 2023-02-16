<?php
/**
 * ASB Log theme - service posts (archive) template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package ASB_Log
 */

// Services page vars
$service_post_id = '76';
$breed_table_post_id = '432';
get_header();

    echo '<main class="archive-main">';

        if ( have_posts() ) { ?>

            <div class="topContent">

                <header class="page-header">
                    <?php the_archive_title( '<h1 id="services_title" class="page-title">', '</h1>' ); ?>
                    <?php echo get_post_field( 'post_content', $service_post_id ); ?>
                </header>

                <section id="pricelist" class="pricelist">
                    <h2>Dog Grooming Service Pricelist</h2>
                    <!-- Fetch service price table -->
                    <?php get_template_part( 'template-parts/content', 'pricelist' ); ?>
                </section>

                <section id="breed-pricelist" class="pricelist">
                    <h2 class=""><?php echo get_post_field( 'post_title', $breed_table_post_id, 'raw' ); ?></h2>
                    <!-- Fetch breed price table -->
                    <?php echo get_post_field( 'post_content', $breed_table_post_id ); ?>
                </section>

            </div>

            <!-- Get the full service details -->
            <section class="postGrid">

                <!-- Build args array for loop to filter and sort -->
                <?php $args = array(
                    'post_type'        => 'service',
                    'post_status'      => 'publish',
                    'posts_per_page'   => '-1',
                    'meta_key'         => 'asb_position',
                    'orderby'          => 'meta_value',
                    'order'            => 'ASC',
                    'tax_query' => array(  /* Exclude hidden category */
                        array(
                            'taxonomy' => 'category',
                            'field'    => 'id',
                            'terms'    => '9',
                            'operator' => 'NOT IN'
                        )
                    )
                );

                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();

                    get_template_part( 'template-parts/content', 'service' );

                endwhile;
                wp_reset_postdata();

            echo '</section>'; /* postGrid */

    	} else {

            get_template_part( 'template-parts/content', 'none' );

        }

        get_sidebar();

    echo '</main>';

echo '<!-- archive-service.php - Post Type: ' . get_post_type() .' -->';
get_footer();
