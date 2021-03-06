<?php
/*
 * Author: KhangLe
 *
 */

if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}

global $job_status; /* define array from class */

$terms = get_terms('lab');
$args_terms = array();
foreach ($terms as $term) {
    $args_terms[] = $term->slug;
}
?>

<div class="header-find-job">
    <div class="container">
        <h2 class="text-center">Find your dream jobs</h2>
        <div class="row-gap-medium"></div>
        <div class="col-xs-12 col-md-8 list l-col">
            <div class="row">
                <div class="header"></div>
                <h3>Jobs</h3>
            </div>

            <?php
            $counter = 0;
            $args = array(
                'post_type' => 'job',
                'posts_per_page' => job_get_option('wpt_job_text_item_per_page'),
                'meta_key' => 'status',
                'orderby' => array('meta_value_num' => 'DESC'),
                'paged' => $paged,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'lab',
                        'field' => 'slug',
                        'terms' => $args_terms,
                        'operator' => 'NOT IN',
                    ),
                ),
            );
            $wp_query = new WP_Query($args);
            ?>
            <?php if ($wp_query->have_posts()): ?>
                <?php
                while ($wp_query->have_posts()): $wp_query->the_post();
                    $counter++;
                    ?>
                    <?php $oe_class = ($counter % 2 == 0) ? '' : 'odd'; ?>
                    <div class="row info <?php echo $oe_class ?>">
                        <h4><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?> <?php if (get_field('status') != 0): ?><i class="highlight">(<?php echo $job_status[get_field('status')] ?>)</i><?php endif; ?></a></h4>
                        <?php $term_location = get_the_terms($post->ID, 'job-location'); ?>
                        <?php $term_position = get_the_terms($post->ID, 'job-position'); ?>
                        <p><?php echo ($term_location != false) ? $term_location[0]->name : '' ?> | <?php echo $term_position[0]->name ?>  / <?php echo get_field('work_level') ?></p>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
            <div class="row info see-all-job-overlay"></div>
            <div class="see-all-job">
                <a href="<?php echo bloginfo('url') ?>/jobs">See All Jobs</a>
            </div>
        </div>

        <div class="col-xs-12 col-md-4 list r-col">
            <div class="row">
                <div class="header"></div>
                <h3>Featured Labs</h3>
            </div>
            <div class="row-gap-medium space"></div>
            <?php include('feature-labs-top-2.php') ?>
        </div>
        <div class="clearfix"></div>
    </div>
</div>