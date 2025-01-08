<?php
if (!isset($_SESSION)) {
  session_start();
}
error_reporting(E_ALL);

require "../config/config.php";
require "../config/functions.php";

$db = new dbClass();
$admin = new Categories();

if (isset($_REQUEST["id"])) {
  $id = base64_decode($_REQUEST["id"]);
  $editval = $admin->getSubCategories($id);
}

// insert record query
if (isset($_REQUEST["submit"])) {
  $category = $db->addStr($_POST["category"]);
  $name = $db->addStr($_POST["name"]); 
  $status = $db->addStr($_POST["status"]);

  $checkSubCategory = $admin->checkSubCategories($name, $category);
  $slug = $admin->slug($name, 'sub_category');

  if ($checkSubCategory == 0):
    $result = $admin->addSubCategories($category, $name, $slug, $status);

    if ($result === true):
        $_SESSION["msg"] = "SubCategory has been created successfully ..!!";
        header("Location: view-subcategory.php");
        exit();
    else:
        $_SESSION["errmsg"] = "Sorry !! Some Error Occurred .. Try Again";
        header("Location: add-subcategory.php");
        exit();
    endif;
  else:
    $_SESSION["errmsg"] = "Sorry !! SubCategory Already Exist .. !!";
    header("Location: add-subcategory.php");
    exit();
  endif;
}

// update record query
if (isset($_REQUEST["update"])) {
  $category = $db->addStr($_POST["category"]);
  $name = $db->addStr($_POST["name"]);
  $status = $db->addStr($_POST["status"]);

  $slug = $admin->updateSlug($name, 'sub_category', $id);

  $result = $admin->updateSubCategories($category, $name, $slug, $status, $id);

  if ($result === true) {
    $_SESSION["msg"] = "SubCategory has been updated successfully ..!!";
  } else {
    $_SESSION["errmsg"] = "Sorry !! Some Error Occurred .. Try Again";
  }
  header("Location: view-subcategory.php");
  exit();
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $websiteTitle ?> | Add Subcategory</title>
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
        <?php include "include/header.php"; ?>
      </header>

      <aside class="main-sidebar">
        <?php include "include/menu.php"; ?>
      </aside>

      <div class="content-wrapper">
        <section class="content-header">
          <h1> Manage Subcategory </h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Subcategory</li>
          </ol>
        </section>

        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-warning">

                <div class="box-header with-border">                  
                  <?php if (empty($id)): ?>
                    <h3 class="box-title">Add Subcategory</h3>
                  <?php else: ?>
                    <h3 class="box-title">Update Subcategory</h3>
                  <?php endif; ?>
                </div>

                <div class="box-body">
                  <?php if (isset($msg)) { ?>
                    <div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4><i class="icon fa fa-check"></i> <?php echo $msg; ?></h4>
                    </div>
                  <?php } if (isset($errmsg)) { ?>
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4><i class="icon fa fa-ban"></i> <?php echo $errmsg; ?></h4>
                    </div>
                  <?php } ?>

                  <?php if (empty($id)): ?>
                    <form name="mysubcategory" id="mysubcategory" method="post" class="form-horizontal" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Categories</label>
                        <div class="col-sm-6">
                          <select name="category" class="form-control" required>
                            <option value="">--Select Category--</option>
                            <?php
                              $cateogryQuery = $admin->allCategories();
                              foreach ($cateogryQuery as $CategoryRow): 
                            ?>
                              <option value="<?php echo $CategoryRow["id"]; ?>">
                                <?php echo $CategoryRow["name"]; ?>
                              </option>
                            <?php endforeach;?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-6">
                          <input type="text" name="name" class="form-control" placeholder="Sub Category Name" required>
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

                    <form name="mysubcategory" id="mysubcategory" method="post" class="form-horizontal" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Categories</label>
                        <div class="col-sm-6">
                          <select name="category" class="form-control" required>
                            <option value="">--Select Category--</option>
                            <?php
                              $cateogryQuery = $admin->allCategories();
                              foreach ($cateogryQuery as $CategoryRow): 
                            ?>
                              <option <?php if ($CategoryRow["id"] == $editval["category_id"]): ?> selected="selected" <?php endif; ?> value="<?php echo $CategoryRow["id"]; ?>">
                                <?php echo $CategoryRow["name"]; ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-6">
                          <input type="text" name="name" value="<?php echo $editval["name"]; ?>" class="form-control" placeholder="Sub Category Name" required>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-6">
                          <select name="status" class="form-control">
                            <option value="">Select Status</option>
                            <option value="1" <?php if ($editval["status"] == 1): ?> selected="selected" <?php endif; ?>>Active</option>
                            <option value="0" <?php if ($editval["status"] == 0): ?> selected="selected" <?php endif; ?>>Inactive</option>
                          </select>
                        </div>
                      </div>                      

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <input type="submit" name="update" value="Update" class="btn btn-danger">
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

      <?php include "include/footer.php"; ?>

      <div class="control-sidebar-bg"></div>
    </div>

    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="bower_components/raphael/raphael.min.js"></script>
    <script src="bower_components/morris.js/morris.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- FastClick -->
    <script src="bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

  </body>

</html>