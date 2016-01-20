<div id="job-carousel-sidebar" class="col-xs-12 col-md-4 sidebar carousel slide vertical carousel-fade" data-ride="carousel">
    <div class="carousel-inner" role="listbox">
        <?php
        $args = array(
            'parent' => 0
        );
        $terms = get_terms('lab', $args);
        $args_terms = array();
        foreach ($terms as $term) {
            $args_terms[] = $term->term_id;
        }



        $total_elements = count($terms);
        $i = 0;
        $ads_per_item = 4;
        ?>
        <?php if ($total_elements > 0) { ?>
            <?php
            foreach ($terms as $term) {               
                if ($i % $ads_per_item == 0) {
                    $active = '';
                    if ($i == 0) {
                        $active = 'active';
                    }
                    echo '<div class="item ' . $active . '">';
                }
            ?>
            <?php
                if (function_exists('get_lab_info_by_id')) {
                    $lab_images = get_lab_info_by_id($term->term_id);

                }
            ?>
                <div class="row ads">
                    <a href="<?php echo get_term_link($term) ?>" title="<?php $term->slug ?>">
                        <h4><?php echo $term->name ?><br/><span class="subtitle"><?php echo $term->description ?></span></h4>
                        <span class="carousel-overlay"></span>
                        <img src="<?php echo $lab_images['top-image']['large'] ?>" alt="" />
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

        <?php $i = 0 ?>
        <?php if ($total_elements > 0): ?>
            <div class="row paging">
                <ul class="carousel-indicators">
                    <?php for ($counter = 0; $counter < $total_elements; $counter++): ?>
                        <?php if ($counter % 3 == 0): ?>
                            <li data-target="#job-carousel-sidebar" data-slide-to="<?php echo $i ?>" data-index="<?php echo $i ?>" class="<?php echo ($i == 0) ? 'active' : ''; ?>"></li>
                            <?php $i++; ?>
                        <?php endif; ?>
                    <?php endfor; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</div>