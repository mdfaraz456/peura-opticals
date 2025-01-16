
<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['USER_LOGIN'])) {
    header('Location: login.php');
    exit(); 
}


error_reporting(E_ALL);
require "config/config.php";
require "config/authentication.php";
require 'config/common.php';
$id="";
$conn = new dbClass();
$products = new Products();
$auth = new Authentication();

$auth->checkSession($_SESSION['USER_LOGIN']);
$userDetail = $auth->userDetails($_SESSION['USER_LOGIN']);
$userShipDetail = $auth->userShipLogin($_SESSION['USER_LOGIN']);
if(isset($_SESSION['USER_LOGIN'])){
	$userAllShipDetail = $auth->userAllShipDetails($_SESSION['USER_LOGIN']);
	$userShipLogin = $auth->userShipLogin($_SESSION['USER_LOGIN']);
}

if (isset($_REQUEST['update'])) {
  $fname = $conn->addStr(trim($_POST['fname']));
  $lname = $conn->addStr(trim($_POST['lname']));
  $phone = $conn->addStr(trim($_POST['phone']));
  $email = $conn->addStr(trim($_POST['email']));
//   $dob = $conn->addStr(trim($_POST['dob']));
  $address = $conn->addStr(trim($_POST['address']));
  $apartment = $conn->addStr(trim($_POST['apartment']));
  $state = $conn->addStr(trim($_POST['state']));
  $city = $conn->addStr(trim($_POST['city']));
  $postcode = $conn->addStr(trim($_POST['postcode']));


	$ProductId=1;
	$order_number=1;
	$auth->addShipping($_SESSION['USER_LOGIN'],$ProductId, $order_number ,$fname, $lname, $phone, $email, $address, $apartment, $state, $city, $postcode);
    
//   if ($sqlQuery == true):
//     $_SESSION['msg'] = "Your Profile Updated Successfully ..";
//     header("Location: " . $_SERVER['REQUEST_URI']);
//     exit;
//   else:
//     $_SESSION['errmsg'] = "Sorry !! Some Error ..";
//   endif;
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
						<table class="mb-5">
								<h5>Shipping Address</h5>
									<?php foreach($userAllShipDetail as $shipRow):?>
										<tbody >
											<tr class="total mb-3">
											
												<td>
													
													<input type="checkbox" id="select-item" />
													<label for="select-item" style="margin-left: 8px; vertical-align: top;">
														<p class="mb-0"><?php echo ucwords($shipRow['first_name'] ?? ''); ?> <?php echo ucwords($shipRow['last_name'] ?? ''); ?></p>
														<p style="margin: 0;"><?php echo ucwords($shipRow['phone'] ?? ''); ?></p>
														<p style="margin: 0;"><?php echo ucwords($shipRow['email'] ?? ''); ?></p>
														<p style="margin: 0;"><?php echo $shipRow['address'] ?? ''; ?>, <?php echo $shipRow['apartment'] ?? ''; ?>, <?php echo $shipRow['city'] ?? ''; ?></p>
														<p style="margin: 0;"><?php echo $shipRow['state'] ?? ''; ?>, <?php echo $shipRow['pincode'] ?? ''; ?></p>
													</label>
												</td>
											
												<td class="price" style=" vertical-align: top;">
										
													<button style="background: none; border: none; cursor: pointer; margin-left: 10px; " title="Edit shipping Address">
														<a href="shop-checkout.php"><i class="fas fa-edit" style="font-size: 16px;"></i></a>
													</button>
												</td>
											</tr>
										
										</tbody>
									<?php endforeach; ?>
								</table>
						<?php if($id==""):?>
							<form class="row" id="updateForm" method="POST" enctype="multipart/form-data">
								<input type="hidden" value="<?php echo $shipRow['first_name']; ?>">
								<div class="col-md-6">
									<div class="form-group m-b25">
										<label class="label-title">First Name</label>
										<input name="fname" required="" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group m-b25">
										<label class="label-title">Last Name</label>
										<input name="lname" required="" class="form-control">
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="form-group m-b25">
										<label class="label-title">Phone *</label>
										<input name="phone" required="" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group m-b25">
										<label class="label-title">Email address *</label>
										<input name="email" required="" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="m-b25">
										<label class="label-title">Town / City *</label>
										<input name="city" required="" class="form-control">
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="m-b25">
										<label class="label-title">State *</label>
										<select id="state" name="state" class="default-select form-select  w-100" style="outline: 1px solid #000;">
										<option value="">Select State</option>
										</select>									
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="form-group m-b25">
										<label class="label-title">Street address *</label>
										<input name="address" required="" class="form-control m-b15" placeholder="House number and street name">
										<input name="apartment" required="" class="form-control" placeholder="Apartment, suite, unit, etc. (optional)">
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="form-group m-b25">
										<label class="label-title">ZIP Code *</label>
										<input name="postcode" required="" class="form-control">
									</div>
								</div>
				
								<div class="col-md-6 text-end">
									<button class="btn btn-primary mt-3 mt-sm-0" type="submit" name="update">Update Address</button>
								</div>
							</form>
						<?php else :?>
							<form class="row" id="updateForm" method="POST" enctype="multipart/form-data">
								<div class="col-md-6">
									<div class="form-group m-b25">
										<label class="label-title">First Name</label>
										<input name="fname" required="" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group m-b25">
										<label class="label-title">Last Name</label>
										<input name="lname" required="" class="form-control">
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="form-group m-b25">
										<label class="label-title">Phone *</label>
										<input name="phone" required="" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group m-b25">
										<label class="label-title">Email address *</label>
										<input name="email" required="" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="m-b25">
										<label class="label-title">Town / City *</label>
										<input name="city" required="" class="form-control">
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="m-b25">
										<label class="label-title">State *</label>
										<select id="state" name="state" class="default-select form-select  w-100" style="outline: 1px solid #000;">
										<option value="">Select State</option>
										</select>									
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="form-group m-b25">
										<label class="label-title">Street address *</label>
										<input name="address" required="" class="form-control m-b15" placeholder="House number and street name">
										<input name="apartment" required="" class="form-control" placeholder="Apartment, suite, unit, etc. (optional)">
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="form-group m-b25">
										<label class="label-title">ZIP Code *</label>
										<input name="postcode" required="" class="form-control">
									</div>
								</div>
				
								<div class="col-md-6 text-end">
									<button class="btn btn-primary mt-3 mt-sm-0" type="submit" name="update">Update profile</button>
								</div>
							</form>
						<?php endif; ?>
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
<script src="js/state.js"></script>

</body>
</html>