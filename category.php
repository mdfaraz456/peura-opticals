﻿<?php
if (!isset($_SESSION)) {
	session_start();
}
error_reporting(E_ALL);
require "config/config.php";
require 'config/functions.php';
require 'config/common.php';

$conn = new dbClass();
$categories = new Categories();
$productTypes = new ProductType();
unset($_SESSION['USER_CHECKOUT']);
$variableForCartAndBuyNow=false;

// Get category and page from the request
$category = isset($_REQUEST['category']) ? base64_decode($_REQUEST['category']) : NULL;
$productType = isset($_GET['product_type']) ? (int)$_GET['product_type'] : NULL;

// Category query (fetching category details)
$categoryQuery = $categories->getCategories($category);
$categoryId = $categoryQuery['id'];
$query= $categories->getCategoryPageProducts($categoryId,$productType);




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
	<link rel="canonical" href="index.html">

	<!-- FAVICONS ICON -->
	<!-- <link rel="icon" type="image/x-icon" href="images/favicon.png"> -->

	<!-- MOBILE SPECIFIC -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

	<!-- STYLESHEETS -->
	<link rel="stylesheet" type="text/css" href="icons/iconly/index.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/magnific-popup/magnific-popup.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/swiper/swiper-bundle.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/nouislider/nouislider.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/lightgallery/dist/css/lightgallery.css">
	<link rel="stylesheet" type="text/css" href="vendor/lightgallery/dist/css/lg-thumbnail.css">
	<link rel="stylesheet" type="text/css" href="vendor/lightgallery/dist/css/lg-zoom.css">
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">

	<!-- Custom Stylesheet -->
	<link class="main-css" rel="stylesheet" type="text/css" href="css/style.css">
	<link class="skin" type="text/css" rel="stylesheet" href="css/skin/skin-1.css">

	<!-- GOOGLE FONTS-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
	<link href="../css2?family=DM+Sans:wght@400;500;700&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
	<!-- Include Magnific Popup Library -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

	<!-- hero-preload-images -->
	<link rel="preload" href="https://img.freepik.com/free-vector/summer-sale-pink-banner_74855-525.jpg?t=st=1734497535~exp=1734501135~hmac=3e5997d75b33b02d4201f5a211865b6a136c168fecc964178038f7efa5c8095b&w=826" as="image">
	<link rel="preload" href="https://img.freepik.com/free-vector/summer-sale-blue-banner_74855-506.jpg?t=st=1734497594~exp=1734501194~hmac=6c2334d91041692977d8fefdc93761c6dc8d8d98ce32978ea7cf3e801210330e&w=826" as="image">
	<link rel="preload" href="https://img.freepik.com/free-vector/summer-sale-green-banner_74855-507.jpg?t=st=1734497649~exp=1734501249~hmac=7a7d760120993918644063d86df162d1a412d7366128e10bf33dfa4d438b6e8c&w=826" as="image">

</head>

