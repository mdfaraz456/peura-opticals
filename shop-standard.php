<?php
if (!isset($_SESSION)) {
	session_start();
	}
error_reporting(E_ALL);
require "config/config.php";
require "config/common.php";

$conn = new dbClass();



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
					<h1>Shop Standard</h1>
					<nav aria-label="breadcrumb" class="breadcrumb-row">
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html"> Home</a></li>
							<li class="breadcrumb-item">Shop Standard</li>
						</ul>
					</nav>
				</div>
			</div>	
		</div>
		<!--Banner End-->

		<section class="content-inner-3 pt-3 z-index-unset">
			<div class="container-fluid">
				<div class="row">
					<div class="col-20 col-xl-3">
						<div class="sticky-xl-top">
							<a href="javascript:void(0);" class="panel-close-btn">																	
								<svg width="35" height="35" viewbox="0 0 51 50" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M37.748 12.5L12.748 37.5" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
									<path d="M12.748 12.5L37.748 37.5" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
								</svg>
							</a>
							<div class="shop-filter mt-xl-2 mt-0">
								<aside>
									 
								 
									<div class="widget">
										<h6 class="widget-title">Price</h6>
										<div class="price-slide range-slider">
											<div class="price">
												<div class="range-slider style-1">
													<div id="slider-tooltips2" class="mb-3"></div>
													<span class="example-val" id="slider-margin-value-min2"></span>
													<span class="example-val" id="slider-margin-value-max2"></span>
												</div>
											</div>
										</div>
									</div>
									 
									
									<div class="widget">
										<h6 class="widget-title">Size</h6>
										<div class="btn-group product-size">
											<input type="radio" class="btn-check" name="btnradio1" id="btnradio101" checked="">
											<label class="btn" for="btnradio101">4</label>

											<input type="radio" class="btn-check" name="btnradio1" id="btnradiol02">
											<label class="btn" for="btnradiol02">6</label>

											<input type="radio" class="btn-check" name="btnradio1" id="btnradiol03">
											<label class="btn" for="btnradiol03">8</label>
										  
											<input type="radio" class="btn-check" name="btnradio1" id="btnradiol04">
											<label class="btn" for="btnradiol04">10</label>
											
											<input type="radio" class="btn-check" name="btnradio1" id="btnradiol05">
											<label class="btn" for="btnradiol05">12</label>
											
											<input type="radio" class="btn-check" name="btnradio1" id="btnradiol06">
											<label class="btn" for="btnradiol06">14</label>
											
											<input type="radio" class="btn-check" name="btnradio1" id="btnradiol07">
											<label class="btn" for="btnradiol07">16</label>
											
											<input type="radio" class="btn-check" name="btnradio1" id="btnradiol08">
											<label class="btn" for="btnradiol08">18</label>
											
											<input type="radio" class="btn-check" name="btnradio1" id="btnradiol09">
											<label class="btn" for="btnradiol09">20</label>
										</div>
									</div>
									
									<div class="widget widget_categories">
										<h6 class="widget-title">Category</h6>
										<ul>
											<li class="cat-item cat-item-26"><a href="blog-category.html">Unisex</a> (10)</li>
											<li class="cat-item cat-item-36"><a href="blog-category.html">Women</a> (5)</li>
											<li class="cat-item cat-item-43"><a href="blog-category.html">Men</a> (17)</li>
											<li class="cat-item cat-item-27"><a href="blog-category.html">Kids</a> (13)</li>
											<li class="cat-item cat-item-40"><a href="blog-category.html">Sunglasses</a> (06)</li> 
											<li class="cat-item cat-item-40"><a href="blog-category.html">Turban Friendly</a> (17)</li> 
											
										</ul>
									</div>
									
									
								 
								</aside>
							</div>
						</div>
					</div>
					<div class="col-80 col-xl-9">
						<!-- <div class="filter-wrapper">
							<div class="filter-left-area">								
								<ul class="filter-tag">
									<li>
										<a href="javascript:void(0);" class="tag-btn">Dresses 
											<i class="icon feather icon-x tag-close"></i>
										</a>
									</li>
									<li>
										<a href="javascript:void(0);" class="tag-btn">Tops
											<i class="icon feather icon-x tag-close"></i>
										</a>
									</li>
									<li>
										<a href="javascript:void(0);" class="tag-btn">Outerwear 
											<i class="icon feather icon-x tag-close"></i>
										</a>
									</li>
								</ul>
								<span>Showing 1–5 Of 50 Results</span>
							</div>
							<div class="filter-right-area">
								<a href="javascript:void(0);" class="panel-btn me-2">
									<svg class="me-2" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 25 25" width="20" height="20"><g id="Layer_28" data-name="Layer 28"><path d="M2.54,5H15v.5A1.5,1.5,0,0,0,16.5,7h2A1.5,1.5,0,0,0,20,5.5V5h2.33a.5.5,0,0,0,0-1H20V3.5A1.5,1.5,0,0,0,18.5,2h-2A1.5,1.5,0,0,0,15,3.5V4H2.54a.5.5,0,0,0,0,1ZM16,3.5a.5.5,0,0,1,.5-.5h2a.5.5,0,0,1,.5.5v2a.5.5,0,0,1-.5.5h-2a.5.5,0,0,1-.5-.5Z"></path><path d="M22.4,20H18v-.5A1.5,1.5,0,0,0,16.5,18h-2A1.5,1.5,0,0,0,13,19.5V20H2.55a.5.5,0,0,0,0,1H13v.5A1.5,1.5,0,0,0,14.5,23h2A1.5,1.5,0,0,0,18,21.5V21h4.4a.5.5,0,0,0,0-1ZM17,21.5a.5.5,0,0,1-.5.5h-2a.5.5,0,0,1-.5-.5v-2a.5.5,0,0,1,.5-.5h2a.5.5,0,0,1,.5.5Z"></path><path d="M8.5,15h2A1.5,1.5,0,0,0,12,13.5V13H22.45a.5.5,0,1,0,0-1H12v-.5A1.5,1.5,0,0,0,10.5,10h-2A1.5,1.5,0,0,0,7,11.5V12H2.6a.5.5,0,1,0,0,1H7v.5A1.5,1.5,0,0,0,8.5,15ZM8,11.5a.5.5,0,0,1,.5-.5h2a.5.5,0,0,1,.5.5v2a.5.5,0,0,1-.5.5h-2a.5.5,0,0,1-.5-.5Z"></path></g></svg>
									Filter
								</a>
								<div class="form-group">
									<select class="default-select">
										<option>Latest</option>
										<option>Popularity</option>
										<option>Average rating</option>
										<option>Latest</option>
										<option>Low to high</option>
										<option>high to Low</option>
									</select>
								</div>
								
								
							</div>
						</div> -->
						
						<div class="row">
							<div class="col-12 tab-content shop-" id="pills-tabContent">
							 
								 
								<div class="tab-pane fade active show" id="tab-list-grid" role="tabpanel" aria-labelledby="tab-list-grid-btn">
									<div class="row gx-xl-4 g-3">
										<div class="col-6 col-xl-3 col-lg-4 col-md-4 col-sm-6 m-md-b15 m-b30">
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
											<a href="shop-cart.html" class="btn btn-primary meta-icon dz-carticon">
												<i class="flaticon flaticon-basket"></i>
												<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
											</a>
													</div>							
												</div>
												<div class="dz-content">
													<h5 class="title"><a href="shop-list.html">Cozy Knit Cardigan Sweater</a></h5>
													<h5 class="price">$80</h5>
												</div>
												<div class="product-tag">
										<span class="badge ">Try On</span>
									</div>
											</div>
										</div>
										<div class="col-6 col-xl-3 col-lg-4 col-md-4 col-sm-6 m-md-b15 m-b30">
											<div class="shop-card style-1">
												<div class="dz-media">
													<img src="images/product-card/product-2.webp" alt="image">
											<div class="shop-meta">
														<a href="javascript:void(0);" class="btn btn-secondary btn-md btn-rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">
															<i class="fa-solid fa-eye d-md-none d-block"></i>
															<span class="d-md-block d-none">Quick View</span>
														</a>
														<div class="btn btn-primary meta-icon dz-wishicon" data-bs-toggle="modal" data-bs-target="#exampleModal">
												<i class="icon feather icon-eye dz-eye"></i>
												<i class="icon feather icon-eye-on dz-eye-fill"></i>
											</div>
											<a href="shop-cart.html" class="btn btn-primary meta-icon dz-carticon">
												<i class="flaticon flaticon-basket"></i>
												<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
											</a>
													</div>								
												</div>
												<div class="dz-content">
													<h5 class="title"><a href="shop-list.html">Sophisticated Swagger Suit</a></h5>
													<h5 class="price">$80</h5>
												</div>
												<div class="product-tag">
										<span class="badge ">Try On</span>
									</div>
											</div>
										</div>
										<div class="col-6 col-xl-3 col-lg-4 col-md-4 col-sm-6 m-md-b15 m-b30">
											<div class="shop-card style-1">
												<div class="dz-media">
													<img src="images/product-card/product-3.webp" alt="image">
											<div class="shop-meta">
														<a href="javascript:void(0);" class="btn btn-secondary btn-md btn-rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">
															<i class="fa-solid fa-eye d-md-none d-block"></i>
															<span class="d-md-block d-none">Quick View</span>
														</a>
														<div class="btn btn-primary meta-icon dz-wishicon" data-bs-toggle="modal" data-bs-target="#exampleModal">
												<i class="icon feather icon-eye dz-eye"></i>
												<i class="icon feather icon-eye-on dz-eye-fill"></i>
											</div>
											<a href="shop-cart.html" class="btn btn-primary meta-icon dz-carticon">
												<i class="flaticon flaticon-basket"></i>
												<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
											</a>
													</div>								
												</div>
												<div class="dz-content">
													<h5 class="title"><a href="shop-list.html">Classic Denim Skinny Jeans</a></h5>
													<h5 class="price">$80</h5>
												</div>
												<div class="product-tag">
										<span class="badge ">Try On</span>
									</div>
											</div>
										</div>
										<div class="col-6 col-xl-3 col-lg-4 col-md-4 col-sm-6 m-md-b15 m-b30">
											<div class="shop-card style-1">
												<div class="dz-media">
													<img src="images/product-card/product-4.webp" alt="image">
											<div class="shop-meta">
														<a href="javascript:void(0);" class="btn btn-secondary btn-md btn-rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">
															<i class="fa-solid fa-eye d-md-none d-block"></i>
															<span class="d-md-block d-none">Quick View</span>
														</a>
														<div class="btn btn-primary meta-icon dz-wishicon" data-bs-toggle="modal" data-bs-target="#exampleModal">
												<i class="icon feather icon-eye dz-eye"></i>
												<i class="icon feather icon-eye-on dz-eye-fill"></i>
											</div>
											<a href="shop-cart.html" class="btn btn-primary meta-icon dz-carticon">
												<i class="flaticon flaticon-basket"></i>
												<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
											</a>
													</div>								
												</div>
												<div class="dz-content">
													<h5 class="title"><a href="shop-list.html">Athletic Mesh Sports Leggings</a></h5>
													<h5 class="price">$80</h5>
												</div>
												<div class="product-tag">
										<span class="badge ">Try On</span>
									</div>
											</div>
										</div>
										<div class="col-6 col-xl-3 col-lg-4 col-md-4 col-sm-6 m-md-b15 m-b30">
											<div class="shop-card style-1">
												<div class="dz-media">
													<img src="images/product-card/product-5.webp" alt="image">
											<div class="shop-meta">
														<a href="javascript:void(0);" class="btn btn-secondary btn-md btn-rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">
															<i class="fa-solid fa-eye d-md-none d-block"></i>
															<span class="d-md-block d-none">Quick View</span>
														</a>
														<div class="btn btn-primary meta-icon dz-wishicon" data-bs-toggle="modal" data-bs-target="#exampleModal">
												<i class="icon feather icon-eye dz-eye"></i>
												<i class="icon feather icon-eye-on dz-eye-fill"></i>
											</div>
											<a href="shop-cart.html" class="btn btn-primary meta-icon dz-carticon">
												<i class="flaticon flaticon-basket"></i>
												<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
											</a>
													</div>								
												</div>
												<div class="dz-content">
													<h5 class="title"><a href="shop-list.html">Vintage Denim Overalls Shorts</a></h5>
													<h5 class="price">$80</h5>
												</div>
												<div class="product-tag">
										<span class="badge ">Try On</span>
									</div>
											</div>
										</div>
										<div class="col-6 col-xl-3 col-lg-4 col-md-4 col-sm-6 m-md-b15 m-b30">
											<div class="shop-card style-1">
												<div class="dz-media">
													<img src="images/product-card/product-6.webp" alt="image">
											<div class="shop-meta">
														<a href="javascript:void(0);" class="btn btn-secondary btn-md btn-rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">
															<i class="fa-solid fa-eye d-md-none d-block"></i>
															<span class="d-md-block d-none">Quick View</span>
														</a>
														<div class="btn btn-primary meta-icon dz-wishicon" data-bs-toggle="modal" data-bs-target="#exampleModal">
												<i class="icon feather icon-eye dz-eye"></i>
												<i class="icon feather icon-eye-on dz-eye-fill"></i>
											</div>
											<a href="shop-cart.html" class="btn btn-primary meta-icon dz-carticon">
												<i class="flaticon flaticon-basket"></i>
												<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
											</a>
													</div>								
												</div>
												<div class="dz-content">
													<h5 class="title"><a href="shop-list.html">Satin Wrap Party Blouse</a></h5>
													<h5 class="price">$80</h5>
												</div>
												<div class="product-tag">
										<span class="badge ">Try On</span>
									</div>
											</div>
										</div>
										<div class="col-6 col-xl-3 col-lg-4 col-md-4 col-sm-6 m-md-b15 m-b30">
											<div class="shop-card style-1">
												<div class="dz-media">
													<img src="images/product-card/product-7.webp" alt="image">
											<div class="shop-meta">
														<a href="javascript:void(0);" class="btn btn-secondary btn-md btn-rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">
															<i class="fa-solid fa-eye d-md-none d-block"></i>
															<span class="d-md-block d-none">Quick View</span>
														</a>
														<div class="btn btn-primary meta-icon dz-wishicon" data-bs-toggle="modal" data-bs-target="#exampleModal">
												<i class="icon feather icon-eye dz-eye"></i>
												<i class="icon feather icon-eye-on dz-eye-fill"></i>
											</div>
											<a href="shop-cart.html" class="btn btn-primary meta-icon dz-carticon">
												<i class="flaticon flaticon-basket"></i>
												<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
											</a>
													</div>								
												</div>
												<div class="dz-content">
													<h5 class="title"><a href="shop-list.html">Plaid Wool Winter Coat</a></h5>
													<h5 class="price">$80</h5>
												</div>
												<div class="product-tag">
										<span class="badge ">Try On</span>
									</div>
											</div>
										</div>
										<div class="col-6 col-xl-3 col-lg-4 col-md-4 col-sm-6 m-md-b15 m-b30">
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
											<a href="shop-cart.html" class="btn btn-primary meta-icon dz-carticon">
												<i class="flaticon flaticon-basket"></i>
												<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
											</a>
													</div>								
												</div>
												<div class="dz-content">
													<h5 class="title"><a href="shop-list.html">Water-Resistant Windbreaker Jacket</a></h5>
													<h5 class="price">$80</h5>
												</div>
												<div class="product-tag">
										<span class="badge ">Try On</span>
									</div>
											</div>
										</div>
										<div class="col-6 col-xl-3 col-lg-4 col-md-4 col-sm-6 m-md-b15 m-b30">
											<div class="shop-card style-1">
												<div class="dz-media">
													<img src="images/product-card/product-2.webp" alt="image">
											<div class="shop-meta">
														<a href="javascript:void(0);" class="btn btn-secondary btn-md btn-rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">
															<i class="fa-solid fa-eye d-md-none d-block"></i>
															<span class="d-md-block d-none">Quick View</span>
														</a>
														<div class="btn btn-primary meta-icon dz-wishicon" data-bs-toggle="modal" data-bs-target="#exampleModal">
												<i class="icon feather icon-eye dz-eye"></i>
												<i class="icon feather icon-eye-on dz-eye-fill"></i>
											</div>
											<a href="shop-cart.html" class="btn btn-primary meta-icon dz-carticon">
												<i class="flaticon flaticon-basket"></i>
												<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
											</a>
													</div>								
												</div>
												<div class="dz-content">
													<h5 class="title"><a href="shop-list.html">Comfy Lounge Jogger Pants</a></h5>
													<h5 class="price">$80</h5>
												</div>
												<div class="product-tag">
										<span class="badge ">Try On</span>
									</div>
											</div>
										</div>
										<div class="col-6 col-xl-3 col-lg-4 col-md-4 col-sm-6 m-md-b15 m-b30">
											<div class="shop-card style-1">
												<div class="dz-media">
													<img src="images/product-card/product-3.webp" alt="image">
											<div class="shop-meta">
														<a href="javascript:void(0);" class="btn btn-secondary btn-md btn-rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">
															<i class="fa-solid fa-eye d-md-none d-block"></i>
															<span class="d-md-block d-none">Quick View</span>
														</a>
														<div class="btn btn-primary meta-icon dz-wishicon" data-bs-toggle="modal" data-bs-target="#exampleModal">
												<i class="icon feather icon-eye dz-eye"></i>
												<i class="icon feather icon-eye-on dz-eye-fill"></i>
											</div>
											<a href="shop-cart.html" class="btn btn-primary meta-icon dz-carticon">
												<i class="flaticon flaticon-basket"></i>
												<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
											</a>
													</div>								
												</div>
												<div class="dz-content">
													<h5 class="title"><a href="shop-list.html">Stylish Fedora Hat Collection</a></h5>
													<h5 class="price">$80</h5>
												</div>
												<div class="product-tag">
										<span class="badge ">Try On</span>
									</div>
											</div>
										</div>
										<div class="col-6 col-xl-3 col-lg-4 col-md-4 col-sm-6 m-md-b15 m-b30">
											<div class="shop-card style-1">
												<div class="dz-media">
													<img src="images/product-card/product-4.webp" alt="image">
											<div class="shop-meta">
														<a href="javascript:void(0);" class="btn btn-secondary btn-md btn-rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">
															<i class="fa-solid fa-eye d-md-none d-block"></i>
															<span class="d-md-block d-none">Quick View</span>
														</a>
														<div class="btn btn-primary meta-icon dz-wishicon" data-bs-toggle="modal" data-bs-target="#exampleModal">
												<i class="icon feather icon-eye dz-eye"></i>
												<i class="icon feather icon-eye-on dz-eye-fill"></i>
											</div>
											<a href="shop-cart.html" class="btn btn-primary meta-icon dz-carticon">
												<i class="flaticon flaticon-basket"></i>
												<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
											</a>
													</div>								
												</div>
												<div class="dz-content">
													<h5 class="title"><a href="shop-list.html">Suede Ankle Booties Collection</a></h5>
													<h5 class="price">$80</h5>
												</div>
												<div class="product-tag">
										<span class="badge ">Try On</span>
									</div>
											</div>
										</div>
										<div class="col-6 col-xl-3 col-lg-4 col-md-4 col-sm-6 m-md-b15 m-b30">
											<div class="shop-card style-1">
												<div class="dz-media">
													<img src="images/product-card/product-6.webp" alt="image">
											<div class="shop-meta">
														<a href="javascript:void(0);" class="btn btn-secondary btn-md btn-rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">
															<i class="fa-solid fa-eye d-md-none d-block"></i>
															<span class="d-md-block d-none">Quick View</span>
														</a>
														<div class="btn btn-primary meta-icon dz-wishicon" data-bs-toggle="modal" data-bs-target="#exampleModal">
												<i class="icon feather icon-eye dz-eye"></i>
												<i class="icon feather icon-eye-on dz-eye-fill"></i>
											</div>
											<a href="shop-cart.html" class="btn btn-primary meta-icon dz-carticon">
												<i class="flaticon flaticon-basket"></i>
												<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
											</a>
													</div>								
												</div>
												<div class="dz-content">
													<h5 class="title"><a href="shop-list.html">Hiking Outdoor Gear Collection</a></h5>
													<h5 class="price">$80</h5>
												</div>
												<div class="product-tag">
										<span class="badge ">Try On</span>
									</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row page mt-0">
							<div class="col-md-6">
								<p class="page-text">Showing 1–5 Of 50 Results</p>
							</div>
							<div class="col-md-6">
								<nav aria-label="Blog Pagination">
									<ul class="pagination style-1">
										<li class="page-item"><a class="page-link active" href="javascript:void(0);">1</a></li>
										<li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
										<li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
										<li class="page-item"><a class="page-link next" href="javascript:void(0);">Next</a></li>
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

	<!-- Quick Modal Start -->
	<!-- Quick Modal Start -->
	<!-- <div class="modal quick-view-modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
		
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
									<?php $productDetails['short_description']?>
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
	</div> -->
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
											
										</div>
									</div>
									<div class="swiper quick-modal-swiper thumb-swiper-lg thumb-sm swiper-vertical">
										<div class="swiper-wrapper">
											
										</div>
									</div>
								</div>  
							</div>  
						</div>
						<div class="col-xl-6 col-md-6">
							<div class="dz-product-detail style-2 ps-xl-3 ps-0 pt-2 mb-0">
								<div class="dz-content">
									<p class="para-text mt-5" id="product-description">
										
									</p>
									<div class="meta-content m-b20 d-flex align-items-end">
										<div class="me-3">
											<span class="form-label">Price</span>
											<span class="price" id="product-price">
												
											</span>
										</div>
										<div class="btn-quantity light me-0">
											<label class="form-label">Quantity</label>
											<input type="text" value="1" name="demo_vertical2">
										</div>
									</div>
									<div class="cart-btn">
										<a href="JavaScript:void(0)" class="btn btn-secondary text-uppercase">Add To Cart</a>
										<a href="JavaScript:void(0)" class="btn btn-outline-secondary btn-icon">
											<i class="bi bi-cart-plus"></i> BUY NOW
										</a>
									</div>
									<div class="dz-info mb-0">
										<ul>
											<li><strong>SKU:</strong></li>
											<li id="product-sku">
												
											</li>
										</ul>
										<ul>
											<li><strong>Category:</strong></li>
											<li id="product-category">
												
											</li>                                                
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
                slidesPerView: 2, // Show 2 slides on tablet
            },
            1024: {
                slidesPerView: 3, // Show 3 slides on desktop
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

<!-- <script>
	document.querySelector('[data-bs-toggle="modal"]').addEventListener('click', function (e) {
    // Get the data-* attributes
    var price = e.target.closest('a').getAttribute('data-price');
    var oldPrice = e.target.closest('a').getAttribute('data-old-price');
    var description = e.target.closest('a').getAttribute('data-description');
    var singleImage = e.target.closest('a').getAttribute('data-single-image');
    var images = JSON.parse(e.target.closest('a').getAttribute('data-images')); // Parse JSON array of images
    var sku = e.target.closest('a').getAttribute('data-sku');
    var category = e.target.closest('a').getAttribute('data-category');

    // Update the modal content dynamically
    document.querySelector('#exampleModal .dz-product-detail .dz-content .para-text').innerText = description;

    // Set price details
    var priceElement = document.querySelector('#exampleModal .meta-content .price');
    priceElement.querySelector('.product-price').innerText = price;
    var oldPriceElement = priceElement.querySelector('.old-price');
    oldPriceElement.innerText = oldPrice;

    // Set SKU and Category
    document.querySelector('#exampleModal .dz-info .product-sku').innerText = sku;
    document.querySelector('#exampleModal .dz-info .product-category').innerHTML = category;

    // Set the main image (first image in the array or single image)
    var mainImageElement = document.querySelector('#exampleModal .swiper-wrapper');
    mainImageElement.innerHTML = ''; // Clear any existing image

    if (images.length === 0) {
        var imgElement = document.createElement('img');
        imgElement.src = singleImage; // Use the single image path
        imgElement.alt = 'Product Image';
        mainImageElement.appendChild(imgElement);
    } else {
        // If images exist in the array, create image elements for each one
        images.forEach(function(image) {
            var imgElement = document.createElement('img');
            imgElement.src = "adminuploads/products/" + image; // Use the image path from the array
            imgElement.alt = 'Product Image';
            mainImageElement.appendChild(imgElement);
        });
    }

    // Now handle thumbnails
    var thumbContainer = document.querySelector('#exampleModal .thumb-swiper-lg .swiper-wrapper');
    thumbContainer.innerHTML = ''; // Clear existing thumbnails

    if (images.length === 0) {
        var thumbElement = document.createElement('div');
        thumbElement.classList.add('swiper-slide');
        thumbElement.innerHTML = `<img src="${singleImage}" alt="Thumbnail Image">`;
        thumbContainer.appendChild(thumbElement);
    } else {
        images.forEach(function(image) {
            var thumbElement = document.createElement('div');
            thumbElement.classList.add('swiper-slide');
            thumbElement.innerHTML = `<img src="adminuploads/products/${image}" alt="Thumbnail Image">`;
            thumbContainer.appendChild(thumbElement);
        });
    }
});

</script> -->
<script>
	
	$(document).on('click', '[data-bs-toggle="modal"]', function() {
    var product_id = $(this).data('id');  // Get the product_id from the data-id attribute
    console.log("Product ID: ", product_id);  // Check if the product_id is being fetched correctly

    // Trigger the AJAX request
    $.ajax({
        type: "POST",
        url: "fetch.php",
        data: { product_id: product_id },
        success: function(response) {
            console.log("Response from fetch.php: ", response);  // Check the response

            var data = JSON.parse(response);  // Parse the response as JSON
            
            if (data.error) {
                alert(data.error);  // Show error message if product not found
            } else {
                // Populate modal with dynamic data
                $('#exampleModal .modal-body').html(`
                    <div class="row g-xl-4 g-3">
                        <div class="col-xl-6 col-md-6">
                            <div class="dz-product-detail mb-0">
                                <div class="swiper-btn-center-lr">
                                    <div class="swiper quick-modal-swiper2">
                                        <div class="swiper-wrapper" id="lightgallery">
                                            ${data.images}
                                        </div>
                                    </div>
                                    <div class="swiper quick-modal-swiper thumb-swiper-lg thumb-sm swiper-vertical">
                                        <div class="swiper-wrapper">
                                            ${data.images}
                                        </div>
                                    </div>
                                </div>	
                            </div>	
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="dz-product-detail style-2 ps-xl-3 ps-0 pt-2 mb-0">
                                <div class="dz-content">
                                    <p class="para-text mt-5">${data.description}</p>
                                    <div class="meta-content m-b20 d-flex align-items-end">
                                        <div class="me-3">
                                            <span class="form-label">Price</span>
                                            <span class="price">${data.price}</span>
                                        </div>
                                        <div class="btn-quantity light me-0">
                                            <label class="form-label">Quantity</label>
                                            <input type="text" value="1" name="demo_vertical2">
                                        </div>
                                    </div>
                                    <div class="cart-btn">
                                        <a href="JavaScript:void(0)" class="btn btn-secondary text-uppercase">Add To Cart</a>
                                        <a href="JavaScript:void(0)" class="btn btn-outline-secondary btn-icon">
                                            <i class="bi bi-cart-plus"></i> BUY NOW
                                        </a>
                                    </div>
                                    <div class="dz-info mb-0">
                                        <ul>
                                            <li><strong>SKU:</strong></li>
                                            <li>${data.sku}</li>
                                        </ul>
                                        <ul>
                                            <li><strong>Category:</strong></li>
                                            <li>${data.category}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `);

                // Optionally, open the modal if it's not already open
                $('#exampleModal').modal('show');
            }
        },
        error: function(xhr, status, error) {
            console.log("AJAX Error: " + status + " " + error);  // Log AJAX error
        }
    });
});


</script>
</body>
</html>