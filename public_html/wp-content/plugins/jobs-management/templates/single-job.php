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
if (function_exists('setPostViews')) {
    setPostViews(get_the_ID(), 'job_views');
}

get_header();
?>

<div id="new-job-detail">

    <!--//Search Bar-->
    <?php require_once(dirname(__FILE__) . '/job-search-bar.php') ?>
    <!--//Search Bar End-->

    <div id="print-job-part" class="container">
        <div class="row">
            <div class="col-xs-12">

                <div class="standout">
                    <div class="row">
                        <div class="col-xs-12 col-md-9">
                            <div class="title">
                                <?php the_title() ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3 text-right">
                            posted on <span class="time"><?php echo get_time_duration(get_the_date('Y-m-d H:i:s')) ?></span>
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
                                <p>Location: <?php echo ($location!==FALSE)?$location[0]->name:"" ?></p>
                                <p>Expire date: <?php echo format_date(get_field('expire_date')) ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- description -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="title">Job Description</div>
                            <?php echo get_field('job_description') ?>
                        </div>
                    </div>
                    <!-- requirement -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="title">Job Requirement</div>
                            <?php echo get_field('job_requirement') ?>
                        </div>
                    </div>

                    <div class="row-gap-medium"></div>

                    <div class="row noprint">
                        <div class="col-xs-12">
                            <a href="#apply-form-modal-<?php the_ID()?>" class="openform  submit col-xs-12 col-md-4"><span class="send">Apply</span></a>
                        </div>
                    </div>
                </div>
                <div class="row-gap-medium"></div>
            </div>
        </div>
    </div>
</div>

<?php require_once(dirname(__FILE__) . '/part-apply-form.php') ?>

<?php get_footer(); ?>