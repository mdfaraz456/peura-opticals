<?php

if(!isset($_SESSION)){session_start();}
error_reporting(E_ALL);

require '../config/config.php';
require '../config/functions.php';

$db = new dbClass();
$admin = new adminUpdate();

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $websiteTitle; ?> | DASHBOARD</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.png">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>

  <body class="hold-transition skin-blue sidebar-mini fixed">
    <div class="wrapper">

      <header class="main-header"> 
        <?php include 'include/header.php'; ?>
      </header>

      <aside class="main-sidebar">
        <?php include 'include/menu.php'; ?>
      </aside>

      <div class="content-wrapper">
        <section class="content-header">
          <h1> Dashboard </h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section> 

        
      </div> 

      <?php include 'include/footer.php'; ?>

      <div class="control-sidebar-bg"></div>

    </div>


    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bower_components/raphael/raphael.min.js"></script>
    <script src="bower_components/morris.js/morris.min.js"></script>
    <script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
    <script src="bower_components/moment/min/moment.min.js"></script>
    <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="bower_components/fastclick/lib/fastclick.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
    <script src="dist/js/pages/dashboard.js"></script>
    <script src="dist/js/demo.js"></script>
  </body>

</html>


