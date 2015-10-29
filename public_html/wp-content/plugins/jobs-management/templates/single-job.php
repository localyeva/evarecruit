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
                        <div class="col-xs-12 col-md-3">
                            posted on <span class="time"><?php echo get_time_duration(get_the_date('Y-m-d H:i:s')) ?></span>
                            <div id="print-job" class="noprint pull-right">
                                <div class="item">
                                    <img src="<?php echo WP_PLUGIN_URL ?>/jobs-management/img/new_job_detail/5.png" alt="">
                                </div>
                            </div>
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
                            <a href="#apply-form-modal" class="openform  submit col-xs-12 col-md-4"><span class="send">Apply</span></a>
                        </div>
                    </div>
                </div>
                <div class="row-gap-medium"></div>
            </div>
        </div>
    </div>
</div>

<style>#re_check-error{display: none;}</style>
<!-- // Apply Form Start -->
<div id="apply-form-modal" class="apply-form-modal" style="display: none;">
    <div class="header-top-apply">
        <div class="text-center">
            <h2 class="text-bold">Apply Your Resume</h2>
        </div>
    </div>
    <div class="row-gap-large"></div>
    <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2">
            <form id="apply-form" name="apply-form" class="form-horizontal" action="<?php echo bloginfo('url') ?>/jobs-apply" target="iapply" enctype="multipart/form-data" method="POST">
                <div class="form-group">
                    <label for="re_email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="re_email" name="re_email" placeholder="Email">
                    </div>
                </div>

                <div class="form-group">
                    <label for="re_fullname" class="col-sm-2 control-label">Full Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="re_fullname" name="re_fullname" placeholder="Full Name">
                    </div>
                </div>

                <div class="form-group">
                    <label for="re_tel" class="col-sm-2 control-label">Phone Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="re_tel" name="re_tel" placeholder="Phone Number">
                    </div>
                </div>

                <div class="form-group">
                    <label for="re_gender" class="col-sm-2 control-label">Gender</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label>
                                <input type="radio" name="re_gender[]" id="re_gender_m" value="m" checked>Male
                            </label>
                            <label>
                                <input type="radio" name="re_gender[]" id="re_gender_f" value="f">Female
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="re_attach" class="col-sm-2 control-label">Attach CV</label>
                    <div class="col-sm-10">
                        <input type="file" id="re_attach" name="re_attach" />
                    </div>
                </div>

                <div class="row-gap-medium"></div>
                <div class="form-group">
                    <label for="content" class="control-label">Terms - Privacy</label>
                </div>
                <div class="box">
                    <div class="row">
                        <div class="col-xs-10">
                                <?php require_once(dirname(__FILE__) . '/part-job-privacy-agree.php'); ?>
                        </div>
                    </div>
                </div>
                <div class="row-gap-small"></div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="checkbox">
                            <label for="re_check">
                                <input type="checkbox" id="re_check" name="re_check" value="" checked>
                                I agree to the Evolable Asia Terms and Privacy.
                            </label>
                            <br/>
                            <label id="re_check-error" class="error" for="re_check">Bạn có đồng ý ứng tuyển vị trí. Vui lòng check bên dưới</label>
                        </div>
                    </div>
                </div>
                <div class="row-gap-medium"></div>
                <div class="row">
                    <div class="col-md-5 col-xs-12 btn-apply">
                        <button class="btn btn-block btn-orange" type="submit" name="apply" value="job">Submit request</button>
                    </div>
                </div>
                <div class="row-gap-large"></div>
                <input type="hidden" name="job_id" value="<?php the_ID() ?>"/>
                <input type="hidden" name="job_slug" value="<?php echo $post->post_name ?>"/>
                <input type="hidden" name="job_title" value="<?php the_title() ?>"/>
                <input type="hidden" name="job_position" value="<?php echo $position[0]->name ?>"/>
                <input type="hidden" name="job_location" value="<?php echo $location[0]->name ?>"/>
                <input type="hidden" name="job_level" value="<?php echo get_field('work_level') ?>"/>
                <input type="hidden" name="job_salary" value="<?php echo get_field('salary') ?>"/>
                <input type="hidden" name="job_expired" value="<?php echo format_date(get_field('expire_date')) ?>"/>
            </form>
        </div>
    </div>
</div>
<iframe id="iapply" name="iapply" width="0" height="0" border="0" style="display: none;"></iframe>
<!-- // Apply Form End -->

<?php get_footer(); ?>