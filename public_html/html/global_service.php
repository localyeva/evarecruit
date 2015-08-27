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
    	<?php include('./_common/navbar.php'); ?>
        <div id="global-service">
            <?php include('./_global_service/banner.php'); ?>
            <?php include('./_global_service/gallery.php'); ?>
            <?php include('./_global_service/our_thoughts.php'); ?>
            <?php include('./_global_service/environment.php'); ?>
        	<?php include('./_home/map.php'); ?>
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
