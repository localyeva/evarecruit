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
        <script type="text/javascript" src="js/parallax.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jquery.sidr.dark.css">
        <link rel="stylesheet" href="<?php assetSrc('css/style.css'); ?>">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    </head>
    <body>
        	<?php include('./_common/navbar.php'); ?>
            <div id="home">
            	<?php include('./_home/banner.php'); ?>
            	<div class="header-work-environment">
                    <div class="container">
                        <div class="row-gap-large"></div>
                        <h2 class="text-center">Event</h2>
                        <div class="row-gap-medium"></div>
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="img/global_service/2.png" class="photo" title="EVOLABLE ASIA">
                                    <img src="img/global_service/2.png" alt="" class="img-responsive">
                                </a>
                                <div class="row-gap-small"></div>
                                <h3>EVOLABLE ASIA</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                            <div class="col-xs-6">
                                <a href="img/global_service/3.png" class="photo" title="EVOLABLE ASIA">
                                    <img src="img/global_service/3.png" alt="" class="img-responsive">
                                </a>
                                <div class="row-gap-small"></div>
                                <h3>EVOLABLE ASIA</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>

                        <div class="row-gap-medium"></div>
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="img/global_service/4.png" class="photo" title="EVOLABLE ASIA">
                                    <img src="img/global_service/4.png" alt="" class="img-responsive">
                                </a>
                                <div class="row-gap-small"></div>
                                <h3>EVOLABLE ASIA</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                            <div class="col-xs-6">
                                <a href="img/global_service/5.png" class="photo" title="EVOLABLE ASIA">
                                    <img src="img/global_service/5.png" alt="" class="img-responsive">
                                </a>
                                <div class="row-gap-small"></div>
                                <h3>EVOLABLE ASIA</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>

                        <div class="row-gap-large"></div>
                        <h2 class="text-center">Benefits</h2>
                        <div class="row-gap-medium"></div>
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="img/global_service/6.png" class="photo" title="EVOLABLE ASIA">
                                    <img src="img/global_service/6.png" alt="" class="img-responsive">
                                </a>
                                <div class="row-gap-small"></div>
                                <h3>EVOLABLE ASIA</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                            <div class="col-xs-6">
                                <a href="img/global_service/7.png" class="photo" title="EVOLABLE ASIA">
                                    <img src="img/global_service/7.png" alt="" class="img-responsive">
                                </a>
                                <div class="row-gap-small"></div>
                                <h3>EVOLABLE ASIA</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>

                        <div class="row-gap-medium"></div>
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="img/global_service/8.png" class="photo" title="EVOLABLE ASIA">
                                    <img src="img/global_service/8.png" alt="" class="img-responsive">
                                </a>
                                <div class="row-gap-small"></div>
                                <h3>EVOLABLE ASIA</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                            <div class="col-xs-6">
                                <a href="img/global_service/9.png" class="photo" title="EVOLABLE ASIA">
                                    <img src="img/global_service/9.png" alt="" class="img-responsive">
                                </a>
                                <div class="row-gap-small"></div>
                                <h3>EVOLABLE ASIA</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>

                        <div class="row-gap-large"></div>
                        <h2 class="text-center">Work space</h2>
                        <div class="row-gap-medium"></div>
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="img/global_service/10.png" class="photo" title="EVOLABLE ASIA">
                                    <img src="img/global_service/10.png" alt="" class="img-responsive">
                                </a>
                                <div class="row-gap-small"></div>
                                <h3>EVOLABLE ASIA</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                            <div class="col-xs-6">
                                <a href="img/global_service/11.png" class="photo" title="EVOLABLE ASIA">
                                    <img src="img/global_service/11.png" alt="" class="img-responsive">
                                </a>
                                <div class="row-gap-small"></div>
                                <h3>EVOLABLE ASIA</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row-gap-large"></div>
                </div>
                <?php include('./_home/apply-resume.php'); ?>
                <?php include('./_home/find-job.php'); ?>
                <?php include('./_home/map.php'); ?>
                <?php include('./_home/info.php'); ?>
            </div>
            <?php include('./_home/footer.php'); ?>
            <script>
                $('#responsive-menu-button').sidr({
                    name: 'sidr-main',
                    source: '#navigation'
                });
            </script>
    </body>
</html>
