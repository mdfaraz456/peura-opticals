<?php
if (!isset($_SESSION)) {
  session_start();
}
error_reporting(E_ALL);
require "config/config.php";
require 'config/common.php';

$conn = new dbClass();
$products = new Products();

$id = isset($_REQUEST['id']) ? base64_decode($_REQUEST['id']) : NULL;
if($id==NULL){
	header('location: index.php');

}

$catsName = $products->getProductCategories($id);
$subCatName = $products->getProductSubCategories($id);
$productTypesName = $products->getProductTypes($id);

$data = $products->getProdcutsById($id);
$imageVal = $products->getProdcutsImages($data['product_id']);
$imageCount = $products->prodcutsImageCount($data['product_id']);

$discountInfo = calculateDiscount($data['price'], $data['discount']);

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
		<link rel="canonical" href="index.php">
		
		<!-- FAVICONS ICON -->
		<!-- <link rel="icon" type="image/x-icon" href="images/favicon.png"> -->
		
		<!-- MOBILE SPECIFIC -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
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
	

		<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

	</head>	
	<body id="bg">
	<div class="page-wraper">
	
		<!-- <div id="loading-area" class="preloader-wrapper-4">
			<img src="images/loading.gif" alt="">
		</div>
		 -->
	<!-- Header Star -->
	<?php include("include/header.php"); ?>
	<!-- Header End -->
	
	<div class="page-content">
		
 
		
		<section class="content-inner" id="content-container">
			<div class="container-fluid mt-5 mt-md-0">
				<div class="row ">
					<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
						<div class="dz-product-detail sticky-top style-3">
							<div class="swiper-btn-center-lr">
								<div class="swiper product-gallery-swiper2">
									<div class="swiper-wrapper" id="content-magnify">
										
									<?php array_unshift($imageVal, ['image' => $data['image']]);
	
									 ?>	
                							<?php foreach ($imageVal as $imageRow): ?>
										<div class="swiper-slide">
										
												<img src="adminuploads/products/<?php echo $imageRow['image']; ?>" class="tf-image-zoom" alt="image">
													<div class="zoom-circle"></div>
												
										</div>
										<?php endforeach; ?>
              							
										
										
									</div>
									    <!-- Add Navigation Buttons -->
										<div class="gallery-button-prev">
											<i class="fa fa-chevron-left"></i>
										</div>
										<div class="gallery-button-next">
											<i class="fa fa-chevron-right"></i>
										</div>
										
								</div>
								<div class="swiper product-gallery-swiper thumb-swiper-lg swiper-vertical" id="thumb-swiper-lg">
									<div class="swiper-wrapper swipper-ver-img-auto">
									
                							<?php foreach ($imageVal as $imageRow): ?>
										<div class="swiper-slide">
											<img src="adminuploads/products/<?php echo $imageRow['image']; ?>" alt="image">
										</div>
										<?php endforeach; ?>
              								
										
									</div>
								</div>
							</div>	
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6">
						<div class="dz-product-detail style-2 p-t50 bg-transparent">
							<div class="dz-content">
								<div class="dz-content-footer">
									<div class="dz-content-start">
										<?php if($data['discount']):?>
											<span class="badge bg-secondary mb-2">SALE <?php echo ($data['discount']); ?>% Off</span>
										<?php endif; ?>
										<h4 class="title mb-1"><?php echo htmlspecialchars($data['name']); ?></h4>
										
									</div>
								</div>
								<p class="para-text"><?php echo ($data['short_description']); ?></p>
								<div class="meta-content m-b20 d-flex align-items-end">
									<div class="me-3">
										<span class="form-label">Price</span>
										<span class="price">₹<?php echo htmlspecialchars(number_format($discountInfo['discountedPrice'])); ?> <del><?php echo htmlspecialchars($data['price']); ?></del></span>
										
									</div>
									<div class="btn-quantity quantity-sm light d-xl-none d-blcok d-sm-block">
										<label class="form-label"><?php echo ($data['Quantity']); ?></label>
										<input type="text" value="1" name="demo_vertical2">
									</div>
								</div>
								<div class="product-num">
									<div class="btn-quantity light d-xl-block d-sm-none d-none">
										<label class="form-label">Quantity</label>
										<input type="text" value="1" name="demo_vertical2">
									</div>
									<div class="d-block">
									<label class="form-label">Size</label>
									<div class="btn-group product-size m-0">
										<?php if($data['size_small']) : ?>
											<input type="radio" class="btn-check" name="btnradio1" id="btnradio101" checked="">
											<label class="btn" for="btnradio101">S</label>
										<?php endif;?>
										<?php if($data['size_medium']) : ?>
											<input type="radio" class="btn-check" name="btnradio1" id="btnradiol02">
											<label class="btn" for="btnradiol02">M</label>
										<?php endif;?>
										<?php if($data['size_large']) : ?>
											<input type="radio" class="btn-check" name="btnradio1" id="btnradiol03">
											<label class="btn" for="btnradiol03">L</label>
										<?php endif;?>
									</div>
									
								</div>
								</div>
								<div class="btn-group cart-btn">
									<a href="shop-cart.php" class="btn btn-secondary text-uppercase">Add To Cart</a>
									<a href="JavaScript:void(0)" class="btn btn-outline-secondary btn-icon">
										<i class="bi bi-cart-plus"></i> BUY NOW
									</a>
									
								</div>
								<div class="dz-info">
									<ul>
										<li><strong>SKU : </strong></li>
										<li><?php echo htmlspecialchars($data['sku']); ?></li>
									</ul>
									<ul>
										<li><strong>Category:</strong></li>
										<?php 
											$catCount = count($catsName); // Get total count of categories
											$index = 0; // Initialize a counter for iteration

											foreach($catsName as $catrow): 
												$index++; // Increment the counter
											?>
												<li>
													<?php echo htmlspecialchars($catrow['category_name']); ?>
													<?php if ($index < $catCount): ?>,<?php endif; ?>
												</li>
											<?php endforeach; ?>

										<?php 
											if (count($subCatName) > 0): // Check if there are subcategories
												echo ','; // Print a comma before the list if subcategories exist
												$subCatCount = count($subCatName); // Get total count of subcategories
												$subIndex = 0; // Initialize a counter for iteration

												foreach($subCatName as $subCatrow): 
													$subIndex++; // Increment the counter
												?>
													<li>
														<?php echo htmlspecialchars($subCatrow['subcategory_name']); ?>
														<?php if ($subIndex < $subCatCount): ?>,<?php endif; ?>
													</li>
												<?php endforeach; ?>
											<?php endif; ?>


											<?php 
												if (count($productTypesName) > 0): // Check if there are product types
													echo ','; // Print a comma before the list if product types exist
													$productTypesCount = count($productTypesName); // Get total count of product types
													$productTypesIndex = 0; // Initialize a counter for iteration

													foreach($productTypesName as $productType): 
														$productTypesIndex++; // Increment the counter
													?>
														<li>
															<?php echo htmlspecialchars($productType['product_type_name']); ?>
															<?php if ($productTypesIndex < $productTypesCount): ?>,<?php endif; ?>
														</li>
													<?php endforeach; ?>
												<?php endif; ?>

									</ul>
							 
								</div>
							</div>
		 
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="content-inner-3 pb-0 pt-0"> 
			<div class="container">
				<div class="product-description">
					<div class="dz-tabs">					
						<ul class="nav nav-tabs" id="myTab1" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Details</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Measurements</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="package-tab" data-bs-toggle="tab" data-bs-target="#package-tab-pane" type="button" role="tab" aria-controls="package-tab-pane" aria-selected="false">Package Contains</button>
							</li>
						</ul>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
								<div class="detail-bx">
	
						<div class="details-info">
						<?php echo ($data['details']); ?>
						</div>
				 
								</div>
								
							</div>
							<div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
								<div class="clear" id="comment-list">
									<div class="post-comments comments-area style-1 clearfix">
									<div class="details-info">
									<?php echo ($data['measurements']); ?>
									</div>
								</div>
								</div>
							</div>
							<div class="tab-pane fade" id="package-tab-pane" role="tabpanel" aria-labelledby="package-tab" tabindex="0">
								<div class="clear" id="comment-list">
									<div class="post-comments comments-area style-1 clearfix">
									<div  class="details-info">
									<?php echo ($data['package_contains']); ?>
										  
									</div>
								</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="content-inner-1 mt-5  overflow-hidden">
			<div class="container">
				<div class="section-head style-2 d-md-flex align-items-center justify-content-between">
					<div class="left-content">
						<h2 class="title mb-0">Related products</h2>
					</div>
						
				</div>
				<div class="swiper-btn-center-lr">
					<div class="swiper swiper-four">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<div class="shop-card style-1">
									<div class="dz-media">
										<img src="images/product-card/product-1.webp" alt="image">
										<div class="shop-meta">
														<a href="javascript:void(0);" class="btn btn-secondary btn-md btn-rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">
															<i class="fa-solid fa-eye d-md-none d-block"></i>
															<span class="d-md-block d-none">Quick View</span>
														</a>
														<div class="btn btn-primary meta-icon dz-wishicon" data-bs-toggle="modal" data-bs-target="#exampleModal">
															<i class="icon feather icon-eye dz-eye"></i>
												<i class="icon feather icon-eye-on dz-eye-fill"></i>
														</div>
														<div class="btn btn-primary meta-icon dz-carticon">
															<i class="flaticon flaticon-basket"></i>
															<i class="flaticon flaticon-shopping-basket-on dz-heart-fill"></i>
														</div>
													</div>							
									</div>
									<div class="dz-content">
										<h5 class="title"><a href="product-detail.php">Cozy Knit Cardigan Sweater</a></h5>
										<h5 class="price">₹80</h5>
									</div>
									<div class="product-tag">
										<span class="badge ">Try On</span>
									</div>
								</div>
							</div>
							
						</div>
					</div>
					<div class="pagination-align">
						<div class="tranding-button-prev btn-prev">
							<i class="flaticon flaticon-left-chevron"></i>
						</div>
						<div class="tranding-button-next btn-next">
							<i class="flaticon flaticon-chevron"></i>
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
	
	<!-- Quick Modal Start -->
	<div class="modal quick-view-modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					<i class="icon feather icon-x"></i>
				</button>
				<div class="modal-body">
					<div class="row g-xl-4 g-3">
						<div class="col-xl-6 col-md-6">
							<div class="dz-product-detail mb-0">
								<div class="swiper-btn-center-lr">
									<div class="swiper quick-modal-swiper2">
										<div class="swiper-wrapper" id="lightgallery">
											<div class="swiper-slide">
												<div class="dz-media DZoomImage">
													<a class="mfp-link lg-item" href="images/product-card/product-1.webp" data-src="images/product-card/product-1.webp">
														<i class="feather icon-maximize dz-maximize top-right"></i>
													</a>
													<img src="images/product-card/product-1.webp" alt="image">
												</div>
											</div>
											<div class="swiper-slide">
												<div class="dz-media DZoomImage">
													<a class="mfp-link lg-item" href="images/product-card/product-2.webp" data-src="images/product-card/product-2.webp">
														<i class="feather icon-maximize dz-maximize top-right"></i>
													</a>
													<img src="images/product-card/product-2.webp" alt="image">
												</div>
											</div>
											<div class="swiper-slide">
												<div class="dz-media DZoomImage">
													<a class="mfp-link lg-item" href="images/product-card/product-3.webp" data-src="images/product-card/product-3.webp">
														<i class="feather icon-maximize dz-maximize top-right"></i>
													</a>
													<img src="images/product-card/product-3.webp" alt="image">
												</div>
											</div>
										</div>
									</div>
									<div class="swiper quick-modal-swiper thumb-swiper-lg thumb-sm swiper-vertical">
										<div class="swiper-wrapper">
											<div class="swiper-slide">
												<img src="images/product-card/product-1.webp" alt="image">
											</div>
											<div class="swiper-slide">
												<img src="images/product-card/product-2.webp" alt="image">
											</div>
											<div class="swiper-slide">
												<img src="images/product-card/product-3.webp" alt="image">
											</div>
										</div>
									</div>
								</div>	
							</div>	
						</div>
						<div class="col-xl-6 col-md-6">
							<div class="dz-product-detail style-2 ps-xl-3 ps-0 pt-2 mb-0">
								<div class="dz-content">
									 
									<p class="para-text mt-5">
										Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has.
									</p>
									<div class="meta-content m-b20 d-flex align-items-end">
										<div class="me-3">
											<span class="form-label">Price</span>
											<span class="price">₹125.75 <del>₹132.17</del></span>
										</div>
										<div class="btn-quantity light me-0">
											<label class="form-label">Quantity</label>
											<input type="text" value="1" name="demo_vertical2">
										</div>
									</div>
									<div class=" cart-btn">
										<a href="JavaScript:void(0)" class="btn btn-secondary text-uppercase">Add To Cart</a>
										<a href="JavaScript:void(0)" class="btn btn-outline-secondary btn-icon">
											<i class="bi bi-cart-plus"></i> BUY NOW
										</a>
									</div>
									<div class="dz-info mb-0">
										<ul>
											<li><strong>SKU:</strong></li>
											<li>PRT584E63A</li>
										</ul>
										<ul>
											<li><strong>Category:</strong></li>
											<li><a href="JavaScript:void(0)">Sunglasses,</a></li>                                                
											<li><a href="JavaScript:void(0)">Prescription Glasses,</a></li>                                                
											<li><a href="JavaScript:void(0)">Blue Light Glasses,</a></li>                                                
											<li><a href="JavaScript:void(0)">Sports Glasses,</a></li>                                                
											<li><a href="JavaScript:void(0)">Eyewear Accessories</a></li>                                                
										</ul>
							
									 
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Quick Modal End -->
	
