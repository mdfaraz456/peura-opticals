<?php
// Include necessary files or DB connections
include('config/config.php'); // Include your DB connection file
$conn = new dbClass();
if (isset($_GET['product_type_id'])) {
    $productTypeId = $_GET['product_type_id'];
    $categoryId = $_GET['category_id'];
    
    // Modify the query to filter based on the selected product type
    if ($productTypeId) {
        $query = $conn->getAllData(
            "SELECT p.*, pc.category_id, GROUP_CONCAT(ppt.product_type_id) AS product_type_ids
            FROM products p 
            JOIN product_category pc ON p.product_id = pc.product_id
            JOIN product_product_type ppt ON p.product_id = ppt.product_id
            WHERE p.status = '1' AND ppt.product_type_id = '$productTypeId'
            AND pc.category_id = '$categoryId'
            GROUP BY p.product_id, pc.category_id
            ORDER BY p.product_id DESC"
        );
    } else {
        // If no product type is selected, show all products
        $query = $conn->getAllData(
            "SELECT p.*, pc.category_id, GROUP_CONCAT(ppt.product_type_id) AS product_type_ids
            FROM products p 
            JOIN product_category pc ON p.product_id = pc.product_id
            JOIN product_product_type ppt ON p.product_id = ppt.product_id
            WHERE p.status = '1' AND pc.category_id = '$categoryId'
            GROUP BY p.product_id, pc.category_id
            ORDER BY p.product_id DESC"
        );
    }

    // Loop through the products and output the HTML for each product
    foreach ($query as $ProRow):
        $discountInfo = calculateDiscount($ProRow['price'], $ProRow['discount']);
        $hasDiscount = $ProRow['discount'] > 0;
        ?>
        <div class="col-6 col-xl-3 col-lg-4 col-md-4 col-sm-6 m-md-b15 m-b30">
            <div class="shop-card style-1">
                <div class="dz-media" id="dz-img">
                    <img class="img-dz" src="adminuploads/products/<?php echo htmlspecialchars($ProRow['image']); ?>" alt="image">
                    <div class="shop-meta">
                        <a href="product-detail.php?id=<?php echo base64_encode($ProRow['product_id']) ?>" class="btn btn-secondary btn-md btn-rounded" >
                            <i class="fa-solid fa-eye d-md-none d-block"></i>
                            <span class="d-md-block d-none">View Details</span>
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
                    <h5 class="title"><a href="product-detail.php?id=<?php echo base64_encode($ProRow['product_id']) ?>"><?php echo htmlspecialchars($ProRow['name']); ?></a></h5>
                    <h5 class="price">₹<?php echo htmlspecialchars(number_format($discountInfo['discountedPrice'])); ?></h5>
                </div>
                <div class="product-tag">
                    <span class="badge">Try On</span>
                </div>
            </div>
        </div>
        <?php
    endforeach;
}
?>
