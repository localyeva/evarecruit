<?php

/*
 * Author: KhangLe
 * 
 * 
 */

include_once (dirname(__FILE__) . '/MyThemeOptions.php');
include_once (dirname(__FILE__) . '/MyFunctions.php');
include_once (dirname(__FILE__) . '/MyTheme_Customize.php');
include_once (dirname(__FILE__) . '/MyTheme_Global_Service.php');
include_once (dirname(__FILE__) . '/MyTheme_Customize_Staff_Detail.php');
include_once(dirname(__FILE__) . '/cpt_acf_definitions.php');

/* -------------------------------------------------------------------------- */
add_action('init', 'myStartSession', 1);

// init session id
function myStartSession() {
    if (!session_id()) {
        session_start();
    }
}

/* ---------------------------------------------------------------------------- */
global $map_data;
add_action('init', 'load_data', 2);

function load_data() {

    global $map_data;
    // Google Map Data
    $args = array(
        'post_type' => 'stay-connected',
        'posts_per_page' => -1,
        'orderby' => array('date' => 'ASC'),
    );
    $loop = new WP_Query($args);
    if ($loop->have_posts()):
        while ($loop->have_posts()): $loop->the_post();
            if (have_rows('main_locations')):
                while (have_rows('main_locations')): the_row();
                    $map_data[] = array(
                        'main_location' => get_sub_field('main_location'),
                        'address' => get_sub_field('address'),
                        'lat' => get_sub_field('lat'),
                        'lng' => get_sub_field('lng'));
                endwhile;
            endif;
        endwhile;
        $map_data = json_encode($map_data);
    endif;
    wp_reset_postdata();
}

add_action('wp_print_scripts', 'scripts');

function scripts() {
    if (is_page('contact')) {
        wp_enqueue_script('js-validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array(), '1.14.0', TRUE);
    }
    
    if (is_home() || is_page('staff-detail')){
        wp_enqueue_script('js-google-map-api', '//maps.google.com/maps/api/js?sensor=false', array('js-common'), '3.0', TRUE);
    }

    //
    global $map_data;
    //
    wp_enqueue_script('js-common', get_template_directory_uri() . '/js/common.js', array(), '1.0', TRUE);
    $dataToBePassed = array(
        'home' => get_template_directory_uri(),
        'map_data' => $map_data,
    );
    wp_localize_script('js-common', 'vars', $dataToBePassed);
}

/* ------------------------------------------------------------ theme support */
global $theme_options;
$theme_options = get_option('my_theme_option');

add_action('wp_footer', 'add_custom_script');

function add_custom_script() {

    global $theme_options;
    $script = '';

    //Google Analytics
    if (isset($theme_options['ct_google_analytics'])) {
        $script .= $theme_options['ct_google_analytics'];
    }

    if (isset($theme_options['ct_google_tag_manager'])) {
        $script .= $theme_options['ct_google_tag_manager'];
    }

    // Social Network
    if (isset($theme_options['ct_facebook_script'])) {
        $script .= $theme_options['ct_facebook_script'];
    }

    if (isset($theme_options['ct_google_plus_script'])) {
        $script .= $theme_options['ct_google_plus_script'];
    }

    if (isset($theme_options['ct_twitter_script'])) {
        $script .= $theme_options['ct_twitter_script'];
    }

    // Custom Script
    if (isset($theme_options['ct_custom_script'])) {
        $script .= $theme_options['ct_custom_script'];
    }

    echo $script;
}

/* --------------------------------------------------------------------------- */