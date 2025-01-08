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

	function addTestimonial($files,$date,$Name, $Description, $Status)
	{  
		$conn = new dbClass;
        $this->Name = $Name;
		$this->Description = $Description;
		$this->Status = $Status;
	
		$stmt = $conn->execute("INSERT INTO `testimonial`(`name`, `video_url`, `image`,`date`, `status`) VALUES ('$Name', '$Description', '$files', '$date', '$Status')");
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

    function updateTestimonial($file,$date,$Name, $Description, $Status, $ID)
    {
    $conn = new dbClass();
	$this->ID = $ID;
	$this->Name = $Name;
	$this->Description = $Description;
	$this->Status = $Status;
	$this->conndb = $conn;

	$stmt = $conn->execute("UPDATE `testimonial` SET `name` = '$Name', `image` ='$file', `video_url` = '$Description', `date` = '$date', `status` = '$Status', `updated_at` = now() WHERE `id` = '$ID'");
	return $stmt;
    }
}
class Categories
{
	private $ID;
	private $CatId;
	private $SubCatId;
	private $Name;
	private $Slug;
	private $Status;
	private $Table;
	private $product_id;
	private $conndb;
	
	function slug($Name, $Table){
	
		$conn = new dbClass;
		$this->Name = $Name;
		$this->Table = $Table;
		$this->conndb = $conn;
		
		$count = $conn->getData("SELECT id FROM $Table WHERE `name` = '".addslashes($Name)."'");
		$RowId = $count['id'];
		if(empty($RowId)):
			$slug=strtolower(trim(preg_replace("/[\s-]+/", "-", preg_replace( "/[^a-zA-Z0-9\-]/", '-', addslashes($Name))),"-")); 
		else: 
			$slug=strtolower(trim(preg_replace("/[\s-]+/", "-", preg_replace( "/[^a-zA-Z0-9\-]/", '-', addslashes($Name."-".$RowId))),"-")); 
		endif;
		
   		return $slug;
	}

	
	function updateSlug($Name, $Table, $ID){
	
		$conn = new dbClass;
		$this->ID = $ID;
		$this->Name = $Name;
		$this->Table = $Table;
		$this->conndb = $conn;
		
		$count = $conn->getData("SELECT id FROM $Table WHERE `name` = '".addslashes($Name)."' AND id!='$ID'");
		$RowId = $count['id'];
		if(empty($RowId)):
			$slug=strtolower(trim(preg_replace("/[\s-]+/", "-", preg_replace( "/[^a-zA-Z0-9\-]/", '-', addslashes($Name))),"-")); 
		else: 
			$slug=strtolower(trim(preg_replace("/[\s-]+/", "-", preg_replace( "/[^a-zA-Z0-9\-]/", '-', addslashes($Name."-".$RowId))),"-")); 
		endif;
		
   		return $slug;
	}
	
	
	function checkCategories($Name,$Table)
	{  
		$conn = new dbClass;
		$this->Name = $Name;
		$this->Table = $Table;
		$this->conndb = $conn;
	
		$stmt = $conn->getRowCount("SELECT * FROM $Table WHERE `name` = '$Name'");
		return $stmt;
	}
	
	function checkSubCategories($Name,$CatId)
	{  
		$conn = new dbClass;
		$this->Name = $Name;
		$this->CatId = $CatId;
		$this->conndb = $conn;
	
		$stmt = $conn->getRowCount("SELECT * FROM `sub_category` WHERE `name` = '$Name' AND `category_id` = '$CatId'");
		return $stmt;
	}

	function checkSubSubCategories($Name,$CatId,$SubCatId)
	{  
		$conn = new dbClass;
		$this->Name = $Name;
		$this->CatId = $CatId;
		$this->SubCatId = $SubCatId;
		$this->conndb = $conn;
	
		$stmt = $conn->getRowCount("SELECT * FROM `sub_sub_category` WHERE `name` = '$Name' AND `category_id` = '$CatId' AND `sub_category_id` = '$SubCatId'");
		return $stmt;
	}
	
	function addCategories($Name, $Slug, $Status)
	{  
		$conn = new dbClass;
		$this->Name = $Name;
		$this->Slug = $Slug;
		$this->Status = $Status;
		$this->conndb = $conn;
	
		$stmt = $conn->execute("INSERT INTO `category`(`name`, `slug`, `status`) VALUES ('$Name', '$Slug', '$Status')");
		return $stmt;
	}
	
	function updateCategories($Name, $Slug, $Status, $ID)
	{  
		$conn = new dbClass;
		$this->ID = $ID;
		$this->Name = $Name;
		$this->Slug = $Slug;
		$this->Status = $Status;
		$this->conndb = $conn;
	
		$stmt = $conn->execute("UPDATE `category` SET `name` = '$Name', `slug` = '$Slug', `status` = '$Status', `updated_at` = now() WHERE `id` = '$ID'");
		return $stmt;
	}
	
