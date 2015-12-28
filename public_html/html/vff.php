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
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/jquery.sidr.dark.css">
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/vff.css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery.sidr.min.js"></script>
        <script type="text/javascript" src="js/parallax.min.js"></script>

    </head>
    <body>
          <?php include('./_common/navbar.php'); ?>
            <div id="home">
              <?php include('./_home/vffvietnam.php'); ?>
              <?php  include('./_home/info.php'); ?>
            </div>
            <?php  include('./_home/footer.php'); ?>
            <script>
                $('#responsive-menu-button').sidr({
                    name: 'sidr-main',
                    source: '#navigation'
                });
            </script>
    </body>
</html>
