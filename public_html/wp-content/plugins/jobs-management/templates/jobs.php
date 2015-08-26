<?php
/*
 * Author: KhangLe
 * Template Name: Jobs
 * 
 */

if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}

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
            'posts_per_page' => 10,
            'meta_key' => 'status',
            'orderby' => array('status' => 'DESC'),
        );
        $loop = new WP_Query($args);
        ?>
        <?php if ($loop->have_posts()): ?>
            <?php while ($loop->have_posts()): $loop->the_post(); ?>
                <div class="row item hot">
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
        <?php wp_reset_postdata(); ?>
    </div>
    <!--//Jobs List End-->

    <!--//Paging-->
    <div class="container">
        <div class="row">
            <div class="col-xs-12 no-padding-l">
                <nav>
                    <ul class="pagination">
                        <li>
                            <a href="#" aria-label="Previous">
                                <span aria-hidden="true">Prev</span>
                            </a>
                        </li>
                        <li><a href="#" class="active">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li>
                            <a href="#" aria-label="Next">
                                <span aria-hidden="true">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<!--//Paging End-->

<?php get_footer(); ?>