	function getAllCategories() 
	{  
		$conn = new dbClass;
		$this->conndb = $conn;
	
		$stmt = $conn->getAllData("SELECT * FROM `category` ORDER BY `id` DESC");
		return $stmt;
	}

	function allCategories() 
	{  
		$conn = new dbClass;
		$this->conndb = $conn;
	
		$stmt = $conn->getAllData("SELECT * FROM `category` WHERE `status` = '1' ORDER BY `id` ASC");
		return $stmt;
	}
	
	function getCategories($ID) 
	{  
		$conn = new dbClass;
		$this->ID = $ID;
		$this->conndb = $conn;
	
		$stmt = $conn->getData("SELECT * FROM `category` WHERE `id` = '$ID'");
		return $stmt;
	}

	function getCategoriesBySlug($Slug) 
	{  
		$conn = new dbClass;
		$this->Slug = $Slug;
		$this->conndb = $conn;
	
		$stmt = $conn->getData("SELECT * FROM `category` WHERE `slug` = '$Slug'");
		return $stmt;
	}
	
	function addSubCategories($CatId, $Name, $Slug, $Status)
	{  
		$conn = new dbClass;
		$this->CatId = $CatId;
		$this->Name = $Name;
		$this->Slug = $Slug;
		$this->Status = $Status;
		$this->conndb = $conn;
	
		$stmt = $conn->execute("INSERT INTO `sub_category`(`category_id`, `name`, `slug`, `status`) VALUES ('$CatId', '$Name', '$Slug', '$Status')");
		return $stmt;
	}
	
	function updateSubCategories($CatId, $Name, $Slug, $Status, $ID)
	{  
		$conn = new dbClass;
		$this->ID = $ID;
		$this->CatId = $CatId;
		$this->Name = $Name;
		$this->Slug = $Slug;
		$this->Status = $Status;
		$this->conndb = $conn;
	
		$stmt = $conn->execute("UPDATE `sub_category` SET `category_id` = '$CatId', `name` = '$Name', `slug` = '$Slug', `status` = '$Status', `updated_at` = now() WHERE `id` = '$ID'");
		return $stmt;
	}
	
	function getAllSubCategories() 
	{  
		$conn = new dbClass;
		$this->conndb = $conn;
	
		$stmt = $conn->getAllData("SELECT * FROM `sub_category` ORDER BY `id` DESC");
		return $stmt;
	}

	function allSubCategories() 
	{  
		$conn = new dbClass;
		$this->conndb = $conn;
	
		$stmt = $conn->getAllData("SELECT * FROM `sub_category` WHERE `status` = '1' ORDER BY `id` ASC");
		return $stmt;
	}
	
	function getSubCategories($ID) 
	{  
		$conn = new dbClass;
		$this->ID = $ID;
		$this->conndb = $conn;
	
		$stmt = $conn->getData("SELECT * FROM `sub_category` WHERE `id` = '$ID'");
		return $stmt;
	}

	function getSubCatgoriesDropdown($CatId)
	{
		$conn = new dbClass;
		$this->CatId = $CatId;
		$this->conndb = $conn;
	
		$stmt = $conn->getAllData("SELECT * FROM `sub_category` WHERE `status` = 1 AND `category_id` = '$CatId'");
		return $stmt;
	}
	
	function getSubCategoryFormCat($CatId) 
	{  
		$conn = new dbClass;
		$this->CatId = $CatId;
		$this->conndb = $conn;
	
		$stmt = $conn->getData("SELECT * FROM `sub_category` WHERE `category_id` = '$CatId'");
		return $stmt;
	}

	function getSubCategoriesBySlug($Slug) 
	{  
		$conn = new dbClass;
		$this->Slug = $Slug;
		$this->conndb = $conn;
	
		$stmt = $conn->getData("SELECT * FROM `sub_category` WHERE `slug` = '$Slug'");
		return $stmt;
	}

	function addSubSubCategories($CatId, $SubCatId, $Name, $Slug, $Status)
	{  
		$conn = new dbClass;
		$this->CatId = $CatId;
		$this->SubCatId = $SubCatId;
		$this->Name = $Name;
		$this->Slug = $Slug;
		$this->Status = $Status;
		$this->conndb = $conn;
	
		$stmt = $conn->execute("INSERT INTO `sub_sub_category`(`category_id`, `sub_category_id`, `name`, `slug`, `status`) VALUES ('$CatId', '$SubCatId', '$Name', '$Slug', '$Status')");
		return $stmt;
	}
	
