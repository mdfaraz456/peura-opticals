<?php

class Products{
	private $productID;
	private $searchKey;
	private $page;
	private $limit;
	private $total_pages;
	private $conndb;


	public function trendingProducts(){
		$conn = new dbClass;
		$this->conndb = $conn;
		
		$output = $conn->getAllData("SELECT * FROM `products` WHERE `status` = '1' AND `trending` = '1' ORDER BY `product_id` DESC");
		return $output;
	}
	public function newArrivalProducts() {
		$conn = new dbClass;
		$this->conndb = $conn;
		
		// Query to select products marked as new arrivals
		$output = $conn->getAllData("SELECT * FROM `products` WHERE `status` = '1' AND `new_arrivals` = '1' ORDER BY `product_id` DESC");
		return $output;
	}
	

	public function hotestProducts(){
		$conn = new dbClass;
		$this->conndb = $conn;

		$output = $conn->getAllData("SELECT * FROM `products` WHERE `status` = '1' AND `hotest_eyewear` = '1' ORDER BY `product_id` DESC");
		return $output;
	}


	public function occasionProducts(){
		$conn = new dbClass;
		$this->conndb = $conn;
	
		$output = $conn->getAllData(
			"SELECT *, `category`.`name` as cname FROM `category`
			JOIN `product_category` ON `product_category`.`category_id` = `category`.`id`
			LEFT JOIN `products` ON `products`.`product_id` = `product_category`.`product_id`
			WHERE `products`.`status` = '1' 
			AND `product_category`.`category_id` = '9' 
			AND `category`.`status` = '1'
			ORDER BY `products`.`product_id` DESC"
		);
		return $output;
	}
	
	

	public function bestProducts(){
		$conn = new dbClass;
		$this->conndb = $conn;

		$output = $conn->getAllData("SELECT * FROM `products` WHERE `status` = '1' AND `best_sellers` = '1' ORDER BY `product_id` DESC");
		return $output;
	}

	public function newProducts(){
		$conn = new dbClass;
		$this->conndb = $conn;

		$output = $conn->getAllData("SELECT * FROM `products` WHERE `status` = '1' AND `new_arrivals` = '1' ORDER BY `product_id` DESC");
		return $output;
	}

	public function getProdcutsById($productID){
		$conn = new dbClass;
		$this->conndb = $conn;
		$this->productID = $productID;

		$output = $conn->getData("SELECT * FROM `products` WHERE `status` = '1' AND `product_id` = '$productID'");
		return $output;
	}

	public function getProdcutsImages($productID){
		$conn = new dbClass;
		$this->productID = $productID;
		$this->conndb = $conn;

		$output = $conn->getAllData("SELECT * FROM `products_images` WHERE `product_id` = '$productID'");
		return $output;
	}

	public function prodcutsImageCount($productID){
		$conn = new dbClass;
		$this->productID = $productID;
		$this->conndb = $conn;

		$output = $conn->getRowCount("SELECT image_id FROM `products_images` WHERE `product_id` = '$productID'");
		return $output;
	}

	public function getProductTypes($productID) {
		$conn = new dbClass;
		$this->productID = $productID;
		$this->conndb = $conn;
		
		$productID = intval($productID); 
	
		$sql = "
			SELECT DISTINCT
				pt.id AS product_type_id, 
				pt.name AS product_type_name
			FROM products p
			JOIN product_product_type ppt ON ppt.product_id = p.product_id
			JOIN product_type pt ON pt.id = ppt.product_type_id
			WHERE p.product_id = $productID
		";
	
		$output = $conn->getAllData($sql);    
		return $output;
	}
	

	public function getProductCategories($productID) {
		$conn = new dbClass;
		$this->productID = $productID;
		$this->conndb = $conn;
		
		$productID = intval($productID); 
	
		$sql = "
			SELECT DISTINCT
				c.id AS category_id, 
				c.name AS category_name
			FROM products p 
			JOIN product_category pc ON pc.product_id = p.product_id
			JOIN category c ON c.id = pc.category_id
			WHERE p.product_id = $productID
		";
	
		$output = $conn->getAllData($sql);	
		return $output;
	}
	
	public function getProductSubCategories($productID) {
		$conn = new dbClass;
		$this->productID = $productID;
		$this->conndb = $conn;
		
		$productID = intval($productID); 
	
		$sql = "
			SELECT DISTINCT
				sc.id AS subcategory_id, 
				sc.category_id AS category_id, 
				sc.name AS subcategory_name
			FROM products p 
			JOIN product_subcategory psc ON psc.product_id = p.product_id
			JOIN sub_category sc ON sc.id = psc.subcategory_id
			WHERE p.product_id = $productID
		";
	
		$output = $conn->getAllData($sql);	
		return $output;
	}
	
