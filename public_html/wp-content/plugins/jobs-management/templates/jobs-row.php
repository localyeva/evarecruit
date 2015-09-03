<?php if ($wp_query->have_posts()): ?>
    <?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>
        <div class="row item">
            <div class="col-xs-6">
                <div class="title">
                    <a class="<?php echo $job_status[get_field('status')] ?>" href="<?php the_permalink() ?>"><?php the_title() ?></a>
                </div>
                <div class="info">
                    <?php $term = get_the_terms($post->ID, 'job-location'); ?>
                    <span class="localtion"><?php echo $term[0]->name ?></span> | <span class="level"><?php echo get_field('work_level') ?></span>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="text-blue">
                    <?php echo wp_trim_words(get_field('job_requirement'), 10, '...') ?>
                </div>
            </div>
            <div class="col-xs-3">
                <div><img class="date" src="<?php echo WP_PLUGIN_URL ?>/jobs-management/img/new_job/4.png" alt="posted"> Posted: <?php echo get_the_date('d-m-Y') ?></div>
                <div><img class="view" src="<?php echo WP_PLUGIN_URL ?>/jobs-management/img/new_job/5.png" alt="views"> Views: <?php echo getPostViews(get_the_ID(), 'job_views') ?></div>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>