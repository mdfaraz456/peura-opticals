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
							<?php
									$sqlCatQuery = $categories->allCategories();
									foreach ($sqlCatQuery as $sqlcatRow):
										$rowCount = $conn->getRowCount(
											"SELECT p.*, pc.category_id
											FROM products p
											JOIN product_category pc ON p.product_id = pc.product_id 
											WHERE p.status = 1 AND pc.category_id = '" . $sqlcatRow['id'] . "'"
										);
										if ($rowCount > 0):
									?>
										<li class="has-submenu">
											<a class="text-white" href="category.php?category=<?php echo base64_encode($sqlcatRow['id']) ?>"><?php echo $sqlcatRow['name']; ?></a>
											
											
										</li>
									<?php
										endif;
									endforeach;
									?>
								
								
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