<div class="header-map">
    <div class="container-fluid">
        <div class="row-gap-small"></div>
        <h2 class="text-center"><?php echo get_part_connected_title() ?></h2>
        <p class="text-center">
            <?php echo get_part_connected_content() ?>            
        </p>
        <div class="row-gap-large"></div>
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <style>
                    #map{
                        height: 30em;
                    }
                </style>
                <div id="map"></div>
            </div>
            <div class="col-xs-12 col-md-4 no-padding-lr">
                <div class="row">
                    <div class="col-xs-12">
                        <?php
                        $args = array(
                            'post_type' => 'stay-connected',
                            'posts_per_page' => -1,
                            'orderby' => array('date' => 'ASC'),
                        );
                        $loop = new WP_Query($args);
                        ?>
                        <?php if ($loop->have_posts()): ?>
                            <?php while ($loop->have_posts()): $loop->the_post(); ?>
                                <div class="row">
                                    <div class="col-xs-1">
                                        <img class="img-responsive map-marker" src="<?php echo get_template_directory_uri() ?>/img/32.png" alt="">
                                    </div>
                                    <div class="col-xs-11">
                                        <h3><a href="javascript:void(0)" class="map-focus black-link" data-lat="<?php echo get_field('z_lat') ?>" data-lng="<?php echo get_field('z_lng') ?>"><?php echo mb_convert_case(get_the_title(), MB_CASE_UPPER) ?></a></h3>
                                        <?php if (have_rows('main_locations')): ?>
                                            <?php while (have_rows('main_locations')): the_row(); ?>
                                                <?php if (get_sub_field('main_location') != ''): ?>
                                                    <p>* <?php echo get_sub_field('main_location') ?></p>
                                                <?php endif; ?>
                                                <?php if (get_sub_field('address') != ''): ?>
                                                    <p><?php echo get_sub_field('address') ?></p>
                                                <?php endif; ?>
                                            <?php endwhile; ?>
                                        <?php endif; ?>                                        
                                        <div class="row-gap-small"></div>
                                        <div class="separator"></div>
                                        <div class="row-gap-small"></div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>