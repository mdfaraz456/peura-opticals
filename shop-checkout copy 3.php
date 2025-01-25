<?php
if (!isset($_SESSION)) {
	session_start();
}
if (!isset($_SESSION['USER_LOGIN'])) {
	$_SESSION['USER_CHECKOUT'] = 'checkout';
	$_SERVER['REQUEST_URI'] = "shop-checkout.php";
	header('Location: cart.php');
	exit();
}





error_reporting(E_ALL);
require "config/config.php";
require "config/authentication.php";
require 'config/common.php';
require_once 'config/cart.php';

$id = "";
$conn = new dbClass();
$products = new Products();
$auth = new Authentication();
$cartItem = new Cart();

$ipAddress = $_SERVER["REMOTE_ADDR"];
$variableForCartAndBuyNow=true;
$cartData = $cartItem->cartItems($_SESSION['cart_item'], $ipAddress);
if(empty($cartData)){
	header('Location: index.php');
	exit();
}

$auth->checkSession($_SESSION['USER_LOGIN']);
$userDetail = $auth->userDetails($_SESSION['USER_LOGIN']);
$userShipDetail = $auth->userShipLogin($_SESSION['USER_LOGIN']);
if (isset($_SESSION['USER_LOGIN'])) {
	$userAllShipDetail = $auth->userAllShipDetails($_SESSION['USER_LOGIN']);
	$userShipLogin = $auth->userShipLogin($_SESSION['USER_LOGIN']);
}

if (isset($_REQUEST['add_new_address'])) {
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


	$ProductId = 1;
	$order_number = 1;
	$auth->addShipping($_SESSION['USER_LOGIN'], $ProductId, $order_number, $fname, $lname, $phone, $email, $address, $apartment, $state, $city, $postcode);
	header("Location: shop-checkout.php");
	//   if ($sqlQuery == true):
	//     $_SESSION['msg'] = "Your Profile Updated Successfully ..";
	//     header("Location: " . $_SERVER['REQUEST_URI']);
	//     exit;
	//   else:
	//     $_SESSION['errmsg'] = "Sorry !! Some Error ..";
	//   endif;
}

