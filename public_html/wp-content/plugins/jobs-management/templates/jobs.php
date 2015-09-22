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


    <?php
    $terms = get_terms('lab');
    $args_terms = array();
    foreach ($terms as $term) {
        $args_terms[] = $term->slug;
    }

    $args = array(
        'post_type' => 'job',
        'posts_per_page' => 3,
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
    ?>

    <ul>
        <?php if ($wp_query->have_posts()): ?>
            <?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>
                <li>
                    <?php
                    if(function_exists('get_lab_images')){
                        $lab_images = get_lab_images();
                    }
                    ?>
                    <h1><?php echo get_the_title() ?></h1>
                    <img src="<?php echo $lab_images['medium-top-image'] ?>" />
                </li>
            <?php endwhile; ?>
        <?php endif; ?>
    </ul>

</div>

<?php get_footer(); ?>