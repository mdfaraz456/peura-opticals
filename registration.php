
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
							<form>
								<div class="m-b25">
									<label class="label-title">Username</label>
									<input name="dzName" required="" class="form-control" placeholder="Username" type="text">
								</div>
								<div class="m-b25">
									<label class="label-title">Email Address</label>
									<input name="dzName" required="" class="form-control" placeholder="Email Address" type="email">
								</div>
								<div class="m-b40">
									<label class="label-title">Password</label>
									<div class="secure-input ">
										<input type="password" name="password" class="form-control dz-password" placeholder="Password">
										<div class="show-pass">
											<i class="eye-open fa-regular fa-eye"></i>
										</div>
									</div>
								</div>
								<div class="text-center">
									<a href="registration.php" class="btn btn-secondary btnhover text-uppercase me-2">Register</a>
									<a href="login.php" class="btn btn-outline-secondary btnhover text-uppercase">Sign In</a>
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