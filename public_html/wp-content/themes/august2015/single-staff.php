<?php
/*
 * Author: KhangLe
 * Template Name: Staff Info Detail
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
            <div class="row-gap-medium"></div>
            <div class="row item">
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
            </div>             
        </div>
    </div>

    <?php get_template_part('part_template_staff_list') ?>  
</div>
<?php get_footer(); ?>