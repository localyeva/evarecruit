<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link type="image/x-icon" href="<?php echo get_template_directory_uri() ?>/images/evaicon.png" rel="shortcut icon">

        <meta name="author" content="Evolable Asia">
        <meta name="description" itemprop="description" content="Trang tuyển dụng Evolable Asia. Chúng tôi đang tìm kiếm các ứng viên đáp ứng nhu cầu cho các dự án phát triển phần mềm, dịch vụ BPO.">
        <meta name="keywords" itemprop="keywords" content="tuyển dụng,Evolable Asia,developer,communicator,jobs,japan,recruitment,lập trình" />
        <meta property="fb:app_id" content="795903230445450">
        <meta property="og:type" content="website">
        <meta property="og:url" content="http://jobs.evolable.asia/">
        <meta property="og:site_name" content="Evolable Asia - Tuyển dụng">
        <meta property="og:title" content="">
        <meta property="og:image" content="http://jobs.evolable.asia/wp-content/uploads/2015/08/fb_share.png">
        <meta property="og:description" content="Trang tuyển dụng Evolable Asia. Chúng tôi đang tìm kiếm các ứng viên đáp ứng nhu cầu cho các dự án phát triển phần mềm, dịch vụ BPO.">

        <title><?php echo bloginfo('name') ?></title>

        <!-- Bootstrap -->
        <!--
        <link href="<?php echo get_template_directory_uri() ?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo get_template_directory_uri() ?>/css/font-awesome.min.css" rel="stylesheet">        
        <link href="<?php echo get_template_directory_uri() ?>/css/jquery.sidr.dark.css" rel="stylesheet">
        <link href="<?php echo get_template_directory_uri() ?>/css/jquery.fancybox.css" rel="stylesheet">
        <link href="<?php echo get_template_directory_uri() ?>/css/nanoscroller.css" rel="stylesheet">
        -->
        <link href="<?php echo get_template_directory_uri() ?>/css/app.css" rel="stylesheet">
        <link href="<?php echo get_template_directory_uri() ?>/css/style.css" rel="stylesheet">

        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php wp_head(); ?>
    </head>
    <body>
        <div id="mobile-header">
            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?php echo bloginfo('url') ?>">
                            <img alt="Evolable Asia" src="<?php echo get_site_logo() ?>">
                        </a>
                        <a id="responsive-menu-button" class="btn btn-toggle navbar-btn pull-right" href="#">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="fa fa-bars fa-lg"></span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="navigation">
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?php echo bloginfo('url') ?>">
                            <img height="40" alt="Evolable Asia" src="<?php echo get_site_logo() ?>">
                        </a>
                    </div>
                    <style>
                        .navbar-default .navbar-nav > li > a.btn-join, .navbar-default .navbar-text{
                            background-color: #ff530d;
                            border-radius: 5px;
                            color: #fff;
                            padding: 6px 12px;
                        }
                        .navbar-default .navbar-nav > li > a.btn-join:focus, .navbar-default .navbar-nav > li > a.btn-join:hover{
                            background-color: #ff530d;
                        }
                    </style>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="<?php echo bloginfo('url') ?>">Home</a></li>
                            <!--<li><a href="<?php echo bloginfo('url') ?>/#services" data-goto="services">Services</a></li>-->
                            <li><a href="<?php echo bloginfo('url') ?>/work-environment">Work Environment</a></li>
                            <!--<li><a href="<?php echo bloginfo('url') ?>/#about-us" data-goto="about-us">About</a></li>-->
                            <!--<li><a href="<?php echo bloginfo('url') ?>/team">Team</a></li>-->
                            <li>
                                <a class="btn btn-orange navbar-btn btn-join white-link" href="<?php echo bloginfo('url') ?>/jobs">Join Us Now</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>