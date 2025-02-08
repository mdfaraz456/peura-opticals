<?php 
class Order
{
	private $cartId;
	private $userId;
	private $ProductId;
	private $Quantity;
	private $IpAddress;
	private $conndb;


	
	
	public function getFiteredOrder($filter){
		$sql="SELECT * 
		FROM `orders_table` 
		JOIN `customers` ON `orders_table`.`customer_id` = `customers`.`customer_id`
		WHERE `orders_table`.`payment_status` = '$filter';
		";
		$conn = new dbClass();
		$stmt=$conn->getAllData($sql);
		return $stmt;
	}

	

}