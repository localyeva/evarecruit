<?php
/*
 * Author: KhangLe
 * Template Name: Jobs Search
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
        <?php require_once(dirname(__FILE__) . '/jobs-row.php') ?>
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