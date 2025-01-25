<?php
if (!isset($_SESSION)) {
  session_start();
}
error_reporting(E_ALL);
require "config/config.php";
require "config/authentication.php";

$conn = new dbClass();
$auth = new Authentication();

$auth->checkSession($_SESSION['USER_LOGIN']);
$userDetail = $auth->userDetails($_SESSION['USER_LOGIN']);

unset($_SESSION['USER_CHECKOUT']);
$variableForCartAndBuyNow=false;

if (isset($_POST['btn_pass'])) {
  $current_pass = $conn->addStr(trim($_POST['current_pass']));
  $new_pass = $conn->addStr(trim($_POST['new_pass']));
  $cnf_pass = $conn->addStr(trim($_POST['cnf_pass']));

  $sqlPassword = $auth->userDetails($_SESSION['USER_LOGIN']);

  $Password = $sqlPassword['password'];

  if ($current_pass == $Password):
    $sql = $auth->changePassword($new_pass, $_SESSION['USER_LOGIN']);
    $_SESSION['msg'] = "Password has been changed successfully !!";
  else:
    $_SESSION['errmsg'] = "You have entered wrong Password.!";
  endif;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

	<!-- Title -->
	<title>Peura Opticals</title>
	
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<!-- CANONICAL URL -->
	<link rel="canonical" href="account-profile.php">
	
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

</head>
<body>
<div class="page-wraper">

	
	<!-- Header Star -->
	<?php include("include/header.php"); ?>
	<!-- Header End -->
	
	<div class="page-content">
		<!--Banner Start-->
		<div class="dz-bnr-inr bg-secondary overlay-black-light" style="background-image:url(images/background/bg1.jpg); margin-top: 5rem;">
			<div class="container">
				<div class="dz-bnr-inr-entry">
					<h1>Profile</h1>
					<nav aria-label="breadcrumb" class="breadcrumb-row">
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php"> Home</a></li>
							<li class="breadcrumb-item">Account Profile</li>
						</ul>
					</nav>
				</div>
			</div>	
		</div>
		<!--Banner End-->
		
		<div class="content-inner-1">
			<div class="container">
                <div class="row">
					<aside class="col-xl-3">
						<div class="toggle-info">
							<h5 class="title mb-0">Account Navbar</h5>
							<a class="toggle-btn" href="#accountSidebar">Account Menu</a>
						</div>
						<?php include("include/acount-sidebar.php") ?>
                    </aside>
					<section class="col-xl-9 account-wrapper">
						<div class="account-card">
							<!-- <div class="profile-edit">
								<div class="avatar-upload d-flex align-items-center">
									<div class=" position-relative ">
										<div class="avatar-preview thumb">
											<div id="imagePreview" style="background-image: url(https://i.pinimg.com/236x/d9/72/9c/d9729c556e9e19d7ddf2bd12dd5df71a.jpg);"></div>
										</div>
										<div class="change-btn  thumb-edit d-flex align-items-center flex-wrap">
											<input type='file' class="form-control d-none" id="imageUpload" accept=".png, .jpg, .jpeg">
											<label for="imageUpload" class="btn btn-light ms-0"><i class="fa-solid fa-camera"></i></label>
										</div>	
									</div>
								</div>
								<div class="clearfix">
									<h2 class="title mb-0">Sajid Khan</h2><span class="text text-primary">	<span class="text text-primary">info@example.com</span></span>
									
								</div>
							</div> -->
							<form  method="post" id="password" enctype="multipart/form-data" class="row">
								<div class="col-lg-12">
									<div class="form-group m-b25" style="position: relative;">
										<label class="label-title">Current Password</label>
										<input type="password" name="current_pass" class="form-control" placeholder="Password">
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group m-b25" style="position: relative;">
										<label class="label-title">New Password</label>
										<input type="password" name="new_pass" class="form-control" placeholder="Password">
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group m-b25" style="position: relative;">
										<label class="label-title">Conform Password</label>
										<div class="secure-input ">
											<input type="password" name="cnf_pass" class="form-control" placeholder="Password">
									 
										</div>
									
									</div>
								</div>
								<div class="d-flex flex-wrap justify-content-between align-items-center">
									<button type="submit" name="btn_pass" class="btn btn-primary mt-3 mt-sm-0" >Submit</button>
								</div>
							</form>
							
								<!-- <div class="form-group">
									<div class="custom-control custom-checkbox text-black">
										<input type="checkbox" class="form-check-input" id="basic_checkbox_1">
										<label class="form-check-label" for="basic_checkbox_1">Subscribe me to Newsletter</label>
									</div>
								</div> -->
								
							
						</div>
					</section>
				</div>
      		</div>
		</div>
	</div>

	<!-- Footer -->
	<?php include("include/footer.php"); ?>
	<!-- Footer End -->
	
	<button class="scroltop" type="button"><i class="fas fa-arrow-up"></i></button>

</div>
<!-- JAVASCRIPT FILES ========================================= -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
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
    $(document).ready(function() {
        $("#password").validate({
            rules: {
                current_pass: {
                    required: true,
					minlength: 8
                },
                new_pass: {
                    required: true,
                    minlength: 8  // Ensure new password is at least 6 characters
                },
                cnf_pass: {
                    required: true,
                    equalTo: "[name='new_pass']"  // Make sure confirm password matches new password
                }
            },
            messages: {
                current_pass: {
                    required: "Please enter your current password"
                },
                new_pass: {
                    required: "Please enter a new password",
                    minlength: "New password must be at least 6 characters long"
                },
                cnf_pass: {
                    required: "Please confirm your new password",
                    equalTo: "Confirm password must match the new password"
                }
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.closest('.form-group')); // Append error message below the field
            },
            submitHandler: function(form) {
                // Optional: You can handle form submission here if you want to do it via AJAX
                form.submit(); // This will submit the form
            }
        });
    });
</script>
</body>
</html>