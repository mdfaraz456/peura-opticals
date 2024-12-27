<?php
class Authentication
{
	private $Id;
	private $CustomerId;
	private $ProductId;
	private $order_number;
	private $FirstName;
	private $LastName;
	private $Phone;
	private $Dob;
	private $Email;
	private $Password;
	private $Address;
	private $Apartment;
	private $State;
	private $City;
	private $Postcode;
	private $Title;
	private $Fee;
	private $Mobile;
	private $FullName;
	private $conndb;

	public function checkCustomer($Email){  
		$conn = new dbClass;
		$this->Email = $Email;
		$this->conndb = $conn;

		$output = $conn->getRowCount("SELECT customer_id FROM `customers` WHERE `email` = '$Email'");
		return $output;
	}

	public function register($UserName, $Email, $Password){  
		$conn = new dbClass;
		$this->Email = $Email;
		$this->Password = $Password;
		$this->conndb = $conn;

		$stmt = $conn->execute("INSERT INTO `customers`(`username`, `email`, `password`) VALUES ('$UserName', '$Email', '$Password')");
		
		$registerId = $conn->lastInsertId();
		return $registerId;
	}

	
	// public function register($FirstName, $LastName, $Phone, $Dob, $Email, $Password, $Cookies) {  
	// 	$conn = new dbClass;
	// 	$this->Cookies = $Cookies;
	// 	$this->FirstName = $FirstName;
	// 	$this->LastName = $LastName;
	// 	$this->Phone = $Phone;
	// 	$this->Dob = $Dob;
	// 	$this->Email = $Email;
	// 	$this->Password = $Password;
	// 	$this->conndb = $conn;
		
	// 	$stmt = $conn->execute("INSERT INTO `customers` (`first_name`, `last_name`, `phone`, `dob`, `email`, `password`) 
	// 							VALUES ('$FirstName', '$LastName', '$Phone', '$Dob', '$Email', '$Password')");
	// 	$registerId = $conn->lastInsertId();
		
	// 	$checkEmail = $this->getCheckEmailSubscriber($Email);  
		
	// 	if (empty($checkEmail)) {
	// 		$stmt1  = $conn->execute("INSERT INTO `subscribers` (`email`) VALUES ('$Email')");    
	// 		$subcriberId = $conn->lastInsertId();    
	// 		$stmt1  = $conn->execute("INSERT INTO `subscribers_cookies` (`subscribers_id`, `cookies`) 
	// 								   VALUES ('$subcriberId', '$Cookies')");    
	// 	} else {
	// 		$stmt1  = $conn->execute("INSERT INTO `subscribers_cookies` (`subscribers_id`, `cookies`) 
	// 								   VALUES ('" . $checkEmail['id'] . "', '$Cookies')");    
	// 	}
		
	// 	return $registerId;
	// }
	
	function getCheckEmailSubscriber($Email) {
		$conn = new dbClass;
		$this->conndb = $conn;
		
		$query = "SELECT * FROM `subscribers` WHERE `email` = '$Email'";
		$result = $conn->getData($query);
		return $result; 
	}
	


	// public function userLogin($Email, $Password) {  
	// 	$conn = new dbClass;
	// 	$this->Email = $Email;
	// 	$this->Password = $Password;
	// 	$this->conndb = $conn;
	
	// 	$output = $conn->getData("SELECT `customer_id` FROM `customers` WHERE `email` = '$Email' AND `password` = '$Password'");
	
	// 	if (isset($_SESSION['USER_CHECKOUT']) && $_SESSION['USER_CHECKOUT'] == 'checkout' && !empty($output['customer_id']) && isset($_SESSION['cart_item'])) {
	// 		$cartItem = $_SESSION['cart_item'];
	// 		$remoteAddr = $_SERVER["REMOTE_ADDR"];
	// 		$output1 = $conn->getAllData("SELECT `cart_id` FROM `cart` WHERE `user_id` = '$cartItem' AND `insert_ip` = '$remoteAddr'");
	
	// 		if (isset($output['customer_id']) && isset($output1['cart_id']) && !empty($output1['cart_id'])) {
	// 			$customerId = $output['customer_id'];
	// 			$cartId = $output1['cart_id'];
	// 			$conn->execute("UPDATE `cart` SET `customer_id` = '$customerId' WHERE `cart_id` = '$cartId'");
	// 		}
	// 	}
	
