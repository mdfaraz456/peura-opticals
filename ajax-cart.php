<?php

if(!isset($_SESSION)) { session_start(); }
error_reporting(E_ALL);

require 'config/config.php';
require 'config/cart.php';

$conn = new dbClass();
$cartItem = new Cart();


if(!empty($_POST["state_id"])){ 
    $stateId = $_POST["state_id"];
    $result = $conn->cities($stateId);

    if(count($result) > 0){ 
        echo '<option value="">Select city</option>'; 
        foreach($result as $row){  
            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">City not available</option>'; 
    } 
} 


// json response of city
if (isset($_POST["state"]) && !empty($_POST["state"]) && isset($_POST["country"]) && !empty($_POST["country"])) {
    $selectedState = $_POST["state"];
    $selectedCountry = $_POST["country"];
  
    // Fetch cities based on the selected state and country using your database queries
    $result = $conn->cities($selectedState);

    $cities = [];
    foreach ($result as $row) {
        $cities[] = ['id' => $row['id'], 'name' => $row['name']];
    }

    if(count($result) > 0):
        $response = [
            'success' => true,
            'data' => ['cities' => $cities]
        ];
    else:
        $response = [
            'success' => false
        ];
    endif;
    echo json_encode($response);
}
// json response of city


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle cart quantity update
    if (isset($_POST['user_id']) && isset($_POST['product_id']) && isset($_POST['product_quantity']) && isset($_POST['cart_id'])) {
        $userId = $_POST['user_id'];
        $product_id = $_POST['product_id'];
        $product_quantity = $_POST['product_quantity'];
        $cart_id = $_POST['cart_id'];

        // Update cart item
        $updateCartSql = $cartItem->updateCartItem123($userId, $product_id, $product_quantity, $cart_id);

        if ($updateCartSql) {
            echo 'Cart Updated Successfully';
        } else {
            echo 'Sorry, Some Error occurred';
        }
    }
    // Handle adding a product to the cart
    elseif (isset($_POST['buyNow']) && $_POST['buyNow'] === 'Buy Now' && isset($_POST['pId']) && isset($_POST['quantity'])) {
        $userId = $_SESSION['cart_item'];
        $pId = $_POST['pId'];
        $quantityNumber = $_POST['quantity'];
        $ipAddress = $_SERVER["REMOTE_ADDR"];

        // Check if the product exists in the cart
        $cartDetail = $cartItem->cartCheck($userId, $pId, $ipAddress);

        if (empty($cartDetail['cart_id']) && empty($cartDetail['insert_ip'])) {
            // Add the product to the cart
            $addCartSql = $cartItem->addCartItem($userId, $pId, $quantityNumber, $ipAddress);
            if ($addCartSql) {
                echo 'Product added to the cart successfully';
            } else {
                echo 'Error adding product to the cart';
            }
        } else {
            // Update the quantity of the existing product in the cart
            $updateCartSql = $cartItem->updateCartItem($userId, $pId, $quantityNumber, $ipAddress, $cartDetail['cart_id']);
            if ($updateCartSql) {
                echo 'Product already added to your cart';
            } else {
                echo 'Error updating product in the cart';
            }
        }
    } else {
        echo 'Missing required parameters';
    }
} else {
    echo 'Invalid request method';
}

// // Delete cart item
if(isset($_POST['deleteCartItem']) && isset($_POST['productId']) && isset($_POST['productCartId'])){
  $userId = $_SESSION['cart_item'];
  $productId = $_POST['productId'];
  $productCartId = $_POST['productCartId'];
  $ipAddress = $_SERVER["REMOTE_ADDR"];
  // Delete Cart item
  $cartDeleteItem = $cartItem->removeCartItem($userId,$productCartId,$productId,$ipAddress);
  if($cartDeleteItem==true):
    echo 'Remove item from cart successfully';
  else:
    echo 'Sorry Some Error';
  endif;
  exit;
}


// // shipping address start
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addressId'])) {
//     $addressId = base64_decode($_POST['addressId']);

//     // Update all addresses' status to 0
//     $updateQuery = "UPDATE shipping_address SET status = 0 WHERE customer_id = '".$_SESSION['USER_LOGIN']."'";
//     $conn->execute($updateQuery);

//     // Update the selected address's status to 1
//     $updateQuery = "UPDATE shipping_address SET status = 1 AND customer_id = '".$_SESSION['USER_LOGIN']."' WHERE id = $addressId";
//     $conn->execute($updateQuery);

//     // Fetch address details based on the addressId
//     $detailsQuery = "SELECT * FROM shipping_address WHERE status = 1 AND customer_id = '".$_SESSION['USER_LOGIN']."' AND id = $addressId";
//     $detailsResult = $conn->getRowCount($detailsQuery);
//     if ($detailsResult && $detailsResult > 0) {
//         $addressDetails = $conn->getData($detailsQuery);
//         echo json_encode(array("success" => true, "data" => $addressDetails));
//     } else {
//         echo json_encode(array("success" => false));
//     }
// }
// // shipping address end


?>