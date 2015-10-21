<?php
global $staff_ids;

$args = array(
    'post_type' => 'staff',
    'post__not_in' => $staff_ids,
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