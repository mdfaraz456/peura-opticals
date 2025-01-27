<?php
if (!isset($_SESSION)) {
  session_start();
}
error_reporting(E_ALL);
if (isset($_SESSION['Login_Page'])) {
	unset($_SESSION['Login_Page']);
  header("Location: cart.php");
}
require "config/config.php";
require "config/authentication.php";
require_once 'config/common.php';

$orderdetails=new OrderPage();

$conn = new dbClass();

$auth = new Authentication();
$product=new Products();
$variableForCartAndBuyNow=false;

$id = isset($_REQUEST['id']) ? base64_decode($_REQUEST['id']) : NULL;
if($id==NULL){
	header('location: index.php');

}
$order=$orderdetails->getOrderById($id);
$orderproducts=$orderdetails->getProductOrderDetailsById($id);
// var_dump($orderproducts);




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
					<h1>Order Details</h1>
					<nav aria-label="breadcrumb" class="breadcrumb-row">
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php"> Home</a></li>
							<li class="breadcrumb-item">Order Details</li>
						</ul>
					</nav>
				</div>
			</div>	
		</div>
		<!--Banner End-->

			<section class="content-inner shop-account">
				<!-- Product -->
				<div class="container">
        
					<div class="row justify-content-center">
						<div class="col-lg-8">
              <h3 class="mb-4">Order Id : #9217661176</h3>
							<div class="table-responsive">
								<table class="table check-tbl">
									<thead>
										<tr>
											<th>Products</th>
											<th></th>
											<th>Price</th>
											<th>Quantity</th>
											<th>Subtotal</th>
											<!-- <th></th> -->
										</tr>
									</thead>
									<tbody >
									<?php 
                        $total=0;
                        foreach ($orderproducts as $row):	
                          $product_id = (int) $row['product_id'];

                          $productData=$product->getProdcutsById($product_id);
                          // var_dump($row);
                          $total = $total + $row['product_total_price'];
                    
                    ?>
										<tr class="custom-border-radius">
                    <?php if (!empty($productData['image'])): ?>
												<td class="product-item-img"><img src="adminuploads/products/<?php echo $productData['image']; ?>" alt="product_thumbnail"></td>
											<?php endif; ?>
											<td class="product-item-name">
                        <a href="product-detail.php?id=<?php echo base64_encode($row['product_id']) ?>"><?php echo $row['product_name']; ?></a>
                      </td>
											
											<td class="product-item-price">
                        ₹<?php echo $row['product_price']; ?>
											</td>
											<td class="product-item-quantity" data-title="Quantity">
												<p><?php echo $row['product_quantity']; ?></p>
                    </td>
											<td class="product-item-totle">
												₹ <?php echo $row['product_total_price']; ?>
											</td>
                      
										</tr>
										<?php
											endforeach;
										?>
                    <tr>
                      <td colspan="4">
                        <Strong>Total Amount</Strong>
                      </td>
                      <td><strong>₹ <?php echo $total; ?></strong></td>
                    </tr>
									</tbody>
								</table>
						</div>
            </div>
					</div>
          
				</div>
				</div>
				<!-- Product END -->
			</section>
		
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
<!-- <script src="js/main.js"></script> -->
<script src="js/custom.min.js"></script><!-- CUSTOM JS -->





