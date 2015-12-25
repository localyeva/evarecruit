<div class="row">
    <div class="list-detail">
        <div class="list-detail-content">
            <?php if ($wp_query->have_posts()): ?>
                <?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>
                    <?php $term_location = get_the_terms($post->ID, 'job-location'); ?>
                    <?php $term_position = get_the_terms($post->ID, 'job-position'); ?>

                    <div class="row item hot">
                        <div class="col-xs-6 info">
                            <a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><h3 class="title"><?php the_title() ?></h3></a>
                            <div class="info">
                                <span class="localtion"><?php echo $term_location[0]->name ?></span> | <span class="level"><?php echo $term_position[0]->name ?> / <?php echo get_field('work_level') ?></span>
                            </div>
                        </div>
                        <div class="col-xs-3 info">
                            <?php echo wp_trim_words(get_field('job_requirement'), 10, '...') ?>
                        </div>
                        <div class="col-xs-3 info">
                            <div class="posted">Posted: <?php echo get_the_date('d-m-Y') ?></div>
                            <div class="views">Views: <?php echo getPostViews(get_the_ID(), 'job_views') ?></div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>