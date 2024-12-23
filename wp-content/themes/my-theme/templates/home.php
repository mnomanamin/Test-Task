<?php

/**
 * Template Name: Home
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = [
    'post_type' => 'post',
    'posts_per_page' => 6,
    'paged' => $paged,
    'post_status' => 'publish'
];

$query = new WP_Query($args);

if ($query->have_posts()) : ?>


<infinite-scroll>
    <section class="template__category">
        <div class="container">
            <div class="blog__row">
                <div class="blogs__all-column" >
                    <div class="blogs__item-row">
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <div class="blogs__item-column">
                                <a href="<?php the_permalink(); ?>" class="blogs__item-wapper">
                                    <div class="blog__featured-img">
                                        <?php the_post_thumbnail('full'); ?>
                                    </div>
                                    <div class="blog__featured-info">
                                        <h3><?php the_title(); ?></h3>
                                        <p><?php echo get_the_date(); ?></p>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    
                    </div>
                    <div class="loader-container" style="display: none;">
                        
                        <div class="product__items-loader">
                            <div class="loader"></div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </section>
</infinite-scroll>

<?php wp_reset_postdata(); ?>
<?php endif; ?>

<?php get_footer(); ?>