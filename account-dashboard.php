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

$variableForCartAndBuyNow=false;
unset($_SESSION['USER_CHECKOUT']);
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
	<link rel="canonical" href="account-dashboard.php">
	
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
					<h1>Dashboard</h1>
					<nav aria-label="breadcrumb" class="breadcrumb-row">
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php"> Home</a></li>
							<li class="breadcrumb-item">Dashboard</li>
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
						<div class="account-card account-card-mb" style="gap: 20px; padding: 20px; border-radius: 10px;">
							<!-- Left Column -->
							<div  class="col-lg-4" style=" border-right: 1px solid #ccc; padding-right: 20px;">
								<p><strong>Name:</strong></p>
								<p><strong>Phone No:</strong></p>
								<p><strong>Date of Birth:</strong></p>
								<p><strong>Email:</strong></p>
								<p><strong>Address:</strong></p>
							</div>
							<!-- Right Column -->
							<div class="col-lg-7">
								<p><strong><?php echo ($userDetail['first_name'] ?? '') . "&nbsp;&nbsp;&nbsp;" . ($userDetail['last_name'] ?? ''); ?></strong></p>
								<p><strong><?php echo $userDetail['phone'] ?? ''; ?></strong></p>
								<p><strong>
								<?php
									if (!empty($userDetail['dob'])) {
										$date = new DateTime($userDetail['dob']);
										echo $date->format('jS F Y');
									} else {
										echo '';
									}
								?></strong></p>
								<p><strong><?php echo $userDetail['email'] ?? ''; ?></strong></p>
								<p><strong>
									<?php if (!empty($userDetail['address']) || !empty($userDetail['city']) || !empty($userDetail['state']) || !empty($userDetail['postcode'])): ?>
										<?php echo $userDetail['address'] . ', ' . $userDetail['city'] . ', ' . ($userDetail['state']) . ' - ' . $userDetail['postcode']; ?>                        
									<?php endif; ?>
								</strong></p>
							</div>
							<div class="col-lg-1"  >
								<a href="account-profile.php" class="edit-icon" title="Edit">
									<i class="fas fa-edit"></i>
								</a>
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
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="js/jquery.min.js"></script><!-- JQUERY MIN JS -->
<script src="vendor/wow/wow.min.js"></script><!-- WOW JS -->
<script src="vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script><!-- BOOTSTRAP MIN JS -->
<script src="vendor/apexchart/apexchart.js"></script><!-- apex chart MIN JS -->
<script src="js/dashbord-account.js"></script>
<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script><!-- BOOTSTRAP SELECT MIN JS -->
<script src="vendor/bootstrap-touchspin/bootstrap-touchspin.js"></script><!-- BOOTSTRAP TOUCHSPIN JS -->
<script src="vendor/swiper/swiper-bundle.min.js"></script><!-- SWIPER JS -->
<script src="vendor/imagesloaded/imagesloaded.js"></script><!-- IMAGESLOADED-->
<script src="vendor/countdown/jquery.countdown.js"></script><!-- COUNTDOWN FUCTIONS  -->
<script src="vendor/wnumb/wNumb.js"></script><!-- WNUMB -->
<script src="vendor/nouislider/nouislider.min.js"></script><!-- NOUSLIDER MIN JS-->
<script src="js/dz.carousel.js"></script><!-- DZ CAROUSEL JS -->
<script src="js/dz.ajax.js"></script><!-- AJAX -->
<script src="js/custom.min.js"></script><!-- CUSTOM JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
 
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
</body>
</html>