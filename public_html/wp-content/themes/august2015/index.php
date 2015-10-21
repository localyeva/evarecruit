<?php
/*
 * Author: KhangLe
 * Template Name: Index
 * 
 */
get_header();
?>

<?php
$args = array(
    'post_type' => 'slider-home',
    'posts_per_page' => -1,
    'orderby' => array('date' => 'DESC'),
);
$loop = new WP_Query($args);
$slider_home = array();
if ($loop->have_posts()) {
    while ($loop->have_posts()) {
        $loop->the_post();
        while (have_rows('images')) {
            the_row();
            $slider_home[]['image'] = get_sub_field('image');
        }
    }
}
?>

<div class="bs-carousel" data-example-id="carousel-with-captions">
    <div id="carousel-captions" class="carousel slide carousel-fade" data-ride="carousel" data-interval=5000>
        <ol class="carousel-indicators">
            <?php for ($i = 0; $i < count($slider_home); $i++): ?>
                <li data-target="#carousel-captions" data-slide-to="<?php echo $i ?>" class="<?php echo ($i == 0) ? 'active' : '' ?>"></li>
            <?php endfor; ?>
        </ol>
        <div class="carousel-inner" role="listbox">
            <?php for ($i = 0; $i < count($slider_home); $i++): ?>
                <div class="item <?php echo ($i == 0) ? 'active' : '' ?>">
                    <img alt="" src="<?php echo $slider_home[$i]['image'] ?>">
                    <div class="carousel-caption">
                        <h1 class="text-bold standout"><?php echo get_intro_1_text() ?></h1>
                        <h2 class="mission"><?php echo get_intro_2_text() ?></h2>
                        <h3 class="out-tro"><?php echo get_intro_3_text() ?></h3>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>

<!--//About-->
<div class="header-about">
    <div class="container">
        <div class="row content">
            <div class="col-xs-12 col-md-5"></div>
            <div class="col-xs-12 col-md-7">
                <h2><?php echo get_part_about_us_title_text() ?></h2>
                <div class="row-gap-large"></div>
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
                        <div class="row">
                            <div class="col-xs-12">
                                <?php echo get_field('content') ?>
                            </div>
                        </div>
                        <div class="row">
                            <?php if (have_rows('process')): ?>
                                <?php while (have_rows('process')) : the_row(); ?>
                                    <div class="col-xs-12">
                                        <p>
                                            <strong><?php echo get_sub_field('stage') . ": " ?></strong>
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
</div>
<!--/About End-->

<!--//Service-->
<div id="services" class="header-service" style="display: none;">
    <div class="container">
        <h2 class="text-center"><?php echo get_part_our_service_title_text() ?></h2>
        <div class="row-gap-medium"></div>
        <div class="row">
            <?php
            $args = array(
                'post_type' => 'service',
                'posts_per_page' => -1,
                'orderby' => array('date' => 'ASC'),
            );
            $loop = new WP_Query($args);
            ?>
            <?php
            if ($loop->have_posts()):
                $num_posts = count($loop->posts);
                ?>
                <?php while ($loop->have_posts()): $loop->the_post(); ?>
                    <div class="col-xs-12 col-md-4">
                        <div class="row">
                            <div class="col-xs-3">
                                <img src="<?php echo get_field('image') ?>" alt="" class="img-responsive">
                            </div>
                            <div class="col-xs-9">
                                <a class="white-link" href="<?php echo get_field('redirect_url') ?>">
                                    <div class="h4"><?php the_title() ?></div>
                                    <p><?php echo get_field('short_description') ?></p>
                                </a>
                            </div>
                        </div>
                    </div>                    
                <?php endwhile; ?>
            <?php endif; ?>
            <?php wp_reset_postdata() ?>
        </div>
        <div class="row-gap-large"></div>
    </div>
