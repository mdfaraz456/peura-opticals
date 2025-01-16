<?php


include_once('config/functions.php');
include_once('config/cart.php');


$cartItem = new Cart();

// Set Session for cart
if (!isset($_SESSION['cart_item'])) {
  $_SESSION['cart_item'] = strtoupper(uniqid() . time() . str_shuffle(12345));
}
$ipAddress = $_SERVER["REMOTE_ADDR"];

$cartSqlCount = $cartItem->cartCount($_SESSION['cart_item'], $ipAddress);

if (!empty($cartSqlCount['CartCount'])):
  $cartTotalCount = $cartSqlCount['CartCount'];
else:
  $cartTotalCount = 0;
endif;

$categories = new Categories();
// var_dump($categoriesData);

// $productSubType =new ProductSubType();
// $productSubTypeData=$productSubType->getProductSubType();


?>
<header class="site-header mo-left header style-1 header-transparent">		
		<!-- Main Header -->
		<div class="sticky-header main-bar-wraper navbar-expand-lg">
			<div class="main-bar clearfix">
				<div class="container-fluid clearfix d-lg-flex d-block">
					
					<!-- Website Logo -->
					<div class="logo-header logo-dark me-md-5">
						<a href="index.php"><img src="images/logo1.webp" alt="logo"></a>
					</div>
					
					<!-- Nav Toggle Button -->
					<button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span></span>
						<span></span>
						<span></span>
					</button>
				
					<!-- Main Nav -->
					<div class="header-nav w3menu navbar-collapse collapse justify-content-center" id="navbarNavDropdown">
    <div class="logo-header logo-dark">
        <a href="index.php"><img src="images/logo1.png" alt=""></a>
    </div>
    <ul class="nav navbar-nav">
        <li class="has-mega-menu auto-width menu-left">
            <a href="index.php"><span>HOME</span></a>
        </li>

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
                <a href="category.php?category=<?php echo base64_encode($sqlcatRow['id']) ?>"><?php echo $sqlcatRow['name']; ?></a>
                <ul class="submenu">
                    <?php
                    $sqlSubCatQuery = $categories->getSubCatgoriesDropdown($sqlcatRow['id']);
                    foreach ($sqlSubCatQuery as $sqlSubCatRow):
                        $rowCount = $conn->getRowCount(
                            "SELECT p.*, pc.category_id, psc.subcategory_id
                            FROM products p
                            JOIN product_category pc ON p.product_id = pc.product_id
                            JOIN product_subcategory psc ON p.product_id = psc.product_id 
                            WHERE p.status = 1 AND pc.category_id = '" . $sqlcatRow['id'] . "' AND psc.subcategory_id = '" . $sqlSubCatRow['id'] . "'"
                        );
                        if ($rowCount > 0):
                    ?>
                        <li>
                            <a href="subcategory.php?category=<?php echo base64_encode($sqlcatRow['id']) ?>&subcategory=<?php echo base64_encode($sqlSubCatRow['id']) ?>">
                                <?php echo $sqlSubCatRow['name']; ?>
                            </a>
                        </li>
                    <?php
                        endif;
                    endforeach;
                    ?>
                </ul>
                <span class="dd-trigger"><i class="fal fa-angle-down"></i></span>
            </li>
        <?php
            endif;
        endforeach;
        ?>
    </ul>
    <div class="dz-social-icon">
        <ul>
            <li><a class="fab fa-facebook-f" target="_blank" href="JavaScript:void(0)"></a></li>
            <li><a class="fab fa-twitter" target="_blank" href="JavaScript:void(0)"></a></li>
            <li><a class="fab fa-linkedin-in" target="_blank" href="JavaScript:void(0)"></a></li>
            <li><a class="fab fa-instagram" target="_blank" href="JavaScript:void(0)"></a></li>
        </ul>
    </div>
</div>

				
					<!-- EXTRA NAV -->
					<div class="extra-nav">
						<div class="extra-cell">						
							<ul class="header-right">
								<li class="nav-item cart-link">
								<?php if (empty($_SESSION['USER_LOGIN'])): ?>
										<a href="login.php" class="nav-link cart-btn">
											<!-- Profile Icon -->
											<i class="fas fa-user"></i>
										</a>
									<?php else: ?>
										<a href="account-dashboard.php" class="nav-link cart-btn">
											<!-- Profile Icon -->
											<i class="fas fa-user"></i>
										</a>
									<?php endif; ?>

								</li>
								
								<li class="nav-item cart-link">
									<a href="cart.php" class="nav-link cart-btn"  >
										<i class="iconly-Broken-Buy"></i>
										<span class="badge badge-circle"><?php echo $cartTotalCount; ?></span>
									</a>

									
								</li>
						
							 
							</ul>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<!-- Main Header End -->
		
	
		
	</header>