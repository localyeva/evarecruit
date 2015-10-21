<?php
/*
 * Author: KhangLe
 * Template Name: Staff Detail
 * 
 */
get_header();
global $staff_ids;
?>
<div id="detail-staff">
    <div class="header-banner">
        <div class="container text-center">
            <h2 class="text-bold"><?php echo get_intro_1_text() ?></h2>
            <h2><?php echo get_intro_2_text() ?></h2>
            <h3><?php echo get_intro_3_text() ?></h3>
        </div>
    </div>

    <div class="header-our-thoughts">
        <div class="container">
            <h2 class="text-bold text-center"><?php echo get_staff_detail_thought_title_text() ?></h2>
            <?php
            $staff_ids = array();
            $args = array(
                'post_type' => 'staff',
                'orderby' => 'rand',
                'posts_per_page' => 3,
            );
            $loop = new WP_Query($args);
            $i = 0;
            ?>
            <?php
            if ($loop->have_posts()):
                ?>    
                <?php
                while ($loop->have_posts()):
                    $loop->the_post();
                    $staff_ids[] = $post->ID;
                    ?>
                    <div class="row-gap-medium"></div>
                    <div class="row item">
                        <?php if ($i % 2 == 0): ?>
                            <div class="col-md-4 col-xs-12 no-padding-lr">
                                <img src="<?php echo get_field('image') ?>" alt="" class="img-responsive full-width">
                                <div class="caption full-width left">
                                    <h3><?php the_title(); ?></h3>
                                    <div class="intro"><?php echo get_field('job_description'); ?></div>
                                </div>
                            </div>
                            <div class="col-md-8 col-xs-12 content icon-right">
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
                        <?php else: ?>
                            <div class="col-md-8 col-xs-12 no-padding-l content icon-left">
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
                            <div class="col-md-4 col-xs-12 no-padding-lr">
                                <img src="<?php echo get_field('image') ?>" alt="" class="img-responsive full-width">
                                <div class="caption full-width right">
                                    <h3><?php the_title(); ?></h3>
                                    <div class="intro"><?php echo get_field('job_description'); ?></div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php
                    $i++;
                endwhile;
                ?>
            <?php endif; ?>
            <?php wp_reset_postdata() ?>                    
        </div>
    </div>
    
    <?php get_template_part('part_template_staff_list') ?>  
</div>

<!--//Map-->
<?php get_template_part('google-map') ?>
<!--//Map End-->

<?php get_footer(); ?>