	public function getProductSubSubCategories($productID) {
		$conn = new dbClass;
		$this->productID = $productID;
		$this->conndb = $conn;
		
		$productID = intval($productID); 
	
		$sql = "
			SELECT DISTINCT
				ssc.id AS subsubcategory_id, 
				ssc.category_id AS category_id, 
				ssc.sub_category_id  AS sub_category_id, 
				ssc.name AS subsubcategory_name
			FROM products p 
			JOIN product_subsubcategory pssc ON pssc.product_id = p.product_id
			JOIN sub_sub_category ssc ON ssc.id = pssc.subsubcategory_id 
			WHERE p.product_id = $productID
		";
	
		$output = $conn->getAllData($sql);	
		return $output;
	}

	// public function getProductSearch($searchKey) {
	// 	$conn = new dbClass;
	// 	$this->searchKey = $searchKey;
	// 	$this->conndb = $conn;
	
	// 	// Split the search key into words
	// 	$keywords = explode(' ', $searchKey);
	// 	$searchConditions = [];
	
	// 	foreach ($keywords as $word) {
	// 		// Trim any whitespace and prepare the LIKE condition for each word
	// 		$word = trim($word);
	// 		if (!empty($word)) {
	// 			$searchConditions[] = "(p.name LIKE '%$word%' OR p.description LIKE '%$word%' OR c.name LIKE '%$word%' OR sc.name LIKE '%$word%' OR ssc.name LIKE '%$word%')";
	// 		}
	// 	}
	
	// 	// Join the conditions with AND to ensure all words are present
	// 	$searchQuery = implode(' AND ', $searchConditions);
	
	// 	$sql = "
	// 		SELECT DISTINCT p.* 
	// 		FROM products p
	// 		LEFT JOIN product_category pc ON p.product_id = pc.product_id
	// 		LEFT JOIN category c ON pc.category_id = c.id
	// 		LEFT JOIN product_subcategory psc ON p.product_id = psc.product_id
	// 		LEFT JOIN sub_category sc ON psc.subcategory_id = sc.id
	// 		LEFT JOIN product_subsubcategory pssc ON p.product_id = pssc.product_id
	// 		LEFT JOIN sub_sub_category ssc ON ssc.id = pssc.subsubcategory_id
	// 		WHERE ($searchQuery) AND p.status = 1
	// 	";
	
	// 	$output = $conn->getAllData($sql);
	// 	return $output;
	// }