</div>
<!--//Service End-->

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
        $images = array();
        $all_images = array();
        $num_imgs = 0;
        foreach ($categories as $category) {
            $cat_name = $category->name;
            $images[$cat_name] = array();
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
            if ($loop->have_posts()) {
                while ($loop->have_posts()) {
                    $loop->the_post();
                    $img = array(get_the_title(), get_field('main_image'), 'work-environment');
                    $images[$cat_name][] = $img;
                    $all_images[] = $img;
                    $num_imgs++;
                    if (have_rows('images')) {
                        while (have_rows('images')) {
                            the_row();
                            $img = array(get_the_title(), get_sub_field('image'), 'work-environment');
                            $images[$cat_name][] = $img;
                            $all_images[] = $img;
                            $num_imgs++;
                        }
                    }
                }
            }
        }

        wp_reset_postdata();
        ?>
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <ul class="nav nav-pills nav-justified">
                    <li role="presentation" data-tab="all"><a href="#">All</a></li>
                    <?php foreach ($categories as $category): ?>
                        <li role="presentation" data-tab="<?php echo $category->name ?>"><a href="#"><?php echo $category->name ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="row-gap-large"></div>
        <!-- //Image gallery -->
        <div class="row gallery" data-tab="all">
            <?php
            if ($num_imgs <= 4) {
                for ($i = 0; $i <= 4; $i++) {
                    if (isset($images[$i])) {
                        ?>
                        <div class="col-xs-3">
                            <div class="row">
                                <div class="col-xs-12">
                                    <img src="<?php echo $images[$i][1] ?>" alt="<?php echo $images[$i][0] ?>" class="img-responsive" />
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            } else {
                $mod = $num_imgs % 4;
                $num = intval($num_imgs / 4);
                if ($mod == 0) {
                    $parts = array_chunk($all_images, $num);
                } else if ($mod == 1) {
                    $parts[0] = array_slice($all_images, 0, $num + 1);
                    $parts[1] = array_slice($all_images, $num + 1, $num);
                    $parts[2] = array_slice($all_images, ($num + 1) + $num, $num);
                    $parts[3] = array_slice($all_images, ($num + 1) + 2 * $num, $num);
                } else if ($mod == 2) {
                    $parts[0] = array_slice($all_images, 0, $num + 1);
                    $parts[1] = array_slice($all_images, $num + 1, $num + 1);
                    $parts[2] = array_slice($all_images, ($num + 1) * 2, $num);
                    $parts[3] = array_slice($all_images, ($num + 1) * 2 + $num, $num);
                } else {
                    $parts[0] = array_slice($all_images, 0, $num + 1);
                    $parts[1] = array_slice($all_images, $num + 1, $num + 1);
                    $parts[2] = array_slice($all_images, ($num + 1) * 2, $num + 1);
                    $parts[3] = array_slice($all_images, ($num + 1) * 3, $num);
                }
                for ($i = 0; $i < 4; $i++) {
                    $tparts = $parts[$i];
                    ?>
                    <div class="col-xs-3">
                        <div class="row">
                            <?php foreach ($tparts as $part) {
                                ?>
                                <div class="col-xs-12">
                                    <a href="<?php echo bloginfo('url') . '/' . $part[2] ?>"><img src="<?php echo $part[1] ?>" alt="<?php echo $part[0] ?>" class="img-responsive" /></a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

        <?php foreach ($images as $cat_name => $pimages) {
            ?>
            <div class="row gallery" data-tab="<?php echo $cat_name ?>">
                <?php
                $num_imgs = count($pimages);
                if ($num_imgs <= 4) {
                    for ($i = 0; $i <= 4; $i++) {
                        if (isset($pimages[$i])) {
                            ?>
                            <div class="col-xs-3">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <img src="<?php echo $pimages[$i][1] ?>" alt="<?php echo $pimages[$i][0] ?>" class="img-responsive" />
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                } else {
                    $mod = $num_imgs % 4;
                    $num = intval($num_imgs / 4);
                    if ($mod == 0) {
                        $parts = array_chunk($pimages, $num);
                    } else if ($mod == 1) {
                        $parts[0] = array_slice($pimages, 0, $num);
                        $parts[1] = array_slice($pimages, $num + 1, $num);
                        $parts[2] = array_slice($pimages, ($num + 1) + $num, $num);
                        $parts[3] = array_slice($pimages, ($num + 1) + 2 * $num, $num);
                    } else if ($mod == 2) {
                        $parts[0] = array_slice($pimages, 0, $num + 1);
                        $parts[1] = array_slice($pimages, $num + 1, $num + 1);
                        $parts[2] = array_slice($pimages, ($num + 1) * 2, $num);
                        $parts[3] = array_slice($pimages, ($num + 1) * 2 + $num, $num);
                    } else {
                        $parts[0] = array_slice($pimages, 0, $num + 1);
                        $parts[1] = array_slice($pimages, $num + 1, $num + 1);
                        $parts[2] = array_slice($pimages, ($num + 1) * 2, $num + 1);
                        $parts[3] = array_slice($pimages, ($num + 1) * 3, $num);
                    }
                    for ($i = 0; $i < 4; $i++) {
                        $tparts = $parts[$i];
                        ?>
                        <div class="col-xs-3">
                            <div class="row">
                                <?php foreach ($tparts as $part) {
                                    ?>
                                    <div class="col-xs-12">
                                        <a href="<?php echo bloginfo('url') . '/' . $part[2] ?>"><img src="<?php echo $part[1] ?>" alt="<?php echo $part[0] ?>" class="img-responsive" /></a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>

            </div>
        <?php } ?>
        <!-- //Image gallery End -->
    </div>
</div>
<!--//Environment End-->

<!--//Intro Movie-->
<div class="header-intro-movie">
    <div class="container">
        <div class="row">
            <div class="no-padding-r col-md-1 col-xs-4">
                <img class="img-responsive" src="<?php echo get_template_directory_uri() ?>/img/7.png" alt="">
            </div>
            <div class="col-md-4 col-xs-8">
                <h2><?php echo get_part_work_environment_movie_title_text() ?></h2>
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
        <div class="row content">
            <div class="col-xs-12 col-md-4">
                <img src="<?php echo get_part_ceo_message_image(); ?>" alt="" style="position:relative;right:172px;margin-bottom:0px;" />
            </div>
            <div class="col-xs-12 col-md-8">
                <h2><?php echo get_part_ceo_message_title() ?> <strong>CEO</strong></h2>
                <div class="row-gap-medium"></div>

                <?php
                $args = array(
                    'post_type' => 'ceo-message',
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
                        <div class="row">
                            <div class="col-xs-12">
                                <?php echo get_the_content() ?>
                            </div>
                        </div>
                        <div class="row" style="float:right;">
                            <img src="<?php echo get_field('sign') ?>" alt="" />
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
                <?php wp_reset_postdata() ?>
            </div>
        </div>
    </div>
</div>
<!--//CEO Message End-->

<div class="header-join">
    <div class="container text-center">
        <h2 class="text-bold"><?php echo get_home_top_text() ?></h2>
        <div class="row-gap-medium"></div>
        <a href="<?php echo bloginfo('url') ?>/#new-opportunities" data-goto="new-opportunities"><button class="btn btn-orange">Check for new opportunities</button></a>
    </div>
</div>

<!--//Map-->
<?php get_template_part('google-map') ?>
<!--//Map End-->

<?php get_footer(); ?>