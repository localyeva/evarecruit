<?php
/*
 * Author: KhangLe
 * 
 */

if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}
?>

<div class="header-job-list home-page">
    <div class="container">
        <div class="row-gap-medium"></div>
        <h2 class="text-center">Find your dream jobs</h2>
        <div class="row-gap-large"></div>
        <div class="row">
            <div class="col-xs-12 block-center">
                <form class="form-horizontal">
                    <div class="form-group">
                        <div class="col-xs-12 col-md-6">
                            <input type="email" class="form-control" id="inputEmail3" placeholder="Nhập chức danh, ngành nghề, từ khóa">
                        </div>
                        <div class="col-xs-12 col-xs-3">
                            <?php
                            $args = array(
                                'orderby' => 'count',
                                'hide_empty' => 0
                            );
                            $positions = get_terms('job-position', $args);
                            ?>
                            <select name = "position" class = "form-control">
                                <option value="">-- Select Position --</option>
                                <?php foreach ($positions as $position): ?>
                                    <option value="<?php echo $position->term_id ?>"><?php echo $position->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-xs-12 col-xs-3">
                            <?php
                            $args = array(
                                'orderby' => 'count',
                                'hide_empty' => 0
                            );
                            $locations = get_terms('job-location', $args);
                            ?>
                            <select name="location" class="form-control">
                                <option value="">-- Select Location --</option>
                                <?php foreach ($locations as $location): ?>
                                    <option value="<?php echo $location->term_id ?>"><?php echo $location->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="row-gap-medium"></div>
                <div class="row-gap-small"></div>
                <div class="row">
                    <div class="col-xs-12 col-md-10">
                        <p class="stat">
                            <?php
                            $i = 0;
                            foreach ($positions as $position):
                                ?>
                                <a href="#" class="white-link text-bold"><?php echo $position->name ?> (<?php echo $position->count ?>)</a> 
                                <?php if ($i < count($positions) - 1): ?>
                                    <span class="vertical-bar">|</span> 
                                <?php endif; ?>
                                <?php
                                $i++;
                            endforeach;
                            ?>
                        </p>
                    </div>
                    <div class="col-xs-12 col-md-2 pull-right">
                        <button class="btn btn-block btn-search btn-orange"><i class="glyphicon glyphicon-menu-right"></i><i class="glyphicon glyphicon-menu-right"></i> Tìm kiếm</button>
                    </div>
                </div>
                <div class="row-gap-small"></div>
                <!-- list of jobs -->
                <div class="list">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="nano">
                                <div class="nano-content">
                                    <!-- hot -->
                                    <?php
                                    $args = array(
                                        'post_type' => 'job',
                                        'posts_per_page' => 10,
                                        'meta_key' => 'status',
                                        'orderby' => array('status' => 'DESC'),
                                    );
                                    $loop = new WP_Query($args);
                                    ?>
                                    <?php if ($loop->have_posts()): ?>
                                        <?php while ($loop->have_posts()): $loop->the_post(); ?>
                                            <div class="row item hot">
                                                <div class="col-xs-6">
                                                    <div class="title">
                                                        <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                                    </div>
                                                    <div class="info">
                                                        <span class="localtion">Ho Chi Minh</span> | <span class="level"><?php echo get_field('work_level') ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xs-3">
                                                    <div class="text-blue">
                                                        <?php echo wp_trim_words(get_field('job_requirement'), 10, '...') ?>
                                                    </div>
                                                </div>
                                                <div class="col-xs-3">
                                                    <div><img class="date" src="<?php echo WP_PLUGIN_URL ?>/jobs-management/img/new_job/4.png" alt=""> Posted: <?php the_date()  ?></div>
                                                    <div><img class="view" src="<?php echo WP_PLUGIN_URL ?>/jobs-management/img/new_job/5.png" alt=""> Views: 92</div>
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
                <div class="row-gap-large"></div>
                <!-- end of job list -->
            </div>
        </div>
    </div>
</div>