	public function getTotalPages($searchKey) {
		$conn = new dbClass;
		$this->searchKey = $searchKey;
		$this->conndb = $conn;

        $keywords = explode(' ', $searchKey);
        $searchConditions = [];

        foreach ($keywords as $word) {
            $word = trim($word);
            if (!empty($word)) {
                $searchConditions[] = "(p.name LIKE '%$word%' OR p.description LIKE '%$word%' OR c.name LIKE '%$word%' OR sc.name LIKE '%$word%' OR ssc.name LIKE '%$word%')";
            }
        }

        $searchQuery = implode(' AND ', $searchConditions);

        $total_pages = $conn->getData("
            SELECT COUNT(DISTINCT p.product_id) AS num 
            FROM products p
            LEFT JOIN product_category pc ON p.product_id = pc.product_id
            LEFT JOIN category c ON pc.category_id = c.id
            LEFT JOIN product_subcategory psc ON p.product_id = psc.product_id
            LEFT JOIN sub_category sc ON psc.subcategory_id = sc.id
            LEFT JOIN product_subsubcategory pssc ON p.product_id = pssc.product_id
            LEFT JOIN sub_sub_category ssc ON ssc.id = pssc.subsubcategory_id
            WHERE ($searchQuery) AND p.status = 1
        ");

        return $total_pages['num'];
    }

	public function getProductz($searchKey, $page, $limit) {
		$conn = new dbClass;
		$this->searchKey = $searchKey;
		$this->page = $page;
		$this->limit = $limit;
		$this->conndb = $conn;

        $start = ($page - 1) * $limit;
        $keywords = explode(' ', $searchKey);
        $searchConditions = [];

        foreach ($keywords as $word) {
            $word = trim($word);
            if (!empty($word)) {
                $searchConditions[] = "(p.name LIKE '%$word%' OR p.description LIKE '%$word%' OR c.name LIKE '%$word%' OR sc.name LIKE '%$word%' OR ssc.name LIKE '%$word%')";
            }
        }

        $searchQuery = implode(' AND ', $searchConditions);

        $sql = "
            SELECT DISTINCT p.* 
            FROM products p
            LEFT JOIN product_category pc ON p.product_id = pc.product_id
            LEFT JOIN category c ON pc.category_id = c.id
            LEFT JOIN product_subcategory psc ON p.product_id = psc.product_id
            LEFT JOIN sub_category sc ON psc.subcategory_id = sc.id
            LEFT JOIN product_subsubcategory pssc ON p.product_id = pssc.product_id
            LEFT JOIN sub_sub_category ssc ON ssc.id = pssc.subsubcategory_id
            WHERE ($searchQuery) AND p.status = 1
            ORDER BY p.product_id DESC 
            LIMIT $start, $limit
        ";

        return $conn->getAllData($sql);
    }

	public function getPagination($total_pages, $page, $searchKey, $limit) {
		$conn = new dbClass;
		$this->total_pages = $total_pages;
		$this->searchKey = $searchKey;
		$this->page = $page;
		$this->limit = $limit;
		$this->conndb = $conn;
		
        $targetpage = "search.php?key=" . urlencode($searchKey);
        $lastpage = ceil($total_pages / $limit);
        $pagination = "";

        if ($lastpage > 1) {
            $prev = $page - 1;
            $next = $page + 1;

            if ($page > 1)
                $pagination .= "<a href=\"$targetpage&page=$prev\"> Prev </a>";
            else
                $pagination .= "<a href=\"javascript:void(0)\"> Prev </a>";

            // Pages
            if ($lastpage < 7 + (2 * 2)) {
                for ($counter = 1; $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination .= "<a href=\"\" class=\"active\"> $counter </a>";
                    else
                        $pagination .= "<a href=\"$targetpage&page=$counter\"> $counter </a>";
                }
            } elseif ($lastpage > 5 + (2 * 2)) {
                if ($page < 1 + (2 * 2)) {
                    for ($counter = 1; $counter < 4 + (2 * 2); $counter++) {
                        if ($counter == $page)
                            $pagination .= "<a href=\"\" class=\"active\"> $counter </a>";
                        else
                            $pagination .= "<a href=\"$targetpage&page=$counter\"> $counter </a>";
                    }
                    $pagination .= "<a href=\"$targetpage&page=" . ($lastpage - 1) . "\"> " . ($lastpage - 1) . " </a>";
                    $pagination .= "<a href=\"$targetpage&page=$lastpage\"> $lastpage </a>";
                } elseif ($lastpage - (2 * 2) > $page && $page > (2 * 2)) {
                    $pagination .= "<a href=\"$targetpage&page=1\">1</a>";
                    $pagination .= "<a href=\"$targetpage&page=2\">2</a>";
                    for ($counter = $page - 2; $counter <= $page + 2; $counter++) {
                        if ($counter == $page)
                            $pagination .= "<a href=\"\" class=\"active\"> $counter </a>";
                        else
                            $pagination .= "<a href=\"$targetpage&page=$counter\"> $counter </a>";
                    }
                    $pagination .= "<a href=\"$targetpage&page=" . ($lastpage - 1) . "\"> " . ($lastpage - 1) . " </a>";
                    $pagination .= "<a href=\"$targetpage&page=$lastpage\"> $lastpage</a>";
                } else {
                    $pagination .= "<a href=\"$targetpage&page=1\"> 1 </a>";
                    $pagination .= "<a href=\"$targetpage&page=2\"> 2 </a>";
                    for ($counter = $lastpage - (2 + (2 * 2)); $counter <= $lastpage; $counter++) {
                        if ($counter == $page)
                            $pagination .= "<a href=\"\" class=\"active\"> $counter </a>";
                        else
                            $pagination .= "<a href=\"$targetpage&page=$counter\"> $counter </a>";
                    }
                }
            }

            // Next button
            if ($page < $counter - 1)
                $pagination .= "<a href=\"$targetpage&page=$next\"> Next </a>";
            else
                $pagination .= "<a href=\"javascript:void(0)\"> Next</a>";
        }

        return $pagination;
    }
}


class CounterPage {
	public function getCounters(){
		$conn = new dbClass;

		$output = $conn->getAllData("SELECT * FROM `counter` ORDER BY `id` ASC");
		return $output;
	}
}



class TestimonialPage {
	public function getTestimonial(){
		$conn = new dbClass;

		$output = $conn->getAllData("SELECT * FROM `testimonial` WHERE `status` = 1 ORDER BY `id` DESC");
		return $output;
	}
}


class Subscribe
{
	private $Email;
	private $db;

