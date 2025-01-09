<?php
if (!isset($_SESSION)) {
  session_start();
}
error_reporting(E_ALL);
require "config/config.php";
require_once 'config/cart.php';

$conn = new dbClass();
$cartItem = new Cart();
$ipAddress = $_SERVER["REMOTE_ADDR"];

$cartSqlCount = $cartItem->cartCount($_SESSION['cart_item'], $ipAddress);
$cartTotalCount = $cartSqlCount['CartCount'];

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
	<link rel="canonical" href="cart.php">
	
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
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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
		<div class="dz-bnr-inr bg-secondary overlay-black-light" style="background-image:url('https://chashma.com/cdn/shop/files/New_Accessories.png?v=1706692918&width=1500'); margin-top: 5rem;">
			<div class="container">
				<div class="dz-bnr-inr-entry">
					<h1>Shop Cart</h1>
					<nav aria-label="breadcrumb" class="breadcrumb-row">
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php"> Home</a></li>
							<li class="breadcrumb-item">Shop Cart</li>
						</ul>
					</nav>
				</div>
			</div>	
		</div>
		<!--Banner End-->

		
		<!-- contact area -->
		<?php if($cartTotalCount > 0): ?>
			<section class="content-inner shop-account">
				<!-- Product -->
				<div class="container">
					<div class="row">
						<div class="col-lg-8">
							<div class="table-responsive">
								<table class="table check-tbl">
									<thead>
										<tr>
											<th>Product</th>
											<th></th>
											<th>Price</th>
											<th>Quantity</th>
											<th>Subtotal</th>
											<th></th>
										</tr>
									</thead>
									<tbody >
									<?php
											$i = 0;
											$itemTotal = 0;
											$discountTotal = 0;
											$amountTotal = 0;
											$cartData = $cartItem->cartItems($_SESSION['cart_item'], $ipAddress);

											foreach ($cartData as $cartQuery):
												$i++;
												$cartProductSql = $cartItem->getProductsDetail($cartQuery['product_id']);

												$discountInfo = calculateDiscount($cartProductSql['price'], $cartProductSql['discount']);

												$cartProductTotal = $cartQuery['quantity'] * $discountInfo['discountedPrice'];

												$itemTotal = $itemTotal + ($cartQuery['quantity'] * ($discountInfo['originalPrice']));
												$discountTotal = $discountTotal + $cartQuery['quantity'] * ($discountInfo['originalPrice'] - $discountInfo['discountedPrice']);
												$amountTotal = $amountTotal + $cartProductTotal;

											?>
										<tr class="custom-border-radius">
											<?php if (!empty($cartProductSql['image'])): ?>
												<td class="product-item-img"><img src="adminuploads/products/<?php echo $cartProductSql['image']; ?>" alt="product_thumbnail"></td>
											<?php endif; ?>
											<a href="product-detail.php?id=<?php echo base64_encode($cartQuery['product_id']) ?>">
												<td class="product-item-name"><?php echo $cartProductSql['name']; ?></td>
											</a>
											<td class="product-item-price">
												<span class="disPrice" data-discounted-price="<?php echo $discountInfo['discountedPrice']; ?>">
												₹ <?php echo $discountInfo['discountedPrice']; ?>
												</span>
											</td>
											<td class="product-item-quantity" data-title="Quantity">
												<div class="quantity btn-quantity style-1 me-3">
													<div class="quantity-box">
														<button type="button" class="minus-button">
															<i class="fal fa-minus"></i>
														</button>
															<input type="text" class="input-qty qtyValue" id="quantityNumber" name="quantity" value="<?php echo $cartQuery['quantity']; ?>">
														<button type="button" class="plus-button">
															<i class="fal fa-plus"></i>
														</button>
													</div>

												</div>
												
												<input type="hidden" data-cart-id="<?php echo $cartQuery['cart_id']; ?>" value="<?php echo $cartQuery['cart_id']; ?>">
												<input type="hidden" data-pro-id="<?php echo $cartQuery['product_id']; ?>" value="<?php echo $cartQuery['product_id']; ?>">
											</td>
											<td class="product-item-totle">
												₹<span class="subtotal"></span>
											</td>
											<td class="product-item-close">
												<a href="javascript:void(0);">
												<button class="btn btn-outline-danger btn-sm removeCart" type="button"
													data-product-id="<?php echo $cartQuery['product_id']; ?>"
													data-cart-id="<?php echo $cartQuery['cart_id']; ?>">
													<i class="bi bi-trash-fill"></i>
													</button>
												</a></td>
										</tr>
										<?php
											endforeach;
										?>
									</tbody>
								</table>
							</div>
							<div class="row shop-form m-t30">
								<div class="col-md-6">
									<!-- <div class="form-group">
										<div class="input-group mb-0">
											<input name="dzEmail" required="required" type="text" class="form-control" placeholder="Coupon Code">
											<div class="input-group-addon">
												<button name="submit" value="Submit" type="submit" class="btn coupon">
													Apply Coupon
												</button>
											</div>
										</div>
									</div> -->
								</div>
								<div class="col-md-6 text-end">
									<a href="cart.php" class="btn btn-secondary">UPDATE CART</a>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<h4 class="title mb15 text-center">Cart Total</h4>
							<div class="cart-detail">
								<!-- <a href="javascript:void(0);" class="btn btn-outline-secondary w-100 m-b20">Bank Offer 5% Cashback</a> -->
								<div class="icon-bx-wraper style-4 m-b15">

								<div class="icon-content" id="icon-content">
								<div class="d-flex justify-content-between align-items-center mb-2">
									<span class="text-start">Subtotal (2 items)</span>
									<span class="text-end fw-bold">₹. <span class="totalAmount"></span></span>
								</div>
								<div class="d-flex justify-content-between align-items-center mb-2">
									<span class="text-start">GST</span>
									<span class="text-end fw-bold">5%</span>
								</div>
								<div class="d-flex justify-content-between align-items-center">
									<span class="text-start">Shipping</span>
									<span class="text-end text-success fw-bold">FREE</span>
								</div>

								
							</div>
							
								</div>
			
	
								<div class="save-text">
									<i class="icon feather icon-check-circle"></i>
									<span class="m-l10">You will save ₹504 on this order</span>
								</div>
							
								<table>
									<tbody>
									<tr class="total">
											<td>
												<h5>Shipping Address</h5>
												<input type="checkbox" id="select-item" />
												<label for="select-item" style="margin-left: 8px; vertical-align: top;">
													<p class="mb-0">Name</p>
													<p style="margin: 0;">Mobile: 1234567890</p>
													<p style="margin: 0;">Address: 123, Main Street, City</p>
												</label>
											</td>
											<td class="price" style=" vertical-align: top;">
									
												<button style="background: none; border: none; cursor: pointer; margin-left: 10px; " title="Edit shipping Address">
													<a href="shop-checkout.php"><i class="fas fa-edit" style="font-size: 16px;"></i></a>
												</button>
											</td>
										</tr>
										<tr class="total">
											<td>
												<h6 class="mb-0">Total</h6>
											</td>
											<td class="price">
												₹14,348
											</td>
										</tr>
									</tbody>
								</table>
								<a href="shop-checkout.php" class="btn btn-secondary w-100">PLACE ORDER</a>
							</div>
							<!-- <div class="row  border-top border-bottom mt-5">
								<div class="col p-2  border-end d-flex justify-content-center align-items-center gap-3">
									<i class="fa fa-inr fs-2"></i>
									<p class="mb-0">Best price<br>guarantee</p>
								</div>
								<div class="col p-2 d-flex justify-content-center align-items-center gap-3">
									<i class="bi fs-2 bi-arrow-clockwise"></i>
									<p class="mb-0">100 day <br>returns</p>
								</div>
							</div> -->
						</div>
					</div>
				</div>
				<!-- Product END -->
			</section>
		<?php endif; ?>
		<!-- contact area End--> 

	</div>
	
	
	<!-- Footer -->
	<?php include("include/footer.php"); ?>
	<!-- Footer End -->
	<button class="scroltop" type="button"><i class="fas fa-arrow-up"></i></button>

