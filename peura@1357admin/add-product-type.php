<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL);
require '../config/config.php';
require '../config/functions.php';

$db = new dbClass();
$admin = new PType();

if (isset($_REQUEST['id'])) {
  $id = base64_decode($_REQUEST['id']);
  $editval = $admin->getPType($id);
}

// Insert record query
if (isset($_REQUEST['submit'])) {
  $name = $db->addStr($_POST['name']);
  $status = $db->addStr($_POST['status']);

  $checkCategory = $admin->checkPType($name, 'product_type');
  

  if ($checkCategory == 0) {
    $result = $admin->addPType($name, $status);

    if ($result === true) {
      $_SESSION['msg'] = 'Category has been created successfully ..!!';
      header("Location: view-product-type.php");
      exit;
    } else {
      $_SESSION['errmsg'] = "Sorry !! Some Error Occurred .. Try Again";
      header("Location: add-product-type.php");
      exit;
    }
  } else {
    $_SESSION['errmsg'] = "Sorry !! Category Already Exists .. !!";
    header("Location: add-product-type.php");
    exit;
  }
}

// Update record query
if (isset($_REQUEST['update'])) {
  $name = $db->addStr($_POST['name']);
  $status = $db->addStr($_POST['status']);

 
  $result = $admin->updatePType($name, $status, $id);

  if ($result === true) {
    $_SESSION['msg'] = "Category has been updated successfully ..!!";
  } else {
    $_SESSION['errmsg'] = "Sorry !! Some Error Occurred .. Try Again";
  }

  header("Location: view-product-type.php");
  exit;
}

?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $websiteTitle; ?> | Add Product Type</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.png">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
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
          <h1>Manage Product Type</h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Product Type</li>
          </ol>
        </section>

        <section class="content">
          <div class="row">
              <div class="col-xs-12">
                <div class="box box-warning">
                  <div class="box-header with-border">
                    <?php if (empty($id)): ?>
                      <h3 class="box-title">Add Product Type</h3>
                    <?php else: ?>
                      <h3 class="box-title">Update Product Type</h3>
                    <?php endif; ?>
                  </div>

                  <div class="box-body">
                    <?php if (isset($msg)) { ?>
                      <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> <?php echo $msg; ?></h4>
                      </div>
                    <?php }
                    if (isset($errmsg)) { ?>
                      <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> <?php echo $errmsg; ?></h4>
                      </div>
                    <?php } ?>

                    <?php if (empty($id)): ?>
                      <form name="mycategory" id="mycategory" method="post" class="form-horizontal" enctype="multipart/form-data">                        
                        <div class="form-group">
                          <label for="inputName" class="col-sm-2 control-label">Name</label>
                          <div class="col-sm-6">
                              <input type="text" name="name" class="form-control" placeholder="Product Type Name" required>
                          </div>
                        </div>                 
                        <div class="form-group">
                          <label for="inputName" class="col-sm-2 control-label">Status</label>
                          <div class="col-sm-6">
                            <select name="status" class="form-control">
                              <option value="">Select Status</option>
                              <option value="1">Active</option>
                              <option value="0">Inactive</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" name="submit" value="Submit" class="btn btn-success">
                          </div>
                        </div>
                      </form>
                    <?php else: ?>
                        <form name="mycategory" id="mycategory" method="post" class="form-horizontal" enctype="multipart/form-data">
                          <input type="hidden" name="id" value="<?php echo base64_encode($editval['id']); ?>">
                          <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-6">
                              <input type="text" name="name" value="<?= $editval['name'] ?>" class="form-control" placeholder="Product Type Name" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-6">
                              <select name="status" class="form-control">
                                <option value="1" <?= $editval['status'] == 1 ? 'selected' : '' ?>>Active</option>
                                <option value="0" <?= $editval['status'] == 0 ? 'selected' : '' ?>>Inactive</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <input type="submit" name="update" value="Update" class="btn btn-success">
                            </div>
                          </div>
                        </form>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
          </div>
        </section>
      </div>

      <footer class="main-footer">
        <?php include 'footer.php'; ?>
      </footer>
    </div>

    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bower_components/fastclick/lib/fastclick.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="bower_components/Chart.js/Chart.js"></script>
    <script src="dist/js/demo.js"></script>    
  </body>

</html>
