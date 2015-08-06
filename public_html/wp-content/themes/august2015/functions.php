<?php

/*
 * Author: KhangLe
 * 
 * 
 */

include_once (dirname(__FILE__) . '/MyTheme_Customize.php');
include_once(dirname(__FILE__) . '/cpt_acf_definitions.php');

/* -------------------------------------------------------------------------- */

// init session id
function myStartSession() {
    if (!session_id()) {
        session_start();
    }
}

add_action('init', 'myStartSession', 1);

function scripts() {
    if (is_page('contact')) {
        wp_enqueue_script('js-validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array(), '1.14.0', TRUE);
    }
}

add_action('wp_print_scripts', 'scripts');