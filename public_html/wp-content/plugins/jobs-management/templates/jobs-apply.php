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
        $url_cv = isset($movefile['url']) ? $movefile['url'] : '';
    } else {
        $result = array(
            'code' => 'ERR',
            'message' => $movefile['error'],
        );
        exit;
    }

    $table_name = $wpdb->prefix . 'jobs_management';

    $data = array(
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
    require_once plugin_dir_path(__FILE__) . '../lib/includes/Mail.php';
    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem(__DIR__ . '/mail');

    $twig = new Twig_Environment($loader);

    //Admin用メッセージ
    $template_admin = $twig->loadTemplate('to_hr.tpl');

    $subject_admin = 'Ứng tuyển - ' . $_POST['job_position'] . '-' . $_POST['re_fullname'];
    $body_admin = $template_admin->render(
            array_merge(
                    $data, array(
        'entry_time' => gmdate("Y/m/d H:i:s", time() + 9 * 3600),
        'entry_host' => gethostbyaddr(getenv("REMOTE_ADDR")),
        'entry_ua' => getenv("HTTP_USER_AGENT"),
    )));
    
    $list_email = job_get_option('wpt_job_text_list_email');
    if (isset($list_email)){
        $list_email = preg_split('/\r\n|\n|\r/', $list_email);
        
        $fromname = '';
        $mail = new Mail();
        $mail->from = 'khangld@evolable.asia';
        $mail->fromName = $fromname;
        $mail->to = $list_email;
        $mail->title = $subject_admin;
        $mail->body = nl2br($body_admin);
        $mail->send();
    }
    
} else {
    wp_redirect(home_url());
}
?>