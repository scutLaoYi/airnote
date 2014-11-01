<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->title;?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo URL; ?>public/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo URL;?>public/css/template.css" rel="stylesheet" type="text/css">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo URL;?>public/js/ie-emulation-modes-warning.js"></script>

</head>
<body>
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="/home/index">Airnote</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/home/index">Home</a></li>
            <li><a href="/notes/index">Note</a></li>
            <li><a href="/tags/index">Tag</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><?php 
            if (isset($this->username)){
               echo "<a href=\"/user/logout\">$this->username</a>";
            }
            else{
               echo "<a href=\"/user/login\">login</a>";
            }
            ?>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <br/>
    <div class="container">
    <?php
    if (isset($this->_alert_to_show))
    {
    ?>
        <div class="alert alert-danger" role="alert"><p><?php echo $this->_alert_to_show; ?></p></div>
        <?php
    }
    if (isset($this->_info_to_show)) {
    ?>
        <div class="alert alert-success" role="alert"><p><?php echo $this->_info_to_show; ?></p></div>
        <?php
    }
?>

