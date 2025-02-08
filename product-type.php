<?php
if (!isset($_SESSION)) {
  session_start();
}
error_reporting(E_ALL);
require "config/config.php";
require 'config/functions.php';

$conn = new dbClass();
$categories = new Categories();

$variableForCartAndBuyNow=false;

$productType = isset($_REQUEST['type']) ? base64_decode($_REQUEST['type']) : NULL;

$productTypeQuery = $categories->getProductType($productType);

$productTypeId = $productTypeQuery['id'];

$query =$categories->getProductTypePageProducts($productTypeId);


  
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

        <style>

        #page-numbers .active-page a{
            background-color: black;
            color: white;
            
        }

        </style>
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
					<h1><?php echo htmlspecialchars($productTypeQuery['name']); ?></h1>
					<nav aria-label="breadcrumb" class="breadcrumb-row">
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html"> Home</a></li>
							<li class="breadcrumb-item"><?php echo htmlspecialchars($productTypeQuery['name']); ?></li>
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
							<div class=" d-flex gap-3">
								<div class="form-group">
								

								</div>
								<div class="form-group">
								<select id="product-type-filter" class="styled-dropdown"  style=" width: 200px; border: 1px solid rgba(0, 0, 0, 0.3); border-radius:.3rem ;">
                                    <option value="">SELECT CATEGORY</option>
									<?php
										$sqlTypeQuery = $categories->getAllCategories();
										foreach ($sqlTypeQuery as $sqlTypeRow) : ?>
										<option value="<?php echo $sqlTypeRow['id']; ?>"><?php echo $sqlTypeRow['name']; ?></option>
										<?php endforeach; ?>
                                </select>

								</div>
								
								
							</div>
						</div>
						
						<div class="row">
						<div class="col-12 tab-content shop-" id="pills-tabContent">
							<div class="tab-pane fade active show" id="tab-list-grid" role="tabpanel" aria-labelledby="tab-list-grid-btn">
								<div class="row gx-xl-4 g-3">
								<?php foreach ($query as $ProRow) :
                                        $discountInfo = calculateDiscount($ProRow['price'], $ProRow['discount']); 
                                        $productTypeIds = $ProRow['category_ids'];
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
    const rowsPerPage = 16; // Number of products per page
    const productCards = document.querySelectorAll('.ajPagination'); // All product cards
    const filterDropdown = document.getElementById('product-type-filter'); // Filter dropdown
    let currentPage = 1;

    // Function to filter products based on the selected filter
    function filterProducts() {
        const selectedType = filterDropdown.value;
        const filteredProducts = Array.from(productCards).filter(function(card) {
            const productTypes = card.getAttribute('data-product-type').split(',');
            return !selectedType || productTypes.includes(selectedType);
        });

        return filteredProducts;
    }

    // Function to display products for the current page
    function displayRows(page) {
        const filteredProducts = filterProducts(); // Get filtered products
        const totalPages = Math.ceil(filteredProducts.length / rowsPerPage); // Calculate total pages
        const totalProducts = filteredProducts.length;

        // Hide all products
        productCards.forEach(product => {
            product.style.display = 'none';
        });

        // Show products for the current page
        const start = (page - 1) * rowsPerPage;
        const end = Math.min(start + rowsPerPage, totalProducts);
        const visibleProducts = filteredProducts.slice(start, end);

        visibleProducts.forEach(product => {
            product.style.display = 'block';
        });

        // Update pagination buttons
        updatePaginationButtons(page, totalPages);
        updatePageNumbers(page, totalPages);

        // Update the range display (e.g., "Showing 1–5 of 50 results")
        const rangeDisplay = document.querySelector('#range-display');
        rangeDisplay.textContent = `Showing ${start + 1}–${end} of ${totalProducts} results`;
    }

    // Function to update pagination buttons
    function updatePaginationButtons(page, totalPages) {
        const prevButton = document.querySelector('#prev');
        const nextButton = document.querySelector('#next');
        const pagination = document.querySelector('#product-pagination');

        // Disable "Prev" button if on the first page
        prevButton.style.pointerEvents = page === 1 ? 'none' : 'auto';
        prevButton.style.opacity = page === 1 ? 0.5 : 1;

        // Disable "Next" button if on the last page
        nextButton.style.pointerEvents = page === totalPages ? 'none' : 'auto';
        nextButton.style.opacity = page === totalPages ? 0.5 : 1;

        // Hide pagination if only one page
        if (totalPages <= 1) {
            pagination.style.display = 'none';
        } else {
            pagination.style.display = 'block';
        }
    }

    // Function to update page numbers dynamically
    function updatePageNumbers(page, totalPages) {
        const pageNumbersContainer = document.querySelector('#page-numbers');
        pageNumbersContainer.innerHTML = ''; // Clear current page numbers

        // Calculate the range of page numbers to display (maximum 5 pages)
        let startPage = Math.max(1, page - 2); // Ensure the start page is not less than 1
        let endPage = Math.min(totalPages, page + 2); // Ensure the end page is not greater than totalPages

        // Adjust if there are less than 5 pages visible
        if (endPage - startPage < 4) {
            if (page <= 3) {
                endPage = Math.min(5, totalPages); // Show pages 1 to 5
            } else {
                startPage = Math.max(totalPages - 4, 1); // Show last 5 pages
            }
        }

        // Generate page numbers dynamically based on the calculated range
        for (let i = startPage; i <= endPage; i++) {
            const pageLink = document.createElement('li');
            pageLink.classList.add('page-item');
            pageLink.innerHTML = `<a class="page-link" href="javascript:void(0);" data-page="${i}">${i}</a>`;

            // Add event listener to each page number
            pageLink.querySelector('a').addEventListener('click', function() {
                currentPage = i;
                displayRows(currentPage);
                highlightActivePage(); // Call function to highlight active page
            });

            pageNumbersContainer.appendChild(pageLink);
        }

        // Call highlightActivePage function to set the active page styling
        highlightActivePage();
    }

    // Function to highlight the active page
    function highlightActivePage() {
        // Remove the 'active-page' class from all page links
        const pageLinks = document.querySelectorAll('#page-numbers .page-item');
        pageLinks.forEach(link => {
            link.classList.remove('active-page');
        });

        // Add the 'active-page' class to the current page link
        const activePageLink = document.querySelector(`#page-numbers a[data-page="${currentPage}"]`);
        if (activePageLink) {
            activePageLink.parentElement.classList.add('active-page');
        }
    }

    // Event listener for "Prev" button
    document.getElementById('prev').addEventListener('click', function() {
        const filteredProducts = filterProducts();
        const totalPages = Math.ceil(filteredProducts.length / rowsPerPage);

        if (currentPage > 1) {
            currentPage--;
            displayRows(currentPage);
        }
    });

    // Event listener for "Next" button
    document.getElementById('next').addEventListener('click', function() {
        const filteredProducts = filterProducts();
        const totalPages = Math.ceil(filteredProducts.length / rowsPerPage);

        if (currentPage < totalPages) {
            currentPage++;
            displayRows(currentPage);
        }
    });

    // Event listener for filter change
    filterDropdown.addEventListener('change', function() {
        currentPage = 1; // Reset to the first page on filter change
        displayRows(currentPage);
    });

    // Initialize pagination and display
    displayRows(currentPage);
});

</script>



</body>
</html>