	// 	return $output;
	// }


	public function userLogin($Email, $Password) {  
		$conn = new dbClass;
		$this->Email = $Email;
		$this->Password = $Password;
		$this->conndb = $conn;
	
		$output = $conn->getData("SELECT `customer_id` FROM `customers` WHERE `email` = '$Email' AND `password` = '$Password'");
	
		if (!empty($output) && $_SESSION['USER_CHECKOUT'] == 'checkout') {
			// $customerId = $output['customer_id']; 
			// $cartItem = $_SESSION['cart_item'];
			// $IpAddress = $_SERVER["REMOTE_ADDR"];	

			// $conn->execute("UPDATE `cart` SET `customer_id` = '$customerId' WHERE `user_id` = '$cartItem' AND `insert_ip` = '$IpAddress'");
			// unset($_SESSION['cart_item']);			
		}
	
		return $output;
	}
	
	
	
	
	

	public function userDetails($Id){
		$conn = new dbClass;
		$this->Id = $Id;
		$this->conndb = $conn;

		$output = $conn->getData("SELECT * FROM `customers` WHERE `customer_id` = '$Id'");
		return $output;
	}

	public function resetPassword($websiteUrl, $Email){  
		$conn = new dbClass;
		$this->Email = $Email;
		$this->conndb = $conn;

		$output = $conn->getData("SELECT `customer_id`, `first_name`, `last_name`, `email`, `password` FROM `customers` WHERE `email` = '$Email'");

		if(!empty($output['customer_id'])):
			$todayDate = date('d-M-Y');
			$name = ucwords($output['first_name'].' '.$output['last_name']);
			$password = $output['password'];
			$subject = "Your Login Password";
			$from = "divinesoulss@divinesoulss.com";
			$to = $output['email'];

			$message = '
			<html>
				<head>
					<title>Forget Password</title>        
				</head>

				<body>
				<table style="max-width:600px;margin:auto;padding:4px;background:#353530;border-radius:16px;">
					<tr>
						<td>
							<table width="100%" style="background:white;border-radius:12px;" cellspacing="0">
								<tr>
									<td style="padding:15px 30px;">
										<table width="100%">
											<tr>
												<td width="40">
													<img src="'.$websiteUrl.'img/logo.png" style="width:70px;" alt="Logo">
												</td>
												<td style="text-align:right;">
													Date: '.$todayDate.'
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td style="text-align:center;background:#fcc201;color:#353530;">
										<h2 style="margin: 10px 0;">Your Password</h2>
									</td>
								</tr>
								<tr>
									<td style="padding:10px 32px;">
										<p style="line-height: 24px;">
											Hello <strong>'.$name.'</strong>,<br>
											You recently requested to reset your password for your Login.
										</p>
										<table width="100%" style="margin:10px 0;line-height: 25px;">
											<tr>
												<th align="left">Your Password</th>
												<td>: '.$password.'</td>
											</tr>
											<tr>
												<td>To SignIn Your Account</td>
												<td>
												: <a href="https://www.divinesoulss.com/login.php">Click Here</a>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				</body>
		  	</html>';

			mail($to, $subject, $message, "From: <$from>\r\nContent-type: text/html\r\n");

			return true;
		else:
			return false;
		endif;
	}

	public function checkSession($Id){
		$this->Id = $Id;
		if(empty($Id))
		echo "<script>window.location.href='index.php'</script>";
	}	

	public function updateuserProfile($FirstName,$LastName,$Phone,$Email,$Dob,$Address,$Apartment,$State,$City,$Postcode,$Id){
		$conn = new dbClass;
		$this->Id = $Id;
		$this->FirstName = $FirstName;
		$this->LastName = $LastName;
		$this->Phone = $Phone;
		$this->Email = $Email;
		$this->Dob = $Dob;
		$this->Address = $Address;
		$this->Apartment = $Apartment;
		$this->State = $State;
		$this->City = $City;
		$this->Postcode = $Postcode;
		$this->conndb = $conn;

		$output = $conn->execute("UPDATE `customers` SET `first_name` = '$FirstName', `last_name` = '$LastName', `phone` = '$Phone', `email` = '$Email', `dob` = '$Dob', `address` = '$Address', `apartment` = '$Apartment', `state` = '$State', `city` = '$City', `postcode` = '$Postcode', `updated_at` = NOW() WHERE `customer_id` = '$Id'");
		return $output;
	}