<!-- <script>
    document.addEventListener('DOMContentLoaded', () => {
      const minusButtons = document.querySelectorAll('.minus-button');
      const plusButtons = document.querySelectorAll('.plus-button');
      const quantityInputs = document.querySelectorAll('.input-quantity');
      const discountPriceSpans = document.querySelectorAll('.disPrice');
      const totalAmountSpan = document.querySelector('.totalAmount');
      const totalDiscountSpan = document.querySelector('.totalDiscount'); // Add a span to display the total discount
      const userId = '<?php echo $_SESSION['cart_item']; ?>';

      // Function to get the current discounted price
      function getDiscountedPrice(discountPriceSpan) {
        return parseFloat(discountPriceSpan.getAttribute('data-discounted-price'));
      }

      // Function to get the original price
      function getOriginalPrice(discountPriceSpan) {
        return parseFloat(discountPriceSpan.getAttribute('data-original-price'));
      }
      
      // Function to update the total price for a specific product
      function updateProductSubtotal(quantityInput, discountPriceSpan) {
        const quantity = parseInt(quantityInput.value, 10);
        if (isNaN(quantity) || quantity < 1) {
          quantityInput.value = 1;
          return 0; // Avoid negative subtotal
        }
        const discountedPrice = getDiscountedPrice(discountPriceSpan);
        const productSubtotal = quantity * discountedPrice;
        
        // Find the corresponding subtotal span for this product
        const subtotalSpan = quantityInput.closest('tr').querySelector('.product-subtotal');
        if (subtotalSpan) {
          subtotalSpan.textContent = `${productSubtotal.toFixed(2)}`; // Display subtotal
        }
        return productSubtotal;
      }

      // Function to update the total amount for all products
      function updateOverallTotal() {
        let totalAmount = 0;
        quantityInputs.forEach((input, index) => {
          const quantity = parseInt(input.value, 10);
          const discountedPrice = getDiscountedPrice(discountPriceSpans[index]);
          totalAmount += quantity * discountedPrice;
        });
        totalAmountSpan.textContent = `${totalAmount.toFixed(2)}`; // Correctly interpolate the totalAmount
      }

      // Function to calculate and update the total discount for the cart
      function updateTotalDiscount() {
        let totalDiscount = 0;
        quantityInputs.forEach((input, index) => {
          const quantity = parseInt(input.value, 10);
          const originalPrice = getOriginalPrice(discountPriceSpans[index]);
          const discountedPrice = getDiscountedPrice(discountPriceSpans[index]);
          
          // Calculate the discount for this product
          const discountPerProduct = (originalPrice - discountedPrice) * quantity;
          totalDiscount += discountPerProduct;
        });
        
        // Update the total discount display
        if (totalDiscountSpan) {
          totalDiscountSpan.textContent = `${totalDiscount.toFixed(2)}`;
        }
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
          const productSubtotal = updateProductSubtotal(quantityInputs[index], discountPriceSpans[index]);
          updateOverallTotal();
          updateTotalDiscount(); // Update total discount
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
          const productSubtotal = updateProductSubtotal(quantityInputs[index], discountPriceSpans[index]);
          updateOverallTotal();
          updateTotalDiscount(); // Update total discount
          const productId = quantityInputs[index].closest('tr').querySelector('[data-pro-id]').getAttribute('data-pro-id');
          const cartId = quantityInputs[index].closest('tr').querySelector('[data-cart-id]').getAttribute('data-cart-id');
          updateCart(userId, productId, newQuantity, cartId); // Call AJAX function
          // Log updated values
          console.log('Quantity Increased:', newQuantity);
          console.log('Product ID:', productId);
          console.log('User ID:', userId);
          console.log('Cart ID:', cartId);
        });
      });

      // Initialize total price for all products
      updateOverallTotal();
      
      // Initialize the subtotals for each product
      quantityInputs.forEach((input, index) => {
        updateProductSubtotal(input, discountPriceSpans[index]);
      });

      // Initialize the total discount
      updateTotalDiscount();
    });
