<?php
if (!isset($_SESSION)) {
	session_start();
	}
error_reporting(E_ALL);
require "config/config.php";
require "config/common.php";

$conn = new dbClass();
$banner = new BannerPage();

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
<body id="bg">
<div class="page-wraper">

	<!-- <div id="loading-area" class="preloader-wrapper-4">
		<img src="images/loading.gif" alt="">
	</div>
	 -->
	<!-- Header Star -->
	<?php include("include/header.php"); ?>
	<!-- Header End -->
	
	<div class="page-content  ">
	
		<div class="main-slider-wrapper">
			<div class="slider-inner">
				<div class="row">
					<div class="col-1 d-none d-sm-block">
						<div class="slider-main">
							 
						</div>
					</div>
					<div class="col-lg-11 col-12 hero-slider-main ">
						<div class="slider-thumbs">
							<?php
								$banner1Sql = $banner->getBanners();
								foreach ($banner1Sql as $banner1Row):
							?>
								<div class="slick-slide">
									<div class="banner-media" data-name="Winter">
										<div class="img-preview">
											<img src="adminuploads/banner/<?php echo htmlspecialchars($banner1Row['image']); ?>" alt="Peura Opticals">
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
 
			</div>
		</div>
		
		<!-- Shop Section Start -->
		<section class="shop-section overflow-hidden" id="category-glasses">
			<div class="container-fluid p-0">
				<div class="row">
					<div class="col-lg-8 left-box order-2 order-lg-1 ">
						<div class="swiper swiper-shop">
							<div class="swiper-wrapper">
								<div class="swiper-slide">
									<div class="shop-card style-7 ">
										<div class="dz-media">
											<img loading="lazy" src="images/unisex4.webp" alt="image">
										</div>
										<div class="dz-content">
											<h5 class="title"><a href="JavaScript:void(0)">Unisex</a></h5>
										</div>
									</div>
								</div>
								<div class="swiper-slide">
									<div class="shop-card style-7 ">
										<div class="dz-media">
											<img loading="lazy" src="images/cashback-card/cashbak-2.webp" alt="image">
										</div>
										<div class="dz-content">
											<h5 class="title"><a href="JavaScript:void(0)">Women</a></h5>
										</div>
									</div>
								</div>
								<div class="swiper-slide">
									<div class="shop-card style-7 ">
										<div class="dz-media">
											<img loading="lazy" src="images/cashback-card/cashbak-3.webp" alt="image">
										</div>
										<div class="dz-content">
											<h5 class="title"><a href="JavaScript:void(0)">Men</a></h5>
										</div>
									</div>
								</div>
								<div class="swiper-slide">
									<div class="shop-card style-7 ">
										<div class="dz-media">
											<img loading="lazy" src="images/kids.webp" alt="image">
										</div>
										<div class="dz-content">
											<h5 class="title"><a href="JavaScript:void(0)">Kids</a></h5>
										</div>
									</div>
								</div>
								<div class="swiper-slide">
									<div class="shop-card style-7 ">
										<div class="dz-media">
											<img loading="lazy" src="images/sunglass.webp" alt="image">
										</div>
										<div class="dz-content">
											<h5 class="title"><a href="JavaScript:void(0)">Sunglasses</a></h5>
											
										</div>
									</div>
								</div>
								<div class="swiper-slide">
									<div class="shop-card style-7 ">
										<div class="dz-media">
											<img loading="lazy" src="images/turban1.webp" alt="image">
										</div>
										<div class="dz-content">
											<h5 class="title"><a href="JavaScript:void(0)">Turban Friendly</a></h5>
											
										</div>
									</div>
								</div>
								
							</div>
						</div>
						<a class="icon-button" href="JavaScript:void(0)">
							<div class="text-row word-rotate-box c-black border-secondary">
								<span class="word-rotate">More Glasses Explore </span>
								<svg class="badge__emoji" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewbox="0 0 35 35" fill="none">
									<path d="M32.2645 16.9503H4.08145L10.7508 10.4669C11.2604 9.97176 10.5046 9.1837 9.98813 9.68289C9.98815 9.68286 2.35193 17.1063 2.35193 17.1063C2.12911 17.3092 2.14686 17.6755 2.35196 17.8903C2.35193 17.8903 9.98815 25.3169 9.98815 25.3169C10.5021 25.81 11.2622 25.0367 10.7508 24.5328C10.7508 24.5329 4.07897 18.0441 4.07897 18.0441H32.2645C32.9634 18.0375 32.9994 16.9636 32.2645 16.9503Z" fill="#000"></path>
								</svg>
							</div>
						</a>
					</div>
					<div class="col-lg-4 right-box order-1 order-lg-2 right-box-bottom">
						<div>
							<h3 class="title wow fadeInUp" data-wow-delay="1.2s">Featured Categories</h3>
							<p class="text wow fadeInUp" data-wow-delay="1.4s">Discover the most trending products in Peura Opticals.</p>
							<div class="pagination-align justify-content-md-start justify-content-around wow fadeInUp" data-wow-delay="1.6s">
								<div class="shop-button-prev">
									<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewbox="0 0 35 35" fill="none">
										<path d="M32.2645 16.9503H4.08145L10.7508 10.4669C11.2604 9.97176 10.5046 9.1837 9.98813 9.68289C9.98815 9.68286 2.35193 17.1063 2.35193 17.1063C2.12911 17.3092 2.14686 17.6755 2.35196 17.8903C2.35193 17.8903 9.98815 25.3169 9.98815 25.3169C10.5021 25.81 11.2622 25.0367 10.7508 24.5328C10.7508 24.5329 4.07897 18.0441 4.07897 18.0441H32.2645C32.9634 18.0375 32.9994 16.9636 32.2645 16.9503Z" fill="white"></path>
									</svg>
								</div>
								<div class="shop-button-next">
									<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewbox="0 0 35 35" fill="none">
									  <path d="M2.73549 16.9503H30.9186L24.2492 10.4669C23.7396 9.97176 24.4954 9.1837 25.0119 9.68289L32.6481 17.1063C32.8709 17.3092 32.8531 17.6755 32.648 17.8903L25.0118 25.3169C24.4979 25.81 23.7378 25.0367 24.2492 24.5328L30.921 18.0441H2.73549C2.03663 18.0375 2.00064 16.9636 2.73549 16.9503Z" fill="white"></path>
									</svg>
								</div>
							</div>
						</div>
						<a class="icon-button" href="JavaScript:void(0)">
							<div class="text-row word-rotate-box c-black border-white">
								<span class="word-rotate">More Collection Explore </span>
								<svg class="badge__emoji" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewbox="0 0 35 35" fill="none">
									<path d="M32.2645 16.9503H4.08145L10.7508 10.4669C11.2604 9.97176 10.5046 9.1837 9.98813 9.68289C9.98815 9.68286 2.35193 17.1063 2.35193 17.1063C2.12911 17.3092 2.14686 17.6755 2.35196 17.8903C2.35193 17.8903 9.98815 25.3169 9.98815 25.3169C10.5021 25.81 11.2622 25.0367 10.7508 24.5328C10.7508 24.5329 4.07897 18.0441 4.07897 18.0441H32.2645C32.9634 18.0375 32.9994 16.9636 32.2645 16.9503Z" fill="white"></path>
								</svg>
							</div>
						</a>
					</div>
				</div>
			</div>
		</section>
		<!-- Shop Section End -->
		
		

