<?php
/*
 * Author: KhangLe
 * Template Name: Jobs
 * 
 */

if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}

// Count number of views
if (function_exists('setPostViews')){
    setPostViews(get_the_ID(), 'job_views');
}


get_header();
?>

<div id="new-job-detail">

    <!--//Search Bar-->
    <?php require_once(dirname(__FILE__) . '/job-search-bar.php') ?>
    <!--//Search Bar End-->

    <div class="container">
        <div class="row">
            <div class="col-xs-12">

                <div class="standout">
                    <div class="row">
                        <div class="col-xs-12 col-md-9">
                            <div class="title">
                                <?php the_title() ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            posted on <span class="time"><?php echo pretty_relative_time(the_date('', '', '', false)) ?></span>
                        </div>
                    </div>
                </div>

                <div class="detail">
                    <!-- info -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="title">Recruit Information</div>
                            <div class="content">
                                <?php $position = get_the_terms($post->ID, 'job-position'); ?>
                                <p>Position: <?php echo $position[0]->name ?></p>
                                <p>Work level: <?php echo get_field('work_level') ?></p>
                                <p>Salary: <?php echo get_field('salary') ?></p>
                                <?php $location = get_the_terms($post->ID, 'job-location'); ?>
                                <p>Location: <?php echo $location[0]->name ?></p>
                                <p>Expire date: <?php echo get_field('expire_date') ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- description -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="title">Job Description</div>
                            <?php echo get_field('job_requirement') ?>
                        </div>
                    </div>
                    <!-- requirement -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="title">Job Description</div>
                            <?php echo get_field('job_description') ?>
                        </div>
                    </div>
                </div>

                <div class="actions">
                    <div class="row">
                        <div class="col-xs-12 col-md-2">
                            <div class="item">
                                <img src="<?php echo WP_PLUGIN_URL ?>/jobs-management/img/new_job_detail/4.png" alt="">
                                <span class="item-name">Save job</span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-2">
                            <div class="item">
                                <img src="<?php echo WP_PLUGIN_URL ?>/jobs-management/img/new_job_detail/5.png" alt="">
                                <span class="item-name">Print this job</span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-2">
                            <div class="item">
                                <img src="<?php echo WP_PLUGIN_URL ?>/jobs-management/img/new_job_detail/6.png" alt="">
                                <span class="item-name">Report this job</span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 text-right item">[Edit]</div>
                    </div>
                </div>

                <div class="row-gap-medium"></div>

                <div class="row">
                    <div class="col-xs-12">
                        <button class="large pull-right btn btn-blue">Submit request</button>
                    </div>
                </div>

                <div class="row-gap-medium"></div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>