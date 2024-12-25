<?php
if(!isset($_SESSION)){session_start();}
error_reporting(0);
require '../config/config.php';
require '../config/login.php';

$db = new dbClass();
$login = new Login();

// user login check
if(isset($_REQUEST['btn_login']) && $_REQUEST['btn_login'] == 'Sign In')
{
	$email = $db->addStr($_POST['email']);
  $pass = $db->addStr($_POST['password']);

	$result = $login->loginData($email,$pass);

  if($result == true){
		if(!empty($_POST["remember"])){
			setcookie ("member_email", $email, time()+ (10 * 365 * 24 * 60 * 60));  
			setcookie ("member_password", $pass, time()+ (10 * 365 * 24 * 60 * 60));
   		} else {  
    		if(isset($_COOKIE["member_email"])){  
     			setcookie ("member_email","");  
    		}  
    		if(isset($_COOKIE["member_password"])){  
     			setcookie ("member_password","");  
    		}  
   		}  	
		echo "<script>window.location='home.php';</script>";	
	} else {
    	echo "<script>alert('You have Entered Wrong Username OR Password !!')</script>";
		  echo "<script>window.location='index.php';</script>";
  }
}

?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php echo $websiteTitle; ?> | Sign In</title>

    <!-- Tell the browser to be responsive to screen width -->

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.png">

    <!-- Bootstrap 3.3.7 -->

    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->

    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">

    <!-- Ionicons -->

    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">

    <!-- Theme style -->

    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

    <!-- iCheck -->

    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>

<body class="hold-transition login-page">

<div class="login-box">

  <div class="login-logo"><a href="index.php"><img src="../images/logo1.webp" alt="logo"></a> </div>

  <div class="login-box-body">

    <p class="login-box-msg">Admin Panel</p>

    <form name="loginForm" id="loginForm" method="post">

      <div class="form-group has-feedback">

        <input type="email" name="email" value="<?php if(isset($_COOKIE["member_email"])) { echo $_COOKIE["member_email"]; } ?>" class="form-control" placeholder="Email" required>

        <span class="glyphicon glyphicon-envelope form-control-feedback"></span> 

      </div>

      <div class="form-group has-feedback">

        <input type="password" name="password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" class="form-control" placeholder="Password" required>

        <span class="glyphicon glyphicon-lock form-control-feedback"></span> 

      </div>

      <div class="row">

        <div class="col-xs-8">

          <div class="checkbox icheck">

            <label>

            <input type="checkbox" name="remember" <?php if(isset($_COOKIE["member_email"])) { ?> checked <?php } ?>>

            Remember Me </label>

          </div>

        </div>

        <div class="col-xs-4">

          <input type="submit" name="btn_login" value="Sign In" class="btn btn-primary btn-block btn-flat">

        </div>

      </div>

    </form>

    <?php /*?>

    <a href="forgot-password.php">I forgot my password</a><br>

    <?php */?>

  </div>

</div>

<!-- jQuery 3 -->

<script src="bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap 3.3.7 -->

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- iCheck -->

<script src="plugins/iCheck/icheck.min.js"></script>

<script>

  $(function () {

    $('input').iCheck({

      checkboxClass: 'icheckbox_square-blue',

      radioClass: 'iradio_square-blue',

      increaseArea: '20%' /* optional */

    });

  });

</script>

</body>

</html>

