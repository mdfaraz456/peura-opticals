<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL);

require "../config/config.php";
require "../config/functions.php";

$db = new dbClass();
$subcategory = new Product_Type();

// delete record query
if (isset($_REQUEST["delete"]) && $_REQUEST["delete"] == "y") {
  $id = $_REQUEST["id"];

  try{
    $sqlDelete = $db->execute("DELETE FROM `category` WHERE `id` = '$id'");

    if ($sqlDelete == true) {
      $_SESSION["msg"] = "Record Successfully Deleted ..!!";
    } else {
      $_SESSION["errmsg"] = "Sorry !! Some Error Occurred .. Try Again";
    }
  } catch (PDOException $e) {
    $_SESSION['errmsg'] = 'Cannot delete record: Related records exist in Sub Sub-Category table. Please remove the related records first.';
  }

  header("Location: view-product-category.php");
  exit();
}

// visibility record query
if (isset($_REQUEST["status"])) {
  $id = $_REQUEST["id"];
  $status = $_REQUEST["status"];
  $sqlStatus = $db->execute("UPDATE `category` SET `status` = '$status' WHERE `id` = '$id'");
  if ($sqlStatus == true) {
    $_SESSION["msg"] = "Status has been changed Successfully !!";
  } else {
    $_SESSION["errmsg"] = "Sorry !! Some Error Occurred .. Try Again";
  }
  header("Location: view-product-category.php");
  exit();
}

?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $websiteTitle ?> | View Subcategories</title>
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
        <?php include "include/header.php"; ?>
      </header>

      <aside class="main-sidebar">
        <?php include "include/menu.php"; ?>
      </aside>

      <div class="content-wrapper">
        <section class="content-header">
          <h1>Manage Subcategories <small>View Subcategories</small></h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">View Subcategories</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">View Subcategories</h3>
                </div>
                <div class="box-body">
                  <?php include "../include/notification.php"; ?>
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>S.No</th>
                          <th>Product Type</th>
                          <th>Product Category Name</th>
                          
                          <th>Date</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        $subcateogryQuery = $subcategory->getAllProductCategory();
                        foreach ($subcateogryQuery as $row):
                        $categoryName = $subcategory->getPType($row["ptype_id"]); ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $categoryName["name"]; ?></td>
                            <td><?php echo $row["name"]; ?></td>
                            
                            <td><?php echo date("d-m-Y", strtotime($row["created_at"])); ?></td>
                            <td>
                              <?php if ($row["status"] == 1): ?>
                                <a href="?status=0&id=<?php echo $row["id"]; ?>"><i class="fa fa-eye"></i></a>
                              <?php else: ?>
                                <a href="?status=1&id=<?php echo $row["id"]; ?>"><i class="fa fa-eye-slash"></i></a>
                              <?php endif; ?>
                            </td>
                            <td>
                              <a href="add-product-category.php?id=<?php echo base64_encode($row["id"]); ?>"><i class="fa fa-edit"></i></a>
                              ||
                              <a href="?id=<?php echo $row["id"]; ?>&delete=y" onClick="return confirm('Are you sure !! Record will be delete permanently ..!!')">
                                <i class="fa fa-trash-o"></i>
                              </a>
                            </td>
                          </tr>
                        <?php
                        endforeach;
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <?php include "include/footer.php"; ?>

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
        $('#example1').DataTable();
        $('#example2').DataTable({
          'paging': true,
          'lengthChange': false,
          'searching': false,
          'ordering': true,
          'info': true,
          'autoWidth': false
        });
      });
    </script>
  </body>

</html>
