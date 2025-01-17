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

$category = isset($_REQUEST['category']) ? base64_decode($_REQUEST['category']) : NULL;

$categoryQuery = $categories->getCategories($category);
$categoryId = $categoryQuery['id'];

// Pagination settings
$productsPerPage = 12; // Number of products per page
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get the current page from the URL (default is 1)
$offset = ($currentPage - 1) * $productsPerPage; // Calculate the offset for SQL query

// Query to fetch products for the current page with pagination
$query = $conn->getAllData(
	"SELECT p.*, pc.category_id, GROUP_CONCAT(ppt.product_type_id) AS product_type_ids
	FROM products p 
	JOIN product_category pc ON p.product_id = pc.product_id
	JOIN product_product_type ppt ON p.product_id = ppt.product_id
	WHERE p.status = '1' 
	AND pc.category_id = '$categoryId'
	GROUP BY p.product_id, pc.category_id
	ORDER BY p.product_id DESC
	LIMIT $offset, $productsPerPage"
);

// Get the total number of products to calculate the total pages
$totalQuery = $conn->getAllData(
	"SELECT COUNT(*) AS total_products 
	FROM products p 
	JOIN product_category pc ON p.product_id = pc.product_id
	WHERE p.status = '1' 
	AND pc.category_id = '$categoryId'"
);
$totalProducts = $totalQuery[0]['total_products']; // Get the total number of products
$totalPages = ceil($totalProducts / $productsPerPage); // Calculate the total number of pages
$start = ($currentPage - 1) * $productsPerPage + 1;
$end = min($currentPage * $productsPerPage, $totalProducts);


// Generate pagination links
$pagination = '';
if ($totalPages > 1) {  // Only show pagination if there are more than one page
    $pagination .= '<nav aria-label="Blog Pagination"><ul class="pagination style-1">';

    // Previous button
    if ($currentPage > 1) {
        $pagination .= '<li class="page-item"><a class="page-link" href="?category=' . base64_encode($category) . '&page=' . ($currentPage - 1) . '">Previous</a></li>';
    } else {
        $pagination .= '<li class="page-item disabled"><a class="page-link" href="javascript:void(0);">Previous</a></li>';
    }

    // Page links
    for ($page = 1; $page <= $totalPages; $page++) {
        if ($page == $currentPage) {
            $pagination .= '<li class="page-item active"><a class="page-link" href="javascript:void(0);">' . $page . '</a></li>';
        } else {
            $pagination .= '<li class="page-item"><a class="page-link" href="?category=' . base64_encode($category) . '&page=' . $page . '">' . $page . '</a></li>';
        }
    }

    // Next button
    if ($currentPage < $totalPages) {
        $pagination .= '<li class="page-item"><a class="page-link next" href="?category=' . base64_encode($category) . '&page=' . ($currentPage + 1) . '">Next</a></li>';
    } else {
        $pagination .= '<li class="page-item disabled"><a class="page-link next" href="javascript:void(0);">Next</a></li>';
    }

    $pagination .= '</ul></nav>';
}

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
									
								<span>Showing <?php echo $start; ?>–<?php echo $end; ?> of <?php echo $totalProducts; ?> Results</span>
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
										<div class="col-6 col-xl-3 col-lg-4 col-md-4 col-sm-6 m-md-b15 m-b30" data-product-type="<?php echo htmlspecialchars(implode(',', $productTypesArray)); ?>">
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

					<!-- <div class="row page mt-0">
						<div class="col-md-12">
							<nav aria-label="Blog Pagination">
								<ul class="pagination style-1">
									<li class="page-item"><a class="page-link active" href="javascript:void(0);">1</a></li>
									<li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
									<li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
									<li class="page-item"><a class="page-link next" href="javascript:void(0);">Next</a></li>
								</ul>
							</nav>
						</div>
					</div> -->
					<?php if ($totalPages > 1): ?>
						<?php echo $pagination; ?>
					<?php endif; ?>
					

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
		document.addEventListener('DOMContentLoaded', function() {
			const filterDropdown = document.getElementById('product-type-filter');
			const productCards = document.querySelectorAll('[data-product-type]');
			filterDropdown.addEventListener('change', function() {
				const selectedType = filterDropdown.value;
				productCards.forEach(function(card) {
					const productTypes = card.getAttribute('data-product-type').split(',');
					if (selectedType && !productTypes.includes(selectedType)) {
						card.style.display = 'none'; 
					} else {
						card.style.display = 'block';
					}
				});
			});
		});
	</script>

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
                        window.location.href = 'cart.php';  // Redirect to cart page
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


  

</body>

</html>