	public function __construct($db) {
        $this->db = $db;
    }

    // public function addSubscriber($Email) {
	// 	try {
	// 		$query = "INSERT INTO subscribers (email) VALUES (:email)";
	// 		$params = array(':email' => $Email);
	// 		return $this->db->executeStatement($query, $params);
	// 	} catch (PDOException $e) {
	// 		echo "Error: " . $e->getMessage();
	// 		return false; 
	// 	}
	// }

	
	public function addSubscriber($Email, $dVnCp) {
		try {
			$query = "INSERT INTO subscribers (email) VALUES (:email)";
			$params = array(':email' => $Email);            
			$this->db->executeStatement($query, $params);
			$subscriberId = $this->db->lastInsertId();
			$this->addCokies($subscriberId, $dVnCp); 
			return true; 
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
			return false; 
		}
	}
	
	public function addCokies($ID, $Cookies) {
		try {
			$query = "INSERT INTO subscribers_cookies (subscribers_id, cookies) VALUES (:id, :user_cookies)";
			$params = array(':id' => $ID, ':user_cookies' => $Cookies);            
			return $this->db->executeStatement($query, $params); 
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
			return false; 
		}
	}
	
	function getCheckEmail($Email)
	{
		$conn = new dbClass;
		$this->conndb = $conn;	  
		$query = "SELECT * FROM `subscribers` WHERE `email` = '$Email'";
		$result = $conn->getData($query);
		return $result; 
	}


	  function getCoockies($cookieValue)
	  {

		  $conn = new dbClass;
		  $this->conndb = $conn;
		  $query = "SELECT * FROM `subscribers_cookies` WHERE `cookies` = '$cookieValue'";
		  $result = $conn->getAllData($query);
		  return count($result); 
	  }
	  
	  
	

}

// class BannerPage{
// 	private $Type;
// 	private $conndb;
// 	function getBanners($Type)
// 	{
// 		$conn = new dbClass;
// 		$this->Type = $Type;
// 		$this->conndb = $conn;

// 		$stmt = $conn->getAllData("SELECT * FROM `banner` WHERE `type` = '$Type' AND `status` = 1 ORDER BY `id` DESC");
// 		return $stmt;
// 	}
// }
class BannerPage{
	private $Type;
	private $conndb;
	function getBanners()
	{
		$conn = new dbClass;
	   
		$this->conndb = $conn;

		$stmt = $conn->getAllData("SELECT * FROM `banner` WHERE `status` = 1 ORDER BY `id` DESC");
		return $stmt;
	}
}

class WorkshopPage {
	private $ID;
	private $conndb;

	public function getWorkshop(){
		$conn = new dbClass;
		$today = date('Y-m-d');

		$output = $conn->getAllData("SELECT * FROM `workshop` WHERE `status` = 1 AND `date` >= '$today' ORDER BY `id` DESC");
		return $output;
	}

	public function getPreviousWorkshops(){
		$conn = new dbClass;
		$today = date('Y-m-d');
	
		$output = $conn->getAllData("SELECT * FROM `workshop` WHERE `status` = 1 AND `date` < '$today' ORDER BY `date` DESC");
		return $output;
	}

	function getAllWorkshopById($ID){
	    $conn = new dbClass;
	    $this->ID = $ID;

	    $stmt = $conn->getData("SELECT * FROM `workshop` WHERE `id` = '$ID'");
	    return $stmt;
	}

	function getWorkshopImages($ID){
		$conn = new dbClass;
		$this->ID = $ID;
		$this->conndb = $conn;

		$output = $conn->getAllData("SELECT * FROM `workshop_images` WHERE `workshop_id` = '$ID'");
		return $output;
	}

	function workshopImageCount($ID){
		$conn = new dbClass;
		$this->ID = $ID;
		$this->conndb = $conn;

		$output = $conn->getRowCount("SELECT `id` FROM `workshop_images` WHERE `workshop_id` = '$ID'");
		return $output;
	}

	function getWorkshopVideos($ID){
		$conn = new dbClass;
		$this->ID = $ID;
		$this->conndb = $conn;

		$output = $conn->getAllData("SELECT * FROM `workshop_videos` WHERE `workshop_id` = '$ID'");
		return $output;
	}

