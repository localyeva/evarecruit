<?php

/*
 * Author: KhangLe
 * Template Name: Jobs Apply
 * 
 */

if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}

if (isset($_POST['apply']) && $_POST['apply'] == 'job') {
    var_dump($_POST);
} else {
    wp_redirect(home_url());
}
?>