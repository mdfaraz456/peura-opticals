<?php

// require 'config.php';

class adminUpdate
{
	private $ID;
	private $Username;
	private $Email;
	private $Password;
	private $Mobile;
	private $Type;
	private $Image;
	private $Status;
	private $Limit;
	private $Table;
	private $conndb;
	
	function checkUser($Email)
	{  
		$conn = new dbClass;
		$this->Email = $Email;
		$this->conndb = $conn;
		$stmt = $conn->getRowCount("SELECT * FROM `tbl_admin` WHERE `email` = '$Email'");
		return $stmt;
	}
	
	function addUser($Username, $Email, $Password, $Mobile, $Type, $Image, $Status)
	{  
		$conn = new dbClass;
		$this->Username = $Username;
		$this->Email = $Email;
		$this->Password = $Password;
		$this->Mobile = $Mobile;
		$this->Type = $Type;
		$this->Image = $Image;
		$this->Status = $Status;
		$this->conndb = $conn;
		$stmt = $conn->execute("INSERT INTO `tbl_admin`(`username`, `email`, `password`, `mobile`, `type`, `image`, `status`, `created_at`) VALUES ('$Username', '$Email', '$Password', '$Mobile', '$Type', '$Image', '$Status', now())");
		return $stmt;
	}
	
	function updateUser($Username, $Email, $Password, $Mobile, $Type, $Image, $Status, $ID)
	{  
		$conn = new dbClass;
		$this->ID = $ID;
		$this->Username = $Username;
		$this->Email = $Email;
		$this->Password = $Password;
		$this->Mobile = $Mobile;
		$this->Type = $Type;
		$this->Image = $Image;
		$this->Status = $Status;
		$this->conndb = $conn;
		$stmt = $conn->execute("UPDATE `tbl_admin` SET `username` = '$Username', `email` = '$Email', `password` = '$Password', `mobile` = '$Mobile', `type` = '$Type', `image` = '$Image', `status` = '$Status', `updated_at` = now() WHERE `id` = '$ID'");
		return $stmt;
	}
	
	function updateProfile($Username, $Email, $Mobile, $Image, $ID) 
	{  
		$conn = new dbClass;
		$this->ID = $ID;
		$this->Username = $Username;
		$this->Email = $Email;
		$this->Mobile = $Mobile;
		$this->Image = $Image;
		$this->conndb = $conn;
		$stmt = $conn->execute("UPDATE `tbl_admin` SET `username` = '$Username', `email` = '$Email', `mobile` = '$Mobile', `image` = '$Image', `updated_at` = now() WHERE `id` = '$ID'");
		return $stmt;
	}
	
	function changePassword($Password, $ID) 
	{  
		$conn = new dbClass;
		$this->ID = $ID;
		$this->Password = $Password;
		$this->conndb = $conn;
		$stmt = $conn->execute("UPDATE `tbl_admin` SET `password` = '$Password', `updated_at` = now() WHERE `id` = '$ID'");
		return $stmt;
	}
	
	function allUsers() 
	{  
		$conn = new dbClass;
		$this->conndb = $conn;
		$stmt = $conn->getAllData("SELECT * FROM `tbl_admin` ORDER BY `id` DESC");
		return $stmt;
	}
	
	function getNumrowsCount($Table) 
	{  
		$conn = new dbClass;
		$this->Table = $Table;
		$this->conndb = $conn;
	
		$stmt = $conn->getRowCount("SELECT id FROM $Table ORDER BY `id` DESC");
		return $stmt;
	}
	
	function allUsersByLimit($Limit) 
	{  
		$conn = new dbClass;
		$this->Limit = $Limit;
		$this->conndb = $conn;
	
		$stmt = $conn->getAllData("SELECT * FROM `tbl_admin` ORDER BY `id` DESC LIMIT $Limit");
		return $stmt;
	}
	
	function getUsers($ID) 
	{  
		$conn = new dbClass;
		$this->ID = $ID;
		$this->conndb = $conn;
	
		$stmt = $conn->getData("SELECT * FROM `tbl_admin` WHERE `id` = '$ID'");
		return $stmt;
	}
	
}

class Banner
{
	private $ID;
	private $Image;
	private $Tag;
	private $Title;	
	private $BtnName;
	private $BtnLink;
	private $Type;
	private $Status;
	private $conndb;
	
	function addBanner1($Image, $Status)
	{  
		$conn = new dbClass;
		$this->Image = $Image;
		$this->Status = $Status;
		$this->conndb = $conn;
	
		$stmt = $conn->execute("INSERT INTO `banner`( `image`, `status`) VALUES ('$Image', '$Status')");
		return $stmt;
	}
	
