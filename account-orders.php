<!DOCTYPE html>
<html lang="en">
<head>

	<!-- Title -->
	<title>Peura Opticals</title>
	
	<!-- Meta -->
	<meta charset="utf-8">
	 	<!-- MOBILE SPECIFIC -->
		 <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- STYLESHEETS -->
	
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/swiper/swiper-bundle.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/nouislider/nouislider.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/lightgallery/dist/css/lightgallery.css">
    <link rel="stylesheet" type="text/css" href="vendor/lightgallery/dist/css/lg-thumbnail.css">
    <link rel="stylesheet" type="text/css" href="vendor/lightgallery/dist/css/lg-zoom.css">
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
					<h1>Orders</h1>
					<nav aria-label="breadcrumb" class="breadcrumb-row">
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php">Home</a></li>
							<li class="breadcrumb-item">Orders</li>
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
                    <div class="col-xl-9 account-wrapper">
						<div class="account-card">
							<div class="table-responsive table-style-1">
								<table class="table table-hover mb-3">
									<thead>
										<tr>
											<th>Order #</th>
											<th>Order Date</th>
											<th>Order Number</th>
											<th>Payment Satus</th>
											<th>Actions</th>
											<!-- <th>Action</th> -->
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><a href="JavaScript:void(0)" class="fw-medium">#34VB5540K83</a></td>
											<td>May 21, 2024</td>
											<td>$358.75</td>
											<td><span class="badge bg-info  m-0">In Progress</span></td>
											<td><a href="JavaScript:void(0)" class="btn-link text-underline p-0">View</a></td>
										</tr>
										<tr>
											<td><a href="JavaScript:void(0)" class="fw-medium">#78A643CD409</a></td>
											<td>December 09, 2024</td>
											<td><span>$760.50</span></td>
											<td><span class="badge bg-danger  m-0">Canceled</span></td>
											<td><a href="JavaScript:void(0)" class="btn-link text-underline p-0">View</a></td>
										</tr>
										<tr>
											<td><a href="javascript:void(0);" class="fw-medium">#112P45A90V2</a></td>
											<td>October 15, 2024</td>
											<td>$1,264.00</td>
											<td><span class="badge bg-warning  m-0">Delayed</span></td>
											<td><a href="JavaScript:void(0)" class="btn-link text-underline p-0">View</a></td>
										</tr>
										<tr>
											<td><a href="JavaScript:void(0)" class="fw-medium">#28BA67U0981</a></td>
											<td>July 19, 2024</td>
											<td>$198.35</td>
											<td><span class="badge bg-success  m-0">Delivered</span></td>
											<td><a href="JavaScript:void(0)" class="btn-link text-underline p-0">View</a></td>
										</tr>
										<tr>
											<td><a href="JavaScript:void(0)" class="fw-medium">#502TR872W2</a></td>
											<td>April 04, 2024</td>
											<td>$2,133.90</td>
											<td><span class="badge bg-success m-0">Delivered</span></td>
											<td><a href="JavaScript:void(0)" class="btn-link text-underline p-0">View</a></td>
										</tr>
										<tr>
											<td><a href="JavaScript:void(0)" class="fw-medium">#47H76G09F33</a></td>
											<td>March 30, 2024</td>
											<td>$86.40</td>
											<td><span class="badge bg-success m-0">Delivered</span></td>
											<td><a href="JavaScript:void(0)" class="btn-link text-underline p-0">View</a></td>
										</tr>
										<tr>
											<td><a href="JavaScript:void(0)" class="fw-medium">#53U76G09E38</a></td>
											<td>April 21, 2024</td>
											<td>$86.40</td>
											<td><span class="badge bg-success m-0">Delivered</span></td>
											<td><a href="JavaScript:void(0)" class="btn-link text-underline p-0">View</a></td>
										</tr>
										<tr>
											<td><a href="JavaScript:void(0)" class="fw-medium">#31M76G09G76</a></td>
											<td>May 07, 2024</td>
											<td>$112.40</td>
											<td><span class="badge bg-success m-0">Delivered</span></td>
											<td><a href="JavaScript:void(0)" class="btn-link text-underline p-0">View</a></td>
										</tr>
									</tbody>
								</table>
							</div>
							
							<!-- Pagination-->
							<div class="d-flex justify-content-center">
								<nav aria-label="Table Pagination">
									<ul class="pagination style-1">
										<li class="page-item"><a class="page-link" href="javascript:void(0);">Prev</a></li>
										<li class="page-item"><a class="page-link" href="javascript:void(0);">1</a></li>
										<li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
										<li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
										<li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>
									</ul>
								</nav>
							</div>
                        </div>
                    </div>
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