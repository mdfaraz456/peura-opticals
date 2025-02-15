<?php

if(!isset($_SESSION)){session_start();}
error_reporting(0);
require '../config/config.php';
require '../config/functions.php';

$db = new dbClass();
$admin = new adminUpdate();

if(isset($_REQUEST['update'])){

	$username = $db->addStr($_POST['username']);
	$email = $db->addStr($_POST['email']);
	$mobile = $db->addStr($_POST['mobile']);
	
	$oldimage = $_POST['oldimage'];

	if($_FILES['image']['name']!='')
	{
	 unlink("../adminuploads/user-image/".$oldimage);
	 $image = time()."-".$_FILES['image']['name'];
     $imagetmp = $_FILES['image']['tmp_name'];
     $dest = "../adminuploads/user-image/".$image;
	 move_uploaded_file($imagetmp,$dest);
	 
	} else {
	  $image = $oldimage;
	}
	
	$result = $admin->updateProfile($username, $email, $mobile, $image, $_SESSION['ADMIN_USER_ID']);
	
	if($result == true){
		$msg = 'Profile has been updated Successfully ..';
	} else {
		$errmsg = 'Sorry Some Error !! Accurd ..';
  	}

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $websiteTitle; ?> | User Profile</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
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
      <h1> User Profile </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile"> 
              <?php if(!empty($userRow['image'])){ ?>
              <img class="profile-user-img img-responsive img-circle" src="../adminuploads/user-image/<?php echo $userRow['image']; ?>">
              <?php }else{ ?>
              <img class="profile-user-img img-responsive img-circle" src="dist/img/user-image.jpg">
              <?php } ?>
              <h3 class="profile-username text-center"><?php echo $userRow['username']; ?></h3>
              <p class="text-muted text-center"><?php echo $userRow['type']; ?></p>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item"> <b>Mobile</b> <a class="pull-right"><?php echo $userRow['mobile']; ?></a> </li>
                <li class="list-group-item"> <b>Login Date</b> <a class="pull-right"><?php echo $userRow['login_date']; ?></a> </li>
                <li class="list-group-item"> <b>Login Ip</b> <a class="pull-right"><?php echo $userRow['login_ip']; ?></a> </li>
                <li class="list-group-item"> <b>Created Date</b> <a class="pull-right"><?php echo $userRow['created_at']; ?></a> </li>
                <li class="list-group-item"> <b>Updated Date</b> <a class="pull-right"><?php echo $userRow['updated_at']; ?></a> </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#settings" data-toggle="tab">My Account</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="settings">
                <?php if(isset($msg)){ ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> <?php echo $msg; ?></h4>
                </div>
                <?php } if(isset($errmsg)){ ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> <?php echo $errmsg; ?></h4>
                </div>
                <?php } ?>
                <form name="myProfile" id="myProfile" method="post" enctype="multipart/form-data" class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" name="username" value="<?php echo $userRow['username']; ?>" class="form-control" placeholder="User Name" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" name="email" value="<?php echo $userRow['email']; ?>" class="form-control" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Mobile</label>
                    <div class="col-sm-10">
                      <input type="number" name="mobile" value="<?php echo $userRow['mobile']; ?>" class="form-control" placeholder="Mobile">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Image</label>
                    <div class="col-sm-10">
                      <input type="file" name="image" id="image" class="form-control">
                      <input type="hidden" name="oldimage" value="<?php echo $userRow['image']; ?>" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="submit" name="update" value="Update" class="btn btn-danger">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php include 'include/footer.php'; ?>

  <div class="control-sidebar-bg"></div>
</div>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
