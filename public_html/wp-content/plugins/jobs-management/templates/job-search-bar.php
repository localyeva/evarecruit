<?php
/*
 * Author: KhangLe
 * Template Name: Jobs
 * 
 */

if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}

$post_per_page = job_get_option('wpt_job_text_item_per_page_job');

global $job_status;

$terms = get_terms('lab');
$args_terms = array();
foreach ($terms as $term) {
    $args_terms[] = $term->slug;
}

if (!isset($_GET) || !isset($_GET['search']) || (!isset($_GET['keyword']) && $_GET['position'] == '' && $_GET['location'] == '' )) {
    $args = array(
        'post_type' => 'job',
        'posts_per_page' => $post_per_page,
        'meta_key' => 'status',
        'orderby' => array('meta_value_num' => 'DESC'),
        'tax_query' => array(
            array(
                'taxonomy' => 'lab',
                'field' => 'slug',
                'terms' => $args_terms,
                'operator' => 'NOT IN',
            ),
        ),
        'paged' => $paged,
    );
    $wp_query = new WP_Query($args);
} elseif (isset($_GET['search']) || $_GET['search'] == 'job') {

    if ((isset($_GET['keyword']) && $_GET['keyword'] != '' && strlen($_GET['keyword']) > 3) &&
            (isset($_GET['position']) && $_GET['position'] != '') &&
            (isset($_GET['location']) && $_GET['location'] != '')) {
        $args = array(
            'post_type' => 'job',
            'posts_per_page' => $post_per_page,
            'meta_key' => 'status',
            'orderby' => array('meta_value_num' => 'DESC'),
            's' => $_GET['keyword'],
            'tax_query' => array(
                array(
                    'taxonomy' => 'job-position',
                    'field' => 'slug',
                    'terms' => $_GET['position'],
                ),
                array(
                    'taxonomy' => 'job-location',
                    'field' => 'slug',
                    'terms' => $_GET['location'],
                ),
            ),
            'paged' => $paged,
        );
        $wp_query = new WP_Query($args);
    } elseif ((isset($_GET['keyword']) && $_GET['keyword'] != '' && strlen($_GET['keyword']) > 3) &&
            (isset($_GET['position']) && $_GET['position'] != '')) {
        $args = array(
            'post_type' => 'job',
            'posts_per_page' => $post_per_page,
            'meta_key' => 'status',
            'orderby' => array('meta_value_num' => 'DESC'),
            's' => $_GET['keyword'],
            'tax_query' => array(
                array(
                    'taxonomy' => 'job-position',
                    'field' => 'slug',
                    'terms' => $_GET['position'],
                ),
            ),
            'paged' => $paged,
        );
        $wp_query = new WP_Query($args);
    } elseif ((isset($_GET['keyword']) && $_GET['keyword'] != '' && strlen($_GET['keyword']) > 3) &&
            (isset($_GET['location']) && $_GET['location'] != '')) {
        $args = array(
            'post_type' => 'job',
            'posts_per_page' => $post_per_page,
            'meta_key' => 'status',
            'orderby' => array('meta_value_num' => 'DESC'),
            's' => $_GET['keyword'],
            'tax_query' => array(
                array(
                    'taxonomy' => 'job-location',
                    'field' => 'slug',
                    'terms' => $_GET['location'],
                ),
            ),
            'paged' => $paged,
        );
        $wp_query = new WP_Query($args);
    } elseif ((isset($_GET['position']) && $_GET['position'] != '') &&
            (isset($_GET['location']) && $_GET['location'] != '')) {
        $args = array(
            'post_type' => 'job',
            'posts_per_page' => $post_per_page,
            'meta_key' => 'status',
            'orderby' => array('meta_value_num' => 'DESC'),
            'tax_query' => array(
                array(
                    'taxonomy' => 'job-position',
                    'field' => 'slug',
                    'terms' => $_GET['position'],
                ),
                array(
                    'taxonomy' => 'job-location',
                    'field' => 'slug',
                    'terms' => $_GET['location'],
                ),
            ),
            'paged' => $paged,
        );
        $wp_query = new WP_Query($args);
    } elseif ((isset($_GET['keyword']) && $_GET['keyword'] != '' && strlen($_GET['keyword']) > 3)) {
        $args = array(
            'post_type' => 'job',
            'posts_per_page' => $post_per_page,
            'meta_key' => 'status',
            'orderby' => array('meta_value_num' => 'DESC'),
            's' => $_GET['keyword'],
            'paged' => $paged,
        );
        $wp_query = new WP_Query($args);
    } elseif ((isset($_GET['position']) && $_GET['position'] != '')) {
        $args = array(
            'post_type' => 'job',
            'posts_per_page' => $post_per_page,
            'meta_key' => 'status',
            'orderby' => array('meta_value_num' => 'DESC'),
            'tax_query' => array(
                array(
                    'taxonomy' => 'job-position',
                    'field' => 'slug',
                    'terms' => $_GET['position'],
                ),
            ),
            'paged' => $paged,
        );
        $wp_query = new WP_Query($args);
    } elseif ((isset($_GET['location']) && $_GET['location'] != '')) {
        $args = array(
            'post_type' => 'job',
            'posts_per_page' => $post_per_page,
            'meta_key' => 'status',
            'orderby' => array('meta_value_num' => 'DESC'),
            'tax_query' => array(
                array(
                    'taxonomy' => 'job-location',
                    'field' => 'slug',
                    'terms' => $_GET['location'],
                ),
            ),
            'paged' => $paged,
        );
        $wp_query = new WP_Query($args);
    } else {
        $args = array(
            'post_type' => 'job',
            'posts_per_page' => $post_per_page,
            'meta_key' => 'status',
            'orderby' => array('meta_value_num' => 'DESC'),
            'tax_query' => array(
                array(
                    'taxonomy' => 'lab',
                    'field' => 'slug',
                    'terms' => $args_terms,
                    'operator' => 'NOT IN',
                ),
            ),
            'paged' => $paged,
        );
        $wp_query = new WP_Query($args);
    }
}
?>

<div class="header-search-bar">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <form class="form-horizontal" action="<?php echo bloginfo('url') ?>/jobs/search" method="GET">
                    <div class="form-group">
                        <div class="col-xs-12 col-md-6">
                            <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Nhập chức danh, ngành nghề, từ khóa" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>"/>
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
                                    <option value="<?php echo $position->slug ?>" <?php echo (isset($_GET['position']) && $_GET['position'] == $position->slug) ? 'selected' : '' ?>><?php echo $position->name ?></option>
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
                                    <option value="<?php echo $location->slug ?>" <?php echo (isset($_GET['location']) && $_GET['location'] == $location->slug) ? 'selected' : '' ?>><?php echo $location->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row-gap-small"></div>
                    <div class="row">
                        <div class="col-xs-12 col-md-10">
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