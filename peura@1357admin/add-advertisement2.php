<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL);
require '../config/config.php';
require '../config/functions.php';
include '../config/image-resize.php';

$db = new dbClass();
// $admin = new Categories();
$admin1 = new Advertisement();

if (isset($_REQUEST['id'])) {
  $id = base64_decode($_REQUEST['id']);
  $editval = $admin1->getAdvertisement1($id);
}
// $id=1;
// $editval = $admin1->getAdvertisement($id);
// Insert record query
if (isset($_REQUEST['submit'])) {
  // Sanitize and capture the form input
  $heading = $db->addStr($_POST['heading']);
  $subheading = $db->addStr($_POST['subheading']);
  $discount = $db->addStr($_POST['discount']);  // Capture the discount input
  $link = $db->addStr($_POST['link']);          // Capture the link input
  $status = $db->addStr($_POST['status']);      // Capture the status input

  // Handle image upload
  if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
      $image = $_FILES['image']['name']; // Original file name
      $dest = "../adminuploads/products/";  // Destination folder
      $files = resize(1600, 1375, $dest, $_FILES['image']['tmp_name'], $image);  // Resize function to process the image
  } else {
      $files = '0';  // Default in case no image is uploaded
  }

  // Call the function to add the advertisement (modify as needed)
  $result = $admin1->addAdvertisement1($heading, $subheading, $discount, $files, $status, $link);  // Passing all necessary values

  // Handle success or error
  if ($result === true) {
      $_SESSION['msg'] = 'Advertisement has been created successfully ..!!';
      header("Location: view-advertisements2.php");
      exit;
  } else {
      $_SESSION['errmsg'] = "Sorry !! Some error occurred .. Try again";
      header("Location: add-advertisement.php");
      exit;
  }
}

if (isset($_REQUEST['update'])) 
{
  // Sanitize input values
  $heading = $db->addStr($_POST['heading']);
  $subheading = $db->addStr($_POST['subheading']);
  $discount = $db->addStr($_POST['discount']);  // Capture the discount input
  $status = $db->addStr($_POST['status']);
  $link = $db->addStr($_POST['link']);  // Capture the link input
  $oldimage = $_POST['oldimage'];  // Old image path
  $dest = "../adminuploads/products/";  // Directory for image uploads

  // Handle image upload if a new image is provided
  if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
      $image = $_FILES['image']['name'];  // Get the new image name
      $tmp_name = $_FILES['image']['tmp_name'];  // Temporary file path
      $files = resize(1600, 1375, $dest, $tmp_name, $image);  // Resize the image

      // If the new image is uploaded successfully, delete the old image
      if ($files) {
          if (file_exists($dest . $oldimage) && $oldimage != '') {
              unlink($dest . $oldimage);  // Delete old image if it exists
          }
      } else {
          $_SESSION['errmsg'] = 'Error uploading file.';
          header("Location: view-advertisements2.php");
          exit;
      }
  } else {
      // If no new image is uploaded, keep the old image
      $files = $oldimage;
  }

  // Decode the advertisement ID
  $id = base64_decode($_POST['id']);  // Decode the ID from the form

  // Call the method to update the advertisement with the new values
  $result = $admin1->updateAdvertisement1($heading, $subheading, $discount, $files, $status, $link, $id);

  // Handle the result of the update
  if ($result === true) {
      $_SESSION['msg'] = "Advertisement has been updated successfully!";
  } else {
      $_SESSION['errmsg'] = "Sorry, an error occurred. Please try again.";
  }

  // Redirect to the view advertisements page
  header("Location: view-advertisements2.php");
  exit;
}




?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $websiteTitle; ?> | Add Advertisements</title>
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
          <h1>Manage Advertisements</h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Advertisements</li>
          </ol>
        </section>

        <section class="content">
          <div class="row">
              <div class="col-xs-12">
                <div class="box box-warning">
                  <div class="box-header with-border">
                    <?php if (empty($id)): ?>
                      <h3 class="box-title">Add Advertisements</h3>
                    <?php else: ?>
                      <h3 class="box-title">Update Advertisements</h3>
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
                            <label for="inputHeading" class="col-sm-2 control-label">Heading</label>
                            <div class="col-sm-6">
                                <input type="text" name="heading" class="form-control" placeholder="Enter Heading" required>
                            </div>
                        </div>
                        
                          <div class="form-group">
                              <label for="inputSubheading" class="col-sm-2 control-label">SubHeading</label>
                              <div class="col-sm-6">
                                  <input type="text" name="subheading" class="form-control" placeholder="Enter SubHeading" required>
                              </div>
                          </div>
                        
                        <div class="form-group">
                            <label for="inputDiscount" class="col-sm-2 control-label">Discount</label>
                            <div class="col-sm-6">
                                <input type="text" name="discount" class="form-control" placeholder="Enter Discount" required>
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <label for="inputLink" class="col-sm-2 control-label">Link</label>
                            <div class="col-sm-6">
                                <input type="url" name="link" class="form-control" placeholder="Enter URL" required>
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
                      <form name="mycategory" id="mycategory" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo base64_encode($editval['id']); ?>">

                        <div class="form-group">
                            <label for="inputHeading" class="col-sm-2 control-label">Heading</label>
                            <div class="col-sm-6">
                                <input type="text" name="heading" value="<?= $editval['heading'] ?>" class="form-control" placeholder="Enter Heading" required>
                            </div>
                        </div>
                        <?php if ($id =='3'): ?>
                          <div class="form-group">
                              <label for="inputSubheading" class="col-sm-2 control-label">SubHeading</label>
                              <div class="col-sm-6">
                                  <input type="text" name="subheading" value="<?= $editval['subheading'] ?>" class="form-control" placeholder="Enter SubHeading" >
                              </div>
                          </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="inputDiscount" class="col-sm-2 control-label">Discount Line</label>
                            <div class="col-sm-6">
                                <input type="text" name="discount" value="<?= $editval['discount'] ?>" class="form-control" placeholder="Enter Discount" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputLink" class="col-sm-2 control-label">Link</label>
                            <div class="col-sm-6">
                                <input type="url" name="link" value="<?= $editval['link'] ?>" class="form-control" placeholder="Enter URL" required>
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
                            <label for="inputStatus" class="col-sm-2 control-label">Status</label>
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
        <?php include 'include/footer.php'; ?>
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
