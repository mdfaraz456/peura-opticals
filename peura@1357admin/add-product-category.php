<?php
if (!isset($_SESSION)) {
  session_start();
}
error_reporting(E_ALL);

require "../config/config.php";
require "../config/functions.php";
include '../config/image-resize.php';

$db = new dbClass();
$admin = new Product_Type();

if (isset($_REQUEST["id"])) {
  $id = base64_decode($_REQUEST["id"]);
  $editval = $admin->getProductCategory($id);
}

// insert record query
if (isset($_REQUEST["submit"])) {
  $category = $db->addStr($_POST["category"]);
  $name = $db->addStr($_POST["name"]); 
  $status = $db->addStr($_POST["status"]);

  $checkProductCategory = $admin->checkProductCategory($name, $category);
  

  if ($checkProductCategory == 0):
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
      $image = $_FILES['image']['name']; // Original file name
      $dest = "../adminuploads/products/";
      $files = resize(1600, 1375, $dest, $_FILES['image']['tmp_name'], $image);
    } else {
      $files = '0';
    }
    $result = $admin->addProductCategory($files,$category, $name,$status);

    if ($result === true):
        $_SESSION["msg"] = "Product Category has been created successfully ..!!";
        header("Location: view-product-category.php");
        exit();
    else:
        $_SESSION["errmsg"] = "Sorry !! Some Error Occurred .. Try Again";
        header("Location: add-product-category.php");
        exit();
    endif;
  else:
    $_SESSION["errmsg"] = "Sorry !! Product Category Already Exist .. !!";
    header("Location: add-product-category.php");
    exit();
  endif;
}

// update record query
if (isset($_REQUEST["update"])) {
  $category = $db->addStr($_POST["category"]);
  $name = $db->addStr($_POST["name"]);
  $status = $db->addStr($_POST["status"]);
  $oldimage = $_POST['oldimage'];
  $dest = "../adminuploads/products/";

  if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $files = resize(1600, 1375, $dest, $tmp_name, $image);

    if ($files) {
      if (file_exists($dest . $oldimage)) {
          unlink($dest . $oldimage);
      }
    } else {
        $_SESSION['errmsg'] = 'Error uploading file.';

        header("Location: view-products.php");
        exit;
    }
  } else {
    $files = $oldimage;
  }

  $result = $admin->updateProductCategory($category, $name,$files, $status, $id);

  if ($result === true) {
    $_SESSION["msg"] = "Product Category has been updated successfully ..!!";
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
    <title><?= $websiteTitle ?> | Add Product Category</title>
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
          <h1> Manage Product Category </h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Product Category</li>
          </ol>
        </section>

        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-warning">

                <div class="box-header with-border">                  
                  <?php if (empty($id)): ?>
                    <h3 class="box-title">Add Product Category</h3>
                  <?php else: ?>
                    <h3 class="box-title">Update Product Category</h3>
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
                              $ProductTypeQuery = $admin->allPType();
                              foreach ($ProductTypeQuery as $ProductTypeRow): 
                            ?>
                              <option value="<?php echo $ProductTypeRow["id"]; ?>">
                                <?php echo $ProductTypeRow["name"]; ?>
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
                        <label for="inputImage" class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-6">
                          <input type="file" name="image" id="image" onChange="PreviewImage();" class="form-control" required>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="inputImage" class="col-sm-2 control-label"></label>
                        <div class="col-sm-6">
                          <img id="uploadPreview" style="width: 233px; height: 132px; border:1px solid #83888C; background-color: #ffffff;">
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
                              $ProductTypeQuery = $admin->allPType();
                              foreach ($ProductTypeQuery as $ProductTypeRow): 
                            ?>
                              <option <?php if ($ProductTypeRow["id"] == $editval["ptype_id"]): ?> selected="selected" <?php endif; ?> value="<?php echo $ProductTypeRow["id"]; ?>">
                                <?php echo $ProductTypeRow["name"]; ?>
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
                        <label for="inputImage" class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-6">
                          <input type="file" name="image" id="image" onChange="PreviewImage();" class="form-control">
                          <input type="hidden" name="oldimage" value="<?php echo $editval['image']; ?>" class="form-control">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="inputImage" class="col-sm-2 control-label"></label>
                        <div class="col-sm-6">
                          <img src="../adminuploads/products/<?php echo $editval['image']; ?>" 
                            id="uploadPreview" style="width: 233px; height: 132px; border:1px solid #83888C; background-color: #ffffff;">
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
    <script>
    function PreviewImage() {
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("image").files[0]);
      oFReader.onload = function (oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
      };
    };  
  </script>

  </body>

</html>