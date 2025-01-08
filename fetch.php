<?php
// Include database connection and necessary functions
require "config/config.php"; // Make sure to include your DB connection
require "config/common.php";

if (isset($_POST['product_id'])) {
    $products = new Products();
    $product_id = $_POST['product_id'];

    // Get product details using the function
    $productDetails = $products->getProdcutsById($product_id);
    $productDetailsImagesSql = $products->getProdcutsImages($product_id);

    if ($productDetails) {
        // Product Description
        $product_description = htmlspecialchars($productDetails['short_description']);
        $product_price = '₹' . htmlspecialchars($productDetails['price']) . ' <del>₹' . htmlspecialchars($productDetails['discount']) . '</del>';
        $product_sku = htmlspecialchars($productDetails['sku']);
        $product_category = 'ajmal, ajmal, alam'; // Change as needed

        // Start the HTML output for the modal content
        $modalContent = '';

        // Images Section (Lightbox and Thumbnails)
        if ($productDetailsImagesSql) {
            foreach ($productDetailsImagesSql as $image) {
                // Lightbox images
                $modalContent .= '<div class="swiper-slide">
                                    <div class="dz-media DZoomImage">
                                        <a class="mfp-link lg-item" href="adminuploads/products/' . $image['image'] . '" data-src="adminuploads/products/' . $image['image'] . '">
                                            <i class="feather icon-maximize dz-maximize top-right"></i>
                                        </a>
                                        <img src="adminuploads/products/' . $image['image'] . '" alt="Product Image">
                                    </div>
                                </div>';
                // Thumbnail images
                $modalContent .= '<div class="swiper-slide">
                                    <img src="adminuploads/products/' . $image['image'] . '" alt="Thumbnail Image">
                                </div>';
            }
        } else {
            // Fallback images
            $modalContent .= '<div class="swiper-slide">
                                <div class="dz-media DZoomImage">
                                    <img src="path/to/default/image.jpg" alt="Product Image">
                                </div>
                            </div>';
            $modalContent .= '<div class="swiper-slide">
                                <img src="path/to/default/thumbnail.jpg" alt="Thumbnail Image">
                            </div>';
        }

        // Now, echo the modal content with placeholders populated
        echo json_encode([
            'description' => $product_description,
            'price' => $product_price,
            'sku' => $product_sku,
            'category' => $product_category,
            'images' => $modalContent,
        ]);
    } else {
        echo json_encode(['error' => 'Product not found.']);
    }
}
?>
