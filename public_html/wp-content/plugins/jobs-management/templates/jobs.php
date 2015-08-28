<?php
/*
 * Author: KhangLe
 * Template Name: Jobs
 * 
 */

if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}

global $job_status;

get_header();
?>

<div id="new-jobs">

    <!--//Search Bar-->
    <?php require_once(dirname(__FILE__) . '/job-search-bar.php') ?>
    <!--//Search Bar End-->

    <!--//Jobs List-->
    <div class="container header-job-list">
        <!-- hot -->
        <?php
        $args = array(
            'post_type' => 'job',
            'posts_per_page' => 5,
            'meta_key' => 'status',
            'orderby' => array('status' => 'DESC'),
            'paged' => $paged,
        );
        $wp_query = new WP_Query($args);
        ?>
        <?php if ($wp_query->have_posts()): ?>
            <?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>
                <div class="row item <?php echo $job_status[get_field('status')] ?>">
                    <div class="col-xs-6">
                        <div class="title">
                            <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                        </div>
                        <div class="info">
                            <?php $term = get_the_terms($post->ID, 'job-location'); ?>
                            <span class="localtion"><?php echo $term[0]->name ?></span> | <span class="level"><?php echo get_field('work_level') ?></span>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="text-blue">
                            <?php echo wp_trim_words(get_field('job_requirement'), 10, '...') ?>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div><img class="date" src="<?php echo WP_PLUGIN_URL ?>/jobs-management/img/new_job/4.png" alt=""> Posted: <?php the_date() ?></div>
                        <div><img class="view" src="<?php echo WP_PLUGIN_URL ?>/jobs-management/img/new_job/5.png" alt=""> Views: 92</div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
    <!--//Jobs List End-->

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
    <?php wp_reset_postdata(); ?>
</div>

<!--//Map-->
<?php get_template_part('google-map') ?>
<!--//Map End-->

<?php get_footer(); ?>