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
        <div class="col-xs-12 col-md-8">
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
        <div class="col-xs-12 col-md-4 sidebar">
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
            ?>

            <?php if ($wp_query->have_posts()): ?>
                <?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>
                    <?php
                    if (function_exists('get_lab_images')) {
                        $lab_images = get_lab_images();
                    }
                    ?>
                    <?php $term_location = get_the_terms($post->ID, 'job-location'); ?>
                    <?php $term_position = get_the_terms($post->ID, 'job-position'); ?>
                    <?php $term_lab = get_the_terms($post->ID, 'lab'); ?>
                    <div class="row">
                        <a href="<?php the_permalink() ?>" title="<?php echo $term_lab[0]->name ?>">
                            <img src="<?php echo $lab_images['top-image'] ?>" alt="" />
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
                <?php endwhile; ?>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>            

            <?php $i = 0 ?>
            <?php if ($total_elements > 0): ?>
                <div class="row paging">
                    <ul>
                        <?php for ($counter = 0; $counter <= $total_elements; $counter++): ?>
                            <?php if ($counter % 3 == 0): ?>
                                <li data-index="<?php echo $i ?>" class="<?php echo ($i == 0) ? 'active' : ''; ?>"></li>
                                <?php $i++; ?>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </ul>
                </div>
            <?php endif; ?>
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