</div>
 
<!-- JAVASCRIPT FILES ========================================= -->
<!-- <script src="js/jquery.min.js"></script> -->
<!-- JQUERY MIN JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
<script src="js/main.js"></script>
<script src="js/custom.min.js"></script><!-- CUSTOM JS -->



<script>
  	document.addEventListener('DOMContentLoaded', () => {
    const minusButtons = document.querySelectorAll('.minus-button');
    const plusButtons = document.querySelectorAll('.plus-button');
    const quantityInputs = document.querySelectorAll('.input-quantity');
    const discountPriceSpan = document.querySelectorAll('.disPrice');
    const totalAmountSpan = document.querySelector('.totalAmount');
    const userId = '<?php echo $_SESSION['cart_item']; ?>';
    const subtotalSpans = document.querySelectorAll('.subtotal'); // Add this line to select the subtotal spans

    // Function to get the current discounted price
    function getDiscountedPrice(discountPriceSpan) {
      return parseFloat(discountPriceSpan.getAttribute('data-discounted-price'));
    }

    // Function to update the subtotal for a single product
    function updateProductSubtotal(quantityInput, discountPriceSpan, subtotalSpan) {
      const quantity = parseInt(quantityInput.value, 10);
      if (isNaN(quantity) || quantity < 1) {
        quantityInput.value = 1;
        return;
      }
      const discountedPrice = getDiscountedPrice(discountPriceSpan);
      const subtotal = quantity * discountedPrice;
      subtotalSpan.textContent = `${subtotal.toFixed(2)}`; // Update the subtotal for this product
    }

    // Function to update the total amount for all products
    function updateOverallTotal() {
      let totalAmount = 0;
      quantityInputs.forEach((input, index) => {
        const quantity = parseInt(input.value, 10);
        const discountedPrice = getDiscountedPrice(discountPriceSpans[index]);
        totalAmount += quantity * discountedPrice;
        
        // Update the subtotal for each product
        updateProductSubtotal(input, discountPriceSpans[index], subtotalSpans[index]);
      });
      totalAmountSpan.textContent = `${totalAmount.toFixed(2)}`; // Correctly interpolate the totalAmount
    }

    // Function to update the cart via AJAX
    function updateCart(userId, product_id, product_quantity, cart_id) {
      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'ajax-cart.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      xhr.onload = function() {
        if (xhr.status === 200) {
          console.log('Server Response:', xhr.responseText);
        } else {
          console.error('Error updating cart');
        }
      };

      // Send updated data with new parameter names
      xhr.send(`user_id=${userId}&product_id=${product_id}&product_quantity=${product_quantity}&cart_id=${cart_id}`);
    }

    // Add event listeners to all minus buttons
    minusButtons.forEach((minusButton, index) => {
      minusButton.addEventListener('click', () => {
        let quantity = parseInt(quantityInputs[index].value, 10);
        if (isNaN(quantity) || quantity <= 1) return;
        quantityInputs[index].value = quantity - 1;
        const newQuantity = quantity - 1;
        updateOverallTotal();
        const productId = quantityInputs[index].closest('tr').querySelector('[data-pro-id]').getAttribute('data-pro-id');
        const cartId = quantityInputs[index].closest('tr').querySelector('[data-cart-id]').getAttribute('data-cart-id');
        updateCart(userId, productId, newQuantity, cartId); // Call AJAX function
        // Log updated values
        console.log('Quantity Decreased:', newQuantity);
        console.log('Product ID:', productId);
        console.log('User ID:', userId);
        console.log('Cart ID:', cartId);
      });
    });

    // Add event listeners to all plus buttons
    plusButtons.forEach((plusButton, index) => {
      plusButton.addEventListener('click', () => {
        let quantity = parseInt(quantityInputs[index].value, 10);
        if (isNaN(quantity)) quantity = 0;
        quantityInputs[index].value = quantity + 1;
        const newQuantity = quantity + 1;
        updateOverallTotal();
        const productId = quantityInputs[index].closest('tr').querySelector('[data-pro-id]').getAttribute('data-pro-id');
        const cartId = quantityInputs[index].closest('tr').querySelector('[data-cart-id]').getAttribute('data-cart-id');
        updateCart(userId, productId, newQuantity, cartId); // Call AJAX function
        // Log updated values
        console.log('Quantity Increased:', newQuantity);
        console.log('Product ID:', productId);
        console.log('user ID:', userId);
        console.log('Cart ID:', cartId);
      });
    });

    // Initialize total price for all products
    updateOverallTotal();
  });