<body>
	<div class="page-wraper">

		<div id="loading-area" class="preloader-wrapper-4">
			<img src="images/loading.gif" alt="">
		</div>

		<!-- Header Star -->
		<?php include("include/header.php"); ?>
		<!-- Header End -->

		<div class="page-content">
			<!--Banner Start-->
			<div class="dz-bnr-inr bg-secondary overlay-black-light" style="background-image:url('https://chashma.com/cdn/shop/files/New_Accessories.png?v=1706692918&width=1500'); margin-top: 5rem;">
				<div class="container">
					<div class="dz-bnr-inr-entry">
						<h1><?php echo htmlspecialchars($categoryQuery['name']); ?></h1>
						<nav aria-label="breadcrumb" class="breadcrumb-row">
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html"> Home</a></li>
								<li class="breadcrumb-item"><?php echo htmlspecialchars($categoryQuery['name']); ?></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
			<!--Banner End-->

			<section class="content-inner-3 pt-3 z-index-unset">
				<div class="container-fluid">
					
					<div class="row">
						<div class=" col-12">

							<div class="filter-wrapper">
								<div class="filter-left-area">								
									<span id="range-display">Showing 1–5 of 50 results</span>
								
								</div>
								<div class="form-group">
									<select id="product-type-filter" class="styled-dropdown" style=" width: 200px; border: 1px solid rgba(0, 0, 0, 0.3); border-radius:.3rem ;">
										<option value="">Select Type</option>
										<?php
										$sqlTypeQuery = $productTypes->getProductType();
										foreach ($sqlTypeQuery as $sqlTypeRow) : ?>

											<option value="<?php echo $sqlTypeRow['id']; ?>"><?php echo $sqlTypeRow['name']; ?></option>

										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
					</div>
					

					<div class="row">
						<div class="col-12 tab-content shop-" id="pills-tabContent">
							<div class="tab-pane fade active show" id="tab-list-grid" role="tabpanel" aria-labelledby="tab-list-grid-btn">
								<div class="row gx-xl-4 g-3">
								<?php foreach ($query as $ProRow) :
										$discountInfo = calculateDiscount($ProRow['price'], $ProRow['discount']); 
										$productTypeIds = $ProRow['product_type_ids'];
										$productTypesArray = explode(',', $productTypeIds);
									?>
										<div class="col-6 col-xl-3 col-lg-4 col-md-4 col-sm-6 m-md-b15 m-b30 ajPagination" data-product-type="<?php echo htmlspecialchars(implode(',', $productTypesArray)); ?>">
											<div class="shop-card style-1">
												<div class="dz-media" id="dz-img">
													<img class="img-dz" src="adminuploads/products/<?php echo htmlspecialchars($ProRow['image']); ?>" alt="image">
													<div class="shop-meta">
														<a href="product-detail.php?id=<?php echo base64_encode($ProRow['product_id']) ?>" class="btn btn-secondary btn-md btn-rounded">
															<i class="fa-solid fa-eye d-md-none d-block"></i>
															<span class="d-md-block d-none">View Details</span>
														</a>
														<div class="btn btn-primary meta-icon dz-wishicon" data-bs-toggle="modal" data-bs-target="#exampleModal">
															<i class="icon feather icon-eye dz-eye"></i>
															<i class="icon feather icon-eye-on dz-eye-fill"></i>
														</div>
														<a href="#" class="btn btn-primary meta-icon dz-carticon cartBuy" data-product-id="<?php echo $ProRow['product_id']; ?>">
															<i class="flaticon flaticon-basket"></i>
															<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
														</a>
													</div>
												</div>
												<div class="dz-content">
													<h5 class="title"><a href="product-detail.php?id=<?php echo base64_encode($ProRow['product_id']) ?>"><?php echo htmlspecialchars($ProRow['name']); ?></a></h5>
													<h5 class="price">₹<?php echo htmlspecialchars(number_format($discountInfo['discountedPrice'])); ?></h5>
												</div>
												<div class="product-tag">
													<span class="badge ">Try On</span>
												</div>
											</div>
										</div>
									<?php endforeach; ?>

								</div>
							</div>
						</div>
					</div>

					<div class="row page mt-0">
						<div class="col-md-12">
						<nav aria-label="Product Pagination" id="product-pagination">
							<ul class="pagination style-1">
								<li class="page-item"><a class="page-link" href="javascript:void(0);" id="prev">Prev</a></li>
								<!-- Page Numbers will be dynamically inserted here -->
								<ul id="page-numbers" class="pagination"></ul>
								<li class="page-item"><a class="page-link" href="javascript:void(0);" id="next">Next</a></li>
							</ul>
						</nav>
						</div>
					</div>
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

	<script>
		document.addEventListener("DOMContentLoaded", () => {
			const swiper = new Swiper('.swiper', {
				loop: true, // Infinite loop
				spaceBetween: 20, // Space between slides
				slidesPerView: 1, // Number of slides to show
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},
				pagination: {
					el: '.swiper-pagination',
					clickable: true,
				},
				breakpoints: {
					768: {
						slidesPerView: 2,
					},
					1024: {
						slidesPerView: 3,
					},
				},
			});
		});
	</script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

	<script>
		$(document).ready(function() {
			$('.play-btn').magnificPopup({
				type: 'iframe', // Opens video in iframe
				iframe: {
					patterns: {
						youtube: {
							index: 'youtube.com',
							id: 'v=',
							src: 'https://www.youtube.com/embed/%id%?autoplay=1&rel=0'
						},
						vimeo: {
							index: 'vimeo.com',
							id: '/',
							src: 'https://player.vimeo.com/video/%id%?autoplay=1&rel=0'
						}
					}
				}
			});
		});
	</script>




	<!-- JAVASCRIPT FILES ========================================= -->

	<script src="vendor/wow/wow.min.js"></script>
	<script src="vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="vendor/bootstrap-touchspin/bootstrap-touchspin.js"></script>
	<script src="vendor/swiper/swiper-bundle.min.js"></script>
	<script src="vendor/magnific-popup/magnific-popup.js"></script>
	<script src="vendor/imagesloaded/imagesloaded.js"></script>
	<script src="vendor/masonry/masonry-4.2.2.js"></script>
	<script src="vendor/masonry/isotope.pkgd.min.js"></script>
	<script src="vendor/countdown/jquery.countdown.js"></script>
	<script src="vendor/wnumb/wNumb.js"></script>
	<script src="vendor/nouislider/nouislider.min.js"></script>
	<script src="vendor/slick/slick.min.js"></script>
	<script src="vendor/lightgallery/dist/lightgallery.min.js"></script>
	<script src="vendor/lightgallery/dist/plugins/thumbnail/lg-thumbnail.min.js"></script>
	<script src="vendor/lightgallery/dist/plugins/zoom/lg-zoom.min.js"></script>
	<script src="js/dz.carousel.js"></script>
	<script src="vendor/group-slide/group-loop.js"></script>
	<script src="js/dz.ajax.js"></script>
	<script src="js/custom.min.js"></script>

