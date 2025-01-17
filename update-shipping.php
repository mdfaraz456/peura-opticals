<?php
if (!isset($_SESSION)) {
  session_start();
}
require "config/config.php";
require "config/authentication.php";
require_once 'config/cart.php';

$conn = new dbClass();
$auth = new Authentication();
$cartItem = new Cart();

$ipAddress = $_SERVER["REMOTE_ADDR"];
$userId = $_SESSION['USER_LOGIN'];

// Fetch cart items for the current user
$cartData = $cartItem->cartItems($_SESSION['cart_item'], $ipAddress);



// Decode the incoming JSON data if it's sent in that format via AJAX
// $formData = json_decode(file_get_contents('php://input'), true);

  // $productIds = json_decode(trim($_POST['product_ids']), true);
  
  

if (isset($_POST['submit'])) {
  // Add record logic
  $shipId = trim($_POST['shipId']);
  // $lname = trim($_POST['lname']);
  // $phone = trim($_POST['phone']);
  // $email = trim($_POST['email']);
  // $address = trim($_POST['address']);
  // $apartment = trim($_POST['apartment']);
  // $state = trim($_POST['state']);
  // $city = trim($_POST['city']);
  // $postcode = trim($_POST['postcode']);
  // $orderNumber = trim($_POST['orderNumber']);
  // $freeProductQuantity = trim($_POST['free_product_quantity']); 

  // $shipData=$conn->getData("select * from shipping_address where id=$shipId");

  


  

  $errors = [];
  foreach ($productIds as $productId) {
    $sqlQuery = $auth->addShipping($_SESSION['USER_LOGIN'], $productId, $orderNumber, $fname, $lname, $phone, $email, $address, $apartment, $state, $city, $postcode);

    if (!$sqlQuery) {
      $errors[] = "An error occurred while adding your billing details for product ID: $productId.";
    }

    // Get product price from product table
    $output1 = $conn->getData("SELECT price, name FROM `products` WHERE `product_id` = '$productId'");
    $productprice = $output1['price'];
    $productName = $output1['name'];

    // // Get product quantity from cart table
    $cartItem = $_SESSION['cart_item'];
    $Ip_Address = $_SERVER['REMOTE_ADDR'];
    $customerId = $_SESSION['USER_LOGIN'] ?? ''; 
    $output2 = $conn->getData("SELECT quantity FROM `cart` WHERE customer_id = '$customerId' AND product_id = '$productId'");
    $productQuantity = $output2['quantity'];

    $productTotal = intval($productprice) * intval($productQuantity);

    $userLoginId = $_SESSION['USER_LOGIN'];
    $query1 = $conn->execute("INSERT INTO `orders_table`(`order_number`, `customer_id`, `product_id`, `product_price`, `product_quantity`, `product_total`, `insert_ip`, `created_at`) VALUES ('$orderNumber', '$userLoginId', '$productId', '$productprice', '$productQuantity', '$productTotal', '$ipAddress', now())");


  }
  $userLoginId = $_SESSION['USER_LOGIN'];
  $query1 = $conn->execute("INSERT INTO `orders_table`(`order_number`, `customer_id`, `insert_ip`, `created_at`) VALUES ('$orderNumber', '$userLoginId', '$ipAddress', now())");

  foreach($cartData as $products){
      $productId=$products['product_id'];
      $output1 = $conn->getData("SELECT price, name FROM `products` WHERE `product_id` = '$productId'");
      $productprice = $output1['price'];
      $productName = $output1['name'];

      $cartItem = $_SESSION['cart_item'];
      $Ip_Address = $_SERVER['REMOTE_ADDR'];
      $customerId = $_SESSION['USER_LOGIN'] ?? ''; 
      $output2 = $conn->getData("SELECT quantity FROM `cart` WHERE customer_id = '$customerId' AND product_id = '$productId'");
      $productQuantity = $output2['quantity'];
  
      $productTotal = intval($productprice) * intval($productQuantity);
      $query1 = $conn->execute("INSERT INTO `orders_table`(`order_id`, `product_id`, `product_price`, `product_quantity`, `product_total`, `created_at`) VALUES ('$orderId', '$productId', '$productprice', '$productQuantity', '$productTotal',now())");
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