	function workshopVideoCount($ID){
		$conn = new dbClass;
		$this->ID = $ID;
		$this->conndb = $conn;

		$output = $conn->getRowCount("SELECT `id` FROM `workshop_videos` WHERE `workshop_id` = '$ID'");
		return $output;
	}
}

class SpecialPage {
	private $ID;
	public function getSpecial($ID){
		$conn = new dbClass;
		$this->ID = $ID;

		$output = $conn->getData("SELECT * FROM `special_panel` WHERE `id` = '$ID'");
		return $output;
	}
}

class BookAppointment
{
	private $ID;
	private $Name;
	private $Phone;
	private $Email;
	private $Date;
	private $Service;
	private $Price;	
	private $Message;
	private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addBookAppointment($Name, $Phone, $Email, $Date, $Service, $Price, $Message) {
		try {
			$query = "INSERT INTO book_appointment (name, phone, email, date, service, price, message) VALUES (:name, :phone, :email, :date, :service, :price, :message)";
			$params = array(
				':name' => $Name,
				':phone' => $Phone,
				':email' => $Email,
				':date' => $Date,
				':service' => $Service,
				':price' => $Price,				
				':message' => $Message
			);
			return $this->db->executeStatement($query, $params);
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
			return false; 
		}
	}
}


class Contact
{
	private $ID;
	private $Name;
	private $Phone;
	private $Email;
	private $Message;
	private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addContact($Name, $Phone, $Email, $Message) {
		try {
			$query = "INSERT INTO contact (name, phone, email, message) VALUES (:name, :phone, :email, :message)";
			$params = array(
				':name' => $Name,
				':phone' => $Phone,
				':email' => $Email,							
				':message' => $Message
			);
			return $this->db->executeStatement($query, $params);
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
			return false; 
		}
	}
}

class PopupPage {
	public function getPopup(){
		$conn = new dbClass;

		$output = $conn->getAllData("SELECT * FROM `popup` ORDER BY `id` ASC");
		return $output;
	}
}

class OrderPage {
	private $orderID;
	private $productID;
	private $ShippingID;
	private $conndb;

	public function getOrderById($orderID){
		$conn = new dbClass;
		$this->conndb = $conn;
		$this->orderID = $orderID;
	
		$output = $conn->getData("SELECT * FROM `orders_table` WHERE `order_id` = '$orderID'");
		return $output;
	}

	public function getProductByOrderId($productID){
		$conn = new dbClass;
		$this->conndb = $conn;
		$this->productID = $productID;
	
		$output = $conn->getData("SELECT * FROM `products` WHERE `product_id` = '$productID'");
		return $output;
	}

	public function getShippingByOrderId($ShippingID){
		$conn = new dbClass;
		$this->conndb = $conn;
		$this->ShippingID = $ShippingID;
	
		$output = $conn->getData("SELECT * FROM `shipping_address` WHERE `order_number` = '$ShippingID'");
		return $output;
	}
}

class ProductType{
           
	public function getProductType(){
		$conn =new dbClass();
		$stmt =$conn->getAllData("Select * From product_type where `status` = 1 ORDER BY `id` DESC");
		return $stmt;
	}
	public function getProductTypeByPro($id){
		$conn = new dbClass();
		$stmt =$conn->getRowCount(
			"SELECT p.*, pt.product_type_id
			FROM products p
			JOIN product_product_type pt ON p.product_id = pt.product_id 
			WHERE p.status = 1 AND pt.product_type_id = '" . $id . "'"
			);
		return $stmt;
	}
	public function getProductTypeById($id){
		$conn =new dbClass();
		$stmt =$conn->getData("Select * From product_type where `id`=$id");
		return $stmt;
	}
	
}
class Advertisement1{
           
	public function getAdvertisement(){
		$conn =new dbClass();
		$stmt =$conn->getAllData("Select * From advertisement where `status` = 1 ORDER BY `id` ");
		return $stmt;
	}

	public function getAdvertisement1(){
		$conn =new dbClass();
		$stmt =$conn->getAllData("Select * From advertisement1 where `status` = 1 ORDER BY `id` DESC");
		return $stmt;
	}
	
}
class ProductSubType{
	   
	public function getProductSubType(){
		$conn =new dbClass();
		$stmt =$conn->getAllData("Select * From sub_type where `status` = 1 ORDER BY `id` DESC");
		return $stmt;
	}
	
}



?>