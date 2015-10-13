<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link type="image/x-icon" href="<?php echo get_template_directory_uri() ?>/images/evaicon.png" rel="shortcut icon">

        <meta content="Evolable Asia" name="author">
        <meta content="Trang tuyển dụng Evolable Asia" itemprop="description" name="description">
        <meta content="tuyển dụng,Evolable Asia,developer,BSE,BPO,communicator,jobs,japan,recruitment,lập trình,phiên dịch tiếng Nhật,web,di động,kỹ sư cầu nối" itemprop="keywords" name="keywords">

        <meta content="795903230445450" property="fb:app_id">
        <meta content="website" property="og:type">
        <meta content="http://jobs.evolable.asia/" property="og:url">
        <meta content="Evolable Asia - Tuyển dụng" property="og:site_name">
        <meta content="" property="og:title">
        <meta content="http://jobs.evolable.asia/uploaded/images/source/fb_share.png?123456" property="og:image">
        <meta content="" property="og:description">

        <title><?php echo bloginfo('name') ?></title>

        <!-- Bootstrap -->
        <link href="<?php echo get_template_directory_uri() ?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo get_template_directory_uri() ?>/css/jquery.sidr.dark.css" rel="stylesheet">
        <link href="<?php echo get_template_directory_uri() ?>/css/jquery.fancybox.css" rel="stylesheet">
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
                            <img alt="Brand" src="<?php echo get_template_directory_uri() ?>/img/logo_h.png">
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
                            <img height=80 alt="Evolable Asia" src="<?php echo get_site_logo() ?>">
                        </a>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="<?php echo bloginfo('url') ?>">Home</a></li>
                            <li><a href="<?php echo bloginfo('url') ?>/#services" data-goto="services">Services</a></li>
                            <li><a href="<?php echo bloginfo('url') ?>/#about-us" data-goto="about-us">About</a></li>
                            <li><a href="<?php echo bloginfo('url') ?>/team">Team</a></li>
                            <li>
                                <button data-url="<?php echo bloginfo('url') ?>/jobs" type="button" class="btn btn-orange navbar-btn">Join Us Now</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>