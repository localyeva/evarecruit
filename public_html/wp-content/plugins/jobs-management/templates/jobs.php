<?php
/*
 * Author: KhangLe
 * Template Name: Jobs
 *
 */

if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}

global $job_status; /* define array from class */

get_header();
?>

<div id="new-jobs">

    <!--//Search Bar-->
    <?php require_once(dirname(__FILE__) . '/job-search-bar.php') ?>
    <!--//Search Bar End-->


    <div class="container header-job-list">
        <!--//Jobs List-->
        <div class="col-xs-12 col-md-8 content">
            <?php require_once(dirname(__FILE__) . '/jobs-row_1.php') ?>
            <!--//Paging-->
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 no-padding-l">
                        <!--<nav>-->
                        <?php wpbeginner_numeric_posts_nav(); ?>
                        <!--</nav>-->
                    </div>
                </div>
            </div>
            <!--//Paging End-->
        </div>
        <!--//Jobs List END-->
        <?php wp_reset_postdata(); ?>

        <!-- Lab Jobs List -->
        <div id="job-carousel-sidebar" class="col-xs-12 col-md-4 sidebar carousel slide vertical carousel-fade" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
            <?php
            $terms = get_terms('lab');
            $args_terms = array();
            foreach ($terms as $term) {
                $args_terms[] = $term->slug;
            }

            $args = array(
                'post_type' => 'job',
                'posts_per_page' => -1,
                'meta_key' => 'status',
                'orderby' => array('meta_value_num' => 'DESC'),
                'paged' => $paged,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'lab',
                        'field' => 'slug',
                        'terms' => $args_terms,
                    ),
                ),
            );
            $wp_query = new WP_Query($args);
            $total_elements = $wp_query->found_posts;
            $i = 0;
            $ads_per_item = 3;
            ?>

            <?php if ($wp_query->have_posts()): ?>
                <?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>
                    <?php
                    if (function_exists('get_lab_info')) {
                        $lab_images = get_lab_info();
                    }
                    ?>
                    <?php $term_location = get_the_terms($post->ID, 'job-location'); ?>
                    <?php $term_position = get_the_terms($post->ID, 'job-position'); ?>
                    <?php $term_lab = get_the_terms($post->ID, 'lab'); ?>
                    <?php
                    if ($i % $ads_per_item == 0) {
                        $active = '';
                        if ($i == 0) {
                            $active = 'active';
                        }
                        echo '<div class="item ' . $active . '">';
                    }
                    ?>
                    <div class="row ads">
                        <a href="<?php the_permalink() ?>" title="<?php echo $term_lab[0]->name ?>">
                            <img src="<?php echo $lab_images['top-image']['large'] ?>" alt="" />
                        </a>
                        <div class="l-col">
                            <a href="<?php the_permalink() ?>" title="<?php echo get_the_title() ?>">
                                <h4><?php echo get_the_title() ?> <?php if (get_field('status') != 0): ?><i class="new">(<?php echo $job_status[get_field('status')] ?>)</i><?php endif; ?></h4>
                            </a>
                            <div class="info">
                                <span class="localtion"><?php echo $term_location[0]->name ?></span> | <span class="level"><?php echo $term_position[0]->name ?> / <?php echo get_field('work_level') ?></span>
                            </div>
                        </div>
                        <div class="r-col">
                            <div class="text-blue">
                                <?php echo wp_trim_words(get_field('job_requirement'), 10, '...') ?>
                            </div>
                            <div class="posted">Posted: <?php echo get_the_date('d-m-Y') ?></div>
                            <div class="views">Views: <?php echo getPostViews(get_the_ID(), 'job_views') ?></div>
                        </div>
                    </div>
                    <?php
                    if (($i + 1 - $ads_per_item) % $ads_per_item == 0 || $i == $total_elements - 1) {
                        echo '</div>';
                    }
                    $i++;
                    ?>
                <?php endwhile; ?>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>

            <?php $i = 0 ?>
            <?php if ($total_elements > 0): ?>
                <div class="row paging">
                    <ul class="carousel-indicators">
                        <?php for ($counter = 0; $counter < $total_elements; $counter++): ?>
                            <?php if ($counter % 3 == 0): ?>
                                <li data-target="#job-carousel-sidebar" data-slide-to="<?php echo $i ?>" data-index="<?php echo $i ?>" class="<?php echo ($i == 0) ? 'active' : ''; ?>"></li>
                                <?php $i++; ?>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </ul>
                </div>
            <?php endif; ?>
            </div>
        </div>
        <!-- Lab Jobs List -->
    </div>

    <!--//Job Apply your resume-->
    <div id="free-apply">
        <?php echo do_shortcode('[jobs-part type="apply-ur-resume"]') ?>
    </div>
    <!--//Job Apply your resume End-->

</div>

<?php get_footer(); ?>