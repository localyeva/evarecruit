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

<h2>Job of Lab in Plug-in Template</h2>

<?php

$term = get_the_terms($post->ID, 'lab');

if (function_exists('get_all_wp_terms_meta')) {
    $arrayMetaList = get_all_wp_terms_meta($term[0]->term_id);
}

// array all meta fields for category/term
print_r($arrayMetaList['top-image']);


?>

<?php get_footer(); ?>