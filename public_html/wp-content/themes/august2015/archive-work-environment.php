<?php
/*
 * Author: KhangLe
 * Template Name: Work Environment
 *
 */

get_header();
?>

<?php
$args = array('hide_empty=0');
$terms = get_terms('cat-work-environment', $args);
$i = 1;
$loop_temp = '';
$section_count = count($terms);
?>

<div class="header-work-environment">
    <h1 class="text-center"><?php echo get_part_work_environment_title_text() ?></h1>
    <div class="container">

        <?php foreach ($terms as $term): ?>
            <div class="row-gap-large"></div>
            <h2 class="text-center"><?php echo $term->name ?></h2>
            <?php
            $args_ele = array(
                'post_type' => 'work-environment',
                'posts_per_page' => -1,
                'orderby' => array('date' => 'ASC'),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'cat-work-environment',
                        'field' => $term->slug,
                        'terms' => array($term->term_id),
                    )
                )
            );
            $loop = new WP_Query($args_ele);
            ?>

            <?php if ($loop->have_posts()): ?>
                <div class="row-gap-medium"></div>
                <div class="row">
                    <?php while ($loop->have_posts()): $loop->the_post(); ?>
                        <div class="col-xs-6">
                            <a href="<?php echo get_field('main_image') ?>" class="photo" rel="<?php echo $term->slug ?>" title="<?php echo get_the_title() ?>">
                                <img src="<?php echo get_field('main_image') ?>" alt="<?php echo get_the_title() ?>" class="img-responsive">
                            </a>
                            <div class="row-gap-small"></div>
                            <h3><?php echo get_the_title() ?></h3>
                            <p><?php echo get_the_content() ?></p>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
            <?php wp_reset_postdata() ?>
        <?php endforeach; ?>

    </div>
</div>
<div class="row-gap-large"></div>

<!--//Job Apply your resume-->
<div id="free-apply">
    <?php echo do_shortcode('[jobs-part type="apply-ur-resume"]') ?>
</div>
<!--//Job Apply your resume End-->

<!--//Job List-->
<div id="new-opportunities">
    <?php echo do_shortcode('[jobs-part type="find-ur-dream-jobs"]') ?>
</div>
<!--//Job List End-->

<!--//Map-->
<?php get_template_part('google-map') ?>
<!--//Map End-->

<?php get_footer(); ?>