</script> -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
      const minusButtons = document.querySelectorAll('.minus-button');
      const plusButtons = document.querySelectorAll('.plus-button');
      const quantityInputs = document.querySelectorAll('.input-quantity');
      const discountPriceSpans = document.querySelectorAll('.disPrice');
      const totalAmountSpans = document.querySelectorAll('.totalAmount'); // Get all totalAmount spans
      const totalDiscountSpan = document.querySelector('.totalDiscount'); // Add a span to display the total discount
      const userId = '<?php echo $_SESSION['cart_item']; ?>';

      // Function to get the current discounted price
      function getDiscountedPrice(discountPriceSpan) {
        return parseFloat(discountPriceSpan.getAttribute('data-discounted-price'));
      }

      // Function to get the original price
      function getOriginalPrice(discountPriceSpan) {
        return parseFloat(discountPriceSpan.getAttribute('data-original-price'));
      }
      
      // Function to update the total price for a specific product
      function updateProductSubtotal(quantityInput, discountPriceSpan) {
        const quantity = parseInt(quantityInput.value, 10);
        if (isNaN(quantity) || quantity < 1) {
          quantityInput.value = 1;
          return 0; // Avoid negative subtotal
        }
        const discountedPrice = getDiscountedPrice(discountPriceSpan);
        const productSubtotal = quantity * discountedPrice;
        
        // Find the corresponding subtotal span for this product
        const subtotalSpan = quantityInput.closest('tr').querySelector('.product-subtotal');
        if (subtotalSpan) {
          subtotalSpan.textContent = `${productSubtotal.toFixed(2)}`; // Display subtotal
        }
        return productSubtotal;
      }

      // Function to update the total amount for all products
      function updateOverallTotal() {
        let totalAmount = 0;
        quantityInputs.forEach((input, index) => {
          const quantity = parseInt(input.value, 10);
          const discountedPrice = getDiscountedPrice(discountPriceSpans[index]);
          totalAmount += quantity * discountedPrice;
        });
        
        // Update all totalAmount spans
        totalAmountSpans.forEach(span => {
          span.textContent = `${totalAmount.toFixed(2)}`; // Update the content of each totalAmount span
        });
      }

      // Function to calculate and update the total discount for the cart
      function updateTotalDiscount() {
        let totalDiscount = 0;
        quantityInputs.forEach((input, index) => {
          const quantity = parseInt(input.value, 10);
          const originalPrice = getOriginalPrice(discountPriceSpans[index]);
          const discountedPrice = getDiscountedPrice(discountPriceSpans[index]);
          
          // Calculate the discount for this product
          const discountPerProduct = (originalPrice - discountedPrice) * quantity;
          totalDiscount += discountPerProduct;
        });
        
        // Update the total discount display
        if (totalDiscountSpan) {
          totalDiscountSpan.textContent = `${totalDiscount.toFixed(2)}`;
        }
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
          const productSubtotal = updateProductSubtotal(quantityInputs[index], discountPriceSpans[index]);
          updateOverallTotal();
          updateTotalDiscount(); // Update total discount
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
          const productSubtotal = updateProductSubtotal(quantityInputs[index], discountPriceSpans[index]);
          updateOverallTotal();
          updateTotalDiscount(); // Update total discount
          const productId = quantityInputs[index].closest('tr').querySelector('[data-pro-id]').getAttribute('data-pro-id');
          const cartId = quantityInputs[index].closest('tr').querySelector('[data-cart-id]').getAttribute('data-cart-id');
          updateCart(userId, productId, newQuantity, cartId); // Call AJAX function
          // Log updated values
          console.log('Quantity Increased:', newQuantity);
          console.log('Product ID:', productId);
          console.log('User ID:', userId);
          console.log('Cart ID:', cartId);
        });
      });

      // Initialize total price for all products
      updateOverallTotal();
      
      // Initialize the subtotals for each product
      quantityInputs.forEach((input, index) => {
        updateProductSubtotal(input, discountPriceSpans[index]);
      });

      // Initialize the total discount
      updateTotalDiscount();
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
  <script type="text/javascript">
    // Check if USER_CHECKOUT session is set in PHP and pass it to JS
    var isUserCheckout = <?php echo isset($_SESSION['USER_CHECKOUT']) ? 'true' : 'false'; ?>;
    
    // If the session variable is set, hide the div with class "to-hide"
    if (isUserCheckout) {
        document.querySelector('.to-hide').style.display = 'none';
    }
</script>


</body>
</html>