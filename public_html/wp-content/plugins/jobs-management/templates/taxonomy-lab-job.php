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
$args_terms = array();
foreach ($term as $ele) {
    $args_terms[] = $ele->slug;
}

if (function_exists('get_lab_info')) {
    $lab_info = get_lab_info();
}

get_header();
?>
<div id="new-job-detail">

    <div class="header-banner">
        <img src="<?php echo $lab_info['top-image']['url'] ?>" alt="<?php echo $term[0]->name ?>" />
        <div class="overlay container">
            <div class="info">
                <h2><?php echo $term[0]->name ?></h2>
            </div>
        </div>
    </div>
    <div class="greybar"></div>

    <div id="print-job-part" class="container" style="margin-top: -88px;">
        <div class="row">
            <div class="col-xs-12">

                <div class="standout">
                    <div class="row">
                        <div class="col-xs-12 col-md-9">
                            <div class="title">
                                Project Information
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3" style="text-align: right;">
                            posted on <span class="time"><?php echo get_time_duration(get_the_date('Y-m-d H:i:s')) ?></span>
                        </div>
                    </div>
                </div>

                <div class="detail">
                    <div class="row">                    
                        <?php if ($lab_info['lab-des-1'] != ''): ?>
                            <div class="col-xs-12">
                                <div class="title"><?php echo $lab_info['lab-title-1'] ?></div>
                            </div>
                            <div class="col-xs-12">
                                <?php echo $lab_info['lab-des-1'] ?>
                            </div>
                            <div class="row-gap-medium clearfix"></div>
                        <?php endif; ?>
                        <!---->
                        <?php if ($lab_info['lab-des-2'] != ''): ?>
                            <div class="col-xs-12">
                                <div class="title"><?php echo $lab_info['lab-title-2'] ?></div>
                            </div>
                            <div class="col-xs-12">
                                <?php echo $lab_info['lab-des-2'] ?>
                            </div>
                            <div class="row-gap-medium clearfix"></div>
                        <?php endif; ?>
                        <!---->
                        <?php if ($lab_info['lab-des-3'] != ''): ?>
                            <div class="col-xs-12">
                                <div class="title"><?php echo $lab_info['lab-title-3'] ?></div>
                            </div>
                            <div class="col-xs-12">
                                <?php echo $lab_info['lab-des-3'] ?>
                            </div>
                            <div class="row-gap-medium clearfix"></div>
                        <?php endif; ?>
                        <!---->
                        <?php if ($lab_info['lab-des-4'] != ''): ?>
                            <div class="col-xs-12">
                                <div class="title"><?php echo $lab_info['lab-title-4'] ?></div>
                            </div>
                            <div class="col-xs-12">
                                <?php echo $lab_info['lab-des-4'] ?>
                            </div>
                        <div class="row-gap-medium clearfix"></div>
                        <?php endif; ?>
                    </div>
                    <!-- info -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="title"><?php echo $lab_info['lab-title-5'] ?>: <strong><?php the_title() ?></strong></div>
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
                            <div class="title"><?php echo $lab_info['lab-title-6'] ?></div>
                            <?php echo get_field('job_description') ?>
                        </div>
                    </div>
                    <!-- requirement -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="title"><?php echo $lab_info['lab-title-7'] ?></div>
                            <?php echo get_field('job_requirement') ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- pictures -->
        <div class="row noprint">
            <div class="col-xs-12 col-md-12">
                <div class="lab-pictures col-xs-12 col-md-12">
                    <?php for ($i = 1; $i < 3; $i++): ?>
                        <?php if (isset($lab_info['image-' . $i]['url'])): ?>
                            <img class="img-responsive col-xs-12 col-md-6" src="<?php echo $lab_info['image-' . $i]['url'] ?>" />
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>
        </div>

        <div class="row noprint">
            <div class="col-xs-12 col-md-12">
                <div class="col-xs-12 col-md-12 end-lab-info">
                    <a href="#apply-form-modal" class="openform submit col-xs-12 col-md-4"><span class="send">Apply</span></a>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- // Apply Form -->
<?php require_once(dirname(__FILE__) . '/part-apply-form.php') ?>
<!-- // Apply Form End -->

<div id="detail-staff">
    <div class="header-our-thoughts">
        <div class="container">
            <h2 class="text-bold text-center"><?php echo get_staff_detail_thought_title_text() ?></h2>
            <?php
            $staff_ids = array();
            $args = array(
                'post_type' => 'staff',
                'posts_per_page' => 5,
                'orderby' => array('date' => 'ASC'),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'lab',
                        'field' => 'slug',
                        'terms' => $args_terms,
                    ),
                ),
            );
            $loop = new WP_Query($args);
            ?>
            <?php
            if ($loop->have_posts()):
                $i = 0;
                ?>
                <?php
                while ($loop->have_posts()):
                    $loop->the_post();
                    $staff_ids[] = $post->ID;
                    ?>
                    <?php if ($i % 2 == 0): ?>
                        <div class="row item left-alignment col-md-12 col-xs-12">
                            <div class="col-md-4 col-xs-12 avatar">
                                <img src="<?php echo get_field('image') ?>" alt="" class="img-responsive full-width">
                                <div class="caption full-width left">
                                    <h3><?php the_title(); ?></h3>
                                    <div class="intro"><?php echo get_field('job_description'); ?></div>
                                </div>
                            </div>
                            <div class="col-md-8 col-xs-12 content">
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
                        </div>
                    <?php else: ?>
                        <div class="row item right-alignment col-md-12 col-xs-12">
                            <div class="col-md-8 col-xs-12 content">
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
                            <div class="col-md-4 col-xs-12 avatar">
                                <img src="<?php echo get_field('image') ?>" alt="" class="img-responsive full-width">
                                <div class="caption full-width right">
                                    <h3><?php the_title(); ?></h3>
                                    <div class="intro"><?php echo get_field('job_description'); ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
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
        'post__not_in' => $staff_ids,
        'posts_per_page' => -1,
        'orderby' => array('date' => 'ASC'),
        'tax_query' => array(
            array(
                'taxonomy' => 'lab',
                'field' => 'slug',
                'terms' => $args_terms,
            ),
        ),
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