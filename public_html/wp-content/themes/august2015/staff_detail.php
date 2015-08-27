<?php
/*
 * Author: KhangLe
 * Template Name: Staff Detail
 * 
 */
get_header();
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
            $args = array(
                'post_type' => 'staff',
                'posts_per_page' => -1,
                'orderby' => array('date' => 'ASC'),
            );
            $loop = new WP_Query($args);
            ?>
            <?php
            if ($loop->have_posts()):
                $i = 0;
                ?>    
                <?php
                while ($loop->have_posts()):
                    if ($i == 3) {
                        break;
                    }
                    $loop->the_post();
                    ?>
                    <div class="row-gap-medium"></div>
                    <div class="row item">
                        <?php if ($i % 2 == 0): ?>
                            <div class="col-md-4 col-xs-12 no-padding-l">
                                <img src="<?php echo get_field('image') ?>" alt="" class="img-responsive">
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
                                                <img src="<?php echo get_sub_field('image') ?>" alt="" class="img-responsive">
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
                                                <img src="<?php echo get_sub_field('image') ?>" alt="" class="img-responsive">
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-4 col-xs-12 no-padding-r">
                                <img src="<?php echo get_field('image') ?>" alt="" class="img-responsive">
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


    <?php
    $args = array(
        'post_type' => 'staff',
        'posts_per_page' => -1,
        'orderby' => array('date' => 'ASC'),
    );
    $loop = new WP_Query($args);
    if ($loop->have_posts()):
        $num_posts = count($loop->posts);
        ?>
        <div class="header-featured-photos">
            <div class="container">
                <div class="row-gap-large"></div>
                <div class="text-center">
                    <div class="block-center">
                        <img src="<?php echo get_template_directory_uri() ?>/img/down_arrow.png" alt="">
                    </div>
                    <div class="text-muted">Drag to see more</div>
                </div>
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
                                <img src="<?php echo get_field('image') ?>" alt="" class="img-responsive">
                            </div>
                            <?php
                            $j++;
                        }
                        ?>
                    </div> 

                <?php }?>
                <div class="row-gap-large"></div>
            </div>
        </div>

    <?php endif; ?>
    <?php wp_reset_postdata() ?>   
    <!--//Map-->
    <?php get_template_part('google-map') ?>
    <!--//Map End-->
</div>
<?php get_footer(); ?>