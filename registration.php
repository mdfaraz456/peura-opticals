<?php
if (!isset($_SESSION)) {
  session_start();
}
error_reporting(E_ALL);
require "config/config.php";
require "config/authentication.php";

$conn = new dbClass();
$auth = new Authentication();

if (isset($_COOKIE['dVnCp'])) {
  $dVnCp = $_COOKIE['dVnCp'];
} else {
  $dVnCp = uniqid('dVn', true);
  setcookie('dVnCp', $dVnCp, time() + (50 * 365 * 24 * 60 * 60), '/');
}

if (isset($_REQUEST['submit'])) {
  $UserName = $conn->addStr($_POST['username']);
  $Email = $conn->addStr($_POST['email']);
  $Password = $conn->addStr($_POST['password']);

  $checkUserExist = $auth->checkCustomer($Email);
  if ($checkUserExist == 0) {
    $sqlRegister = $auth->register($UserName, $Email, $Password,);
    if ($sqlRegister) {



      $_SESSION['USER_LOGIN'] = $sqlRegister;
      $_SESSION['msg'] = 'Registration successfull.';
      header("Location: account-dashboard.php");
      exit;
    } else {
      $_SESSION['errmsg'] = 'Sorry, some error occurred in registration.';
      header("Location: registration.php");
      exit;
    }
  } else {
    $_SESSION['errmsg'] = 'This email already Exist';
    header("Location: registration.php");
    exit;
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

	<!-- Title -->
	<title>Peura Opticals</title>
	
	<!-- Meta -->
	<meta charset="utf-8">
	 
	<!-- CANONICAL URL -->
	<link rel="canonical" href="registration.php">
	
	<!-- FAVICONS ICON -->
	<link rel="icon" type="image/x-icon" href="images/favicon.png">
	
	<!-- MOBILE SPECIFIC -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- STYLESHEETS -->
	
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/swiper/swiper-bundle.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/nouislider/nouislider.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="vendor/toastr/css/toastr.min.css">	
	
	<!-- GOOGLE FONTS-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
	<link href="../css2?family=DM+Sans:wght@400;500;700&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<!-- Include jQuery Validation Plugin -->
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
	<style>
        .error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
<div class="page-wraper">

	<!-- Header Star -->
	<?php include("include/header.php"); ?>
	<!-- Header End -->
	
	<div class="page-content" style="margin-top: 5rem;">
		<section class="px-3">
				<div class="row align-center-center">
					<div class="col-xxl-6 col-xl-6 col-lg-6 start-side-content">
						<div class="dz-bnr-inr-entry">
							<h1>Registration</h1>
							<nav aria-label="breadcrumb text-align-start" class="breadcrumb-row">
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php"> Home</a></li>
									<li class="breadcrumb-item">Shop Registration</li>
								</ul>
							</nav>	
						</div>
						<div class="registration-media">
							<img src="images/login-boy.png" alt="/">
						</div>
					</div>
					<div class="col-xxl-6 col-xl-6 col-lg-6 end-side-content">
						<div class="login-area">
							<h2 class="text-secondary text-center">Registration Now</h2>
							<p class="text-center m-b30">Welcome please registration to your account</p>
														
						<form id="registerForm" method="post">
							<div class="m-b25" style="position: relative;">
								<label class="label-title">Username</label>
								<input type="text" name="username" class="form-control" placeholder="Username">
							</div>
							<div class="m-b25" style="position: relative;">
								<label class="label-title">Email Address</label>
								<input type="email" name="email" class="form-control" placeholder="Email Address">
							</div>
							<div class="m-b40">
								<label class="label-title">Password</label>
								<div class="secure-input" style="position: relative;">
									<input type="password" name="password" class="form-control dz-password" placeholder="Password">
									<div class="show-pass">
										<i class="eye-open fa-regular fa-eye"></i>
									</div>
								</div>
							</div>
							<div class="text-center">
								
								<button name="submit" class="btn btn-outline-secondary btnhover text-uppercase">Sign Up</button>
								<a href="login.php" class="btn btn-secondary btnhover text-uppercase me-2">Log In</a>
							</div>
						</form>
						</div>
					</div>
				</div>
			
		</section>
	</div>

	
	<!-- Footer -->
	<?php include("include/footer.php"); ?>
	<!-- Footer End -->
	
	<button class="scroltop" type="button"><i class="fas fa-arrow-up"></i></button>
	
</div>
<!-- JAVASCRIPT FILES ========================================= -->
<!-- Include jQuery -->


<script src="vendor/wow/wow.min.js"></script><!-- WOW JS -->
<script src="vendor/toastr/js/toastr.min.js"></script>
<script src="js/toastr-init.js"></script>
<script src="vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script><!-- BOOTSTRAP MIN JS -->
<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script><!-- BOOTSTRAP SELECT MIN JS -->
<script src="vendor/bootstrap-touchspin/bootstrap-touchspin.js"></script><!-- BOOTSTRAP TOUCHSPIN JS -->
<script src="vendor/swiper/swiper-bundle.min.js"></script><!-- SWIPER JS -->
<script src="vendor/countdown/jquery.countdown.js"></script><!-- COUNTDOWN FUCTIONS  -->
<script src="vendor/wnumb/wNumb.js"></script><!-- WNUMB -->
<script src="vendor/nouislider/nouislider.min.js"></script><!-- NOUSLIDER MIN JS-->
<script src="js/dz.carousel.js"></script><!-- DZ CAROUSEL JS -->
<script src="js/dz.ajax.js"></script><!-- AJAX -->
<script src="js/custom.min.js"></script><!-- CUSTOM JS -->

<script>
    <?php if (isset($_SESSION['msg'])): ?>
      toastr.success("<?php echo $_SESSION['msg']; ?>");
      <?php unset($_SESSION['msg']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['errmsg'])): ?>
      toastr.error("<?php echo $_SESSION['errmsg']; ?>");
      <?php unset($_SESSION['errmsg']); ?>
    <?php endif; ?>
</script>

<script>
        $(document).ready(function () {
            // Initialize form validation
            $("#registerForm").validate({
                rules: {
                    username: {	
                        required: true,
                        minlength: 5
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    }
                },
                messages: {
                    username: {
                        required: "Please enter a username.",
                        minlength: "Your username must be at least 5 characters long."
                    },
                    email: {
                        required: "Please enter an email address.",
                        email: "Please enter a valid email address."
                    },
                    password: {
                        required: "Please provide a password.",
                        minlength: "Your password must be at least 8 characters long."
                    }
                },
                errorPlacement: function(error, element) {
                    // Custom error placement (default will work, but this can be used for advanced cases)
                    error.insertAfter(element);  // Inserts the error message after the input field
                },
                submitHandler: function(form) {
                    form.submit(); // If validation passes, the form will be submitted
                }
            });
        });
    </script>

     
</body>
</html>