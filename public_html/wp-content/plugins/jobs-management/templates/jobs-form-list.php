<?php
/*
 * Author: KhangLe
 * 
 */

if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}

global $job_status;
?>

<div class="header-job-list home-page">
    <div class="container">
        <div class="row-gap-medium"></div>
        <h2 class="text-center">Find your dream jobs</h2>
        <div class="row-gap-large"></div>
        <div class="row">
            <div class="col-xs-12 block-center">
                <form class="form-horizontal" action="<?php echo bloginfo('url') ?>/jobs/search" method="GET" >
                    <div class="form-group">
                        <div class="col-xs-12 col-md-6">
                            <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Nhập chức danh, ngành nghề, từ khóa">
                        </div>
                        <div class="col-xs-12 col-xs-3">
                            <?php
                            $args = array(
                                'orderby' => 'count',
                                'hide_empty' => 0
                            );
                            $positions = get_terms('job-position', $args);
                            ?>
                            <select name="position" class="form-control">
                                <option value="">-- Select Position --</option>
                                <?php foreach ($positions as $position): ?>
                                    <option value="<?php echo $position->slug ?>"><?php echo $position->name ?></option>
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
                                    <option value="<?php echo $location->slug ?>"><?php echo $location->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row-gap-medium"></div>
                    <div class="row-gap-small"></div>
                    <div class="row">
                        <div class="col-xs-12 col-md-10">
                            <p class="stat">
                                <?php
                                $i = 0;
                                foreach ($positions as $position):
                                    ?>
                                    <a href="<?php echo bloginfo('url') ?>/jobs/search/?position=<?php echo $position->slug ?>&search=job" class="white-link text-bold"><?php echo $position->name ?> (<?php echo $position->count ?>)</a> 
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
                            <button class="btn btn-block btn-search btn-orange" type="submit"><i class="glyphicon glyphicon-menu-right"></i><i class="glyphicon glyphicon-menu-right"></i> Tìm kiếm</button>
                            <input type="hidden" name="search" value="job" />
                        </div>
                    </div>
                </form>
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
                                        'orderby' => array('meta_value_num' => 'DESC'),
                                        'paged' => $paged,
                                    );
                                    $wp_query = new WP_Query($args);
                                    ?>
                                    <!-- hot -->
                                    <?php require_once(dirname(__FILE__) . '/jobs-row.php') ?>
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