if (isset($_REQUEST['update'])) {
	$fname = $conn->addStr(trim($_POST['fname']));
	$lname = $conn->addStr(trim($_POST['lname']));
	$phone = $conn->addStr(trim($_POST['phone']));
	$email = $conn->addStr(trim($_POST['email']));
	$id = $conn->addStr(trim($_POST['id']));
	$address = $conn->addStr(trim($_POST['address']));
	$apartment = $conn->addStr(trim($_POST['apartment']));
	$state = $conn->addStr(trim($_POST['state']));
	$city = $conn->addStr(trim($_POST['city']));
	$postcode = $conn->addStr(trim($_POST['postcode']));


	$sqlQuery = $auth->updateShipping($fname, $lname, $phone, $email, $address, $apartment, $state, $city, $postcode, $id);

	//   if ($sqlQuery == true):
	//     $_SESSION['msg'] = "Your Shiping Address Updated Successfully ..";
	//     // header("Location: " . $_SERVER['REQUEST_URI']);
	header("Location: shop-checkout.php");
	//     exit;
	//   else:
	//     $_SESSION['errmsg'] = "Sorry !! Some Error ..";
	//   endif;
}
if (isset($_REQUEST['eid'])) {
	$id = $_REQUEST['id'];
	$sqlStatus = $db->execute("UPDATE `popup` SET `status` = '$status' WHERE `id` = '$id'");
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
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
	<link href="../css2?family=DM+Sans:wght@400;500;700&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">


	<style>
		.card-body {
			background-color: #f9f9f9;
			padding: 20px;
		}

		.btn-warning {
			background-color: #ff9800;
			border-color: #ff9800;
		}

		.btn-warning:hover {
			background-color: #e68900;
			border-color: #e68900;
		}

		.form-control {
			border-radius: 5px;
			border: 1px solid #ccc;
		}

		.form-control:focus {
			border-color: #007bff;
			box-shadow: none;
		}

		.shipping-details,
		.shipping-form {
			transition: opacity 0.3s ease;
		}

		.main-card {
			background: #F0F0F0;
			padding: 20px;
			border-radius: 25px;
		}

		.ship-add {
			padding: 18px;
			background: #718092;
			color: #fff;
			border-radius: 5px;
			margin-bottom: 25px;
		}

		.shipping-form {
			display: none;
		}

		.shipping-details p {
			margin: 0;
		}

		.shipping-details .btn-warning {
			margin-top: 10px;
		}

		#new-address-card .card-body {
			cursor: pointer;
		}

		input[type="radio"] {
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
			width: 25px;
			height: 25px;
			border: 2px solid #E68900;
			border-radius: 50%;
			position: relative;
			cursor: pointer;
		}

		input[type="radio"]:checked::before {
			content: '';
			position: absolute;
			top: 3px;
			left: 3px;
			width: 15px;
			height: 15px;
			background-color: #E68900;
			border-radius: 50%;
		}

		input[type="radio"]:hover {
			border-color: rgb(255, 164, 27);
		}
	</style>

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
			<div class="content-inner-1 pt-5 pb-5">
				<div class="container">
					<div class="row shop-checkout">
						<div class="col-xl-7">
							<?php
							$editId = (isset($_REQUEST['eId']) ? base64_decode($_REQUEST['eId']) : '');
							if ($editId) {
								$shippingData = $auth->userShipDetailsByShipId($editId);
							}
							?>

							<!-- Table with Bootstrap styling -->
							<div class="container main-card">
								<h5 class="ship-add">Shipping Addresses</h5>

								<div class="row">
									<?php $i = 0;
									foreach ($userAllShipDetail as $index => $shipRow) :
										$i++; ?>
										<div class="col-md-12">
											<div class="card">
												<div class="card-body">
													<div class="shipping-details" id="details<?php echo $index; ?>" data-index="<?php echo $index; ?>">

														<div class="row">
															<div class="col-md-1">
																<input type="radio" name="shipping-address" id="select-item-<?php echo $index; ?>" class="select-item" <?php echo ($index == 0) ? 'checked' : ''; ?> />
															</div>
															<div class="col-md-10">
																<p>
																	<?php echo ucwords($shipRow['first_name'] ?? '') . ' ' . ucwords($shipRow['last_name'] ?? ''); ?>
																	, <?php echo $shipRow['phone'] ?? ''; ?>
																</p>
																<p>
																	<?php echo $shipRow['email'] ?? ''; ?>,
																	<?php echo $shipRow['address'] ?? ''; ?>,
																	<?php echo $shipRow['apartment'] ?? ''; ?>,
																	<?php echo $shipRow['city'] ?? ''; ?>,
																	<?php echo $shipRow['state'] ?? ''; ?>,
																	<?php echo $shipRow['postcode'] ?? ''; ?>
																</p>

															</div>
															<div class="col-md-1">
																<a href="javascript:void(0);" class="btn btn-warning btn-sm m-0 edit-btn" id="edit-btn-<?php echo $index; ?>" style="display: <?php echo ($index == 0) ? 'inline-block' : 'none'; ?>" data-target="#form<?php echo $index; ?>" data-details="#details<?php echo $index; ?>">
																	<i class="fas fa-edit"></i>
																</a>
															</div>
															<form id="deliveryForm" method="POST" enctype="multipart/form-data">
																<input type="hidden" name="shipId" value="<?php echo $shipRow['id']; ?>">
																<div class="col-md-12 text-end mt-3 pe-0">
																	<button type="submit" name="submit" value="submit" class="btn btn-secondary w-30 delivery-btn" id="delivery-btn-<?php echo $index; ?>" style="display: none;">
																		DELIVERY HERE
																	</button>
																</div>
															</form>

														</div>
													</div>

													<div class="shipping-form" id="form<?php echo $index; ?>" style="display:none;">
														<!-- Edit Form -->
														<form id="updateForm" method="POST" enctype="multipart/form-data">
															<div class="row">
																<div class="col-md-1">
																	<!-- Show radio button inside the form when editing -->
																	<input type="radio" name="shipping-address" id="select-item-<?php echo $index; ?>" class="select-item" checked />
																</div>
																<div class="col-md-11">
																	<!-- Title and the form fields -->
																	<h5>Edit Shipping Address</h5>
																	<div class="row">
																		<div class="col-md-6">
																			<div class="form-group">
																				<label for="fname">First Name</label>
																				<input type="text" class="form-control" id="fname" name="fname" value="<?php echo $shipRow['first_name'] ?? ''; ?>" required>
																				<input type="hidden" value="<?php echo $shipRow['id'] ?? ''; ?>" name="id">
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="form-group">
																				<label for="lname">Last Name</label>
																				<input type="text" class="form-control" id="lname" name="lname" value="<?php echo $shipRow['last_name'] ?? ''; ?>" required>
																			</div>
																		</div>

																		<div class="col-md-6">
																			<div class="form-group">
																				<label for="phone">Phone</label>
																				<input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $shipRow['phone'] ?? ''; ?>" required>
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="form-group">
																				<label for="email">Email</label>
																				<input type="email" class="form-control" id="email" name="email" value="<?php echo $shipRow['email'] ?? ''; ?>" required>
																			</div>
																		</div>

																		<div class="col-md-6">
																			<div class="form-group">
																				<label for="city">City</label>
																				<input type="text" class="form-control" id="city" name="city" value="<?php echo $shipRow['city'] ?? ''; ?>" required>
																			</div>
																		</div>

																		<div class="col-md-6">
																			<div class="form-group">
																				<label for="state">State</label>
																				<select class="form-control state-select" name="state" required data-selected-state="<?php echo isset($shipRow['state']) ? $shipRow['state'] : ''; ?>">
																					<option value="">Select State</option>
																					<!-- Populate states dynamically -->
																				</select>
																			</div>
																		</div>

																		<div class="col-md-12">
																			<div class="form-group">
																				<label for="address">Street Address</label>
																				<input type="text" class="form-control" id="address" name="address" value="<?php echo $shipRow['address'] ?? ''; ?>" required placeholder="House number and street name">
																				<input type="text" class="form-control mt-2" id="apartment" name="apartment" value="<?php echo $shipRow['apartment'] ?? ''; ?>" placeholder="Apartment, suite, unit, etc. (optional)">
																			</div>
																		</div>

																		<div class="col-md-6">
																			<div class="form-group">
																				<label for="postcode">ZIP Code</label>
																				<input type="text" class="form-control" id="postcode" name="postcode" value="<?php echo $shipRow['postcode'] ?? ''; ?>" required>
																			</div>
																		</div>

																		<div class="col-md-6 d-flex align-items-center justify-content-end">
																			<button class="btn btn-primary mt-3" type="submit" name="update">Update
																				Address</button>
																		</div>
																	</div>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
									<?php endforeach; ?>

									<!-- Add New Shipping Address Card -->
									<?php if ($i < 3) : ?>
										<div class="col-md-12 mb-4">
											<div class="card" id="new-address-card">
												<div class="card-body">
													<div class="d-flex gap-4 align-items-center">
														<h5 style="font-size: 35px">+</h5>
														<p><strong>Add New Shipping Address</strong></p>
													</div>
													<!-- The form will be shown when clicking on this card -->
													<div class="shipping-form" id="new-address-form" style="display:none;">
														<div class="shipping-details" id="new-shipping-details">
															<!-- Radio button for the new address -->
															<div class="row">
																<div class="col-md-1">
																	<input type="radio" name="shipping-address" id="select-new-address" class="select-item" />
																</div>
																<div class="col-md-10">
																	<h5>Add New Shipping Address</h5>

																</div>
															</div>
														</div>
														<!-- New Address Form -->
														<form id="addNewShippingAddress" method="POST" enctype="multipart/form-data">
															<div class="row">
																<!-- Fields like first name, last name, etc. -->
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="new-fname">First Name</label>
																		<input type="text" class="form-control" id="new-fname" name="fname" required>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="new-lname">Last Name</label>
																		<input type="text" class="form-control" id="new-lname" name="lname" required>
																	</div>
																</div>

																<div class="col-md-6">
																	<div class="form-group">
																		<label for="new-phone">Phone</label>
																		<input type="tel" class="form-control" id="new-phone" name="phone" required>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="new-email">Email</label>
																		<input type="email" class="form-control" id="new-email" name="email" required>
																	</div>
																</div>

																<div class="col-md-6">
																	<div class="form-group">
																		<label for="new-city">City</label>
																		<input type="text" class="form-control" id="new-city" name="city" required>
																	</div>
																</div>

																<div class="col-md-6">
																	<div class="form-group">
																		<label for="state">State</label>
																		<select class="state-select form-control" id="state" name="state" required>
																			<option value="">Select State</option>
																			<!-- Populate states dynamically -->
																		</select>
																	</div>
																</div>

																<div class="col-md-12">
																	<div class="form-group">
																		<label for="new-address">Street Address</label>
																		<input type="text" class="form-control" id="new-address" name="address" required placeholder="House number and street name">
																		<input type="text" class="form-control mt-2" id="new-apartment" name="apartment" placeholder="Apartment, suite, unit, etc. (optional)">
																	</div>
																</div>

																<div class="col-md-6">
																	<div class="form-group">
																		<label for="new-postcode">ZIP Code</label>
																		<input type="text" class="form-control" id="new-postcode" name="postcode" required>
																	</div>
																</div>

																<div class="col-md-6 d-flex align-items-center justify-content-end">
																	<button class="btn btn-primary mt-3" type="submit" name="add_new_address">Add Address</button>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
									<?php endif; ?>
								</div>
							</div>
						</div>



						<div class="col-xl-5 side-bar">
							<div class="order-detail sticky-top">
								<h4 class="title m-b15">Your Order</h4>
								<table>
									<tbody>
										<div class="accordion dz-accordion accordion-sm" id="accordionFaq1">
											<?php
											$i = 0;
											$itemTotal = 0;
											$discountTotal = 0;
											$amountTotal = 0;
											$cartData = $cartItem->cartItems($_SESSION['cart_item'], $ipAddress);

											foreach ($cartData as $cartQuery) :
												$i++;
												$cartProductSql = $cartItem->getProductsDetail($cartQuery['product_id']);

												$discountInfo = calculateDiscount($cartProductSql['price'], $cartProductSql['discount']);

												$cartProductTotal = $cartQuery['quantity'] * $discountInfo['discountedPrice'];

												$itemTotal = $itemTotal + ($cartQuery['quantity'] * ($discountInfo['originalPrice']));
												$discountTotal = $discountTotal + $cartQuery['quantity'] * ($discountInfo['originalPrice'] - $discountInfo['discountedPrice']);
												$amountTotal = $amountTotal + $cartProductTotal;


											?>
												<div class="accordion-item  ">
													<div class="accordion-header" id="heading2">
														<div class="accordion-button collapsed custom-control custom-checkbox border-0" data-bs-toggle="collapse" data-bs-target="#collapse2" role="navigation" aria-expanded="true" aria-controls="collapse2">

															<img src="adminuploads/products/<?php echo $cartProductSql['image']; ?>" alt="" style="width:80px">

															<div>
																<a href="product-detail.php?id=<?php echo base64_encode($cartQuery['product_id']) ?>">
																	<p class="fs-7 mb-0">
																		<?php echo $cartProductSql['name']; ?>
																	</p>
																</a>
																<p class="fs-7 mb-0 input-quantity">Quantity :
																	<?php echo $cartQuery['quantity']; ?>
																</p>
																<p class="fs-7 mb-0">Price: ₹
																	<?php echo $discountInfo['discountedPrice']; ?>
																</p>
															</div>
														</div>
													</div>
												</div>
											<?php
											endforeach;
											?>
										</div>
										<!-- <tr class="subtotal border-0">
											<td>Subtotal</td>
											<td class="price">₹100</td>
										</tr> -->
										<tr class="total">
											<td>Total</td>
											<td class="price">₹ <?php echo $amountTotal; ?></td>
										</tr>
									</tbody>
								</table>



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
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
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
		$(document).ready(function() {
			// When any radio button is clicked
			$("input[name='shipping-address']").on("change", function() {
				var index = $(this).closest('.shipping-details').data('index');

				$(".shipping-form").hide();
				$(".shipping-details").fadeIn();

				// Hide all edit buttons
				$(".edit-btn").hide();
				$(".delivery-btn").hide();
				if ($(this).closest('.shipping-details').find('.shipping-form').length) {
					$(this).closest('.shipping-details').find('.shipping-form').fadeIn(500);
				}

				$("#edit-btn-" + index).show();

				$("#delivery-btn-" + index).show();

				$("#new-address-form").hide();
			});

			if ($("input[name='shipping-address']:checked").length > 0) {
				var selectedIndex = $("input[name='shipping-address']:checked").closest('.shipping-details').data('index');
				$("#edit-btn-" + selectedIndex).show();
				$("#delivery-btn-" + selectedIndex).show();
			}

			$(".edit-btn").on("click", function() {
				var formTarget = $(this).data("target");
				var detailsTarget = $(this).data("details");

				$(detailsTarget).fadeOut(300, function() {
					$(formTarget).fadeIn(500);
				});
			});

			$(".card-body").on("click", function() {
				var radioButton = $(this).find("input[name='shipping-address']");
				if (!radioButton.is(":checked")) {
					radioButton.prop("checked", true).change();
				}
			});

			$("#new-address-card").on("click", function() {
				$(".shipping-form").hide();

				$("#new-address-form").toggle();

				$(this).find(".d-flex").show();
			});

			$("#new-address-form").on("show", function() {
				$("#new-address-card .card-body .d-flex").hide();
			});
		});
	</script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			const checkbox = document.getElementById('basic_checkbox_3');
			const proceedButton = document.getElementById('proceed-button');

			function toggleButtonState() {
				if (checkbox.checked) {
					proceedButton.disabled = false; // Enable the button if checkbox is checked
				} else {
					proceedButton.disabled = true; // Disable the button if checkbox is unchecked
				}
			}
			checkbox.addEventListener('change', toggleButtonState);
			toggleButtonState();
		});
	</script>

	<script>
		$(document).ready(function() {
			// Initialize form validation
			$('#updateForm').validate({
				rules: {
					fname: {
						required: true,
						minlength: 2
					},
					lname: {
						required: true,
						minlength: 2
					},
					phone: {
						required: true
					},
					email: {
						required: true,
						email: true
					},
					city: {
						required: true,
						minlength: 3
					},
					state: {
						required: true
					},
					address: {
						required: true,
						minlength: 5
					},
					postcode: {
						required: true,
						digits: true,
						minlength: 6,
						maxlength: 6
					}
				},
				messages: {
					fname: {
						required: "Please enter your first name",
						minlength: "Your first name must be at least 2 characters long"
					},
					lname: {
						required: "Please enter your last name",
						minlength: "Your last name must be at least 2 characters long"
					},
					phone: {
						required: "Please enter your phone number",
						phoneUS: "Please enter a valid phone number"
					},
					email: {
						required: "Please enter your email",
						email: "Please enter a valid email address"
					},
					city: {
						required: "Please enter your city",
						minlength: "Your city must be at least 3 characters long"
					},
					state: {
						required: "Please select a state"
					},
					address: {
						required: "Please enter your street address",
						minlength: "Your street address must be at least 5 characters long"
					},
					postcode: {
						required: "Please enter your ZIP code",
						digits: "Please enter a valid ZIP code",
						minlength: "Your ZIP code must be at least 6 digits long",
						maxlength: "Your ZIP code must not exceed 6 digits"
					}
				},
				errorElement: "div", // Error message element
				errorPlacement: function(error, element) {
					error.addClass("invalid-feedback");
					error.insertAfter(element);
				},
				highlight: function(element) {
					$(element).addClass("is-invalid");
				},
				unhighlight: function(element) {
					$(element).removeClass("is-invalid");
				}
			});
		});
	</script>

	<script>
		$(document).ready(function() {
			// Initialize form validation
			$('#addNewShippingAddress').validate({
				rules: {
					fname: {
						required: true,
						minlength: 2
					},
					lname: {
						required: true,
						minlength: 2
					},
					phone: {
						required: true,
						phoneUS: true
					},
					email: {
						required: true,
						email: true
					},
					city: {
						required: true,
						minlength: 3
					},
					state: {
						required: true
					},
					address: {
						required: true,
						minlength: 5
					},
					postcode: {
						required: true,
						digits: true,
						minlength: 6,
						maxlength: 6
					}
				},
				messages: {
					fname: {
						required: "Please enter your first name",
						minlength: "Your first name must be at least 2 characters long"
					},
					lname: {
						required: "Please enter your last name",
						minlength: "Your last name must be at least 2 characters long"
					},
					phone: {
						required: "Please enter your phone number",
						phoneUS: "Please enter a valid phone number"
					},
					email: {
						required: "Please enter your email",
						email: "Please enter a valid email address"
					},
					city: {
						required: "Please enter your city",
						minlength: "Your city must be at least 3 characters long"
					},
					state: {
						required: "Please select a state"
					},
					address: {
						required: "Please enter your street address",
						minlength: "Your street address must be at least 5 characters long"
					},
					postcode: {
						required: "Please enter your ZIP code",
						digits: "Please enter a valid ZIP code",
						minlength: "Your ZIP code must be at least 6 digits long",
						maxlength: "Your ZIP code must not exceed 6 digits"
					}
				},
				errorElement: "div", // Error message element
				errorPlacement: function(error, element) {
					error.addClass("invalid-feedback");
					error.insertAfter(element);
				},
				highlight: function(element) {
					$(element).addClass("is-invalid");
				},
				unhighlight: function(element) {
					$(element).removeClass("is-invalid");
				}
			});
		});
	</script>
	<script>
    $(document).ready(function() {
        // When the form is submitted
        $('#deliveryForm').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            var formData = new FormData(this); // Create a FormData object from the form

            $.ajax({
                url: 'update-shipping.php',  // Specify your action URL here
                type: 'POST',
                data: formData,
                processData: false,  // Don't process the files
                contentType: false,  // Let jQuery handle the content type
                success: function(response) {
                    // // Handle the server response
                    // console.log(response); // You can update the page or show a success message
                    // // Example: show a success alert
                    // alert('Form submitted successfully!');
					var res = JSON.parse(response);

					if (res.success) {
						alert(res.success);  // Show success message
					} else if (res.error) {
						alert(res.error);  // Show error message
					}
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error("Submission failed: " + error);
                    alert('There was an error submitting the form!');
                }
            });
        });
    });
</script>

<!-- <script>
	$(document).ready(function() {
    // When the form is submitted
    $('#deliveryForm').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        var formData = new FormData(this); // Create a FormData object from the form

        $.ajax({
            url: 'update-shipping.php',  // Specify your action URL here
            type: 'POST',
            data: formData,
            processData: false,  // Don't process the files
            contentType: false,  // Let jQuery handle the content type
            success: function(response) {
                // Parse the response JSON to handle success or error messages
                var res = JSON.parse(response);

                if (res.success) {
                    alert(res.success);  // Show success message
                } else if (res.error) {
                    alert(res.error);  // Show error message
                }
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error("Submission failed: " + error);
                alert('There was an error submitting the form!');
            }
        });
    });
});

</script> -->




</body>

</html>