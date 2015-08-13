<?php
/*
 * Author: KhangLe
 * Template Name: Index
 * 
 */
get_header();
?>

<section>
    <div class="keyvisual index">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h2><?php echo get_top_text() ?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="img-loop">
                    <img src="<?php echo catch_that_image() ?>" alt="<?php the_title(); ?>" />
                </a>
                <?php
            endwhile;
        endif;
        ?>
    </div>
    
    <div class="container">
        
    </div>
</section>

<?php get_footer(); ?>