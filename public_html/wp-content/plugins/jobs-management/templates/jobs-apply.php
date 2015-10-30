<?php

/*
 * Author: KhangLe
 * Template Name: Jobs Apply
 * 
 */

if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}

require_once plugin_dir_path(__FILE__) . '../lib/includes/gump.class.php';

function wp_jobs_upload_dir($dirs) {
    $y = date('Y');
    $m = date('m');

    $dirs['subdir'] = "/cv/{$y}/{$m}";
    $dirs['path'] = $dirs['basedir'] . "/cv/{$y}/{$m}";
    $dirs['url'] = $dirs['baseurl'] . "/cv/{$y}/{$m}";

    return $dirs;
}

function my_mail_content_type($content_type) {
    return 'text/html';
}

add_filter('wp_mail_content_type', 'my_mail_content_type');

if (!function_exists('wp_handle_upload')) {
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
}

if (isset($_POST['apply']) && $_POST['apply'] == 'job') {

    global $wpdb;

    // validate input data
    $gump = new GUMP;


    $_POST = $gump->sanitize($_POST);

    $validators = array(
        're_email' => 'required|valid_email',
        're_fullname' => 'required',
        're_tel' => 'required',
    );

    $gump->validation_rules($validators);

    $rules = array(
        're_email' => 'trim|sanitize_email',
        're_fullname' => 'trim',
        're_tel' => 'trim',
        're_gender' => 'trim',
    );
    $gump->filter_rules($rules);

    $validated_data = $gump->run($_POST);

    if ($validated_data === FALSE) {

        $message = array();
        foreach ($gump->get_errors_array() as $k => $v) {
            switch (str_replace(' ', '_', strtolower($k))) {
                case 're_email':
                    $message['re_email'] = 'Email không hợp lệ';
                    break;
                case 're_fullname':
                    $message['re_fullname'] = 'Vui lòng nhập tên';
                    break;
                case 're_tel':
                    $message['re_tel'] = 'Vui long nhập số điện thoại';
                    break;
            }
        }

        $result = array(
            'code' => 'ERR',
            'message' => $message,
        );
        echo "<script>window.parent.parent.get_iframe_result('" . json_encode($result) . "');</script>";
        exit;
    }

    add_filter('upload_dir', 'wp_jobs_upload_dir');

    // upload file
    $uploadedfile = $_FILES['re_attach'];

    $upload_overrides = array('test_form' => false);

    $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

    $url_cv = '';
    if ($movefile && !isset($movefile['error'])) {
        chmod($movefile['file'], 444);
        $url_cv = isset($movefile['url']) ? $movefile['url'] : '';
    } else {
        $result = array(
            'code' => 'ERR',
            'message' => $movefile['error'],
        );
        exit;
    }

    $table_name = $wpdb->prefix . 'jobs_management';

    $download_link = isset($_POST['job_id']) ? (home_url() . '/download?attach=' . $_POST['job_id']) : '';
    $data = array(
        'apply_date' => current_time('mysql'),
        'fullname' => $_POST['re_fullname'],
        'email' => $_POST['re_email'],
        'phone_number' => $_POST['re_tel'],
        'gender' => $_POST['re_gender'][0],
        'attach_file' => $url_cv,
        'download_link' =>  $download_link,
        'job_id' => isset($_POST['job_id']) ? $_POST['job_id'] : '',
        'job_title' => isset($_POST['job_title']) ? $_POST['job_title'] : 'Apply Resumne',
        'job_position' => isset($_POST['job_position']) ? $_POST['job_position'] : '',
        'job_level' => isset($_POST['job_level']) ? $_POST['job_level'] : '',
        'job_salary' => isset($_POST['job_salary']) ? $_POST['job_salary'] : '',
        'job_location' => isset($_POST['job_location']) ? $_POST['job_location'] : '',
        'job_expired' => isset($_POST['job_expired']) ? $_POST['job_expired'] : '',
        'job_slug' => isset($_POST['job_slug']) ? $_POST['job_slug'] : '',
    );

    $wpdb->insert($table_name, $data);

    remove_filter('upload_dir', 'wp_jobs_upload_dir');
    //
    $result = array(
        'code' => 'OK',
        'message' => 'Cảm ơn bạn đã ứng tuyển',
    );

    echo "<script>window.parent.parent.get_iframe_result('" . json_encode($result) . "');</script>";
    /* -------------------------------------------------------------- send mail */
    require_once plugin_dir_path(__FILE__) . '../lib/includes/Twig/Autoloader.php';
    Twig_Autoloader::register();

    $loader = new Twig_Loader_String;

    $twig = new Twig_Environment($loader);

    $from = job_get_option('wpt_job_text_from_email');
    $fromname = job_get_option('wpt_job_text_from_name');

    // Mail to Candidate
    $body_candidate = job_get_option('wpt_job_text_block_candidate');
    if (isset($body_candidate) && $body_candidate != '') {
        $body_candidate = $twig->render($body_candidate, $data);
        //
        $subject_candidate = $twig->render(job_get_option('wpt_job_text_subject_candidate'), $data);
        //
        $headers = 'From: ' . $fromname . ' <' . $from . '>' . '\r\n';
        //	
        wp_mail($data['email'], stripslashes($subject_candidate), stripslashes($body_candidate), $headers);
    }

    //Admin用メッセージ
    $body_admin = job_get_option('wpt_job_text_block_admin');
    if (isset($body_admin) && $body_admin != '') {
        $body_admin = $twig->render($body_admin, array_merge(
                        $data, array(
            'entry_time' => gmdate("Y/m/d H:i:s", time() + 9 * 3600),
            'entry_host' => gethostbyaddr(getenv("REMOTE_ADDR")),
            'entry_ua' => getenv("HTTP_USER_AGENT"),
        )));
        //
        $subject_admin = job_get_option('wpt_job_text_subject_admin');
        //
        $list_email = job_get_option('wpt_job_text_list_email');
        if (isset($list_email) && $list_email != '') {
            $list_email = preg_split('/\r\n|\n|\r/', $list_email);
            //
            $headers = 'From: ' . $fromname . ' <' . $from . '>' . '\r\n';
            //
            wp_mail($list_email, stripslashes($subject_admin), stripslashes($body_admin), $headers);
        }
    }
} else {
    wp_redirect(home_url());
}
?>