<div id="labs-carousel" class="row block-content carousel slide vertical carousel-fade" data-ride="carousel">
    <?php
    $args = array(
        'post_type' => 'job',
        'posts_per_page' => -1,
        'meta_key' => 'status',
        'orderby' => array('meta_value_num' => 'DESC'),
        'paged' => $paged,
        'tax_query' => array(
            array(
                'taxonomy' => 'lab',
                'field' => 'slug',
                'terms' => $args_terms,
            ),
        ),
    );
    $wp_query = new WP_Query($args);
    $total_elements = $wp_query->found_posts;
    $i = 0;
    $ads_per_item = 3;
    ?>
    <?php if ($wp_query->have_posts()) { ?>
        <div class="carousel-inner" role="listbox">
            <?php
            while ($wp_query->have_posts()) {
                $wp_query->the_post();
                if ($i % $ads_per_item == 0) {
                    $active = '';
                    if ($i == 0) {
                        $active = 'active';
                    }
                    echo '<div class="item ' . $active . '">';
                }
                ?>
                <div class="ads">
                    <a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
                        <?php $term_lab = get_the_terms($post->ID, 'lab'); ?>
                        <h4><?php echo $term_lab[0]->name ?><br/><span class="subtitle"><?php the_title() ?></span></h4>
                        <span class="overlay"></span>
                        <?php
                        if (function_exists('get_lab_info')) {
                            $lab_images = get_lab_info();
                        }
                        ?>
                        <img src="<?php echo $lab_images['top-image']['large'] ?>" alt="<?php echo $post->name ?>" />
                    </a>
                </div>
                <?php
                if (($i + 1 - $ads_per_item) % $ads_per_item == 0 || $i == $total_elements - 1) {
                    echo '</div>';
                }
                $i++;
                ?>
            <?php } ?>
        <?php } ?>
        <?php wp_reset_postdata(); ?>

        <?php $i = 0 ?>
        <?php if ($total_elements > 0): ?>
            <div class="row paging">
                <ul class="carousel-indicators">
                    <?php for ($counter = 0; $counter < $total_elements; $counter++): ?>
                        <?php if ($counter % 3 == 0): ?>
                            <li data-target="#labs-carousel" data-slide-to="<?php echo $i ?>" data-index="<?php echo $i ?>" class="<?php echo ($i == 0) ? 'active' : ''; ?>"></li>
                            <?php $i++; ?>
                        <?php endif; ?>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
</div>