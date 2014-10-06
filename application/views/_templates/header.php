<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title;?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="<?php echo URL; ?>public/js/jquery-2.0.3.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/starter-template/starter-template.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo URL;?>public/js/ie-emulation-modes-warning.js"></script>

</head>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./index.php?page=home">Airnote</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="./index.php?page=home">Home</a></li>
            <li><a href="./index.php?page=note">Note</a></li>
            <li><a href="./index.php?page=tag">Tag</a></li>
            <li><?php 
            if (isset($username)){
               echo "<a href=\"./index.php?page=logout\">$username</a>";
            }
            else{
               echo "<a href=\"./index.php?page=login\">login</a>";
            }
            ?>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
