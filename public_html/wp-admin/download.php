<?php

/*
 * Author: Khang LD
 * Description: Force Download
 * 
 */

if (isset($_GET['attach'])) {
    $name = $_GET['attach'];
    //
    $parse = parse_url($name);
    $file = basename($parse['path']);
    $ext = substr(strrchr($file, '.'), 1);
    //
    $clean_name = isset($_GET['clean']) ? trim($_GET['clean']) : "document-cv.$ext";
    //
    $file_path = '..' . $parse['path'];
    $file_path = '../wp-content/uploads/cv/2015/10/test23.pdf';
    //
    header('Content-Description: File Transfer');
    header('Content-Type: application/force-download');
    header("Content-Disposition: attachment; filename=\"" . basename($clean_name) . "\";");
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file_path));
    ob_clean();
    flush();
//    readfile($file_path);
    readfile($file_path, true);
    exit;
}
?>