	function updateSubSubCategories($CatId, $SubCatId, $Name, $Slug, $Status, $ID)
	{  
		$conn = new dbClass;
		$this->ID = $ID;
		$this->CatId = $CatId;
		$this->SubCatId = $SubCatId;
		$this->Name = $Name;
		$this->Slug = $Slug;
		$this->Status = $Status;
		$this->conndb = $conn;
	
		$stmt = $conn->execute("UPDATE `sub_sub_category` SET `category_id` = '$CatId', `sub_category_id` = '$SubCatId', `name` = '$Name', `slug` = '$Slug', `status` = '$Status',  `updated_at` = now() WHERE `id` = '$ID'");
		return $stmt;
	}

	function getAllSubSubCategories() 
	{  
		$conn = new dbClass;
		$this->conndb = $conn;
	
		$stmt = $conn->getAllData("SELECT * FROM `sub_sub_category` ORDER BY `id` DESC");
		return $stmt;
	}

	function getSubSubCategories($ID) 
	{  
		$conn = new dbClass;
		$this->ID = $ID;
		$this->conndb = $conn;
	
		$stmt = $conn->getData("SELECT * FROM `sub_sub_category` WHERE `id` = '$ID'");
		return $stmt;
	}

	function getSubSubCatgoriesDropdown($SubCatId)
	{
		$conn = new dbClass;
		$this->SubCatId = $SubCatId;
		$this->conndb = $conn;
	
		$stmt = $conn->getAllData("SELECT * FROM `sub_sub_category` WHERE `status` = 1 AND `sub_category_id` = '$SubCatId'");
		return $stmt;
	}

	function getSubCategoryWithCategory($SubCatId) {
		$conn = new dbClass;
		$this->SubCatId = $SubCatId;
		$this->conndb = $conn;
	
		$stmt = $conn->getAllData("
			SELECT c.name as category_name, sc.name as subcategory_name
			FROM `sub_category` sc
			INNER JOIN `category` c ON sc.category_id = c.id
			WHERE sc.id = '$SubCatId' AND sc.status = 1
		");
	
		return !empty($stmt) ? $stmt[0] : null;
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


	function getSelectedSubSubCategories($product_id) {
		$conn = new dbClass;
		$this->product_id = $product_id;
		$this->conndb = $conn;

		$stmt = $conn->getAllData("
			SELECT subsubcategory_id 
			FROM `product_subsubcategory` 
			WHERE product_id = '$product_id'
		");

		return !empty($stmt) ? array_column($stmt, 'subsubcategory_id') : [];
	}

	function checkProductType($Name,$Table)
	{  
		$conn = new dbClass;
		$this->Name = $Name;
		$this->Table = $Table;
		$this->conndb = $conn;
		$stmt = $conn->getRowCount("SELECT * FROM $Table WHERE `name` = '$Name'");
		return $stmt;
	}
	function getProductType($ID) 
	{  
		$conn = new dbClass;
		$this->ID = $ID;
		$this->conndb = $conn;
	
		$stmt = $conn->getData("SELECT * FROM `product_type` WHERE `id` = '$ID'");
		return $stmt;
	}
	function addProductType($file, $Name,$Status)
	{  
		$conn = new dbClass;
		$this->Name = $Name;
		$this->Status = $Status;
		$this->conndb = $conn;
	
		$stmt = $conn->execute("INSERT INTO `product_type`(`name`,`image`, `status`) VALUES ('$Name', '$file', '$Status')");
		return $stmt;
	}
	function updateProductType($Name, $file, $Status, $ID)
	{  
		$conn = new dbClass;
		$this->ID = $ID;
		$this->Name = $Name;
		$this->Status = $Status;
		$this->conndb = $conn;
		$stmt = $conn->execute("UPDATE `product_type` SET `name` = '$Name', `image` = '$file',  `status` = '$Status', `updated_at` = now() WHERE `id` = '$ID'");
		return $stmt;
	}
	function getAllPType() 
	{  
		$conn = new dbClass;
		$this->conndb = $conn;
	
		$stmt = $conn->getAllData("SELECT * FROM `product_type` ORDER BY `id` DESC");
		return $stmt;
	}
	function allProductTypes() 
	{  
		$conn = new dbClass;
		$this->conndb = $conn;
	
		$stmt = $conn->getAllData("SELECT * FROM `product_type` WHERE `status` = '1' ORDER BY `id` ASC");
		return $stmt;
	} 
	function getSelectedProductTypes($product_id) {
		$conn = new dbClass;
		$this->product_id = $product_id;
		$this->conndb = $conn;

		$stmt = $conn->getAllData("
			SELECT product_type_id 
			FROM `product_product_type` 
			WHERE product_id = '$product_id'
		");

		return !empty($stmt) ? array_column($stmt, 'product_type_id') : [];
	}
	
	

}





?>