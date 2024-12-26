﻿<!DOCTYPE html>
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
									<h5 class="title mb-0">Sajid Khan</h5>
									<span class="text text-primary">info@example.com</span>
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
							<form action="#" class="row">
								<div class="col-lg-12">
									<div class="form-group m-b25">
										<label class="label-title">Current Password</label>
										<input type="password" name="password" class="form-control" placeholder="Password">
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group m-b25">
										<label class="label-title">New Password</label>
										<input type="password" name="password" class="form-control" placeholder="Password">
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group m-b25">
										<label class="label-title">Conform Password</label>
										<div class="secure-input ">
											<input type="password" name="password" class="form-control" placeholder="Password">
									 
										</div>
									
									</div>
								</div>
							
							</form>
							<div class="d-flex flex-wrap justify-content-between align-items-center">
								<!-- <div class="form-group">
									<div class="custom-control custom-checkbox text-black">
										<input type="checkbox" class="form-check-input" id="basic_checkbox_1">
										<label class="form-check-label" for="basic_checkbox_1">Subscribe me to Newsletter</label>
									</div>
								</div> -->
								<button class="btn btn-primary mt-3 mt-sm-0" type="button">Submit</button>
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
<script src="js/jquery.min.js"></script><!-- JQUERY MIN JS -->
<script src="vendor/wow/wow.min.js"></script><!-- WOW JS -->
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
</body>
</html>