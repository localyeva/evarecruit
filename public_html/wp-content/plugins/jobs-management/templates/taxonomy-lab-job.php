<?php

/*
 * Author: KhangLe
 * Template Name: Job of Lab
 * 
 */
if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}

// Count number of views
if (function_exists('setPostViews')) {
    setPostViews(get_the_ID(), 'job_views');
}

get_header();
?>

<h2>Job of Lab</h2>

<?php get_footer(); ?>