<?php

/*
 * Author: KhangLe
 * Template Name: Jobs Apply
 * 
 */

if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}

function wp_jobs_upload_dir( $dirs ) {
    $y = date('Y');
    $m = date('m');
    
    $dirs['subdir'] = "/cv/{$y}/{$m}";
    $dirs['path'] = $dirs['basedir'] . "/cv/{$y}/{$m}";;
    $dirs['url'] = $dirs['baseurl'] . "/cv/{$y}/{$m}";;

    return $dirs;
}

if (!function_exists('wp_handle_upload')) {
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
}

if (isset($_POST['apply']) && $_POST['apply'] == 'job') {

    global $wpdb;

    add_filter( 'upload_dir', 'wp_jobs_upload_dir' );

    // upload file
    $uploadedfile = $_FILES['re_attach'];

    $upload_overrides = array('test_form' => false);

    $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

    $url_cv = '';
    if ($movefile && !isset($movefile['error'])) {
        $url_cv = isset($movefile['url']) ? $movefile['url'] : '';
    } else {
        $result = array(
            'code' => 'ERR',
            'message' => $movefile['error']
        );
    }

    $table_name = $wpdb->prefix . 'jobs_management';

    $wpdb->insert(
            $table_name, array(
        'apply_date' => current_time('mysql'),
        'fullname' => $_POST['re_fullname'],
        'email' => $_POST['re_email'],
        'phone_number' => $_POST['re_tel'],
        'gender' => $_POST['re_gender'][0],
        'attach_file' => $url_cv,
        'job_id' => $_POST['job_id'],
        'job_title' => $_POST['job_title'],
        'job_position' => $_POST['job_position'],
        'job_level' => $_POST['job_level'],
        'job_salary' => $_POST['job_salary'],
        'job_location' => $_POST['job_location'],
        'job_expired' => $_POST['job_expired'],
        'job_slug' => $_POST['job_slug'],
            )
    );
    
    remove_filter( 'upload_dir', 'wp_jobs_upload_dir' );
    //
    $result = array(
        'code' => 'OK',
        'message' => ''
    );
    
    echo "<script>window.parent.parent.get_iframe_result('" . json_encode($result) . "')</script>";
    
} else {
    wp_redirect(home_url());
}
?>