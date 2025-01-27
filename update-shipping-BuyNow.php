<?php
if (!isset($_SESSION)) {
  session_start();
}
require "config/config.php";
require "config/authentication.php";
require 'config/cart.php';

$conn = new dbClass();
$auth = new Authentication();
$cartItem = new Cart();
$ipAddress = $_SERVER["REMOTE_ADDR"];
$userId = $_SESSION['USER_LOGIN'];
$auth->checkSession($_SESSION['USER_LOGIN']);

// Fetch cart items for the current user
$cartData = $cartItem->buyNowItems($_SESSION['cart_item'], $ipAddress);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Add record logic
  $shipId = trim($_POST['shipId']);


  $errors = [];

  $userLoginId = $_SESSION['USER_LOGIN'];
  $orderNumber=rand(1000000000, 9999999999);
  $query1 = $conn->execute("INSERT INTO `orders_table`(`order_number`, `customer_id`, `address_id`, `insert_ip`, `created_at`) VALUES ('$orderNumber', '$userLoginId', '$shipId', '$ipAddress', now())");
  // $orderId=$conn->getdata("Select `order_id` from `orders_table` order by `order_id` desc limit 1");
  $result = $conn->getdata("SELECT `order_id` FROM `orders_table` ORDER BY `order_id` DESC LIMIT 1");


    if($cartData){
     
        $products=$cartData[0];
        $productId = $products['product_id'];
        $output1 = $conn->getData("SELECT * FROM `products` WHERE `product_id` = '$productId'");
        $productprice = $output1['price'];
        $productName = $output1['name'];
    
        $cartItem = $_SESSION['cart_item'];
        $Ip_Address = $_SERVER['REMOTE_ADDR'];
        $customerId = $_SESSION['USER_LOGIN'] ?? ''; 
        $output2 = $conn->getData("SELECT quantity FROM `buy_now` WHERE customer_id = '$customerId' AND product_id = '$productId'");
        $productQuantity = $output2['quantity'];
    
        // $productTotal = intval($productprice) * intval($productQuantity);

        
        $discountInfo = calculateDiscount($output1['price'], $output1['discount']);

        $productTotal = intval($productQuantity) * intval($discountInfo['discountedPrice']);
        
        
        $query2 = $conn->execute("INSERT INTO `order_product_details` (`order_id`, `product_id`, `product_name`, `product_price`, `product_quantity`, `product_total_price`) 
                                   VALUES ('" . $result['order_id'] . "', '$productId', '$productName', '$productprice', '$productQuantity', '$productTotal')");
   
    $deleteTheItemsFromBuyNow= $conn->execute("Delete from `buy_now` where `customer_id`='$userLoginId'");
    
    }

  if (empty($errors)) {
    echo json_encode(array('success' => 'Your Billing Details Added Successfully.'));
  } else {
    echo json_encode(array('error' => implode(' ', $errors)));
  }

} else {
  echo json_encode(array('error' => 'Invalid request method.'));
}



?>