<!-- Offer Section Start -->
<section class="content-inner-2 pb-2 pb-md-5 mb-2 mb-md-5">
	<div class="container">	
		<div class="section-head style-1 wow fadeInUp d-flex justify-content-between m-b30" data-wow-delay="0.2s">
			<div class="left-content">
				<h2 class="title">Sunglasses at Affordable Prices</h2>
			</div>
			<!-- <a href="JavaScript:void(0)" class="text-secondary font-14 d-flex align-items-center gap-1">See All 
				<i class="icon feather icon-chevron-right font-18"></i>
			</a>			 -->
		</div>
	</div>

 
<!-- desctop -->
<div class="container px-3 d-none d-lg-block" id="category-prodect">
	<div class="row">

				<div class="col">
					<div class="product-box style-2 wow fadeInUp" data-wow-delay="0.6s">
						<div class="product-media" style="background-image: url('https://images.pexels.com/photos/1499477/pexels-photo-1499477.jpeg?auto=compress&cs=tinysrgb&w=600');"></div>
						<div class="product-content">
							<div class="main-content">
								<span class="offer">Under ₹1000</span>
								<h4 class="sub-title1 ">Summer <span class="year ">2024</span></h4>
								<a href="JavaScript:void(0)" class="btn btn-outline-secondary btn-rounded btn-lg ">Collect Now</a>
							</div>
						</div>
					</div>
				</div>
 
		<div class="col">
			<div class="product-box style-2 wow fadeInUp" data-wow-delay="0.6s">
				<div class="product-media" style="background-image: url('https://images.unsplash.com/photo-1577400983943-874919eca6ce?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTQ4fHxleWVnbGFzc2VzfGVufDB8fDB8fHww'); transform: scaleX(-1);"></div>
				<div class="product-content">
					<div class="main-content">
						<span class="offer">₹1000-₹2000</span>
						<h4 class="sub-title1">Summer <span class="year">2024</span></h4>
						<a href="JavaScript:void(0)" class="btn btn-outline-secondary btn-rounded btn-lg">Collect Now</a>
					</div>
				</div>
			</div>
		</div>
 
		<div class="col">
			<div class="product-box style-2 wow fadeInUp" data-wow-delay="0.8s">
				<div class="product-media" style="background-image: url('https://images.pexels.com/photos/4226871/pexels-photo-4226871.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');"></div>
				<div class="product-content">
					<div class="main-content">
						<span class="offer">Above ₹2000</span>
						<h4 class="sub-title2">Swimwear<span class="bg-title">Sale</span></h4>
						<a href="JavaScript:void(0)" class="btn btn-outline-secondary btn-rounded btn-lg">Collect Now</a>
					</div>
				</div>
			</div>
		</div>
	 
		</div>

</div>
<!-- desctop-end -->


	
	<div class="container px-3 d-lg-none" id="category-product">
		<div class="swiper">
			<div class="swiper-wrapper">
				<!-- Slide 1 -->
				<div class="swiper-slide">
					<div class="product-box style-2 wow fadeInUp" data-wow-delay="0.6s">
						<div class="product-media" style="background-image: url('https://images.pexels.com/photos/1499477/pexels-photo-1499477.jpeg?auto=compress&cs=tinysrgb&w=600');"></div>
						<div class="product-content">
							<div class="main-content">
								<span class="offer">Under ₹1000</span>
								<h4 class="sub-title1">Summer <span class="year">2024</span></h4>
								<a href="JavaScript:void(0)" class="btn btn-outline-secondary btn-rounded btn-lg">Collect Now</a>
							</div>
						</div>
					</div>
				</div>
				<!-- Slide 2 -->
				<div class="swiper-slide">
					<div class="product-box style-2 wow fadeInUp" data-wow-delay="0.6s">
						<div class="product-media" style="background-image: url('https://images.unsplash.com/photo-1577400983943-874919eca6ce?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTQ4fHxleWVnbGFzc2VzfGVufDB8fDB8fHww'); transform: scaleX(-1);"></div>
						<div class="product-content">
							<div class="main-content">
								<span class="offer">₹1000-₹2000</span>
								<h4 class="sub-title1">Summer <span class="year">2024</span></h4>
								<a href="JavaScript:void(0)" class="btn btn-outline-secondary btn-rounded btn-lg">Collect Now</a>
							</div>
						</div>
					</div>
				</div>
				<!-- Slide 3 -->
				<div class="swiper-slide">
					<div class="product-box style-2 wow fadeInUp" data-wow-delay="0.8s">
						<div class="product-media" style="background-image: url('https://images.pexels.com/photos/4226871/pexels-photo-4226871.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');"></div>
						<div class="product-content">
							<div class="main-content">
								<span class="offer">Above ₹2000</span>
								<h4 class="sub-title2">Swimwear<span class="bg-title">Sale</span></h4>
								<a href="JavaScript:void(0)" class="btn btn-outline-secondary btn-rounded btn-lg">Collect Now</a>
							</div>
						</div>
					</div>
				</div>
			</div>
	
			<!-- Navigation buttons -->
			<!-- <div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div> -->
	
			<!-- Pagination -->
			<div class="swiper-pagination"></div>
		</div>
	</div>
	