</div>



<!-- JAVASCRIPT FILES ========================================= -->
<script src="js/jquery.min.js"></script><!-- JQUERY MIN JS -->
<script src="vendor/wow/wow.min.js"></script><!-- WOW JS -->
<script src="vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script><!-- BOOTSTRAP MIN JS -->
<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script><!-- BOOTSTRAP SELECT MIN JS -->
<script src="vendor/bootstrap-touchspin/bootstrap-touchspin.js"></script><!-- BOOTSTRAP TOUCHSPIN JS -->
<script src="js/jquery.star-rating-svg.js"></script><!-- Star Rating JS -->
<script src="vendor/swiper/swiper-bundle.min.js"></script><!-- SWIPER JS -->
<script src="vendor/imagesloaded/imagesloaded.js"></script><!-- IMAGESLOADED-->
<script src="vendor/masonry/masonry-4.2.2.js"></script><!-- MASONRY -->
<script src="vendor/masonry/isotope.pkgd.min.js"></script><!-- ISOTOPE -->
<script src="vendor/countdown/jquery.countdown.js"></script><!-- COUNTDOWN FUCTIONS  -->
<script src="vendor/wnumb/wNumb.js"></script><!-- WNUMB -->
<script src="vendor/nouislider/nouislider.min.js"></script><!-- NOUSLIDER MIN JS-->
<script src="js/dz.carousel.js"></script><!-- DZ CAROUSEL JS -->
<script src="vendor/lightgallery/dist/lightgallery.min.js"></script><!-- LIGHTGALLERY JS-->
<script src="vendor/lightgallery/dist/plugins/thumbnail/lg-thumbnail.min.js"></script><!-- LIGHTGALLERY JS-->
<script src="vendor/lightgallery/dist/plugins/zoom/lg-zoom.min.js"></script><!-- LIGHTGALLERY JS-->
<script src="js/dz.ajax.js"></script><!-- AJAX -->
<script src="js/custom.min.js"></script><!-- CUSTOM JS -->

<script>
	
	document.querySelectorAll('.swiper-slide').forEach((slide) => {
  const zoomImage = slide.querySelector('.tf-image-zoom');
  const zoomCircle = slide.querySelector('.zoom-circle');

  slide.addEventListener('mousemove', (e) => {
    const rect = slide.getBoundingClientRect();
    const offsetX = e.clientX - rect.left;  
    const offsetY = e.clientY - rect.top;  

    // Show the zoom circle
    zoomCircle.style.display = 'block';
    zoomCircle.style.left = `${offsetX - zoomCircle.offsetWidth / 2}px`;
    zoomCircle.style.top = `${offsetY - zoomCircle.offsetHeight / 2}px`;

    // Set the zoom circle's background image and position
    zoomCircle.style.backgroundImage = `url(${zoomImage.src})`;
    zoomCircle.style.backgroundSize = `${zoomImage.offsetWidth * 2}px ${zoomImage.offsetHeight * 2}px`; 
    zoomCircle.style.backgroundPosition = `-${offsetX * 2}px -${offsetY * 2}px`;
  });

  slide.addEventListener('mouseleave', () => {
    zoomCircle.style.display = 'none'; // Hide zoom circle on mouse leave
  });
});

</script>

</body>
</html>