</script>



  <script>
    $(document).ready(function () {        
      $('.removeCart').click(function () {
        var action = 'deleteCartItem';
        var productId = $(this).data('product-id');
        var productCartId = $(this).data('cart-id');
        $.ajax({
          type: 'POST',
          url: 'ajax-cart.php',
          data: { deleteCartItem: action, productId: productId, productCartId: productCartId },
          success: function (data) {
            window.location.reload();
          },
          error: function (xhr, status, error) {
            console.error('AJAX Error:', status, error);
          }
        });
      });      
    });
  </script>
    <script>
    $(document).ready(function() {
        shopquantity(); // Call the function when document is ready

        function shopquantity() {
            // Decrease quantity
            $('.minus-button').on('click', function (e) {
                e.preventDefault();
                var $this = $(this);
                var $input = $this.closest('.quantity-box').find('.input-qty');
                var value = parseInt($input.val());
                if (value > 1) {
                    value = value - 1;
                } else {
                    value = 1; // Set the minimum value to 1
                }
                $input.val(value);
            });

            // Increase quantity
            $('.plus-button').on('click', function (e) {
                e.preventDefault();
                var $this = $(this);
                var $input = $this.closest('.quantity-box').find('.input-qty');
                var value = parseInt($input.val());
                if (value < 100) { // You can change the max limit here (100 is just an example)
                    value = value + 1;
                } else {
                    value = 100; // Set the maximum value to 100
                }
                $input.val(value);
            });
        }
    });
</script>

</body>
</html>