<script>
    $(document).ready(function () {
        // Add to Cart Button Click
        $('.cartBuy').click(function (e) {
            e.preventDefault(); // Prevent default link behavior
            
            // Get the product ID from the clicked button's data attribute
            var productId = $(this).data('product-id');
            var quantity = 1;  // Default quantity is 1
            var buyNow = 'Buy Now';

            // Send AJAX request to add product to cart
            $.ajax({
                type: 'POST',
                url: 'ajax-cart.php',
                data: {
                    buyNow: buyNow,
                    pId: productId,
                    quantity: quantity
                },
                success: function (response) {
                    var trimmedResponse = response.trim();
                    if (trimmedResponse === 'Product added to the cart successfully') {
                        console.log('Product added to the cart successfully');
                        window.location.href = 'cart.php'; 
                    } else if (trimmedResponse === 'Product already added to your cart') {
                        console.log('Product already added to your cart');
                        alert('Product already added to your cart.');
                    } else {
                        alert('Unknown response from the server: ' + trimmedResponse);
                        console.log('Server Response:', response);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error updating cart:', error);
                }
            });
        });

       
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rowsPerPage = 16; // Adjust number of products per page
        const filterDropdown = document.getElementById('product-type-filter');
        const productCards = document.querySelectorAll('[data-product-type]');
        let currentPage = 1;

        // Function to filter products based on selected type
        function filterProducts() {
            const selectedType = filterDropdown.value;

            // Filter the products
            const filteredProducts = Array.from(productCards).filter(function(card) {
                const productTypes = card.getAttribute('data-product-type').split(',');
                return !selectedType || productTypes.includes(selectedType);
            });

            return filteredProducts;
        }

        // Function to display the products for the current page
        function displayRows(page) {
            const filteredProducts = filterProducts(); // Get the filtered products

            // Calculate the total pages based on filtered products
            const totalPages = Math.ceil(filteredProducts.length / rowsPerPage);
            const totalProducts = filteredProducts.length;

            // Hide all product cards
            productCards.forEach((product) => {
                product.style.display = 'none';
            });

            // Show products for the current page
            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const visibleProducts = filteredProducts.slice(start, end);

            visibleProducts.forEach((product) => {
                product.style.display = 'block';
            });

            // Update pagination buttons and page numbers
            updatePaginationButtons(page, totalPages);
            updatePageNumbers(page, totalPages);

            // Update the range display (e.g., "Showing 1–5 of 50 results")
            const rangeDisplay = document.querySelector('#range-display');
            rangeDisplay.textContent = `Showing ${start + 1}–${Math.min(end, totalProducts)} of ${totalProducts} results`;
        }

        // Function to update pagination buttons
        function updatePaginationButtons(page, totalPages) {
            const prevButton = document.querySelector('#prev');
            const nextButton = document.querySelector('#next');
            const pagination = document.querySelector('#product-pagination');

            // Disable the "Prev" button if we are on the first page
            prevButton.style.pointerEvents = page === 1 ? 'none' : 'auto';
            prevButton.style.opacity = page === 1 ? 0.5 : 1;

            // Disable the "Next" button if we are on the last page
            nextButton.style.pointerEvents = page === totalPages ? 'none' : 'auto';
            nextButton.style.opacity = page === totalPages ? 0.5 : 1;

            // Hide the pagination if there is only one page
            if (totalPages <= 1) {
                pagination.style.display = 'none';
            } else {
                pagination.style.display = 'block';
            }
        }

        // Function to dynamically generate page numbers
        function updatePageNumbers(page, totalPages) {
            const paginationContainer = document.querySelector('#product-pagination .pagination');
            const pageNumbersContainer = document.querySelector('#page-numbers');
            pageNumbersContainer.innerHTML = ''; // Clear current page numbers

            // Generate page numbers dynamically
            for (let i = 1; i <= totalPages; i++) {
                const pageLink = document.createElement('li');
                pageLink.classList.add('page-item');
                pageLink.innerHTML = `<a class="page-link" href="javascript:void(0);" data-page="${i}">${i}</a>`;

                // Add event listener to each page number link
                pageLink.querySelector('a').addEventListener('click', () => {
                    currentPage = i;
                    displayRows(currentPage);
                });

                pageNumbersContainer.appendChild(pageLink);
            }
        }

        // Handle prev and next buttons
        document.getElementById('prev').addEventListener('click', () => {
            const filteredProducts = filterProducts();
            const totalPages = Math.ceil(filteredProducts.length / rowsPerPage);

            if (currentPage > 1) {
                currentPage--;
                displayRows(currentPage);
            }
        });

        document.getElementById('next').addEventListener('click', () => {
            const filteredProducts = filterProducts();
            const totalPages = Math.ceil(filteredProducts.length / rowsPerPage);

            if (currentPage < totalPages) {
                currentPage++;
                displayRows(currentPage);
            }
        });

        // Handle the filter change event
        filterDropdown.addEventListener('change', function() {
            currentPage = 1; // Reset to the first page when the filter changes
            displayRows(currentPage);
        });

        // Initialize pagination and filter display
        displayRows(currentPage);
    });
</script>





  

</body>

</html>