	function updateBanner1($Image, $Status, $ID)
	{  
		$conn = new dbClass;
		$this->ID = $ID;
		$this->Image = $Image;
		
		$this->Status = $Status;
		$this->conndb = $conn;
	
		$stmt = $conn->execute("UPDATE `banner` SET `image` = '$Image', `status` = '$Status', `updated_at` = now() WHERE `id` = '$ID'");
		return $stmt;
	}

	function addBanner2($Image, $Type, $Status)
	{  
		$conn = new dbClass;
		$this->Image = $Image;
		$this->Type = $Type;
		$this->Status = $Status;
		$this->conndb = $conn;
	
		$stmt = $conn->execute("INSERT INTO `banner`( `image`, `type`, `status`) VALUES ('$Image', '$Type', '$Status')");
		return $stmt;
	}
	
	function updateBanner2($Image, $Type, $Status, $ID)
	{  
		$conn = new dbClass;
		$this->ID = $ID;
		$this->Image = $Image;
		$this->Type = $Type;
		$this->Status = $Status;
		$this->conndb = $conn;
	
		$stmt = $conn->execute("UPDATE `banner` SET `image` = '$Image', `type` = '$Type', `status` = '$Status', `updated_at` = now() WHERE `id` = '$ID'");
		return $stmt;
	}
	
	function allBanner() 
	{  
		$conn = new dbClass;
		
		$this->conndb = $conn;
	
		$stmt = $conn->getAllData("SELECT * FROM `banner` ORDER BY `id` DESC");
		return $stmt;
	}
	
	function getBanner($ID) 
	{  
		$conn = new dbClass;
		$this->ID = $ID;
		$this->conndb = $conn;
	
		$stmt = $conn->getData("SELECT * FROM `banner` WHERE `id` = '$ID'");
		return $stmt;
	}	
}
class Testimonial
{
    private $ID;
    private $Name;
    private $Description;
    private $Status;
    private $conndb;

	function addTestimonial($files,$Name, $Description, $Status)
	{  
		$conn = new dbClass;
        $this->Name = $Name;
		$this->Description = $Description;
		$this->Status = $Status;
	
		$stmt = $conn->execute("INSERT INTO `testimonial`(`name`, `video_url`, `image`, `status`) VALUES ('$Name', '$Description', '$files', '$Status')");
		return $stmt;
	}
     
    function allTestimonial()
    {
        $conn = new dbClass();
        $this->conndb = $conn;

        $stmt = $conn->getAllData("SELECT * FROM `testimonial` ORDER BY `id` DESC");
        return $stmt;
    }

    function getTestimonialById($ID)
    {
        $conn = new dbClass;
        $this->ID = $ID;
        $this->conndb = $conn;

        $stmt = $conn->getData("SELECT * FROM `testimonial` WHERE `id` = '$ID'");
        return $stmt;
    }

    function updateTestimonial($file,$Name, $Description, $Status, $ID)
    {
    $conn = new dbClass();
	$this->ID = $ID;
	$this->Name = $Name;
	$this->Description = $Description;
	$this->Status = $Status;
	$this->conndb = $conn;

	$stmt = $conn->execute("UPDATE `testimonial` SET `name` = '$Name', `image` ='$file', `video_url` = '$Description', `status` = '$Status', `updated_at` = now() WHERE `id` = '$ID'");
	return $stmt;
    }
}


class Product_Type
{
	private $ID;
	private $CatId;	
	private $Name;
	private $Slug;
	private $Status;
	private $Table;
	private $product_id;
	private $file;
	private $conndb;
			
	function checkPType($Name,$Table)
	{  
		$conn = new dbClass;
		$this->Name = $Name;
		$this->Table = $Table;
		$this->conndb = $conn;
		$stmt = $conn->getRowCount("SELECT * FROM $Table WHERE `name` = '$Name'");
		return $stmt;
	}
		
	function addPType($Name, $Status)
	{  
		$conn = new dbClass;
		$this->Name = $Name;
		
		$this->Status = $Status;
		$this->conndb = $conn;
	
		$stmt = $conn->execute("INSERT INTO `product_type`(`name`, `status`) VALUES ('$Name', '$Status')");
		return $stmt;
	}
	
