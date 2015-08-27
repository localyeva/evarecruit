<?php
/*
 * Author: KhangLe
 * Template Name: Index
 * 
 */
get_header();
?>

<div class="header-banner">
    <div class="container text-center">
        <h2 class="text-bold"><?php echo get_intro_1_text() ?></h2>
        <h2><?php echo get_intro_2_text() ?></h2>
        <h3><?php echo get_intro_3_text() ?></h3>
    </div>
</div>
<div class="header-join">
    <div class="container text-center">
        <h2 class="text-bold"><?php echo get_home_top_text() ?></h2>
        <div class="row-gap-medium"></div>
        <button class="btn btn-orange">Check for new opportunities</button>
    </div>
</div>
<!--//About-->

<div class="header-about">
    <div class="container">
        <h2 class="text-center"><?php echo get_part_about_us_title_text() ?></h2>
        <div class="row-gap-large"></div>
        <div class="row">
            <?php
            $args = array(
                'post_type' => 'about-us',
                'posts_per_page' => -1,
                'orderby' => array('date' => 'DESC'),
            );
            $loop = new WP_Query($args);
            ?>
            <?php
            if ($loop->have_posts()):
                $num_posts = count($loop->posts);
                ?>    
                <?php while ($loop->have_posts()): $loop->the_post(); ?>
                    <div class="col-xs-12 col-md-6">
                        <img class="img-responsive" src="<?php echo get_field('image_chart') ?>" alt="">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <?php if (have_rows('process')): ?>
                            <?php while (have_rows('process')) : the_row(); ?>
                                <div class="col-xs-12">
                                    <?php the_content() ?>
                                    <p>
                                        <?php echo get_sub_field('stage') . ": " ?>
                                        <?php echo get_sub_field('description') ?>
                                    </p>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>                    
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
            <?php wp_reset_postdata() ?>
        </div>
    </div>
</div>
<!--/About End-->
<!--//Service-->
<?php
$args = array(
    'post_type' => 'service',
    'posts_per_page' => -1,
    'orderby' => array('date' => 'ASC'),
);
$loop = new WP_Query($args);
?>
<?php
if ($loop->have_posts()): $xid = 1;
    $num_posts = count($loop->posts);
    ?>
    <div class="header-service">
        <div class="container">
            <h2 class="text-center"><?php echo get_part_our_service_title_text() ?></h2>
            <div class="row-gap-medium"></div>
            <div class="row">
                <?php while ($loop->have_posts()): $loop->the_post(); ?>
                    <div class="col-xs-12 col-md-4">
                        <div class="row">
                            <div class="col-xs-3">
                                <img src="<?php echo get_field('image') ?>" alt="" class="img-responsive">
                            </div>
                            <div class="col-xs-9">
                                <div class="h4"><?php the_title() ?></div>
                                <p><?php echo get_field('short_description') ?></p>
                            </div>
                        </div>
                    </div>                    
                <?php endwhile; ?>
            </div>
            <div class="row-gap-large"></div>
        </div>
    </div>
<?php endif; ?>
<?php wp_reset_postdata() ?>

<!--//Service End-->
<!--//Environment-->
<div class="header-environment">
    <div class="container">
        <div class="row-gap-small"></div>
        <h2 class="text-center"><?php echo get_part_work_environment_title_text() ?></h2>
        <div class="row-gap-large"></div>
        <?php
        $args = array(
            'hide_empty' => 0
        );
        $categories = get_terms('cat-work-environment', $args);
        ?>
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <ul class="nav nav-pills nav-justified">
                    <li role="presentation" data-tab="all"><a href="#">All</a></li>
                    <?php foreach ($categories as $category): ?>
                        <li role="presentation" data-tab=<?php echo $category->name ?>><a href="#"><?php echo $category->name ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="row-gap-large"></div>
        <!-- //Image gallery -->
        <?php
        $args = array(
            'post_type' => 'work-environment',
            'posts_per_page' => -1,
            'orderby' => array('date' => 'ASC'),
        );
        $loop = new WP_Query($args);
        ?>
        <div class="row gallery" data-tab="all">
            <div class="col-xs-3">
                <div class="row">
                    <?php if ($loop->have_posts()): ?>
                        <?php while ($loop->have_posts()): $loop->the_post(); ?>
                            <div class="col-xs-12">
                                <img src="<?php echo get_field('main_image') ?>" alt="<?php the_title() ?>" class="img-responsive" />
                            </div>
                            <?php if (have_rows('images')): ?>
                                <?php while (have_rows('images')): the_row(); ?>
                                    <div class="col-xs-12">
                                        <img src="<?php echo get_sub_field('image') ?>" alt="<?php the_title() ?>" class="img-responsive" />
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div>

        <?php foreach ($categories as $category): ?>
            <?php
            $args = array(
                'post_type' => 'work-environment',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'cat-work-environment',
                        'terms' => array($category->term_id),
                    ),
                ),
                'orderby' => array('date' => 'ASC'),
            );
            $loop = new WP_Query($args);
            ?>
            <div class="row gallery" data-tab="<?php echo $category->name ?>">
                <div class="col-xs-3">
                    <div class="row">
                        <?php if ($loop->have_posts()): ?>
                            <?php while ($loop->have_posts()): $loop->the_post(); ?>
                                <div class="col-xs-12">
                                    <img src="<?php echo get_field('main_image') ?>" alt="<?php the_title() ?>" class="img-responsive" />
                                </div>
                                <?php if (have_rows('images')): ?>
                                    <?php while (have_rows('images')): the_row(); ?>
                                        <div class="col-xs-12">
                                            <img src="<?php echo get_sub_field('image') ?>" alt="<?php the_title() ?>" class="img-responsive" />
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <!-- //Image gallery End -->
    </div>
</div>
<!--//Environment End-->
<!--//Intro Movie-->
<div class="row-gap-large"></div>
<div class="header-intro-movie">
    <div class="container">
        <div class="row">
            <div class="no-padding-r col-md-1 col-xs-4">
                <img class="img-responsive" src="<?php echo get_template_directory_uri() ?>/img/7.png" alt="">
            </div>
            <div class="col-md-4 col-xs-8">
                <?php echo get_part_work_environment_movie_desc_text() ?>                
            </div>
            <div class="col-md-6 col-md-offset-1 col-xs-12">
                <?php echo get_part_work_environment_movie_link() ?>                
            </div>
        </div>
    </div>
</div>
<!--//Intro Movie End-->
<!--//CEO Message-->
<div class="header-ceo-message">
    <div class="container">
        <div class="row-gap-large"></div>
        <h2 class="text-center"><?php echo get_part_ceo_message_title() ?></h2>
        <div class="row-gap-medium"></div>
        <div class="row">
            <div class="col-xs-12">
                <img src="<?php echo get_part_ceo_message_image(); ?>" alt="" class="img-responsive">
            </div>
        </div>
    </div>
</div>
<!--//CEO Message End-->

<!--//Job List-->
<?php echo do_shortcode('[jobs-part type="form-list"]') ?>
<!--//Job List End-->

<!--//Map-->
<?php get_template_part('google-map') ?>
<!--//Map End-->

<?php get_footer(); ?>