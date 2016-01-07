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

<div id="carousel-captions" class="carousel slide carousel-fade" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php for ($i = 0; $i < count($slider_home); $i++): ?>
            <li data-target="#carousel-captions" data-slide-to="<?php echo $i ?>" class="<?php echo ($i == 0) ? 'active' : '' ?>"></li>
        <?php endfor; ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <?php for ($i = 0; $i < count($slider_home); $i++): ?>
            <div class="item left next <?php echo ($i == 0) ? 'active' : '' ?>">
                <div class="parallax-window" data-parallax="scroll" data-image-src="<?php echo $slider_home[$i]['image'] ?>"></div>
            </div>
        <?php endfor; ?>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#carousel-captions" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-captions" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

    <div class="slide-caption">
        <h1 class="text-bold standout"><?php echo get_intro_1_text() ?></h1>
        <h2 class="mission"><?php echo get_intro_2_text() ?></h2>
        <h3 class="out-tro"><?php echo get_intro_3_text() ?></h3>
    </div>
</div>

<!--//About-->
<div class="header-about">
    <div class="container">
        <div class="row content">
            <div class="col-xs-12 col-md-5"></div>
            <div class="col-xs-12 col-md-7 bg-white">
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
              <div class="row">
                <a href="<?php echo home_url('vff') ?>" class="btn submit_vff">
                <i class="fa fa-arrow-circle-o-right fa-4 fa_vff"></i>VFF</a>
              </div>
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
<div id="work-invironment" class="header-environment">
    <div class="container">
        <div class="row-gap-small"></div>
        <h2 class="text-center"><?php echo get_part_work_environment_title_text() ?></h2>
        <div class="row-gap-large"></div>
        <?php
        $args = array(
            'hide_empty' => 0
        );
        $terms = get_terms('cat-work-environment', $args);
        $args_terms = array();
        foreach ($terms as $term) {
            $args_terms[] = $term->slug;
        }
        // not in terms
        $loop_all = array();
        $args = array(
            'post_type' => 'work-environment',
            'posts_per_page' => -1,
            'orderby' => array('date' => 'ASC'),
            'tax_query' => array(
                array(
                    'taxonomy' => 'cat-work-environment',
                    'field' => 'slug',
                    'terms' => $args_terms,
                    'operator' => 'NOT IN',
                ),
            ),
        );
        $loop_all = new WP_Query($args);
        $count_all = $loop_all->found_posts;
        //
        ?>
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <ul class="nav nav-pills nav-justified">
                    <li role="presentation" data-tab="all"><a href="#">All</a></li>
                    <?php foreach ($terms as $term): ?>
                        <li role="presentation" data-tab="<?php echo $term->slug ?>"><a href="#"><?php echo $term->name ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="row-gap-large"></div>
        <!-- // image not in terms -->
        <div class="row masonry gallery gallery-all" data-tab="all">
            <?php $i = 0; ?>
            <?php if ($loop_all->have_posts()): ?>
                <?php while ($loop_all->have_posts()): $loop_all->the_post(); ?>
                    <?php
                    if ($i > 8) {
                        $i = 1;
                    } else {
                        $i++;
                    }
                    //
                    $main_image = get_field('main_image');
                    $size = 'medium';
                    $thumb = $main_image['sizes'][$size];
                    ?>
                    <div class="item">
                        <div class="row">
                            <div class="col-xs-12 wow fadeInUp" data-wow-delay="<?php echo $i * 0.1; ?>s">
                                <a href="<?php echo bloginfo('url') . '/work-environment' ?>"><img src="<?php echo $thumb ?>" alt="<?php echo get_the_title() ?>" class="img-responsive center-block" /></a>
                            </div>
                        </div>
                    </div>
                    <?php if (have_rows('images')): ?>
                        <?php while (have_rows('images')): the_row(); ?>
                            <?php
                            if ($i > 8) {
                                $i = 1;
                            } else {
                                $i++;
                            }
                            //
                            $sub_image = get_sub_field('image');
                            $size = 'medium';
                            $thumb_sub = $sub_image['sizes'][$size];
                            ?>
                            <div class="item">
                                <div class="row">
                                    <div class="col-xs-12 wow fadeInUp" data-wow-delay="<?php echo $i * 0.1; ?>s">
                                        <a href="<?php echo bloginfo('url') . '/work-environment' ?>"><img src="<?php echo $thumb_sub ?>" alt="<?php echo get_the_title() ?>" class="img-responsive center-block" /></a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <!-- image in terms -->
        <?php
        // in terms
        foreach ($args_terms as $term_slug) :
            ?>
            <div class="row gallery masonry" data-tab="<?php echo $term_slug ?>">
                <?php
                //
                $loop_ele = array();
                $args = array(
                    'post_type' => 'work-environment',
                    'posts_per_page' => -1,
                    'orderby' => array('date' => 'ASC'),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'cat-work-environment',
                            'field' => 'slug',
                            'terms' => array($term_slug),
                        ),
                    ),
                );
                $loop_ele = new WP_Query($args);
                $count_ele = $loop_ele->found_posts;
                ?>
                <?php if ($loop_ele->have_posts()): ?>
                    <?php while ($loop_ele->have_posts()): $loop_ele->the_post(); ?>
                        <?php
                        //
                        $main_image = get_field('main_image');
                        $size = 'medium';
                        $thumb = $main_image['sizes'][$size];
                        ?>
                        <div class="item">
                            <div class="row">
                                <div class="col-xs-12">
                                    <a href="<?php echo bloginfo('url') . '/work-environment' ?>"><img src="<?php echo $thumb ?>" alt="<?php echo get_the_title() ?>" class="img-responsive center-block" /></a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="row-gap-large"></div>
<!--//Environment End-->

<!--//Intro Movie-->
<div class="header-intro-movie">
    <!-- <div class="container"> -->
    <!-- <div class="row"> -->
    <video autoplay loop poster="<?php echo get_part_work_environment_movie_cover() ?>" id="bgvid">
        <source src="<?php echo get_part_work_environment_movie_webm() ?>" type="video/webm">
        <source src="<?php echo get_part_work_environment_movie_mp4() ?>" type="video/mp4">
    </video>
    <!-- </div> -->
    <!-- </div> -->
</div>
<!--//Intro Movie End-->

<!--//CEO Message-->
<div class="header-ceo-message">
    <div class="container">
        <div class="row-gap-large"></div>
        <div class="row content">
            <div class="col-xs-12 col-md-4">
                <img src="<?php echo get_part_ceo_message_image(); ?>" alt="" id="ceo-picture" />
            </div>
            <div class="col-xs-12 col-md-8 bg-white">
                <h2><?php echo get_part_ceo_message_title() ?></h2>
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
                            <img src="<?php echo get_field('sign') ?>" alt="" id="ceo-signature" />
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
        <h2><?php echo get_home_top_text() ?></h2>
        <div class="row-gap-medium"></div>
        <a href="<?php echo bloginfo('url') ?>/#new-opportunities" data-goto="new-opportunities"><button class="btn btn-orange">Check for new opportunities</button></a>
    </div>
</div>

<!--//Map-->
<?php get_template_part('google-map') ?>
<!--//Map End-->

<?php get_footer(); ?>
