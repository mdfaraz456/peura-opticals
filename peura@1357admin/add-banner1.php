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

$id = (isset($_REQUEST['id']) ? base64_decode($_REQUEST['id']) : '');
$editval = $banner1->getBanner($id);


// insert record query
if(isset($_REQUEST['submit'])) {
  
  $status = $db->addStr($_POST['status']);

  if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image = $_FILES['image']['name']; // Original file name
    $dest = "../adminuploads/banner/";
    $files = resize(1038, 500, $dest, $_FILES['image']['tmp_name'], $image);
  } else {
    $files = '0';
  }

  $result = $banner1->addBanner1($files, $status);

  if ($result === true) {
    $_SESSION['msg'] = 'Content Banner has been created successfully.';
    header("Location: view-banner1.php");
    exit;
  } else {
    $_SESSION['errmsg'] = 'Sorry, some error occurred. in add';
    header("Location: add-banner1.php");
    exit;
  }
}


// update record query
if(isset($_REQUEST['update'])) {
  $id = $_REQUEST['eId'];
  $status = $db->addStr($_POST['status']);

  $oldimage = $_POST['oldimage'];
  $dest = "../adminuploads/banner/";

  if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $files = resize(1038, 500, $dest, $tmp_name, $image);

    if ($files) {
      if (file_exists($dest . $oldimage)) {
        unlink($dest . $oldimage);
      }
    } else {
      $_SESSION['errmsg'] = 'Error uploading file.';
      header("Location: view-banner1.php");
      exit;
    }
} else {
    $files = $oldimage;
}

  $result = $banner1->updateBanner1($files, $status, $id);

  if($result===true){
    $_SESSION['msg'] = "Content Banner has been updated successfully ..!!";
  } else {  
    $_SESSION['errmsg'] = "Sorry !! Some Error Occurred .. Try Again";  
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
    <title><?php echo $websiteTitle; ?> | Add Contect Banner</title>
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
        <?php include 'include/header.php'; ?>
      </header>

      <aside class="main-sidebar">
        <?php include 'include/menu.php'; ?>
      </aside>

      <div class="content-wrapper">
        <section class="content-header">
          <h1> Contect Banner </h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Contect Banner</li>
          </ol>
        </section>

        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-warning">
                <div class="box-header with-border">
                  <?php if(empty($id)): ?>
                  <h3 class="box-title">Add Contect Banner</h3>
                  <?php else: ?>
                  <h3 class="box-title">Update Contect Banner</h3>
                  <?php endif; ?>
                </div>

                <div class="box-body">
                  <?php include '../include/notification.php'; ?>        
                  <?php if(empty($id)): ?>
                    <form method="post" class="form-horizontal" enctype="multipart/form-data">           
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-6">
                          <input type="file" name="image" id="image" onChange="PreviewImage();" class="form-control" required>
                        </div>
                      </div>            

                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label"></label>
                        <div class="col-sm-6">
                          <img id="uploadPreview" style="width: 233px; height: 132px; border:1px solid #83888C; background-color: #ffffff;">
                          <small>Size (826px * 334px)</small>
                        </div>
                      </div>  
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-6">
                          <select name="status" class="form-control" required>
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

                    <form method="post" class="form-horizontal" enctype="multipart/form-data">
                      <input type="hidden" name="eId" value="<?php echo $id; ?>">  
                      <div class="form-group">
                          <label for="inputSkills" class="col-sm-2 control-label">Image</label>
                          <div class="col-sm-10">
                            <input type="file" name="image" id="image" onChange="PreviewImage();" class="form-control">
                            <input type="hidden" name="oldimage" value="<?php echo $editval['image']; ?>" class="form-control">
                          </div>
                      </div>             
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label"></label>
                        <div class="col-sm-6">
                          <img src="../adminuploads/banner/<?php echo $editval['image']; ?>" id="uploadPreview" style="width: 233px; height: 132px; border:1px solid #83888C; background-color: #ffffff;">
                          <small>Size (826px * 334px)</small>
                        </div>
                      </div>   
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-6">
                          <select name="status" class="form-control" required>
                              <option value="">Select Status</option>
                              <option value="1" <?php if($editval['status']==1): ?> selected="selected" <?php endif; ?>>Active</option>
                              <option value="0" <?php if($editval['status']==0): ?> selected="selected" <?php endif; ?>>Inactive</option>
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
    
      <?php include 'include/footer.php'; ?>

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
    <!-- Image Prieview -->
    <script>
      function PreviewImage() 
      {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("image").files[0]);
        oFReader.onload = function(oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
      };
    };    
    </script>

  </body>
</html>