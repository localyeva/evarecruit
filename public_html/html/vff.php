<?php
function assetSrc($file)
{
    echo $file.'?'.filemtime($file);
}
?>
<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/jquery.sidr.dark.css">
        <link rel="stylesheet" href="css/style.css" />



    </head>
    <body>
          <?php include('./_common/navbar.php'); ?>
            <div id="home">
              <?php include('./_home/vffvietnam.php'); ?>
              <?php  include('./_home/info.php'); ?>
            </div>
            <?php  include('./_home/footer.php'); ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery.sidr.min.js"></script>
        <script type="text/javascript" src="js/parallax.min.js"></script>
            <script>
                $('#responsive-menu-button').sidr({
                    name: 'sidr-main',
                    source: '#navigation'
                });
            </script>

    </body>
</html>
