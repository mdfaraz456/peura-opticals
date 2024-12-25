<?php
if (!isset($_SESSION)) {
  session_start();
}
error_reporting(E_ALL);

require '../config/config.php';
require '../config/functions.php';
include '../config/image-resize.php';

$db = new dbClass();
$banner1 = new Banner();

$type = 'withText';

if (isset($_REQUEST['delete']) && $_REQUEST['delete'] == 'y') {
  $id = $_REQUEST['id'];

  $sqlSelectData = $banner1->getBanner($id);

  if ($sqlSelectData) {
    if ($sqlSelectData['image']) {
      unlink("../adminuploads/banner/" . $sqlSelectData['image']);
    } 

    $sqlDelete = $db->execute("DELETE FROM `banner` WHERE `id` = '$id'");
    
    if ($sqlDelete == true) {
      $_SESSION['msg'] = 'Record and images successfully deleted ..!!';
    } else {
      $_SESSION['errmsg'] = 'Sorry !! Some Error Occurred .. Try Again';
    }
  }
  header("Location: view-banner1.php");
  exit;
}

if(isset($_REQUEST['status']))
{
  $id = $_REQUEST['id'];
  $status = $_REQUEST['status'];

	$sqlStatus = $db->execute("UPDATE `banner` SET `status` = '$status' WHERE `id` = '$id'");
  if ($sqlStatus == true) {
    $_SESSION['msg'] = 'Status has been changed Successfully !!';
  }else{
    $_SESSION['errmsg'] = 'Sorry !! Some Error Occurred .. Try Again';
  }
  header("Location: view-banner1.php");
  exit;
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $websiteTitle; ?> | View Contect Banner</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.png">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>

  <body class="hold-transition skin-blue sidebar-mini fixed">
    <div class="wrapper">

      <header class="main-header"> 
        <?php include 'header.php'; ?>
      </header>

      <aside class="main-sidebar">
        <?php include 'menu.php'; ?>
      </aside>
    

      <div class="content-wrapper">
        <section class="content-header">
          <h1> Manage Contect Banner <small>View Contect Banner</small> </h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">View Contect Banner</li>
          </ol>
        </section>
      

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">View Contect Banner</h3>
                </div>
                <div class="box-body">
                  <?php include '../include/notification.php'; ?>
                  <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php 	  
                        $i=1;
                        $bannerQuery = $banner1->allBanner();
                        foreach($bannerQuery as $row):      				  
                      ?>
                      <tr>
                        <td><?php echo $i++; ?></td>

                        <td>
                          <img src="../adminuploads/banner/<?php echo $row['image']; ?>" height="100" width="200" />
                        </td>

                        <td>
                          <?php if($row['status']==1): ?>
                            <a href="?status=0&id=<?php echo $row['id']; ?>"><i class="fa fa-eye"></i></a>
                          <?php else: ?>
                            <a href="?status=1&id=<?php echo $row['id']; ?>"><i class="fa fa-eye-slash"></i></a>
                          <?php endif; ?>
                        </td>

                        <td>
                          <a href="add-banner1.php?id=<?php echo base64_encode($row['id']); ?>">
                            <i class="fa fa-edit"></i>
                          </a> 
                          || 
                          <a href="javascript:void(0);" onclick="if (confirm('Are you sure you want to delete this item?')) window.location.  href='?id=<?php echo $row['id']; ?>&delete=y';">  
                            <i class="fa fa-trash-o"></i>
                          </a>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <?php include 'footer.php'; ?>   

      <div class="control-sidebar-bg"></div>

    </div>


    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="bower_components/fastclick/lib/fastclick.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
    <script src="dist/js/demo.js"></script>
    <script>
      $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
          'paging'      : true,
          'lengthChange': false,
          'searching'   : false,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false
        })
      })
    </script>

  </body>

</html>