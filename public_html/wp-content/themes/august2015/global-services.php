<?php
/*
 * Author: KhangLe
 * Template Name: Global Services
 * 
 */
get_header();
?>
<div id="global-service">
    <!--//Banner-->
    <div class="header-banner">
        <div class="container text-center">
            <h2 class="text-bold"><?php echo get_intro_1_text() ?></h2>
            <h2><?php echo get_intro_2_text() ?></h2>
            <h3><?php echo get_intro_3_text() ?></h3>
        </div>
    </div>
    <!--//Banner End-->
    <!--//Galary-->
    <div class="container">
        <div class="row-gap-large"></div>
        <div class="row-gap-medium"></div>
        <div class="row">
            <?php
            $args = array(
                'post_type' => 'global-service',
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
                    <div class="col-xs-6">
                        <a href="<?php echo get_field('image'); ?>" class="photo" title="EVOLABLE ASIA">
                            <img src="<?php echo get_field('image'); ?>" alt="<?php the_title(); ?>" class="img-responsive">
                        </a>
                        <div class="row-gap-small"></div>
                        <h3><?php the_title() ?></h3>
                        <p><?php echo get_field('short_description') ?></p>
                    </div>                
                <?php endwhile; ?>
            <?php endif; ?>
            <?php wp_reset_postdata() ?>
        </div>
    </div>
    <!--//Galary -->
    <div class="row-gap-large"></div>
    <div class="container" id="our-thoughts">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="text-center"><?php echo get_intro_4_text() ?></h2>
                <div class="row-gap-small"></div>
                <div class="text-center icon-circles">
                    <span class="icon">&#9899;</span>
                    <span class="icon large">&#9899;</span>
                    <span class="icon">&#9899;</span>
                </div>
                <div class="row-gap-medium"></div>
                <div class="row">
                    <?php
                    $args = array(
                        'post_type' => 'staff',
                        'posts_per_page' => 4,
                        'orderby' => array('date' => 'DESC'),
                    );
                    $loop = new WP_Query($args);
                    ?>
                    <?php
                    if ($loop->have_posts()):
                        $num_posts = count($loop->posts);
                        $color = 1;
                        ?>
                        <?php while ($loop->have_posts()): $loop->the_post(); ?>
                            <div class="col-xs-3 image-wrapper" data-bg-color="<?php
                            if ($color == 1) {
                                echo "#A3D8C7";
                            } else if ($color == 2) {
                                echo "#229EBA";
                            } else if ($color == 3) {
                                echo "#EBD14E";
                            } else {
                                echo "#E4887D";
                            }
                            ?>">
                                <img src="<?php echo get_field('image'); ?>" alt="" class="img-responsive">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="text-wrapper" data-bg-color="#304562">
                                        <div class="title overtext"><?php
                                            echo get_field('position');
                                            echo $post->ID . '  ' . $post->ID % 2;
                                            ?></div>
                                        <div class="tagline overtext"><?php echo get_field('job_description'); ?></div>
                                    </div>
                                </a>
                            </div>
                            <?php $color++; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    <?php wp_reset_postdata() ?>
                </div>
                <div class="row-gap-medium"></div>
                <div class="headline-blue text-center"><?php echo get_intro_5_text() ?></div>
                <div class="row-gap-medium"></div>
                <div class="row">
                    <?php
                    $args = array(
                        'post_type' => 'staff',
                        'posts_per_page' => 4,
                        'orderby' => array('date' => 'ASC'),
                    );
                    $loop = new WP_Query($args);
                    ?>
                    <?php
                    if ($loop->have_posts()):
                        $num_posts = count($loop->posts);
                        $color = 1;
                        ?>
                        <?php while ($loop->have_posts()): $loop->the_post(); ?>
                            <div class="col-xs-3 image-wrapper" data-bg-color="<?php
                            if ($color == 1) {
                                echo "#A3D8C7";
                            } else if ($color == 2) {
                                echo "#229EBA";
                            } else if ($color == 3) {
                                echo "#EBD14E";
                            } else {
                                echo "#E4887D";
                            }
                            ?>">
                                <img src="<?php echo get_field('image'); ?>" alt="<?php the_title(); ?>" class="img-responsive">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="text-wrapper" data-bg-color="#304562">
                                        <div class="title overtext"><?php echo get_field('position'); ?></div>
                                        <div class="tagline overtext"><?php echo get_field('job_description'); ?></div>
                                    </div>
                                </a>
                            </div>
                            <?php $color++; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    <?php wp_reset_postdata() ?>
                </div>
            </div>
        </div>
    </div>
    <!--//Galary End-->
    <!--//Environment -->
    <div class="row-gap-large"></div>
    <div class="container">
        <div class="row">
            <h2 class="text-center"><?php echo get_intro_6_text() ?></h2>
            <div class="row-gap-small"></div>
            <div class="text-center icon-circles">
                <span class="icon">&#9899;</span>
                <span class="icon large">&#9899;</span>
                <span class="icon">&#9899;</span>
            </div>
            <div class="row-gap-medium"></div>
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <?php
                        $args = array(
                            'post_type' => 'slider-evnironment',
                            'posts_per_page' => 1,
                            'orderby' => array('date' => 'DESC'),
                        );
                        $loop = new WP_Query($args);
                        $a = 0
                        ?>
                        <?php
                        if ($loop->have_posts()):
                            $num_posts = count($loop->posts);
                            ?>
                            <?php
                            while ($loop->have_posts()): $loop->the_post();
                                foreach (get_field('images') as $key => $val) {
                                    if ($a < 3) {
                                        ?>
                                        <div class="col-xs-4">
                                            <img src="<?php echo $val['image']; ?>" alt="<?php the_title(); ?>" class="img-responsive">
                                        </div>
                                        <?php
                                    }
                                    $a++;
                                }
                                ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                        <?php wp_reset_postdata() ?>
                    </div>
                    <div class="item">
                        <?php
                        $args = array(
                            'post_type' => 'slider-evnironment',
                            'posts_per_page' => 1,
                            'orderby' => array('date' => 'DESC'),
                            'offset' => 1,
                        );
                        $loop = new WP_Query($args);
                        $b = 0;
                        ?>
                        <?php
                        if ($loop->have_posts()):
                            $num_posts = count($loop->posts);
                            ?>
                            <?php
                            while ($loop->have_posts()): $loop->the_post();
                                foreach (get_field('images') as $key => $val) {
                                    if ($b < 3) {
                                        ?>
                                        <div class="col-xs-4">
                                            <img src="<?php echo $val['image']; ?>" alt="<?php the_title(); ?>" class="img-responsive">
                                        </div>
                                        <?php
                                    }
                                    $b++;
                                }
                                ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                        <?php wp_reset_postdata() ?>
                    </div>
                    <div class="item">
                        <?php
                        $args = array(
                            'post_type' => 'slider-evnironment',
                            'posts_per_page' => 1,
                            'orderby' => array('date' => 'DESC'),
                            'offset' => 2,
                        );
                        $loop = new WP_Query($args);
                        $c = 0;
                        ?>
                        <?php
                        if ($loop->have_posts()):
                            $num_posts = count($loop->posts);
                            ?>
                            <?php
                            while ($loop->have_posts()): $loop->the_post();
                                foreach (get_field('images') as $key => $val) {
                                    if ($c < 3) {
                                        ?>
                                        <div class="col-xs-4">
                                            <img src="<?php echo $val['image']; ?>" alt="<?php the_title(); ?>" class="img-responsive">
                                        </div>
                                        <?php
                                    }
                                    $c++;
                                }
                                ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                        <?php wp_reset_postdata() ?>
                    </div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>
<!--//Environment End -->
<div class="row-gap-large"></div>
<h2 class="text-center">Stay Connected</h2>
<p class="text-center">
    Join us on our social networks for all the latest updates, product/service announcements and more.
</p>
<!--//Map-->
<?php get_template_part('google-map') ?>
<!--//Map End-->

<?php get_footer(); ?>