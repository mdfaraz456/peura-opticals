<?php
// require 'config.php';
class Products
{
	private $Id;
	private $Image;
	private $Name;
	private $Slug;
	private $Price;
	private $Discount;
	private $Stock;
	private $Sku;
	private $ShortDesc;
	private $Details;
	private $measurements;
	private $package_contains;	
	private $trending;
	private $hotest_eyewear;
	private $Bestsellers;
	private $new_arrivals;
	private $Status;
	private $Table;
	private $conndb;
	private $size_large;
	private $size_medium;
	private $size_small;

	function addProducts($Image, $Name, $Slug, $Price, $Discount, $Stock, $Sku, $ShortDesc, $Details, $measurements, $package_contains, $trending, $hotest_eyewear, $Status, $new_arrivals)
	{  
		$conn = new dbClass;
		$this->Image = $Image;
		$this->Name = $Name;
		$this->Slug = $Slug;
		$this->Price = $Price;
		$this->Discount = $Discount;
		$this->Stock = $Stock;
		$this->Sku = $Sku;
		$this->ShortDesc = $ShortDesc;
		$this->Details = $Details;
		$this->measurements = $measurements;
		$this->package_contains = $package_contains;
		$this->trending = $trending;
		$this->hotest_eyewear = $hotest_eyewear;
		$this->Status = $Status;
		$this->new_arrivals = $new_arrivals;
		$this->conndb = $conn;

		// Modified INSERT query to include the new_arrivals field
		$stmt = $conn->execute("INSERT INTO `products`(`image`, `name`, `slug`, `price`, `discount`, `stock`, `sku`, `short_description`, `details`, `measurements`, `package_contains`, `trending`, `hotest_eyewear`, `status`, `new_arrivals`) 
								VALUES ('$Image', '$Name', '$Slug', '$Price', '$Discount', '$Stock', '$Sku', '$ShortDesc', '$Details', '$measurements', '$package_contains', '$trending', '$hotest_eyewear', '$Status', '$new_arrivals')");
		
		$productId = $conn->lastInsertId(); // Get the last inserted product ID
		return $productId;
	}

		

	function updateProducts($Image, $Name, $Slug, $Price, $Discount, $Stock, $Sku, $ShortDesc, $Details, $measurements, $package_contains, $trending, $hotest_eyewear, $Status, $new_arrivals, $Id)
	{  
		$conn = new dbClass;
		$this->Id = $Id;
		$this->Image = $Image;
		$this->Name = $Name;
		$this->Slug = $Slug;
		$this->Price = $Price;
		$this->Discount = $Discount;
		$this->Stock = $Stock;
		$this->Sku = $Sku;
		$this->ShortDesc = $ShortDesc;
		$this->Details = $Details;
		$this->measurements = $measurements;
		$this->package_contains = $package_contains;
		$this->trending = $trending;
		$this->hotest_eyewear = $hotest_eyewear;
		$this->Status = $Status;
		$this->new_arrivals = $new_arrivals;
		$this->conndb = $conn;

		// Modify SQL query to update the new_arrivals field
		$stmt = $conn->execute("UPDATE `products` 
								SET `image`='$Image', `name`='$Name', `slug`='$Slug', `price`='$Price', `discount`='$Discount', 
									`stock`='$Stock', `sku`='$Sku', `short_description`='$ShortDesc', `details`='$Details', 
									`measurements`='$measurements', `package_contains`='$package_contains', `trending`='$trending', 
									`hotest_eyewear`='$hotest_eyewear', `status`='$Status', `new_arrivals`='$new_arrivals', 
									`updated_at` = NOW() 
								WHERE `product_id` = '$Id'");
		
		return $stmt;
	}


	function getProducts($Id) 
	{  
		$conn = new dbClass;
		$this->Id = $Id;
		$this->conndb = $conn;

		$stmt = $conn->getData("SELECT * FROM `products` WHERE `product_id` = '$Id'");
		return $stmt;
	}

	// function getProductsCategory($Id) 
	// {  
	// 	$conn = new dbClass;
	// 	$this->Id = $Id;
	// 	$this->conndb = $conn;

	// 	$stmt = $conn->getAllData("SELECT * FROM `product_category` WHERE `product_id` = '$Id'");
	// 	return $stmt;
	// }

	// function getProductsSubCategory($Id) 
	// {  
	// 	$conn = new dbClass;
	// 	$this->Id = $Id;
	// 	$this->conndb = $conn;

	// 	$stmt = $conn->getAllData("SELECT * FROM `product_subcategory` WHERE `product_id` = '$Id'");
	// 	return $stmt;
	// }

	function allProducts() 
	{  
		$conn = new dbClass;
		$this->conndb = $conn;

		$stmt = $conn->getAllData("SELECT * FROM `products` ORDER BY `product_id` DESC");
		return $stmt;
	}	

	function getProdcutsImages($Id){
		$conn = new dbClass;
		$this->Id = $Id;
		$this->conndb = $conn;

		$output = $conn->getAllData("SELECT * FROM `products_images` WHERE `product_id` = '$Id'");
		return $output;
	}

	function prodcutsImageCount($Id){
		$conn = new dbClass;
		$this->Id = $Id;
		$this->conndb = $conn;

		$output = $conn->getRowCount("SELECT image_id FROM `products_images` WHERE `product_id` = '$Id'");
		return $output;
	}

	function slug($Name, $Table){
		$conn = new dbClass;
		$this->Name = $Name;
		$this->Table = $Table;
		$this->conndb = $conn;
		
		$slug = strtolower(trim(preg_replace("/[\s-]+/", "-", preg_replace( "/[^a-zA-Z0-9\-]/", '-', addslashes($Name))),"-"));
		$count = $conn->getData("SELECT product_id FROM $Table WHERE `slug` = '".addslashes($slug)."'");
		$RowId = $count['product_id'];
		if(!empty($RowId)): 
			$slug=strtolower(trim(preg_replace("/[\s-]+/", "-", preg_replace( "/[^a-zA-Z0-9\-]/", '-', addslashes($Name."-".date('ymdis')."-".rand(0,999)))),"-")); 
		endif;
   		return $slug;
	}

	function updateSlug($Name, $Table, $Id){
		$conn = new dbClass;
		$this->Id = $Id;
		$this->Name = $Name;
		$this->Table = $Table;
		$this->conndb = $conn;

		$slug = strtolower(trim(preg_replace("/[\s-]+/", "-", preg_replace( "/[^a-zA-Z0-9\-]/", '-', addslashes($Name))),"-"));
		$count = $conn->getData("SELECT product_id FROM $Table WHERE `slug` = '".addslashes($slug)."' AND product_id!='$Id'");
		// $RowId = $count['product_id'];
        $RowId = ($count !== false) ? $count['product_id'] : null;
		if(!empty($RowId)): 
			$slug=strtolower(trim(preg_replace("/[\s-]+/", "-", preg_replace( "/[^a-zA-Z0-9\-]/", '-', addslashes($Name."-".date('ymdis')."-".rand(0,999)))),"-")); 
		endif;
   		return $slug;
	}
}
?>