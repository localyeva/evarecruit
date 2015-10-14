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
        <div id="new-jobs">
            <?php include('./_common/navbar.php'); ?>
            <?php include('./_new_jobs/search_bar.php'); ?>
            <div class="container header-job-list">
                <?php include('./_new_jobs/job_list.php'); ?>
                <div class="col-xs-12 col-md-4 sidebar">
                    <div class="row">
                        <a href="" title="">
                            <img src="img/new_job/staffs.png" alt="" />
                        </a>
                        <div class="l-col">
                            <a href="" title="">
                                <h4>Urgent! Nhan vien xu ly du lieu tieng Nhat <i class="new">(New)</i></h4>
                            </a>
                            <div class="info">
                                <span class="localtion">Ho Chi Minh</span> | <span class="level">Team Leader/Supervisor</span>
                            </div>
                        </div>
                        <div class="r-col">
                            <div class="text-blue">
                                Internation Skill<br/>
                                Technical Field Knowledge<br/>
                                Management &amp; Leadership
                            </div>
                            <div class="posted">Posted: 13/08/2015</div>
                            <div class="views">Views: 92</div>
                        </div>
                    </div>
                    <div class="row">
                        <a href="" title="">
                            <img src="img/new_job/staffs.png" alt="" />
                        </a>
                        <div class="l-col">
                            <a href="" title="">
                                <h4>Urgent! Nhan vien xu ly du lieu tieng Nhat <i class="new">(New)</i></h4>
                            </a>
                            <div class="info">
                                <span class="localtion">Ho Chi Minh</span> | <span class="level">Team Leader/Supervisor</span>
                            </div>
                        </div>
                        <div class="r-col">
                            <div class="text-blue">
                                Internation Skill<br/>
                                Technical Field Knowledge<br/>
                                Management &amp; Leadership
                            </div>
                            <div class="posted">Posted: 13/08/2015</div>
                            <div class="views">Views: 92</div>
                        </div>
                    </div>
                    <div class="row">
                        <a href="" title="">
                            <img src="img/new_job/staffs.png" alt="" />
                        </a>
                        <div class="l-col">
                            <a href="" title="">
                                <h4>Urgent! Nhan vien xu ly du lieu tieng Nhat <i class="new">(New)</i></h4>
                            </a>
                            <div class="info">
                                <span class="localtion">Ho Chi Minh</span> | <span class="level">Team Leader/Supervisor</span>
                            </div>
                        </div>
                        <div class="r-col">
                            <div class="text-blue">
                                Internation Skill<br/>
                                Technical Field Knowledge<br/>
                                Management &amp; Leadership
                            </div>
                            <div class="posted">Posted: 13/08/2015</div>
                            <div class="views">Views: 92</div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('./_home/apply-resume.php'); ?>
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
        <style type="text/css">
            .navbar li:last-child {
                display: none;
            }
        </style>
    </body>
</html>
