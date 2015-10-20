<?php
function assetSrc($file)
{
    echo $file.'?'.filemtime($file);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery.sidr.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jquery.sidr.dark.css">
        <link rel="stylesheet" href="<?php assetSrc('css/style.css'); ?>">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    </head>
    <body>
        <?php include('./_home/navbar.php'); ?>
        <div id="new-job-detail">
            <?php include('./_common/navbar.php'); ?>
            <div class="header-banner">
                <img src="img/new_job_detail/9.png" alt="" />
                <div class="overlay container">
                    <div class="info">
                        <h2>Lab name</h2>
                    </div>
                </div>
            </div>
            <div class="greybar"></div>
            <div class="container" style="margin-top: -88px;">
                <div class="row">
                    <div class="col-xs-12">
                        <?php include('./_new_jobs/standout.php'); ?>
                        <?php include('./_new_jobs/detail.php'); ?>
                        <?php // include('./_new_jobs/actions.php'); ?>
                    </div>
                </div>
                <!-- pictures -->
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="lab-pictures col-xs-12 col-md-12">
                            <img src="img/new_job_detail/10.png" alt="" class="col-xs-12 col-md-6" />
                            <img src="img/new_job_detail/10.png" alt=""  class="col-xs-12 col-md-6" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="col-xs-12 col-md-12 end-lab-info">
                            <a href="#" class="submit col-xs-12 col-md-4"><span class="send">Apply</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#responsive-menu-button').sidr({
                name: 'sidr-main',
                source: '#navigation'
            });
        </script>
        <style type="text/css">
            .navbar li:last-child {
                display: none;
            }
        </style>
    </body>
</html>
