<!DOCTYPE html>
<html lang="en">
<head>

	<!-- Title -->
	<title>Peura Opticals</title>
	
	<!-- Meta -->
	<meta charset="utf-8">
	 
	<!-- CANONICAL URL -->
	<link rel="canonical" href="shop-checkout.php">
	
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
	<script src="js/dz.ajax.js"></script><!-- AJAX -->
<script src="js/custom.min.js"></script><!-- CUSTOM JS -->

</head>
<body>
<div class="page-wraper">

	
	<!-- Header Star -->
	<?php include("include/header.php"); ?>
	<!-- Header End -->
	
	<div class="page-content  ">
		<!--Banner Start-->
		<div class="dz-bnr-inr bg-secondary overlay-black-light" style="background-image:url(https://static.vecteezy.com/system/resources/thumbnails/027/300/432/small_2x/stylish-eyeglasses-in-female-hand-on-blue-banner-background-optical-store-vision-test-concept-banner-format-photo.jpg);margin-top: 5rem;">
			<div class="container">
				<div class="dz-bnr-inr-entry">
					<h1>Shop Checkout</h1>
					<nav aria-label="breadcrumb" class="breadcrumb-row">
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php"> Home</a></li>
							<li class="breadcrumb-item">Shop Checkout</li>
						</ul>
					</nav>
				</div>
			</div>	
		</div>
		<!--Banner End-->

		<!-- inner page banner End-->
		<div class="content-inner-1">
			<div class="container">
				<div class="row shop-checkout">
					<div class="col-xl-7">
						<h4 class="title m-b15">BILLING & SHIPPING INFORMATION</h4>
 
						<form class="row">
							<div class="col-md-6">
								<div class="form-group m-b25">
									<label class="label-title">First Name</label>
									<input name="dzName" required="" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group m-b25">
									<label class="label-title">Last Name</label>
									<input name="dzName" required="" class="form-control">
								</div>
							</div>
							<!-- <div class="col-md-6">
								<div class="form-group m-b25">
									<label class="label-title">Company name (optional)</label>
									<input name="dzName" required="" class="form-control">
								</div>
							</div> -->
							<div class="col-md-6">
								<div class="form-group m-b25">
									<label class="label-title">Phone *</label>
									<input name="dzName" required="" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group m-b25">
									<label class="label-title">Email address *</label>
									<input name="dzName" required="" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="m-b25">
									<label class="label-title">Town / City *</label>
									<select class="default-select form-select  w-100" style="outline: 1px solid #000;">
										<option selected="">Kota</option>
										<option value="1">Another option</option>
										<option value="2">Jaipur</option>
										<option value="3">Udaipur</option>
									</select>	
								</div>
							</div>
							<div class="col-md-6">
								<div class="m-b25">
									<label class="label-title">State *</label>
									<select class="default-select form-select  w-100" style="outline: 1px solid #000;">
										<option selected="">Rajasthan</option>
										<option value="1">Another option</option>
										<option value="2">Rajasthan</option>
										<option value="3">Rajasthan</option>
									</select>									
								</div>
							</div>
							<!-- <div class="col-md-6">
								<div class="m-b25">
									<label class="label-title">Country / Region *</label>
									<select class="default-select form-select w-100">
										<option selected="">India</option>
										<option value="1">Another option</option>
										<option value="2">UK</option>
										<option value="3">Iraq</option>
									</select>	
								</div>
							</div> -->
							<div class="col-md-12">
								<div class="form-group m-b25">
									<label class="label-title">Street address *</label>
									<input name="dzName" required="" class="form-control m-b15" placeholder="House number and street name">
									<input name="dzName" required="" class="form-control" placeholder="Apartment, suite, unit, etc. (optional)">
								</div>
							</div>
							
					
							
							<div class="col-md-12">
								<div class="form-group m-b25">
									<label class="label-title">ZIP Code *</label>
									<input name="dzName" required="" class="form-control">
								</div>
							</div>
			
							<div class="col-md-12 m-b25">
								<div class="form-group">
									<label class="label-title">Order notes (optional)</label>
									<textarea id="comments" placeholder="Notes about your order, e.g. special notes for delivery." class="form-control" name="comment" cols="90" rows="5" required="required"></textarea>
								</div>
							</div>
							<div class="col-md-12 m-b25">
								<div class="form-group m-b5">
								   <div class="custom-control custom-checkbox">
										<input type="checkbox" class="form-check-input" id="basic_checkbox_1">
										<label class="form-check-label" for="basic_checkbox_1">Create an account? </label>
									</div>
								</div>
								<div class="form-group">
								   <div class="custom-control custom-checkbox">
										<input type="checkbox" class="form-check-input" id="basic_checkbox_2">
										<label class="form-check-label" for="basic_checkbox_2">Ship to a different address?</label>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="col-xl-5 side-bar">
						<h4 class="title m-b15">Your Order</h4>
						<div class="order-detail sticky-top">
 
							<table>
								<tbody>
									<div class="accordion dz-accordion accordion-sm" id="accordionFaq1">
								
										<div class="accordion-item  ">
											<div class="accordion-header" id="heading2">
												<div class="accordion-button collapsed custom-control custom-checkbox border-0" data-bs-toggle="collapse" data-bs-target="#collapse2" role="navigation" aria-expanded="true" aria-controls="collapse2">
										
													<img src="https://image4.cdnsbg.com/1/220/672020_1732878835285.jpg?width=98&height=49" alt="" style="width:80px">
												
													<div>
														<p class="fs-7 mb-0">Nike LIVEFREE ICONIC EV24012</p>
														<p class="fs-7 mb-0">Price: ₹7,174</p>
														<label class="form-check-label align-items-center" for="flexRadioDefault5">
														<a href="JavaScript:void(0)">More details<i class="feather icon-chevron-down"></i></a>
														</label>
													</div>
												</div>
											</div>
											<div id="collapse2" class="accordion-collapse collapse" aria-labelledby="collapse2" data-bs-parent="#accordionFaq1">
												<div class="accordion-body">
													<p class="m-b0 fs-7">
													  <strong>Frame Color:</strong> Matte Black<br>
													  <strong>Lens Color:</strong> Dark Brown<br>
													  <strong>Size:</strong> L (54-19-140)
													</p>
												  </div>
												  
											</div>
										</div>
										<div class="accordion-item  ">
											<div class="accordion-header" id="heading3">
												<div class="accordion-button collapsed custom-control custom-checkbox border-0" data-bs-toggle="collapse" data-bs-target="#collapse3" role="navigation" aria-expanded="true" aria-controls="collapse3">
													<img src="https://image4.cdnsbg.com/1/220/672022_1721816696574.jpg?width=98&height=49" alt="" style="width:80px">
												
													<div>
														<p class="fs-7 mb-0">Nike LIVEFREE ICONIC EV24012</p>
														<p class="fs-7 mb-0">Price: ₹7,174</p>
														<label class="form-check-label align-items-center" for="flexRadioDefault5">
														<a href="JavaScript:void(0)">More details<i class="feather icon-chevron-down"></i></a>
														</label>
													</div>
												</div>
											</div>
											<div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordionFaq1">
												<div class="accordion-body">
													<p class="m-b0 fs-7">
													  <strong>Frame Color:</strong> Matte Black<br>
													  <strong>Lens Color:</strong> Dark Brown<br>
													  <strong>Size:</strong> L (54-19-140)
													</p>
												  </div>
											</div>
										</div>
									</div>
								 
									<tr class="subtotal border-0">
										<td>Subtotal</td>
										<td class="price">₹100</td>
									</tr>
									<tr class="subtotal border-0">
										<td>GST</td>
										<td class="price">5%</td>
									</tr>
									<tr class="subtotal">
										<td>Shipping</td>
										<td class="price">Free</td>
									</tr>
									<tr class="total">
										<td>Total</td>
										<td class="price">₹125.75</td>
										
									</tr>
								</tbody>
							</table>
							
							
						
							<div class="form-group">
								<div class="custom-control custom-checkbox d-flex m-b15">
									<input type="checkbox" class="form-check-input" id="basic_checkbox_3">
									<label class="form-check-label" for="basic_checkbox_3">I have read and agree to the website terms and conditions </label>
								</div>
							</div>
							<a href="shop-checkout.php" class="btn btn-secondary w-100">PROCEED TO PAYMENT</a>
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

<script src="vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script><!-- BOOTSTRAP MIN JS -->
<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script><!-- BOOTSTRAP SELECT MIN JS -->
<script src="vendor/bootstrap-touchspin/bootstrap-touchspin.js"></script><!-- BOOTSTRAP TOUCHSPIN JS -->
<script src="vendor/swiper/swiper-bundle.min.js"></script><!-- SWIPER JS -->
<script src="vendor/countdown/jquery.countdown.js"></script><!-- COUNTDOWN FUCTIONS  -->
<script src="vendor/wnumb/wNumb.js"></script><!-- WNUMB -->
<script src="vendor/nouislider/nouislider.min.js"></script><!-- NOUSLIDER MIN JS-->
<script src="js/dz.carousel.js"></script><!-- DZ CAROUSEL JS -->

</body>
</html>