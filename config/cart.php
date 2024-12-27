<?php

class Cart
{
	private $cartId;
	private $userId;
	private $ProductId;
	private $Quantity;
	private $IpAddress;
	private $conndb;

	function cartCount($userId, $IpAddress)
	{
		$conn = new dbClass();
		$this->userId = $userId;
		$this->IpAddress = $IpAddress;

		if (isset($_SESSION['USER_LOGIN'])) {
			$customerId = $_SESSION['USER_LOGIN'];
			$stmt = $conn->getData("SELECT COUNT(*) AS CartCount FROM cart WHERE `customer_id` = '$customerId' ");
		} else {
			$stmt = $conn->getData("SELECT COUNT(*) AS CartCount FROM cart WHERE `user_id` = '$userId' AND `insert_ip` = '$IpAddress' AND `customer_id` IS NULL");
		}

		
		return $stmt;
	}

	function cartItems($userId, $IpAddress)
	{
		$conn = new dbClass();
		$this->userId = $userId;
		$this->IpAddress = $IpAddress;

		if (isset($_SESSION['USER_LOGIN'])) {
			$customerId = $_SESSION['USER_LOGIN'];
			$stmt = $conn->getAllData("SELECT * FROM cart WHERE `customer_id` = '$customerId'");
		} else {
			$stmt = $conn->getAllData("SELECT * FROM cart WHERE user_id = '$userId' AND insert_ip = '$IpAddress' AND `customer_id` IS NULL");
		}

		
		return $stmt;
	}

	function cartNumRows($userId, $IpAddress)
	{
		$conn = new dbClass();
		$this->userId = $userId;
		$this->IpAddress = $IpAddress;

		if (isset($_SESSION['USER_LOGIN'])) {
			$customerId = $_SESSION['USER_LOGIN'];
			$stmt = $conn->getRowCount("SELECT cart_id FROM cart WHERE `customer_id` = '$customerId'");
		} else {
			$stmt = $conn->getRowCount("SELECT cart_id FROM cart WHERE user_id = '$userId' AND insert_ip = '$IpAddress' AND `customer_id` IS NULL");
		}

		
		return $stmt;
	}

	function cartCheck($userId, $ProductId, $IpAddress)
	{
		$conn = new dbClass();
		$this->userId = $userId;
		$this->ProductId = $ProductId;
		$this->IpAddress = $IpAddress;

		if (isset($_SESSION['USER_LOGIN'])) {
			$customerId = $_SESSION['USER_LOGIN'];
			$stmt = $conn->getData("SELECT * FROM cart WHERE `product_id` = '$ProductId' AND `customer_id` = '$customerId' ");
		} else {
			$stmt = $conn->getData("SELECT * FROM cart WHERE `product_id` = '$ProductId' AND `user_id` = '$userId' AND `insert_ip` = '$IpAddress' AND `customer_id` IS NULL");

		}

		
		return $stmt;
	}

	function getProductsDetail($ProductId)
	{
		$conn = new dbClass;
		$this->ProductId = $ProductId;
		$this->conndb = $conn;

		$stmt = $conn->getData("SELECT * FROM `products` WHERE `product_id` = '$ProductId'");
		return $stmt;
	}

	// function addCartItem($userId,$ProductId,$Quantity,$IpAddress) 
	// {  
	// 	$conn = new dbClass;
	// 	$this->userId = $userId;
	// 	$this->ProductId = $ProductId;
	// 	$this->Quantity = $Quantity;
	// 	$this->IpAddress = $IpAddress;
	// 	$this->conndb = $conn;

	// 	$stmt = $conn->execute("INSERT INTO `cart`(`user_id`, `product_id`, `quantity`, `insert_ip`) VALUES ('$userId', '$ProductId', '$Quantity', '$IpAddress')");
	// 	return $stmt;
	// }

	function addCartItem($userId, $ProductId, $Quantity, $IpAddress)
	{
		$conn = new dbClass;
		$this->userId = $userId;
		$this->ProductId = $ProductId;
		$this->Quantity = $Quantity;
		$this->IpAddress = $IpAddress;
		$this->conndb = $conn;

		if (isset($_SESSION['USER_LOGIN'])) {
			$customerId = $_SESSION['USER_LOGIN'];
			$stmt = $conn->execute("INSERT INTO cart(user_id, product_id, quantity, insert_ip, customer_id) 
									VALUES ('$userId', '$ProductId', '$Quantity', '$IpAddress', '$customerId')");
		} else {
			$stmt = $conn->execute("INSERT INTO cart(user_id, product_id, quantity, insert_ip) 
									VALUES ('$userId', '$ProductId', '$Quantity', '$IpAddress')");
		}

		return $stmt;
	}


	function updateCartItem($userId, $ProductId, $Quantity, $IpAddress, $cartId)
	{
		$conn = new dbClass;
		$this->userId = $userId;
		$this->ProductId = $ProductId;
		$this->Quantity = $Quantity;
		$this->IpAddress = $IpAddress;
		$this->cartId = $cartId;
		$this->conndb = $conn;

			$stmt = $conn->execute("UPDATE `cart` SET `user_id` = '$userId', `product_id` = '$ProductId', `quantity` = '$Quantity', `insert_ip` = '$IpAddress', `updated_at` = NOW() WHERE `cart_id` = '$cartId'");
		return $stmt;
		
	}


	function updateCartItem123($userId, $ProductId, $Quantity, $cartId)
	{
		$conn = new dbClass;
		$this->ProductId = $ProductId;
		$this->Quantity = $Quantity;
		$this->cartId = $cartId;
		$this->conndb = $conn;

			$stmt = $conn->execute("UPDATE `cart` SET `user_id` = '$userId', `product_id` = '$ProductId', `quantity` = '$Quantity',  `updated_at` = NOW() WHERE `cart_id` = '$cartId'");
		return $stmt;
	}

	function removeCartItem($userId, $cartId, $ProductId, $IpAddress)
	{
		$conn = new dbClass;
		$this->userId = $userId;
		$this->cartId = $cartId;
		$this->ProductId = $ProductId;
		$this->IpAddress = $IpAddress;
		$this->conndb = $conn;

		if (isset($_SESSION['USER_LOGIN'])) {
			$customerId = $_SESSION['USER_LOGIN'];
			$stmt = $conn->execute("DELETE FROM `cart` WHERE cart_id = '$cartId' AND product_id = '$ProductId' AND `customer_id` = '$customerId'");
		} else {
			$stmt = $conn->execute("DELETE FROM `cart` WHERE cart_id = '$cartId' AND product_id = '$ProductId' AND (user_id = '$userId' OR insert_ip = '$IpAddress')");
		return $stmt;
		}


		return $stmt;
	}
}

?>