	public function userShipDetails($Id){
		$conn = new dbClass;
		$this->Id = $Id;
		$this->conndb = $conn;

		$output = $conn->getData("SELECT * FROM `shipping_address` WHERE `customer_id` = '$Id'");
		return $output;
	}

	public function userShipLogin($Id){
		$conn = new dbClass;
		$this->Id = $Id;
		$this->conndb = $conn;

		$output = $conn->getRowCount("SELECT * FROM `shipping_address` WHERE `customer_id` = '$Id'");
		return $output;
	}

	public function addShipping($CustomerId,$ProductId, $order_number, $FirstName,$LastName,$Phone,$Email,$Address,$Apartment,$State,$City,$Postcode){
		$conn = new dbClass;
		$this->CustomerId = $CustomerId;
		$this->ProductId = $ProductId;
		$this->order_number = $order_number;
		$this->FirstName = $FirstName;
		$this->LastName = $LastName;
		$this->Phone = $Phone;
		$this->Email = $Email;
		$this->Address = $Address;
		$this->Apartment = $Apartment;
		$this->State = $State;
		$this->City = $City;
		$this->Postcode = $Postcode;
		$this->conndb = $conn;

		$output = $conn->execute("INSERT INTO `shipping_address`(`customer_id`, `product_id`, order_number, `first_name`, `last_name`, `phone`, `email`, `address`, `apartment`, `state`, `city`, `postcode`) VALUES ('$CustomerId', '$ProductId', $order_number, '$FirstName', '$LastName', '$Phone', '$Email', '$Address', '$Apartment', '$State', '$City', '$Postcode')");
		return $output;
	}

	public function addEnrollment($Title, $FullName, $Mobile, $Email, $State, $City, $Fee, $workshop_order_number,$customer_id) {
		$conn = new dbClass;
		$this->Title = $Title;
		$this->FullName = $FullName;
		$this->Mobile = $Mobile;
		$this->Email = $Email;
		$this->State = $State;
		$this->City = $City;
		$this->Fee = $Fee;
		$this->workshop_order_number = $workshop_order_number;
		$this->customer_id = $customer_id;
		$this->conndb = $conn;
	
		// Prepare the SQL statement
		$output = $conn->execute("INSERT INTO workshop_enroll (title, full_name, mobile, email, state, city, fee, workshop_order_number, customer_id) VALUES ('$Title', '$FullName', '$Mobile', '$Email', '$State', '$City', '$Fee', '$workshop_order_number', '$customer_id')");
	
		if ($output) {
			$lastInsertId = $conn->lastInsertId();
			return $lastInsertId;
		} else {
			return false;
		}
	}
	
	public function getLastWorkshopEnroll() {
		$conn = new dbClass;
		$this->conndb = $conn;
	
		// Assume id is the auto-increment primary key for the table
		$output = $conn->getAllData("SELECT id FROM workshop_enroll ORDER BY id DESC LIMIT 1");
		return $output;
	}

	public function updateShipping($FirstName,$LastName,$Phone,$Email,$Address,$Apartment,$State,$City,$Postcode,$Id){
		$conn = new dbClass;
		$this->Id = $Id;
		$this->FirstName = $FirstName;
		$this->LastName = $LastName;
		$this->Phone = $Phone;
		$this->Email = $Email;
		$this->Address = $Address;
		$this->Apartment = $Apartment;
		$this->State = $State;
		$this->City = $City;
		$this->Postcode = $Postcode;
		$this->conndb = $conn;

		$output = $conn->execute("UPDATE `shipping_address` SET `first_name` = '$FirstName', `last_name` = '$LastName', `phone` = '$Phone', `email` = '$Email', `address` = '$Address', `apartment` = '$Apartment', `state` = '$State', `city` = '$City', `postcode` = '$Postcode', `updated_at` = NOW() WHERE `customer_id` = '$Id'");
		return $output;
	}

	public function changePassword($Password,$Id){
		$conn = new dbClass;
		$this->Id = $Id;
		$this->Password = $Password;
		$this->conndb = $conn;

		$output = $conn->execute("UPDATE `customers` SET `password` = '$Password' WHERE `customer_id` = '$Id'");
		return $output;
	}

	
}

?>