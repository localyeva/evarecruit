<?php
/*
 * Author: KhangLe
 * Template Name: Jobs
 * 
 */

if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}


global $job_status;

var_dump($_GET);

if (!isset($_GET) || !isset($_GET['search'])) {
    $args = array(
        'post_type' => 'job',
        'posts_per_page' => 5,
        'meta_key' => 'status',
        'orderby' => array('status' => 'DESC'),
        'paged' => $paged,
    );
    $wp_query = new WP_Query($args);
}

if (isset($_GET['search']) && $_GET['search'] == 'job') {

    if(isset($_GET['position'])){
        $args = array(
            'post_type' => 'job',
            'posts_per_page' => 5,
            'meta_key' => 'status',
            'orderby' => array('status' => 'DESC'),
            'paged' => $paged,
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'job-position',
                    'field' => 'slug',
                    'terms' => array()
                ),
                array(
                    'taxonomy' => 'job-position',
                    'field' => 'slug',
                    'terms' => array('ho-chi-minh')
                ),
            )
        );
        $wp_query = new WP_Query($args);
    }

}

//global $wp_query;
//var_dump($wp_query);
// check select position location
?>

<div class="header-search-bar">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <form class="form-horizontal" action="<?php echo bloginfo('url') ?>/jobs/search" method="GET">
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
                            <select name="position" class = "form-control">
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
                        </div>
                        <div class="col-xs-12 col-md-2 pull-right">
                            <button class="btn btn-block btn-search btn-orange" type="submit"><i class="glyphicon glyphicon-menu-right"></i><i class="glyphicon glyphicon-menu-right"></i> Tìm kiếm</button>
                            <input type="hidden" name="search" value="job" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>