	function updatePType($Name, $Status, $ID)
	{  
		$conn = new dbClass;
		$this->ID = $ID;
		$this->Name = $Name;
		
		$this->Status = $Status;
		$this->conndb = $conn;
	
		$stmt = $conn->execute("UPDATE `product_type` SET `name` = '$Name', `status` = '$Status', `updated_at` = now() WHERE `id` = '$ID'");
		return $stmt;
	}
	
	function getAllPType() 
	{  
		$conn = new dbClass;
		$this->conndb = $conn;
	
		$stmt = $conn->getAllData("SELECT * FROM `product_type` ORDER BY `id` DESC");
		return $stmt;
	}

	function allPType() 
	{  
		$conn = new dbClass;
		$this->conndb = $conn;
	
		$stmt = $conn->getAllData("SELECT * FROM `product_type` WHERE `status` = '1' ORDER BY `id` ASC");
		return $stmt;
	}

	function getPType($ID) 
	{  
		$conn = new dbClass;
		$this->ID = $ID;
		$this->conndb = $conn;
	
		$stmt = $conn->getData("SELECT * FROM `product_type` WHERE `id` = '$ID'");
		return $stmt;
	}
	function getSelectedCategories($product_id) {
		$conn = new dbClass;
		$this->product_id = $product_id;
		$this->conndb = $conn;

		$stmt = $conn->getAllData("
			SELECT category_id 
			FROM `product_category` 
			WHERE product_id = '$product_id'
		");

		return !empty($stmt) ? array_column($stmt, 'category_id') : [];
	}

	function getSelectedSubCategories($product_id) {
		$conn = new dbClass;
		$this->product_id = $product_id;
		$this->conndb = $conn;

		$stmt = $conn->getAllData("
			SELECT subcategory_id 
			FROM `product_subcategory` 
			WHERE product_id = '$product_id'
		");

		return !empty($stmt) ? array_column($stmt, 'subcategory_id') : [];
	}

	function checkProductCategory($Name,$CatId)
	{  
		$conn = new dbClass;
		$this->Name = $Name;
		$this->CatId = $CatId;
		$this->conndb = $conn;
	
		$stmt = $conn->getRowCount("SELECT * FROM `category` WHERE `name` = '$Name' AND `ptype_id` = '$CatId'");
		return $stmt;
	}
	function addProductCategory($file,$CatId, $Name,$Status)
	{  
		$conn = new dbClass;
		$this->CatId = $CatId;
		$this->Name = $Name;
		$this->Status = $Status;
		$this->conndb = $conn;
		$stmt = $conn->execute("INSERT INTO `category`(`ptype_id`, `name`,`image`, `status`) VALUES ('$CatId', '$Name', '$file', '$Status')");
		return $stmt;
	}
	

	function updateProductCategory($CatId, $Name,$file, $Status, $ID)
	{  
		$conn = new dbClass;
		$this->ID = $ID;
		$this->CatId = $CatId;
		$this->Name = $Name;
		
		$this->Status = $Status;
		$this->conndb = $conn;
	
		$stmt = $conn->execute("UPDATE `category` SET `ptype_id` = '$CatId', `name` = '$Name', `image` = '$file', `status` = '$Status', `updated_at` = now() WHERE `id` = '$ID'");
		return $stmt;
	}
	
	function getAllProductCategory() 
	{  
		$conn = new dbClass;
		$this->conndb = $conn;
	
		$stmt = $conn->getAllData("SELECT * FROM `category` ORDER BY `id` DESC");
		return $stmt;
	}

	function allProductCategory() 
	{  
		$conn = new dbClass;
		$this->conndb = $conn;
	
		$stmt = $conn->getAllData("SELECT * FROM `category` WHERE `status` = '1' ORDER BY `id` ASC");
		return $stmt;
	}
	
	function getProductCategory($ID) 
	{  
		$conn = new dbClass;
		$this->ID = $ID;
		$this->conndb = $conn;
	
		$stmt = $conn->getData("SELECT * FROM `category` WHERE `id` = '$ID'");
		return $stmt;
	}

	function getProductCatgoriesDropdown($CatId)
	{
		$conn = new dbClass;
		$this->CatId = $CatId;
		$this->conndb = $conn;
	
		$stmt = $conn->getAllData("SELECT * FROM `category` WHERE `status` = 1 AND `ptype_id` = '$CatId'");
		return $stmt;
	}
	
	function getProductCategoryFormCat($CatId) 
	{  
		$conn = new dbClass;
		$this->CatId = $CatId;
		$this->conndb = $conn;
	
		$stmt = $conn->getData("SELECT * FROM `category` WHERE `ptype_id` = '$CatId'");
		return $stmt;
	}

}


?>