</section>
<!-- Product End -->

		
	 

		<!-- Tranding Start-->
		<section class="content-inner-1 overflow-hidden">
			<div class="container">
				<div class=" row justify-content-md-between align-items-center">
					<div class="col-lg-6 col-md-8 col-sm-12">
						<div class="section-head style-1 m-b30  wow fadeInUp" data-wow-delay="0.2s">
							<div class="left-content">
								<h2 class="title">What's trending now</h2>
								<p>Discover the most trending products in Peura Opticals.</p>
							</div>
						</div>	
					</div>
					<!-- <div class="col-lg-6 col-md-4 col-sm-12 text-md-end">
						<a class="btn btn-secondary m-b30" href="shop-cart.html">View All</a>
					</div> -->
				</div>
 
				<div class="swiper-btn-center-lr">
					<div class="swiper swiper-four">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<div class="shop-card wow fadeInUp" data-wow-delay="0.2s">
									<div class="dz-media">
										<img loading="lazy" src="images/product-card/product-1.webp" alt="image">
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
										<h5 class="title"><a href="product-detail.html">Elegant Aviator Frames</a></h5>
										<h5 class="price">₹80</h5>
									</div>
									<div class="product-tag">
										<span class="badge ">Try On</span>
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="shop-card wow fadeInUp" data-wow-delay="0.3s">
									<div class="dz-media">
										<img loading="lazy" src="images/product-card/product-2.webp" alt="image">
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
										<h5 class="title"><a href="product-detail.html">Retro Square Glasses</a></h5>
										<h5 class="price">₹80</h5>
									</div>
									<div class="product-tag">
										<span class="badge ">Try On</span>
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="shop-card wow fadeInUp" data-wow-delay="0.4s">
									<div class="dz-media">
										<img loading="lazy" src="images/product-card/product-3.webp" alt="image">
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
										<h5 class="title"><a href="product-detail.html">Stylish Cat-Eye Glasses</a></h5>
										<h5 class="price">₹80</h5>
									</div>
									<div class="product-tag">
										<span class="badge ">Try On</span>
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="shop-card wow fadeInUp" data-wow-delay="0.5s">
									<div class="dz-media">
										<img loading="lazy" src="images/product-card/product-4.webp" alt="image">
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
										<h5 class="title"><a href="product-detail.html">Modern Blue Light Glasses</a></h5>
										<h5 class="price">₹80</h5>
									</div>
									<div class="product-tag">
										<span class="badge ">Try On</span>
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="shop-card wow fadeInUp" data-wow-delay="0.6s">
									<div class="dz-media">
										<img loading="lazy" src="images/product-card/product-5.webp" alt="image">
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
										<h5 class="title"><a href="product-detail.html">Premium Eyewear Frames</a></h5>
										<h5 class="price">₹80</h5>
									</div>
									<div class="product-tag">
										<span class="badge ">Try On</span>
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="shop-card wow fadeInUp" data-wow-delay="0.7s">
									<div class="dz-media">
										<img loading="lazy" src="images/product-card/product-6.webp" alt="image">
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
										<h5 class="title"><a href="product-detail.html">Premium Eyewear Frames</a></h5>
										<h5 class="price">₹80</h5>
									</div>
									<div class="product-tag">
										<span class="badge ">Try On</span>
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="shop-card wow fadeInUp" data-wow-delay="0.8s">
									<div class="dz-media">
										<img loading="lazy" src="images/product-card/product-7.webp" alt="image">
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
										<h5 class="title"><a href="product-detail.html">Classic Denim Skinny Jeans</a></h5>
										<h5 class="price">₹80</h5>
									</div>
									<div class="product-tag">
										<span class="badge ">Try On</span>
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="shop-card wow fadeInUp" data-wow-delay="0.9s">
									<div class="dz-media">
										<img loading="lazy" src="images/product-card/product-3.webp" alt="image">
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
										<h5 class="title"><a href="product-detail.html">Athletic Mesh Sports Leggings</a></h5>
										<h5 class="price">₹80</h5>
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
		</section>
		<!-- Tranding Stop-->
		
		<!-- Products Section Start -->
	<!-- Tranding Start-->
	<section class="content-inner-1 overflow-hidden">
		<div class="container">
 

			<div class="swiper-btn-center-lr">
				<div class="swiper swiper-four">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							<div class="shop-card wow fadeInUp" data-wow-delay="0.2s">
								<div class="dz-media">
									<img loading="lazy" src="images/product-card/product-7.webp" alt="image">
									<div class="shop-meta">
										<a href="javascript:void(0);" class="btn btn-secondary btn-md btn-rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">
											<i class="fa-solid fa-eye d-md-none d-block"></i>
											<span class="d-md-block d-none">Quick View</span>
										</a>
										<div class="btn btn-primary meta-icon dz-wishicon" data-bs-toggle="modal" data-bs-target="#exampleModal">
											<i class="icon feather icon-heart dz-heart"></i>
											<i class="icon feather icon-heart-on dz-heart-fill"></i>
										</div>
										<a href="shop-cart.html" class="btn btn-primary meta-icon dz-carticon">
											<i class="flaticon flaticon-basket"></i>
											<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
										</a>
									</div>							
								</div>
								<div class="dz-content">
									<h5 class="title"><a href="JavaScript:void(0)">Modern Blue Light Glasses</a></h5>
									<h5 class="price">₹80</h5>
								</div>
								<div class="product-tag">
									<span class="badge ">Try On</span>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="shop-card wow fadeInUp" data-wow-delay="0.3s">
								<div class="dz-media">
									<img loading="lazy" src="images/product-card/product-6.webp" alt="image">
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
									<h5 class="title"><a href="JavaScript:void(0)">Premium Eyewear Frames</a></h5>
									<h5 class="price">₹80</h5>
								</div>
								<div class="product-tag">
									<span class="badge ">Try On</span>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="shop-card wow fadeInUp" data-wow-delay="0.4s">
								<div class="dz-media">
									<img loading="lazy" src="images/product-card/product-5.webp" alt="image">
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
									<h5 class="title"><a href="JavaScript:void(0)">Elegant Aviator Frames</a></h5>
									<h5 class="price">₹80</h5>
								</div>
								<div class="product-tag">
									<span class="badge ">Try On</span>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="shop-card wow fadeInUp" data-wow-delay="0.5s">
								<div class="dz-media">
									<img loading="lazy" src="images/product-card/product-4.webp" alt="image">
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
									<h5 class="title"><a href="JavaScript:void(0)">Retro Square Glasses</a></h5>
									<h5 class="price">₹80</h5>
								</div>
								<div class="product-tag">
									<span class="badge ">Try On</span>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="shop-card wow fadeInUp" data-wow-delay="0.6s">
								<div class="dz-media">
									<img loading="lazy" src="images/product-card/product-3.webp" alt="image">
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
									<h5 class="title"><a href="JavaScript:void(0)">Stylish Cat-Eye Glasses</a></h5>
									<h5 class="price">₹80</h5>
								</div>
								<div class="product-tag">
									<span class="badge ">Try On</span>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="shop-card wow fadeInUp" data-wow-delay="0.7s">
								<div class="dz-media">
									<img loading="lazy" src="images/product-card/product-2.webp" alt="image">
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
									<h5 class="title"><a href="JavaScript:void(0)">Stylish Cat-Eye Glasses</a></h5>
									<h5 class="price">₹80</h5>
								</div>
								<div class="product-tag">
									<span class="badge ">Try On</span>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="shop-card wow fadeInUp" data-wow-delay="0.8s">
								<div class="dz-media">
									<img loading="lazy" src="images/product-card/product-1.webp" alt="image">
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
									<h5 class="title"><a href="JavaScript:void(0)">Premium Eyewear Frames</a></h5>
									<h5 class="price">₹80</h5>
								</div>
								<div class="product-tag">
									<span class="badge ">Try On</span>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="shop-card wow fadeInUp" data-wow-delay="0.9s">
								<div class="dz-media">
									<img loading="lazy" src="images/product-card/product-7.webp" alt="image">
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
									<h5 class="title"><a href="JavaScript:void(0)">Premium Eyewear Frames</a></h5>
									<h5 class="price">₹80</h5>
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
	</section>
	<!-- Tranding Stop-->
		<!-- Products Section Start -->

		<!-- Collection Section Start -->
		<section class="adv-area mt-5 pt-3">
			<div class="container-fluid px-0">
				<div class="row product-style2 g-0">
					<div class="col-lg-6 col-md-12 wow fadeInUp" data-wow-delay="0.1s">
						<div class="product-box style-4">
							<div class="product-media" style="background-image: url('images/banner-1.webp');"></div>
							<div class="sale-box">
								<div class="badge style-1 mb-1">Up to 50% Off</div>  
								<h2 class="sale-name">Glasses<span>2024</span></h2>
								<a href="JavaScript:void(0)" class="btn btn-outline-secondary btn-lg text-uppercase">Explore Now</a>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-12 wow fadeInUp" data-wow-delay="0.2s">
						<div class="product-box style-4">
							<div class="product-media" style="background-image: url('images/banner-2.webp');"></div>
							<div class="product-content">
								<div class="main-content">
									<div class="badge style-1 mb-3">Up to 50% Off</div>
									<h2 class="product-name">New Eyewear Collection</h2>
								</div>
								<a href="JavaScript:void(0)" class="btn btn-secondary btn-lg text-uppercase">Shop Now</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Collection Section End -->
		
	

		<!-- Map Area Start-->
		<section class="content-inner-3 overflow-hidden " id="Maping">
			<div class="container p-0">
				<div class="row align-items-start">
					
					<div class="col-xl-12 col-lg-12 col-md-12 custom-width">

		
						<div class=" row justify-content-md-between align-items-center">
							<div class="col-lg-8 col-md-8 col-sm-12">
								<div class="section-head style-1 m-b30  wow fadeInUp" data-wow-delay="0.2s">
									<div class="left-content">
										<h2 class="title">Find the Hottest Eyewear Trends Near You</h2>
										<p>Up to 60% off + up to ₹107 Cashback</p>
									</div>
								</div>	
							</div>
				 
						</div>

						<div class="swiper swiper-shop2 swiper-visible">
							<div class="swiper-wrapper">
								<div class="swiper-slide wow fadeInUp" data-wow-delay="0.2s">
									<div class="shop-card style-7 ">
										<div class="dz-media">
											<img loading="lazy" src="images/cashback-card/cashbak-1.webp" alt="image">
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
											<h5 class="title"><a href="product-detail.html">Durable Athletic Eyewear</a></h5>
											<h5 class="price">₹80</h5>
										</div>
										<div class="product-tag">
											<span class="badge ">Try On</span>
										</div>
									</div>
								</div>
								<div class="swiper-slide wow fadeInUp" data-wow-delay="0.2s">
									<div class="shop-card style-7 ">
										<div class="dz-media">
											<img loading="lazy" src="images/cashback-card/cashbak-2.webp" alt="image">
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
											<h5 class="title"><a href="product-detail.html">Performance Sports Glasses</a></h5>
											<h5 class="price">₹80</h5>
										</div>
										<div class="product-tag">
											<span class="badge ">Try On</span>
										</div>
									</div>
								</div>
								<div class="swiper-slide wow fadeInUp" data-wow-delay="0.2s">
									<div class="shop-card style-7 ">
										<div class="dz-media">
											<img loading="lazy" src="images/cashback-card/cashbak-3.webp" alt="image">
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
											<h5 class="title"><a href="product-detail.html">Active Wear Sunglasses</a></h5>
											<h5 class="price">₹80</h5>
										</div>
										<div class="product-tag">
											<span class="badge ">Try On</span>
										</div>
									</div>
								</div>
								<div class="swiper-slide wow fadeInUp" data-wow-delay="0.2s">
									<div class="shop-card style-7 ">
										<div class="dz-media">
											<img loading="lazy" src="images/cashback-card/cashbak-4.webp" alt="image">
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
											<h5 class="title"><a href="product-detail.html">Sporty Polarized Glasses</a></h5>
											<h5 class="price">₹80</h5>
										</div>
										<div class="product-tag">
											<span class="badge ">Try On</span>
										</div>
									</div>
								</div>
								<div class="swiper-slide wow fadeInUp" data-wow-delay="0.2s">
									<div class="shop-card style-7 ">
										<div class="dz-media">
											<img loading="lazy" src="images/cashback-card/cashbak-5.webp" alt="image">
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
											<h5 class="title"><a href="product-detail.html">High-Performance Sports Frames</a></h5>
											<h5 class="price">₹80</h5>
										</div>
										<div class="product-tag">
											<span class="badge ">Try On</span>
										</div>
									</div>
								</div>
								<div class="swiper-slide wow fadeInUp" data-wow-delay="0.2s">
									<div class="shop-card style-7 ">
										<div class="dz-media">
											<img loading="lazy" src="images/cashback-card/cashbak-6.webp" alt="image">
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
											<h5 class="title"><a href="product-detail.html">High-Performance Sports Frames</a></h5>
											<h5 class="price">₹80</h5>
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
			</div>	
		</section>

	

		<section class="video-section ">
			<div class="video-wrapper bg-parallax" style="background-image:url('images/play-banner.webp');">
				<div class="container">
					<div class="d-flex justify-content-center">
						<a class="icon-button popup-youtube" href="JavaScript:void(0)">
							<div class="text-row word-rotate-box border-white c-black">
								<span class="word-rotate">shop - shop - shop - shop -</span>
								<svg class="badge__emoji" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewbox="0 0 40 40" fill="none">
									<g clip-path="url(#clip0_671_345)">
									  <path d="M34.6779 15.3843L11.0529 0.821429C9.34369 -0.230839 7.2772 -0.274589 5.52493 0.704398C3.77266 1.68323 2.72656 3.46612 2.72656 5.47323V34.4664C2.72656 37.5013 5.17188 39.9835 8.17735 39.9999C8.18556 39.9999 8.19376 40 8.20181 40C9.14103 39.9999 10.1198 39.7056 11.0339 39.1478C11.7693 38.6991 12.0017 37.7392 11.5531 37.0039C11.1044 36.2685 10.1444 36.0361 9.40923 36.4848C8.98165 36.7456 8.56407 36.8805 8.19415 36.8804C7.06016 36.8742 5.84602 35.9028 5.84602 34.4665V5.47331C5.84602 4.6123 6.29477 3.84769 7.04634 3.42776C7.79798 3.00784 8.68431 3.02659 9.41658 3.47745L33.0417 18.0404C33.7518 18.4776 34.1581 19.2065 34.1564 20.0405C34.1547 20.8743 33.7454 21.6016 33.0314 22.0373L15.9503 32.4958C15.2156 32.9456 14.9847 33.9059 15.4346 34.6405C15.8843 35.3752 16.8446 35.6061 17.5792 35.1563L34.6583 24.6991C36.2935 23.7015 37.2721 21.9624 37.276 20.0467C37.2799 18.1312 36.3083 16.3881 34.6779 15.3843Z" fill="#FEEB9D"></path>
									</g>
									<defs>
									  <clippath id="clip0_671_345">
										<rect width="40" height="40" fill="white"></rect>
									  </clippath>
									</defs>
								</svg>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="dz-features-wrapper overflow-hidden">
				<ul class="dz-features text-wrapper">
					<li class="item">
						<h2 class="title">Stylish</h2>
					</li>	
					<li class="item">
						<svg xmlns="http://www.w3.org/2000/svg" width="61" height="60" viewbox="0 0 61 60" fill="none">
						  <path opacity="0.3" d="M29.302 -0.00499268L38.533 21.2005L60.3307 28.9297L39.1253 38.1607L31.396 59.9585L22.165 38.753L0.367297 31.0237L21.5728 21.7928L29.302 -0.00499268Z" fill="black"></path>
						</svg>
					</li>
					<li class="item">
						<h2 class="title">Classic</h2>
					</li>	
					<li class="item">
						<svg xmlns="http://www.w3.org/2000/svg" width="61" height="60" viewbox="0 0 61 60" fill="none">
						  <path opacity="0.3" d="M29.302 -0.00499268L38.533 21.2005L60.3307 28.9297L39.1253 38.1607L31.396 59.9585L22.165 38.753L0.367297 31.0237L21.5728 21.7928L29.302 -0.00499268Z" fill="black"></path>
						</svg>
					</li>
					<li class="item">
						<h2 class="title">Trendy</h2>
					</li>	
					<li class="item">
						<svg xmlns="http://www.w3.org/2000/svg" width="61" height="60" viewbox="0 0 61 60" fill="none">
						  <path opacity="0.3" d="M29.302 -0.00499268L38.533 21.2005L60.3307 28.9297L39.1253 38.1607L31.396 59.9585L22.165 38.753L0.367297 31.0237L21.5728 21.7928L29.302 -0.00499268Z" fill="black"></path>
						</svg>
					</li>
					<li class="item">
						<h2 class="title">Modern</h2>
					</li>	
					<li class="item">
						<svg xmlns="http://www.w3.org/2000/svg" width="61" height="60" viewbox="0 0 61 60" fill="none">
						  <path opacity="0.3" d="M29.302 -0.00499268L38.533 21.2005L60.3307 28.9297L39.1253 38.1607L31.396 59.9585L22.165 38.753L0.367297 31.0237L21.5728 21.7928L29.302 -0.00499268Z" fill="black"></path>
						</svg>
					</li>
						<li class="item">
						<h2 class="title">Retro</h2>
					</li>	
					<li class="item">
						<svg xmlns="http://www.w3.org/2000/svg" width="61" height="60" viewbox="0 0 61 60" fill="none">
						  <path opacity="0.3" d="M29.302 -0.00499268L38.533 21.2005L60.3307 28.9297L39.1253 38.1607L31.396 59.9585L22.165 38.753L0.367297 31.0237L21.5728 21.7928L29.302 -0.00499268Z" fill="black"></path>
						</svg>
					</li>
					<li class="item">
						<h2 class="title">Elegant</h2>
					</li>	
					<li class="item">
						<svg xmlns="http://www.w3.org/2000/svg" width="61" height="60" viewbox="0 0 61 60" fill="none">
						  <path opacity="0.3" d="M29.302 -0.00499268L38.533 21.2005L60.3307 28.9297L39.1253 38.1607L31.396 59.9585L22.165 38.753L0.367297 31.0237L21.5728 21.7928L29.302 -0.00499268Z" fill="black"></path>
						</svg>
					</li>
					<li class="item">
						<h2 class="title">Durable</h2>
					</li>	
					<li class="item">
						<svg xmlns="http://www.w3.org/2000/svg" width="61" height="60" viewbox="0 0 61 60" fill="none">
						  <path opacity="0.3" d="M29.302 -0.00499268L38.533 21.2005L60.3307 28.9297L39.1253 38.1607L31.396 59.9585L22.165 38.753L0.367297 31.0237L21.5728 21.7928L29.302 -0.00499268Z" fill="black"></path>
						</svg>
					</li>
					<li class="item">
						<h2 class="title">Premium</h2>
					</li>	
					<li class="item">
						<svg xmlns="http://www.w3.org/2000/svg" width="61" height="60" viewbox="0 0 61 60" fill="none">
						  <path opacity="0.3" d="M29.302 -0.00499268L38.533 21.2005L60.3307 28.9297L39.1253 38.1607L31.396 59.9585L22.165 38.753L0.367297 31.0237L21.5728 21.7928L29.302 -0.00499268Z" fill="black"></path>
						</svg>
					</li>
					<li class="item">
						<h2 class="title">Sporty</h2>
					</li>	
					<li class="item">
						<svg xmlns="http://www.w3.org/2000/svg" width="61" height="60" viewbox="0 0 61 60" fill="none">
						  <path opacity="0.3" d="M29.302 -0.00499268L38.533 21.2005L60.3307 28.9297L39.1253 38.1607L31.396 59.9585L22.165 38.753L0.367297 31.0237L21.5728 21.7928L29.302 -0.00499268Z" fill="black"></path>
						</svg>
					</li>
					<li class="item">
						<h2 class="title">Lightweight</h2>
					</li>	
					<li class="item">
						<svg xmlns="http://www.w3.org/2000/svg" width="61" height="60" viewbox="0 0 61 60" fill="none">
						  <path opacity="0.3" d="M29.302 -0.00499268L38.533 21.2005L60.3307 28.9297L39.1253 38.1607L31.396 59.9585L22.165 38.753L0.367297 31.0237L21.5728 21.7928L29.302 -0.00499268Z" fill="black"></path>
						</svg>
					</li>
				</ul>
			</div>
		</section>
		
		<!-- Featured Section Start -->
		<section class="content-inner  overflow-hidden">
			<div class="container">	
				<div class="section-head style-1 wow fadeInUp d-flex justify-content-between" data-wow-delay="0.2s">
					<div class="left-content">
						<h2 class="title">Featured now </h2>
					</div>
					<!-- <a href="JavaScript:void(0)" class="text-secondary font-14 d-flex align-items-center gap-1">See All 
						<i class="icon feather icon-chevron-right font-18"></i>
					</a>			 -->
				</div>
				<div class="swiper swiper-product2 swiper-visible ">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							<div class="shop-card style-4 wow fadeInUp" data-wow-delay="0.4s">
								<div class="dz-media">
									<img loading="lazy" src="images/feature/img1.webp" alt="image">
								</div>
								<div class="dz-content">
									<div>
										<h6 class="title"><a href="product-detail.html">Durable Athletic Eyewear</a></h6>
										<span class="sale-title">Up to 40% Off</span>
									</div>
									<div class="d-flex align-items-center"> 
										<h6 class="price">₹80<del>₹95</del></h6>
										<span class="review"><i class="fa-solid fa-star"></i>(2k Review)</span>
									</div>	
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="shop-card style-4 wow fadeInUp" data-wow-delay="0.6s">
								<div class="dz-media">
									<img loading="lazy" src="images/feature/img2.webp" alt="image">
								</div>
								<div class="dz-content">
									<div>
										<h6 class="title"><a href="product-detail.html">Performance Sports Glasses</a></h6>
										<span class="sale-title">Up to 40% Off</span>
									</div>
									<div class="d-flex align-items-center"> 
										<h6 class="price">₹80<del>₹95</del></h6>
										<span class="review"><i class="fa-solid fa-star"></i>(2k Review)</span>
									</div>	
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="shop-card style-4 wow fadeInUp" data-wow-delay="0.8s">
								<div class="dz-media">
									<img loading="lazy" src="images/feature/img3.webp" alt="image">
								</div>
								<div class="dz-content">
									<div>
										<h6 class="title"><a href="product-detail.html">Active Wear Sunglasses</a></h6>
										<span class="sale-title">Up to 40% Off</span>
									</div>
									<div class="d-flex align-items-center"> 
										<h6 class="price">₹80<del>₹95</del></h6>
										<span class="review"><i class="fa-solid fa-star"></i>(2k Review)</span>
									</div>	
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="shop-card style-4 wow fadeInUp" data-wow-delay="0.4s">
								<div class="dz-media">
									<img loading="lazy" src="images/feature/img4.webp" alt="image">
								</div>
								<div class="dz-content">
									<div>
										<h6 class="title"><a href="product-detail.html">Sporty Polarized Glasses</a></h6>
										<span class="sale-title">Up to 40% Off</span>
									</div>
									<div class="d-flex align-items-center"> 
										<h6 class="price">₹80<del>₹95</del></h6>
										<span class="review"><i class="fa-solid fa-star"></i>(2k Review)</span>
									</div>	
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="shop-card style-4 wow fadeInUp" data-wow-delay="0.6s">
								<div class="dz-media">
									<img loading="lazy" src="images/feature/img5.webp" alt="image">
								</div>
								<div class="dz-content">
									<div>
										<h6 class="title"><a href="product-detail.html">High-Performance Sports Frames</a></h6>
										<span class="sale-title">Up to 40% Off</span>
									</div>
									<div class="d-flex align-items-center"> 
										<h6 class="price">₹80<del>₹95</del></h6>
										<span class="review"><i class="fa-solid fa-star"></i>(2k Review)</span>
									</div>	
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="shop-card style-4 wow fadeInUp" data-wow-delay="0.8s">
								<div class="dz-media">
									<img loading="lazy" src="images/feature/img6.webp" alt="image">
								</div>
								<div class="dz-content">
									<div>
										<h6 class="title"><a href="product-detail.html">High-Performance Sports Frames</a></h6>
										<span class="sale-title">Up to 40% Off</span>
									</div>
									<div class="d-flex align-items-center"> 
										<h6 class="price">₹80<del>₹95</del></h6>
										<span class="review"><i class="fa-solid fa-star"></i>(2k Review)</span>
									</div>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Featured Section End -->
		


		<section class="content-inner-3 companies-section overflow-hidden">
			<div class="container">
				<div class="row justify-content-between align-items-end">
					<div class="col-lg-8 col-md-8 col-sm-12">
						<div class="section-head style-2 wow fadeInUp m-0" data-wow-delay="0.1s">
							<h2 class="title text-white">Growing with 6.3k Happy Glasses Wearers</h2>
						</div>	
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12 text-md-center m-b30 wow fadeInUp" data-wow-delay="0.2s">	
						<a class="icon-button d-md-inline-block d-none" href="blog-tag.html">
							<div class="text-row word-rotate-box c-black border-secondary bg-secondary">
								<span class="word-rotate">Our - partners - </span>
								<img loading="lazy" src="images/feature/img1.webp" alt="">
							</div>
						</a>
					</div>	
				</div>
			</div>	

			<div class="container-fluid">
				<div class="tag-slider style-1 wow fadeInUp" data-wow-delay="0.2s" id="tagSlider">
					<div class="item-wrap">	
						<div class="item">
							<a href="javascript:void(0);" class="companies-wrapper">
								<div class="companies-media">
									<img loading="lazy" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSD2vHjYm3ml7GzcUKRVIIH2p3F7a3Z0ho9zA&s" alt=""> 
								</div>
							</a>
						</div>
						<div class="item">
							<a href="javascript:void(0);" class="companies-wrapper">
								<div class="companies-media">
									<img loading="lazy" src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b3/Bausch_and_Lomb_Logo_2010.svg/2560px-Bausch_and_Lomb_Logo_2010.svg.png" alt=""> 
								</div>
							</a>
						</div>
						<div class="item">
							<a href="javascript:void(0);" class="companies-wrapper">
								<div class="companies-media">
									<img loading="lazy" src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/Ray-Ban_logo.svg/2560px-Ray-Ban_logo.svg.png" alt=""> 
								</div>
							</a>
						</div>
						<div class="item">
							<a href="javascript:void(0);" class="companies-wrapper">
								<div class="companies-media">
									<img loading="lazy" src="https://taghills.com/wp-content/uploads/2024/09/cropped-TAGHills-Logo.png" alt=""> 
								</div>
							</a>
						</div>
						<div class="item">
							<a href="javascript:void(0);" class="companies-wrapper">
								<div class="companies-media">
									<img loading="lazy" src="https://1000logos.net/wp-content/uploads/2017/03/Color-of-the-Nikon-Logo.jpg" alt=""> 
								</div>
							</a>
						</div>
						<div class="item">
							<a href="javascript:void(0);" class="companies-wrapper">
								<div class="companies-media">
									<img loading="lazy" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQAGgkv88bKoC3H6CPjzAIDMb9COdD7qqSxMg&s" alt=""> 
								</div>
							</a>
						</div>
						<div class="item">
							<a href="javascript:void(0);" class="companies-wrapper">
								<div class="companies-media">
									<img loading="lazy" src="https://seeklogo.com/images/E/essilor-logo-8A7BCBBBFC-seeklogo.com.png" alt=""> 
								</div>
							</a>
						</div>
						<div class="item">
							<a href="javascript:void(0);" class="companies-wrapper">
								<div class="companies-media">
									<img loading="lazy" src="https://e7.pngegg.com/pngimages/270/770/png-clipart-contact-lenses-coopervision-biofinity-marketing-purple-lens-thumbnail.png" alt=""> 
								</div>
							</a>
						</div>
						<div class="item">
							<a href="javascript:void(0);" class="companies-wrapper">
								<div class="companies-media">
									<img loading="lazy" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2CNqOM0hGglTpdCQruYWZZf4uUGoD5Msdtw&s" alt=""> 
								</div>
							</a>
						</div>
						<div class="item">
							<a href="javascript:void(0);" class="companies-wrapper">
								<div class="companies-media">
									<img loading="lazy" src="https://upload.wikimedia.org/wikipedia/commons/b/b2/Fastrack_logo.png" alt=""> 
								</div>
							</a>
						</div>
					</div>
				</div>
				<div class="tag-slider wow fadeInUp" data-wow-delay="0.4s" id="tagSlider2">
					<div class="item-wrap">	
						<div class="item">
							<a href="javascript:void(0);" class="companies-wrapper">
								<div class="companies-media">
									<img loading="lazy" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSk1Zon8uBo_Fu4nsB1q1Ifxkslk4GdoOaO1A&s" alt=""> 
								</div>
							</a>
						</div>
						<div class="item">
							<a href="javascript:void(0);" class="companies-wrapper">
								<div class="companies-media">
									<img loading="lazy" src="https://upload.wikimedia.org/wikipedia/commons/0/08/Hoya_Corporation_logo.svg" alt=""> 
								</div>
							</a>
						</div>
						<div class="item">
							<a href="javascript:void(0);" class="companies-wrapper">
								<div class="companies-media">
									<img loading="lazy" src="https://logovector.net/wp-content/uploads/2014/06/316937-vogue-3-logo.png" alt=""> 
								</div>
							</a>
						</div>
						<div class="item">
							<a href="javascript:void(0);" class="companies-wrapper">
								<div class="companies-media">
									<img loading="lazy" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSD2vHjYm3ml7GzcUKRVIIH2p3F7a3Z0ho9zA&s" alt=""> 
								</div>
							</a>
						</div>
						<div class="item">
							<a href="javascript:void(0);" class="companies-wrapper">
								<div class="companies-media">
									<img loading="lazy" src="https://upload.wikimedia.org/wikipedia/commons/b/b2/Fastrack_logo.png" alt=""> 
								</div>
							</a>
						</div>
						<div class="item">
							<a href="javascript:void(0);" class="companies-wrapper">
								<div class="companies-media">
									<img loading="lazy" src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/Ray-Ban_logo.svg/2560px-Ray-Ban_logo.svg.png" alt=""> 
								</div>
							</a>
						</div>
						<div class="item">
							<a href="javascript:void(0);" class="companies-wrapper">
								<div class="companies-media">
									<img loading="lazy" src="https://taghills.com/wp-content/uploads/2024/09/cropped-TAGHills-Logo.png" alt=""> 
								</div>
							</a>
						</div>
						<div class="item">
							<a href="javascript:void(0);" class="companies-wrapper">
								<div class="companies-media">
									<img loading="lazy" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQAGgkv88bKoC3H6CPjzAIDMb9COdD7qqSxMg&s" alt=""> 
								</div>
							</a>
						</div>
						<div class="item">
							<a href="javascript:void(0);" class="companies-wrapper">
								<div class="companies-media">
									<img loading="lazy" src="https://e7.pngegg.com/pngimages/270/770/png-clipart-contact-lenses-coopervision-biofinity-marketing-purple-lens-thumbnail.png" alt=""> 
								</div>
							</a>
						</div>
						<div class="item">
							<a href="javascript:void(0);" class="companies-wrapper">
								<div class="companies-media">
									<img loading="lazy" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2CNqOM0hGglTpdCQruYWZZf4uUGoD5Msdtw&s" alt=""> 
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>	


		
		
		<!-- Blog Start -->
		<section class="content-inner-3 overflow-hidden p-b0" id="review-section">
			<div class="container-fluid mb-3">
				<div class="row justify-content-between align-items-center">
					<div class="col-lg-12 col-md-8 col-sm-12">
						<div class="section-head style-2 m-0 wow fadeInUp" data-wow-delay="0.1s">
							<div class="left-content">
								<h2 class="title">Review</h2>
							</div>
						</div>	
					</div>
					
				</div>
			</div>
			<div class="swiper swiper-blog-post">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<div class="dz-card style-2 wow fadeInUp" data-wow-delay="0.2s">
							<div class="dz-media" style="position: relative;">
								<img loading="lazy" src="images/review-img/review-1.webp" alt="">
								<div class="post-date">17 May 2023</div>
					
								<!-- Play Button -->
								<a href="https://www.youtube.com/embed/AG0N2NaYMaw?si=1hmPSoz7KIjPm24i" class="play-btn" data-video="true">
									<i class="feather icon-play-circle"></i>
								</a>
							</div>
						</div>
					</div>
					
					<div class="swiper-slide">
						<div class="dz-card style-2 wow fadeInUp" data-wow-delay="0.4s">
							<div class="dz-media">
								<img loading="lazy" src="images/review-img/review-2.webp" alt="">
								<div class="post-date">28 Feb 2023</div>
										<!-- Play Button -->
								<a href="https://www.youtube.com/embed/AG0N2NaYMaw?si=1hmPSoz7KIjPm24i" class="play-btn" data-video="true">
									<i class="feather icon-play-circle"></i>
								</a>
							</div>
						 
						</div>
					</div>
					<div class="swiper-slide">
						<div class="dz-card style-2 wow fadeInUp" data-wow-delay="0.6s">
							<div class="dz-media">
								<img loading="lazy" src="images/review-img/review-3.webp" alt="">
								<div class="post-date">15 Aug 2023</div>
										<!-- Play Button -->
								<a href="https://www.youtube.com/embed/AG0N2NaYMaw?si=1hmPSoz7KIjPm24i" class="play-btn" data-video="true">
									<i class="feather icon-play-circle"></i>
								</a>
							</div>
							 
						</div>
					</div>
					<div class="swiper-slide">
						<div class="dz-card style-2 wow fadeInUp" data-wow-delay="0.8s">
							<div class="dz-media">
								<img loading="lazy" src="images/review-img/review-4.webp" alt="">
								<div class="post-date">28 Nov 2023</div>
										<!-- Play Button -->
								<a href="https://www.youtube.com/embed/AG0N2NaYMaw?si=1hmPSoz7KIjPm24i" class="play-btn" data-video="true">
									<i class="feather icon-play-circle"></i>
								</a>
							</div>
							 
						</div>
					</div>
					<div class="swiper-slide">
						<div class="dz-card style-2 wow fadeInUp" data-wow-delay="1.0s">
							<div class="dz-media">
								<img loading="lazy" src="images/review-img/review-5.webp" alt="">
								<div class="post-date">13 Feb 2023</div>
										<!-- Play Button -->
								<a href="https://www.youtube.com/embed/AG0N2NaYMaw?si=1hmPSoz7KIjPm24i" class="play-btn" data-video="true">
									<i class="feather icon-play-circle"></i>
								</a>
							</div>
						 
						</div>
					</div>
					<div class="swiper-slide">
						<div class="dz-card style-2 wow fadeInUp" data-wow-delay="0.2s">
							<div class="dz-media">
								<img loading="lazy" src="images/review-img/review-6.webp" alt="">
								<div class="post-date">17 May 2023</div>
										<!-- Play Button -->
								<a href="https://www.youtube.com/embed/AG0N2NaYMaw?si=1hmPSoz7KIjPm24i" class="play-btn" data-video="true">
									<i class="feather icon-play-circle"></i>
								</a>
							</div>
						 
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Blog End -->

 
		
	</div>
	
	<!-- Footer -->
	<footer class="site-footer style-1">
		
		<!-- Footer Top -->
		<div class="footer-top" id="site-footer-main">
			<div class="container">
				<div class="row">
					<div class="col-xl-5 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
						<div class="widget widget_about me-2">
							<div class="footer-logo logo-white">
								<a href="index.php"><img loading="lazy" src="images/logo1.webp" alt=""></a> 
							</div>
							<ul class="widget-address">
								<li>
									<p class="text-white"><span class="text-white">Address</span> : 1234 New Street, Suite 567,<br>
										New Delhi, PIN 10XXXX</p>
								</li>
								<li>
									<p class="text-white"><span class="text-white">E-mail</span> : info@peuraXXX</p>
								</li>
								<li>
									<p class="text-white"><span class="text-white">Phone</span> : +919971XXXXX</p>
								</li>
							</ul>
							
						</div>
					</div>
					
					<div class="col-xl-3 col-md-4 col-sm-4 col-6 wow fadeInUp" data-wow-delay="0.3s">
						<div class="widget widget_services">
							<h5 class="footer-title text-white">Products</h5>
							<ul>
								<li><a class="text-white" href="JavaScript:void(0)">Women</a></li>
								<li><a class="text-white" href="JavaScript:void(0)">Screen Glasses</a></li>
								<li><a class="text-white" href="JavaScript:void(0)">Men</a></li>
								<li><a class="text-white" href="JavaScript:void(0)">Sunglasses</a></li>
								<li><a class="text-white" href="JavaScript:void(0)">Turban Friendly</a></li>
								<li><a class="text-white" href="JavaScript:void(0)">Unisex</a></li>
								<li><a class="text-white" href="JavaScript:void(0)">Kids</a></li>
								<li><a class="text-white" href="JavaScript:void(0)">Contact Lenses</a></li>
								
							</ul>   
						</div>
					</div>
					<div class="col-xl-2 col-md-4 col-sm-4 col-6 wow fadeInUp" data-wow-delay="0.4s">
						<div class="widget widget_services">
							<h5 class="footer-title text-white">Useful Links</h5>
							<ul>
								<li><a class="text-white" href="javascript:void(0);">About Us</a></li>
								<li><a class="text-white" href="javascript:void(0);">Contact Us</a></li>
								<li><a class="text-white" href="javascript:void(0);">Privacy Policy</a></li>
								<li><a class="text-white" href="javascript:void(0);">Returns Conditions</a></li>
								<li><a class="text-white" href="javascript:void(0);">Terms & Conditions</a></li>
								<li><a class="text-white" href="javascript:void(0);">Contact Us</a></li>
								<li><a class="text-white" href="javascript:void(0);">Our Sitemap</a></li>
							</ul>
						</div>
					</div>
					<div class="col-xl-2 col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.5s">
						<div class="widget widget_services">
							<h5 class="footer-title text-white">Follow Us On</h5>
							<ul style="list-style: none; padding: 0; display: flex; gap: 15px; justify-content: left; align-items: center;">
								<li>
									<a class="text-white-two" href="javascript:void(0)" style="text-decoration: none;">
										<img loading="lazy" src="images/instagram.webp"/>
									</a>
								</li>
								<li>
									<a class="text-white-two" href="javascript:void(0);" style="text-decoration: none;">
										<img loading="lazy" src="images/whatsapp.webp"/>
									</a>
								</li>

								<li>
									<a class="text-white-two" href="javascript:void(0);" style="text-decoration: none;">
										<img loading="lazy" src="images/linkedin.webp"/>
									</a>
								</li>
				 
							</ul>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer Top End -->
		
		<!-- Footer Bottom -->
		<div class="footer-bottom">
			<div class="container">
				<div class="row fb-inner wow fadeInUp" data-wow-delay="0.1s">
					<div class="col-lg-6 col-md-12 text-start"> 
						<p class="copyright-text text-white">© <span class="current-year">2024</span> <a href="JavaScript:void(0)">Peura Opticals</a> All Rights Reserved.</p>
					</div>
					<div class="col-lg-6 col-md-12 text-end"> 
						<div class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-end">
							<span class="me-3 text-white">We Accept: </span>
							<img loading="lazy" src="images/footer-img.webp" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer Bottom End -->
		
	</footer>
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
									<!-- <div class="dz-content-footer">
										<div class="dz-content-start">
											<span class="badge bg-secondary mb-2">SALE 20% Off</span>
											<h4 class="title mb-1"><a href="JavaScript:void(0)">Active Wear Sunglasses</a></h4>
											<div class="review-num">
												<ul class="dz-rating me-2">
													<li class="star-fill">
														<i class="flaticon-star-1"></i>
													</li>										
													<li class="star-fill">
														<i class="flaticon-star-1"></i>
													</li>
													<li class="star-fill">
														<i class="flaticon-star-1"></i>
													</li>
													<li>
														<i class="flaticon-star-1"></i>
													</li>
													<li>
														<i class="flaticon-star-1"></i>
													</li>
												</ul>
												<span class="text-secondary me-2">4.7 Rating</span>
												<a href="javascript:void(0);">(5 customer reviews)</a>
											</div>
										</div>
									</div> -->
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
										
										
										<!-- <div class="dz-social-icon">
											<ul>
												<li><a target="_blank" class="text-dark" href="JavaScript:void(0)">
													<i class="fab fa-facebook-f"></i>
												</a></li>
												<li><a target="_blank" class="text-dark" href="JavaScript:void(0)">	
													<i class="fab fa-twitter"></i>
												</a></li>
												<li><a target="_blank" class="text-dark" href="JavaScript:void(0)">
													<i class="fa-brands fa-youtube"></i>
												</a></li>
												<li><a target="_blank" class="text-dark" href="JavaScript:void(0)">
													<i class="fa-brands fa-linkedin-in"></i>
												</a></li>
												<li><a target="_blank" class="text-dark" href="JavaScript:void(0)">
													<i class="fab fa-instagram"></i>
												</a></li>
											</ul>
										</div> -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

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
<script src="js/jquery.min.js"></script>
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
</body>
</html>
