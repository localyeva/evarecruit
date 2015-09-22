<?php
/*
 * Author: KhangLe
 * Template Name: Job of Lab
 * 
 */
if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}

// Count number of views
if (function_exists('setPostViews')) {
    setPostViews(get_the_ID(), 'job_views');
}


/* get meta data of term */
$term = get_the_terms($post->ID, 'lab');

if(function_exists('get_lab_images')){
    $lab_images = get_lab_images();
}

get_header();
?>

<div class="header-banner" style="background: url('<?php echo $lab_images['top-image'] ?>') no-repeat scroll 0 0">
    <div class="container text-center">
        <h2 class="text-bold"><?php echo $term[0]->name ?></h2>
        <h3><?php echo $term[0]->description ?></h3>
    </div>
</div>

<div id="new-job-detail">

    <!--//Search Bar-->
    <?php // require_once(dirname(__FILE__) . '/job-search-bar.php') ?>
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

                <div class="detail lab-photos noprint">
                    <div class="row">
                        <?php for ($i = 1; $i < 3; $i++): ?>
                            <?php if (isset($lab_images['image-' . $i])): ?>
                                <div class="col-xs-12 col-md-6">
                                    <img class="img-responsive" src="<?php echo $lab_images['image-' . $i] ?>" />
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                </div>

                <div class="actions noprint">
                    <div class="row">
                        <!--
                        <div class="col-xs-12 col-md-2">
                            <div class="item">
                                <img src="<?php echo WP_PLUGIN_URL ?>/jobs-management/img/new_job_detail/4.png" alt="">
                                <span class="item-name">Save job</span>
                            </div>
                        </div>
                        -->
                        <div id="print-job" class="col-xs-12 col-md-2">
                            <div class="item">
                                <img src="<?php echo WP_PLUGIN_URL ?>/jobs-management/img/new_job_detail/5.png" alt="">
                                <span class="item-name">Print this job</span>
                            </div>
                        </div>
                        <!--
                        <div class="col-xs-12 col-md-2">
                            <div class="item">
                                <img src="<?php echo WP_PLUGIN_URL ?>/jobs-management/img/new_job_detail/6.png" alt="">
                                <span class="item-name">Report this job</span>
                            </div>
                        </div>
                        -->
                        <!--
                        <div class="col-xs-12 col-md-6 text-right item">[Edit]</div>
                        -->
                    </div>
                </div>

                <div class="row-gap-medium"></div>

                <div class="row noprint">
                    <div class="col-xs-12">
                        <a href="#apply-form-modal" class="openform"><button class="large pull-right btn btn-blue">Apply</button></a>
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
        <div class="container text-center">
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
                    <label for="content" class="col-sm-2 control-label">Terms - Privacy</label>
                </div>
                <div class="box">
                    <div class="row">
                        <div class="col-xs-10 nano">
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
                    <div class="col-xs-3 col-xs-offset-9">
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

<div id="detail-staff">
    <div class="header-our-thoughts">
        <div class="container">
            <h2 class="text-bold text-center"><?php echo get_staff_detail_thought_title_text() ?></h2>
            <?php
            $args = array(
                'post_type' => 'staff',
                'posts_per_page' => -1,
                'orderby' => array('date' => 'ASC'),
            );
            $loop = new WP_Query($args);
            ?>
            <?php
            if ($loop->have_posts()):
                $i = 0;
                ?>    
                <?php
                while ($loop->have_posts()):
                    if ($i == 3) {
                        break;
                    }
                    $loop->the_post();
                    ?>
                    <div class="row-gap-medium"></div>
                    <div class="row item">
                        <?php if ($i % 2 == 0): ?>
                            <div class="col-md-4 col-xs-12 no-padding-lr">
                                <img src="<?php echo get_field('image') ?>" alt="" class="img-responsive full-width">
                                <div class="caption full-width left">
                                    <h3><?php the_title(); ?></h3>
                                    <div class="intro"><?php echo get_field('job_description'); ?></div>
                                </div>
                            </div>
                            <div class="col-md-8 col-xs-12 content icon-right">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p class="text"><?php echo get_field('staff_thoughts') ?></p>
                                        <p><?php echo get_field('activity') ?></p>
                                    </div>
                                </div>
                                <?php if (have_rows('activity_images')): ?>
                                    <div class="row photo">
                                        <?php while (have_rows('activity_images')) : the_row(); ?>                                
                                            <div class="col-xs-3 pull-right">
                                                <a href="<?php echo get_sub_field('image'); ?>" class="photo1" rel="gal<?php echo $i; ?>" title="EVOLABLE ASIA">
                                                    <img src="<?php echo get_sub_field('image') ?>" alt="" class="img-responsive">
                                                </a>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <div class="col-md-8 col-xs-12 no-padding-l content icon-left">
                                <div class="row-gap-medium"></div>
                                <div class="row-gap-small"></div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p class="text"><?php echo get_field('staff_thoughts') ?></p>
                                        <p><?php echo get_field('activity') ?></p>
                                    </div>
                                </div>
                                <?php if (have_rows('activity_images')): ?>
                                    <div class="row photo">
                                        <?php while (have_rows('activity_images')) : the_row(); ?>                                
                                            <div class="col-xs-3 pull-right">
                                                <a href="<?php echo get_sub_field('image'); ?>" class="photo1" rel="gallery2" title="EVOLABLE ASIA">
                                                    <img src="<?php echo get_sub_field('image'); ?>" alt="" class="img-responsive">
                                                </a>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-4 col-xs-12 no-padding-lr">
                                <img src="<?php echo get_field('image') ?>" alt="" class="img-responsive full-width">
                                <div class="caption full-width right">
                                    <h3><?php the_title(); ?></h3>
                                    <div class="intro"><?php echo get_field('job_description'); ?></div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php
                    $i++;
                endwhile;
                ?>
            <?php endif; ?>
            <?php wp_reset_postdata() ?>                    
        </div>
    </div>

    <?php
    $args = array(
        'post_type' => 'staff',
        'posts_per_page' => -1,
        'orderby' => array('date' => 'ASC'),
    );
    $loop = new WP_Query($args);
    if ($loop->have_posts()):
        $num_posts = count($loop->posts);
        ?>
        <div class="header-featured-photos">
            <div class="container">
                <div class="row-gap-large"></div>
                <!--div class="text-center">
                    <div class="block-center">
                        <img src="<?php echo get_template_directory_uri() ?>/img/down_arrow.png" alt="">
                    </div>
                    <div class="text-muted">Drag to see more</div>
                </div-->
                <div class="row-gap-large"></div>
                <?php
                $num_parts = $num_posts % 6 == 0 ? $num_posts / 6 : intval($num_posts / 6) + 1;
                for ($i = 0; $i < $num_parts; $i++) {
                    $j = 0;
                    ?>                    
                    <div class="row-gap-medium"></div>
                    <div class="row">
                        <?php
                        while ($loop->have_posts()) {
                            if ($j == 6)
                                break;
                            $loop->the_post();
                            ?>
                            <div class="col-xs-4 block-center col-md-2">
                                <a href="<?php the_permalink() ?>">
                                    <img src="<?php echo get_field('image') ?>" alt="" class="img-responsive">
                                </a>
                            </div>
                            <?php
                            $j++;
                        }
                        ?>
                    </div> 

                <?php } ?>
                <div class="row-gap-large"></div>
            </div>
        </div>

    <?php endif; ?>
    <?php wp_reset_postdata() ?>
</div>


<?php get_footer(); ?>