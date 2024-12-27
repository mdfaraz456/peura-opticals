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

if (isset($_REQUEST['update'])) {
  $fname = $conn->addStr(trim($_POST['fname']));
  $lname = $conn->addStr(trim($_POST['lname']));
  $phone = $conn->addStr(trim($_POST['phone']));
  $email = $conn->addStr(trim($_POST['email']));
  $dob = $conn->addStr(trim($_POST['dob']));
  $address = $conn->addStr(trim($_POST['address']));
  $apartment = $conn->addStr(trim($_POST['apartment']));
  $state = $conn->addStr(trim($_POST['state']));
  $city = $conn->addStr(trim($_POST['city']));
  $postcode = $conn->addStr(trim($_POST['postcode']));

  $sqlQuery = $auth->updateuserProfile($fname, $lname, $phone, $email, $dob, $address, $apartment, $state, $city, $postcode, $_SESSION['USER_LOGIN']);

  if ($sqlQuery == true):
    $_SESSION['msg'] = "Your Profile Updated Successfully ..";
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
  else:
    $_SESSION['errmsg'] = "Sorry !! Some Error ..";
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
						<div class="sticky-top account-sidebar-wrapper">
							<div class="account-sidebar" id="accountSidebar">
								<div class="profile-head">
									<div class="user-thumb">
										<img class="rounded-circle" src="https://i.pinimg.com/236x/d9/72/9c/d9729c556e9e19d7ddf2bd12dd5df71a.jpg" alt="Susan Gardner">
									</div>
									<h5 class="title mb-0"><?php echo $userDetail['first_name']." ".$userDetail['last_name'];?></h5>
									<span class="text text-primary"><?php echo $userDetail['email'];?></span>
								</div>
								<div class="account-nav">
									<div class="nav-title bg-light">DASHBOARD</div>
									<ul>
										<li><a href="account-dashboard.php">Dashboard</a></li>
										<li><a href="account-orders.php">Orders</a></li>
										<!-- <li><a href="account-downloads.php">Downloads</a></li>
										<li><a href="account-return-request.php">Return request</a></li> -->
									</ul>
									<div class="nav-title bg-light">ACCOUNT SETTINGS</div>
									<ul class="account-info-list">
										<li><a href="account-profile.php">Profile</a></li>
										<li><a href="change-password.php">Change Password</a></li>
										<li class="" style="background-color: #ff4764; margin: 0 .5rem; border-radius: 10px;"><a href="login.php" style="color:#fff;"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
										<!-- <li><a href="account-shipping-methods.php">Shipping methods</a></li> -->
										<!-- <li><a href="account-payment-methods.php">Payment Methods</a></li> -->
										<!-- <li><a href="account-review.php">Review</a></li> -->
									</ul>
								</div>
							</div>
						</div>
                    </aside>
					<section class="col-xl-9 account-wrapper">
						<div class="account-card">
							<div class="profile-edit">
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
									<h2 class="title mb-0"><?php echo $userDetail['first_name']." ".$userDetail['last_name'];?></h2><span class="text text-primary"><?php echo $userDetail['email'];?></span>
									
								</div>
							</div>

							<form id="updateprofile" method="post" enctype="multipart/form-data">
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">First Name</label>
										<input type="text" value="<?php echo $userDetail['first_name'];?>" name="fname" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Last Name</label>
										<input type="text" value="<?php echo $userDetail['last_name'];?>" name="lname" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Email address</label>
										<input type="email" value="<?php echo $userDetail['email'];?>" name="email" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Phone</label>
										<input type="text" value="<?php echo $userDetail['phone'];?>" name="phone" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Date of Birth</label>
										<input type="date" value="<?php echo $userDetail['dob'];?>" name="dob" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Address</label>
										<input type="text" value="<?php echo $userDetail['address'];?>" name="address" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Apartment, Suite, etc.</label>
										<input type="text" value="<?php echo $userDetail['apartment'];?>" name="apartment" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<label class="label-title">State</label>
									<select id="state" name="state" class="form-control" data-selected-state="<?php echo isset($userDetail['state']) ? $userDetail['state'] : ''; ?>">
										<option value="">Select State</option>
										<!-- Populate with options as needed -->
									</select>
								</div>

								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">City</label>
										<input type="text" value="<?php echo $userDetail['city'];?>" name="city" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Zip Code</label>
										<input type="text" value="<?php echo $userDetail['postcode'];?>" name="postcode" class="form-control" pattern="[0-9]{5,6}" title="Please enter a valid 5 or 6 digit zip code">
									</div>
								</div>

								<button class="btn btn-primary mt-3 mt-sm-0" type="submit" name="update">Update profile</button>
							</form>

								<div class="d-flex flex-wrap justify-content-between align-items-center">
								<!-- <div class="form-group">
									<div class="custom-control custom-checkbox text-black">
										<input type="checkbox" class="form-check-input" id="basic_checkbox_1">
										<label class="form-check-label" for="basic_checkbox_1">Subscribe me to Newsletter</label>
									</div>
								</div> -->
								
							</div>
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
<!-- <script src="js/jquery.min.js"></script>JQUERY MIN JS -->
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
<script src="js/state.js"></script>


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
    $("#updateprofile").validate({
        rules: {
            fname: {
                required: true,
                minlength: 2
            },
            lname: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                minlength: 10,
                maxlength: 15
            },
            dob: {
                required: true,
                date: true
            },
            address: {
                required: true,
                minlength: 5
            },
            apartment: {
                required: false,
                minlength: 2
            },
            state: {
                required: true
            },
            city: {
                required: true,
                minlength: 2
            },
            postcode: {
                required: true,
                pattern: /^[0-9]{5,6}$/ // Validates 5 or 6 digit zip code
            }
        },
        messages: {
            fname: {
                required: "First Name is required",
                minlength: "First Name must be at least 2 characters"
            },
            lname: {
                required: "Last Name is required",
                minlength: "Last Name must be at least 2 characters"
            },
            email: {
                required: "Email address is required",
                email: "Please enter a valid email address"
            },
            phone: {
                required: "Phone number is required",
                minlength: "Phone number must be at least 10 characters",
                maxlength: "Phone number must be no more than 15 characters"
            },
            dob: {
                required: "Date of Birth is required",
                date: "Please enter a valid date"
            },
            address: {
                required: "Address is required",
                minlength: "Address must be at least 5 characters"
            },
            apartment: {
                minlength: "Apartment field must be at least 2 characters"
            },
            state: {
                required: "State is required"
            },
            city: {
                required: "City is required",
                minlength: "City must be at least 2 characters"
            },
            postcode: {
                required: "Zip Code is required",
                pattern: "Please enter a valid 5 or 6 digit zip code"
            }
        },
        // Optional: Customizing the error message placement
        errorPlacement: function (error, element) {
            error.insertAfter(element); // You can customize where the error message appears
        },
        submitHandler: function(form) {
            form.submit(); // Proceed to submit the form if validation passes
        }
    });
});
</script>

</body>
</html>