<?php
/*
 * Author: KhangLe
 * Template Name: Jobs Search
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
        <?php include('feature-labs-jobs-1.php') ?>
        <!-- Lab Jobs List -->
    </div>

    <!--//Job Apply your resume-->
    <div id="free-apply">
        <?php echo do_shortcode('[jobs-part type="apply-ur-resume"]') ?>
    </div>
    <!--//Job Apply your resume End-->

</div>

<?php get_footer(); ?>