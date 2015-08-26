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
<?php
$args = array(
    'post_type' => 'about-us',
    'posts_per_page' => -1,
    'orderby' => array('date' => 'ASC'),
);
$loop = new WP_Query($args);
?>
<?php
if ($loop->have_posts()): $xid = 1;
    $num_posts = count($loop->posts);
    ?>
    <?php while ($loop->have_posts()): $loop->the_post(); ?>
        <div class="header-about">
            <div class="container">
                <h2 class="text-center"><?php the_title() ?></h2>
                <div class="row-gap-large"><?php the_content() ?></div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <img class="img-responsive" src="<?php echo get_field('image_chart') ?>" alt="">
                    </div>
                    <?php if (have_rows('process')): ?>
                        <?php while (have_rows('process')) : the_row(); ?>
                            <div class="col-xs-12">
                            	<p>
                                	<?php echo get_sub_field('stage') . ": " ?>
                                	<?php echo get_sub_field('description') ?>
                               </p>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>                    

                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_postdata() ?>
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
            <h2 class="text-center">Our service</h2>
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
        <h2 class="text-center">Work Environment</h2>
        <div class="row-gap-large"></div>
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <ul class="nav nav-pills nav-justified">
                    <li role="presentation" data-tab=1><a href="#">All</a></li>
                    <li role="presentation" data-tab=2><a href="#">Event</a></li>
                    <li role="presentation" data-tab=3><a href="#">Benifit</a></li>
                    <li role="presentation" data-tab=4><a href="#">Work space</a></li>
                </ul>
            </div>
        </div>
        <div class="row-gap-large"></div>
        <!-- //Image gallery -->
        <div class="row gallery" data-tab=1>
            <div class="col-xs-3">
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/10.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/11.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/12.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/13.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/14.png" alt="" class="img-responsive">
                    </div>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/15.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/16.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/17.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/18.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/19.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/20.png" alt="" class="img-responsive">
                    </div>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/21.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/22.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/23.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/24.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/25.png" alt="" class="img-responsive">
                    </div>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/26.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/27.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/28.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/29.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/30.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/31.png" alt="" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>
        <div class="gallery row" data-tab=3>
            <div class="col-xs-3">
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/10.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/11.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/12.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/13.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/14.png" alt="" class="img-responsive">
                    </div>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/15.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/16.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/17.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/18.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/19.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/20.png" alt="" class="img-responsive">
                    </div>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/21.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/22.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/23.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/24.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/25.png" alt="" class="img-responsive">
                    </div>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/26.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/27.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/28.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/29.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/30.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img src="<?php echo get_template_directory_uri() ?>/img/31.png" alt="" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>
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
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
            <div class="col-md-6 col-md-offset-1 col-xs-12">
                <img src="<?php echo get_template_directory_uri() ?>/img/8.png" alt="" class="img-responsive">
            </div>
        </div>
    </div>
</div>
<!--//Intro Movie End-->
<!--//CEO Message-->
<div class="header-ceo-message">
    <div class="container">
        <div class="row-gap-large"></div>
        <h2 class="text-center">Thông điệp từ CEO</h2>
        <div class="row-gap-medium"></div>
        <div class="row">
            <div class="col-xs-12">
                <img src="<?php echo get_template_directory_uri() ?>/img/9.png" alt="" class="img-responsive">
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