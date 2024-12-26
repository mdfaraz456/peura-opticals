<?php
if (!isset($_SESSION)) {
  session_start();
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../config/config.php';
require '../config/functions.php';
require '../config/products.php';
include '../config/image-resize.php';
include '../config/image-resize2.php';
include 'fckeditor/fckeditor_php5.php';


$db = new dbClass();
$categories = new Product_Type();
$products = new Products();

$id = isset($_REQUEST['id']) ? base64_decode($_REQUEST['id']) : '';
$editval = $products->getProducts($id);

$imageVal = $products->getProdcutsImages($id);
$imageCount = $products->prodcutsImageCount($id);

// insert record query
if (isset($_REQUEST['submit'])) {

  $name = $db->addStr($_POST['name'] ?? '');
  $price = $db->addStr($_POST['price'] ?? '0');
  $discount = (int) $db->addStr($_POST['discount'] ?? '0');
  $stock = $db->addStr($_POST['stock'] ?? '0');
  $sku = $db->addStr($_POST['sku'] ?? '');
  $shortdesc = $db->addStr($_POST['shortdesc'] ?? '');
  $description = $db->addStr($_POST['description'] ?? '');
  $care_instruction = $db->addStr($_POST['care_instruction'] ?? '');
  $instruction = $db->addStr($_POST['instruction'] ?? '');  
  $rare_collections = $db->addStr($_POST['rare_collections'] ?? '0');
  $spiritual_home_decors = $db->addStr($_POST['spiritual_home_decors'] ?? '0');
	$best_sellers = $db->addStr($_POST['best_sellers'] ?? '0');
	$new_arrivals = $db->addStr($_POST['new_arrivals'] ?? '0');
  $status = $db->addStr($_POST['status'] ?? '1');

  if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image = $_FILES['image']['name']; // Original file name
    $dest = "../adminuploads/products/";
    $files = resize(1600, 1375, $dest, $_FILES['image']['tmp_name'], $image);
  } else {
    $files = '0';
  }

  $slug = $products->slug($name, 'products');

  $result = $products->addProducts($files, $name, $slug, $price, $discount, $stock, $sku, $shortdesc, $description, $care_instruction, $instruction, $rare_collections, $spiritual_home_decors, $best_sellers, $new_arrivals, $status); 

  
  
  if (!empty($result)) {

    if (!empty($_POST['category_id'])) {
      foreach ($_POST['category_id'] as $categoryId) {
        $db->execute("INSERT INTO `product_category` (`product_id`, `category_id`) VALUES ('$result', '$categoryId')");
      }
    }

    if (!empty($_POST['subcategory_id'])) {
      foreach ($_POST['subcategory_id'] as $subCategoryId) {
        $db->execute("INSERT INTO `product_subcategory` (`product_id`, `subcategory_id`) VALUES ('$result', '$subCategoryId')");
      }
    }

    if (!empty($_POST['subsubcategory_id'])) {
      foreach ($_POST['subsubcategory_id'] as $subSubCategoryId) {
        $db->execute("INSERT INTO `product_subsubcategory` (`product_id`, `subsubcategory_id`) VALUES ('$result', '$subSubCategoryId')");
      }
    }


    if (!empty($_FILES['images']['name'][0])) {
      foreach ($_FILES['images']['name'] as $key => $imageName) {
        if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
          $tempName = $_FILES['images']['tmp_name'][$key];
          $dest = "../adminuploads/products/";
          $resizedImage = resize(1600, 1375, $dest, $tempName, $imageName);

          $db->execute("INSERT INTO `products_images` (`product_id`, `image`) VALUES ('$result', '$resizedImage')");
        }
      }
    }

    $_SESSION['msg'] = 'Product has been saved successfully.';
    header("Location: view-products.php");
    exit;
  } else {
    $_SESSION['errmsg'] = 'Sorry, an error occurred.';
    header("Location: add-products.php");
    exit;
  }
}

// update record query
if (isset($_REQUEST['update'])) {
  $id = $_POST['id'];
  $name = $db->addStr($_POST['name'] ?? '');
  $price = $db->addStr($_POST['price'] ?? '0');
  $discount = (int) $db->addStr($_POST['discount'] ?? '0');
  $stock = $db->addStr($_POST['stock'] ?? '0');
  $sku = $db->addStr($_POST['sku'] ?? '');
  $shortdesc = $db->addStr($_POST['shortdesc'] ?? '');
  $description = $db->addStr($_POST['description'] ?? '');
  $care_instruction = $db->addStr($_POST['care_instruction'] ?? '');
  $instruction = $db->addStr($_POST['instruction'] ?? '');  
  $rare_collections = $db->addStr($_POST['rare_collections'] ?? '0');
  $spiritual_home_decors = $db->addStr($_POST['spiritual_home_decors'] ?? '0');
	$best_sellers = $db->addStr($_POST['best_sellers'] ?? '0');
	$new_arrivals = $db->addStr($_POST['new_arrivals'] ?? '0');
  $status = $db->addStr($_POST['status'] ?? '1');
  $oldimage = $_POST['oldimage'];
  $dest = "../adminuploads/products/";

  if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $files = resize(1600, 1375, $dest, $tmp_name, $image);

    if ($files) {
      if (file_exists($dest . $oldimage)) {
          unlink($dest . $oldimage);
      }
    } else {
        $_SESSION['errmsg'] = 'Error uploading file.';

        header("Location: view-products.php");
        exit;
    }
  } else {
    $files = $oldimage;
  }

  $slug = $products->updateSlug($name, 'products', $id);

  $result = $products->updateProducts($files, $name, $slug, $price, $discount, $stock, $sku, $shortdesc, $description, $care_instruction, $instruction, $rare_collections, $spiritual_home_decors, $best_sellers, $new_arrivals, $status, $id); 
  
  if ($result) {

    if (!empty($_POST['update_category_id']) || !empty($_POST['update_subcategory_id']) || !empty($_POST['update_subsubcategory_id'])) {
      $queries = [
        "DELETE FROM product_category WHERE product_id = :product_id",
        "DELETE FROM product_subcategory WHERE product_id = :product_id",
        "DELETE FROM product_subsubcategory WHERE product_id = :product_id",
      ];
      
      $params = [':product_id' => $id];
      foreach ($queries as $query) {
        try {
          $db->executeStatement($query, $params);
        } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
          exit();
        }
      }
    }


    if (!empty($_POST['update_category_id'])) {
      foreach ($_POST['update_category_id'] as $updateCategoryId) {
        $checkQuery = "SELECT COUNT(*) AS count FROM `product_category` WHERE `product_id` = $id AND `category_id` = $updateCategoryId";
        $exists = $db->getAllData($checkQuery);

        if ($exists && $exists[0]['count'] == 0) {
          $insertQuery = "INSERT INTO `product_category` (`product_id`, `category_id`) VALUES ($id, $updateCategoryId)";
          $db->execute($insertQuery);
        }
      }
    }

    if (!empty($_POST['update_subcategory_id'])) {
      foreach ($_POST['update_subcategory_id'] as $updateSubCategoryId) {
        $checkSubCategoryQuery = "SELECT COUNT(*) AS count FROM `product_subcategory` WHERE `product_id` = $id AND `subcategory_id` = $updateSubCategoryId";
        $subCategoryExists = $db->getAllData($checkSubCategoryQuery);

        if ($subCategoryExists && $subCategoryExists[0]['count'] == 0) {
          $insertSubCategoryQuery = "INSERT INTO `product_subcategory` (`product_id`, `subcategory_id`) VALUES ($id, $updateSubCategoryId)";
          $db->execute($insertSubCategoryQuery);
        }
      }
    }


    if (!empty($_POST['update_subsubcategory_id'])) {
      foreach ($_POST['update_subsubcategory_id'] as $updateSubSubCategoryId) {
        $checkSubSubCategoryQuery = "SELECT COUNT(*) AS count FROM `product_subsubcategory` WHERE `product_id` = $id AND `subsubcategory_id` = $updateSubSubCategoryId";
        $subSubCategoryExists = $db->getAllData($checkSubSubCategoryQuery);

        if ($subSubCategoryExists && $subSubCategoryExists[0]['count'] == 0) {
          $insertSubSubCategoryQuery = "INSERT INTO `product_subsubcategory` (`product_id`, `subsubcategory_id`) VALUES ($id, $updateSubSubCategoryId)";
          $db->execute($insertSubSubCategoryQuery);
        }
      }
    }


    if (!empty($_FILES['images']['name'][0])) {
      foreach ($_FILES['images']['name'] as $key => $imageName) {
        if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
          $tempName = $_FILES['images']['tmp_name'][$key];
          $dest = "../adminuploads/products/";
          $currentTime = time();
          $filename = $currentTime . "-" . basename($imageName);
          $destinationPath = $dest . $filename;

          $resizedImage = resize2(1600, 1375, $tempName, $destinationPath);
          
          if ($resizedImage) {
            $db->execute("INSERT INTO `products_images` (`product_id`, `image`) VALUES ('$id', '$filename')");
          }
        }
      }
    }

    $_SESSION['msg'] = 'Product has been updated successfully';
    header("Location: view-products.php");
    exit;
  } else {
    $_SESSION['errmsg'] = 'Sorry, an error occurred.';
    header("Location: view-products.php");
    exit;
  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php echo $websiteTitle; ?> | Add Products
  </title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.png">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style>
    #category_container, #update_category_container,
    #subcategory_container, #update_subcategory_container,
    #subsubcategory_container, #update_subsubcategory_container {
      display: flex;
      flex-wrap: wrap;
    }
    #category_container .checkbox, #update_category_container .checkbox,
    #subcategory_container .checkbox, #update_subcategory_container .checkbox,
    #subsubcategory_container .checkbox, #update_subsubcategory_container .checkbox {
      margin-right: 30px;
    }

    .subtitle{
      width: 100%; 
      margin-top: 20px; 
      font-weight: 600
    }
  </style>
</head>

<body class="hold-transition skin-blue sidebar-mini fixed">
  <div class="wrapper">

    <header class="main-header">
      <?php include 'include/header.php'; ?>
    </header>

    <aside class="main-sidebar">
      <?php include 'include/menu.php'; ?>
    </aside>

    <div class="content-wrapper">
      <section class="content-header">
        <h1> Products </h1>
        <ol class="breadcrumb">
          <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Add Products</li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box box-warning">
              <div class="box-header with-border">
                <?php if (empty($id)): ?>
                  <h3 class="box-title">Add Products</h3>
                <?php else: ?>
                  <h3 class="box-title">Update Products</h3>
                <?php endif; ?>
              </div>
              <div class="box-body">
                <?php if (isset($msg)) { ?>
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i>
                      <?php echo $msg; ?>
                    </h4>
                  </div>
                <?php }
                if (isset($errmsg)) { ?>
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i>
                      <?php echo $errmsg; ?>
                    </h4>
                  </div>
                <?php } ?>

                <?php if (empty($id)): ?>
                  <form method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Category</label>
                      <div class="col-sm-6" id="category_container">
                        <?php
                        $sqlCatQuery = $categories->allPType();
                        foreach ($sqlCatQuery as $sqlcatRow):
                        ?>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="category_id[]" value="<?php echo $sqlcatRow['id']; ?>">
                              <?php echo $sqlcatRow['name']; ?>
                            </label>
                          </div>
                        <?php endforeach; ?>
                      </div>
                    </div>

                    <div class="form-group" id="subcategory_group" style="display: none;">
                      <label for="inputName" class="col-sm-2 control-label">Subcategory</label>
                      <div class="col-sm-6"  id="subcategory_container">
                        <!-- Subcategory checkboxes will be populated here -->
                      </div>
                    </div>

                    <div class="form-group" id="subsubcategory_group" style="display: none;">
                      <label for="inputName" class="col-sm-2 control-label">Sub-Subcategory</label>
                      <div class="col-sm-6" id="subsubcategory_container">
                        <!-- Sub-Subcategory checkboxes will be populated here -->
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Name</label>
                      <div class="col-sm-6">
                        <input type="text" name="name" class="form-control" placeholder="Name" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Price</label>
                      <div class="col-sm-6">
                        <input type="number" name="price" class="form-control" placeholder="Price" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Discount</label>
                      <div class="col-sm-6">
                        <input type="number" name="discount" class="form-control" placeholder="Discount">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Stock</label>
                      <div class="col-sm-6">
                        <input type="text" name="stock" class="form-control" placeholder="Stock" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">SKU</label>
                      <div class="col-sm-6">
                        <input type="text" name="sku" class="form-control" placeholder="SKU">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputExperience" class="col-sm-2 control-label">Short Description</label>
                      <div class="col-sm-6">
                        <textarea name="shortdesc" class="form-control" rows="3" placeholder="Short Description"></textarea>
                      </div>
                    </div>        

                    <div class="form-group">
                      <label for="inputExperience" class="col-sm-2 control-label">Description</label>
                      <div class="col-sm-6">
                        <?php
                          $description = isset($_POST['description']) ? $_POST['description'] : '';
                          $sBasePath = 'fckeditor/';
                          $oFCKeditor = new FCKeditor('description');
                          $oFCKeditor->BasePath = $sBasePath;
                          $oFCKeditor->Value = $description;
                          $oFCKeditor->Width = '100%';
                          $oFCKeditor->Height = '400';
                          $oFCKeditor->Create();
                        ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputExperience" class="col-sm-2 control-label">Care Instruction</label>
                      <div class="col-sm-6">
                        <?php
                          $care_instruction = isset($_POST['care_instruction']) ? $_POST['care_instruction'] : '';
                          $sBasePath = 'fckeditor/';
                          $oFCKeditor = new FCKeditor('care_instruction');
                          $oFCKeditor->BasePath = $sBasePath;
                          $oFCKeditor->Value = $care_instruction;
                          $oFCKeditor->Width = '100%';
                          $oFCKeditor->Height = '400';
                          $oFCKeditor->Create();
                        ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputExperience" class="col-sm-2 control-label">Instruction</label>
                      <div class="col-sm-6">
                        <?php
                          $instruction = isset($_POST['instruction']) ? $_POST['instruction'] : '';
                          $sBasePath = 'fckeditor/';
                          $oFCKeditor = new FCKeditor('instruction');
                          $oFCKeditor->BasePath = $sBasePath;
                          $oFCKeditor->Value = $instruction;
                          $oFCKeditor->Width = '100%';
                          $oFCKeditor->Height = '400';
                          $oFCKeditor->Create();
                        ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-2"></div>
                      <div class="col-sm-6">
                        <div class="checkbox">
                          <label><input type="checkbox" name="rare_collections" value="1">Rare Collections</label>
                        </div>
                        <div class="checkbox">
                          <label><input type="checkbox" name="spiritual_home_decors" value="1">Spiritual Home Decors</label>
                        </div>
                        <div class="checkbox">
                          <label><input type="checkbox" name="best_sellers" value="1">Best Sellers</label>
                        </div>
                        <div class="checkbox">
                          <label><input type="checkbox" name="new_arrivals" value="1">New Arrivals</label>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputImage" class="col-sm-2 control-label">Image</label>
                      <div class="col-sm-6">
                        <input type="file" name="image" id="image" onChange="PreviewImage();" class="form-control" required>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="inputImage" class="col-sm-2 control-label"></label>
                      <div class="col-sm-6">
                        <img id="uploadPreview" style="width: 233px; height: 132px; border:1px solid #83888C; background-color: #ffffff;">
                      </div>
                    </div>

                    <div class="field_wrapper">
                      <div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-2 control-label">Add More Images</label>
                          <div class="col-sm-5">
                            <input type="file" name="images[]" class="form-control">
                          </div>
                          <div class="col-sm-1">
                            <a href="javascript:void(0);" class="btn btn-success add_button" title="Add field">Add More</a>
                          </div>
                        </div>
                      </div>
                    </div> 
                   
                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-6">
                        <select name="status" class="form-control" required>
                          <option value="0">Select Status</option>
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" name="submit" value="Submit" class="btn btn-success">
                      </div>
                    </div>

                  </form>

                <?php else: ?>
                  
                  <form method="post" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Category</label>
                      <div class="col-sm-6" id="update_category_container">
                        <?php
                        $sqlCatQuery = $categories->allPType();
                        $selectedCategories = $categories->getSelectedCategories($id);
                        foreach ($sqlCatQuery as $sqlcatRow):
                          $isChecked = in_array($sqlcatRow['id'], $selectedCategories) ? 'checked' : '';
                        ?>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="update_category_id[]" value="<?php echo $sqlcatRow['id']; ?>" <?php echo $isChecked; ?>>
                              <?php echo $sqlcatRow['name']; ?>
                            </label>
                          </div>
                        <?php endforeach; ?>
                      </div>
                    </div>

                    <div class="form-group" id="update_subcategory_group" style="display: none;">
                      <label for="inputName" class="col-sm-2 control-label">Subcategory</label>
                      <div class="col-sm-6"  id="update_subcategory_container">
                        <!-- Subcategory checkboxes will be populated here -->
                      </div>
                    </div>

                    <div class="form-group" id="update_subsubcategory_group" style="display: none;">
                      <label for="inputName" class="col-sm-2 control-label">Sub-Subcategory</label>
                      <div class="col-sm-6" id="update_subsubcategory_container">
                        <!-- Sub-Subcategory checkboxes will be populated here -->
                      </div>
                    </div>                     

                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Name</label>
                      <div class="col-sm-6">
                        <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $editval['name']; ?>" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Price</label>
                      <div class="col-sm-6">
                        <input type="number" name="price" class="form-control" placeholder="Price" value="<?php echo $editval['price']; ?>" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Discount</label>
                      <div class="col-sm-6">
                        <input type="number" name="discount" class="form-control" placeholder="Discount" value="<?php echo $editval['discount']; ?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Stock</label>
                      <div class="col-sm-6">
                        <input type="text" name="stock" class="form-control" placeholder="Stock" value="<?php echo $editval['stock']; ?>" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">SKU</label>
                      <div class="col-sm-6">
                        <input type="text" name="sku" class="form-control" placeholder="SKU" value="<?php echo $editval['sku']; ?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputExperience" class="col-sm-2 control-label">Short Description</label>
                      <div class="col-sm-6">
                        <textarea name="shortdesc" class="form-control" rows="3" placeholder="Short Description">
                          <?php echo $editval['short_description']; ?>
                        </textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputExperience" class="col-sm-2 control-label">Description</label>
                      <div class="col-sm-6">
                        <?php
                          $shortid = $editval['description'];
                          $sBasePath = 'fckeditor/';
                          $oFCKeditor = new FCKeditor('description');
                          $oFCKeditor->BasePath = $sBasePath;
                          $oFCKeditor->Value = $shortid;
                          $oFCKeditor->Width = '100%';
                          $oFCKeditor->Height = '400';
                          $oFCKeditor->Create();
                        ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputExperience" class="col-sm-2 control-label">Care Instruction</label>
                      <div class="col-sm-6">
                        <?php
                          $shortid = $editval['care_instruction'];
                          $sBasePath = 'fckeditor/';
                          $oFCKeditor = new FCKeditor('care_instruction');
                          $oFCKeditor->BasePath = $sBasePath;
                          $oFCKeditor->Value = $shortid;
                          $oFCKeditor->Width = '100%';
                          $oFCKeditor->Height = '400';
                          $oFCKeditor->Create();
                        ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputExperience" class="col-sm-2 control-label">Instruction</label>
                      <div class="col-sm-6">
                        <?php
                          $shortid = $editval['instruction'];
                          $sBasePath = 'fckeditor/';
                          $oFCKeditor = new FCKeditor('instruction');
                          $oFCKeditor->BasePath = $sBasePath;
                          $oFCKeditor->Value = $shortid;
                          $oFCKeditor->Width = '100%';
                          $oFCKeditor->Height = '400';
                          $oFCKeditor->Create();
                        ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-2"></div>
                      <div class="col-sm-6">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" <?php if($editval['rare_collections']==1): ?> checked <?php endif; ?> name="rare_collections" value="1">Rare Collections
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" <?php if($editval['spiritual_home_decors']==1): ?> checked <?php endif; ?> name="spiritual_home_decors" value="1">Spiritual Home Decors
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" <?php if($editval['best_sellers']==1): ?> checked <?php endif; ?> name="best_sellers" value="1">Best Sellers
                          </label>
                        </div>
                        <div class="checkbox">
                          <label><input type="checkbox" <?php if($editval['new_arrivals']==1): ?> checked <?php endif; ?> name="new_arrivals" value="1">New Arrivals</label>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputImage" class="col-sm-2 control-label">Image</label>
                      <div class="col-sm-6">
                        <input type="file" name="image" id="image" onChange="PreviewImage();" class="form-control">
                        <input type="hidden" name="oldimage" value="<?php echo $editval['image']; ?>" class="form-control">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="inputImage" class="col-sm-2 control-label"></label>
                      <div class="col-sm-6">
                        <img src="../adminuploads/products/<?php echo $editval['image']; ?>" 
                          id="uploadPreview" style="width: 233px; height: 132px; border:1px solid #83888C; background-color: #ffffff;">
                      </div>
                    </div>

                    <div class="field_wrapper">
                      <div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-2 control-label">Add More Images</label>
                          <div class="col-sm-5">
                            <input type="file" name="images[]" class="form-control">
                          </div>
                          <div class="col-sm-1">
                            <a href="javascript:void(0);" class="btn btn-success add_button" title="Add field">Add More</a>
                          </div>
                        </div>
                      </div>
                    </div> 
                   
                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-6">
                        <select name="status" class="form-control" required>
                          <option value="">Select Status</option>
                          <option value="1" <?php if ($editval['status'] == 1): ?> selected="selected" <?php endif; ?>>Active</option>
                          <option value="0" <?php if ($editval['status'] == 0): ?> selected="selected" <?php endif; ?>>Inactive</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" name="update" id="update" value="Update" class="btn btn-danger">
                      </div>
                    </div>

                  </form>

                  <?php if ($imageCount > 0): ?>
                    <div class="table-responsive">
                      <div class="box-header">
                        <h3 class="box-title">View Product Images</h3>
                      </div>
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>S.No</th>
                            <th>Image</th>
                            <th>Created Date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i = 1;
                          foreach ($imageVal as $imageRow):
                            ?>
                            <tr id="<?php echo $imageRow['image_id']; ?>">
                              <td>
                                <?php echo $i++; ?>
                              </td>
                              <td>
                                <a href="../adminuploads/products/<?php echo $imageRow['image']; ?>"target="_blank">
                                  <img src="../adminuploads/products/<?php echo $imageRow['image']; ?>" width="200" height="100">
                                </a>
                              </td>
                              <td>
                                <?php echo date('d-m-Y', strtotime($imageRow['created_at'])); ?>
                              </td>
                              <td><a class="removeimage"><i class="fa fa-trash-o"></i></a></td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  <?php endif; ?>

                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <?php include 'include/footer.php'; ?>

    <div class="control-sidebar-bg"></div>
  </div>
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- Morris.js charts -->
  <script src="bower_components/raphael/raphael.min.js"></script>
  <script src="bower_components/morris.js/morris.min.js"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- FastClick -->
  <script src="bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>

  <!-- Image Prieview -->
  <script>
    function PreviewImage() {
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("image").files[0]);
      oFReader.onload = function (oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
      };
    };  
  </script>

  <script>
    $(document).ready(function () {
      var selectedSubcategories = [];
      var selectedSubSubcategories = [];

      // When a category is selected
      $('#category_container').on('change', 'input[name="category_id[]"]', function () {
          var category_ids = $('input[name="category_id[]"]:checked').map(function () {
              return this.value;
          }).get();

          if (category_ids.length > 0) {
              $.ajax({
                  type: 'POST',
                  url: 'get-values.php',
                  data: { category_id: category_ids.join(',') },
                  success: function (html) {
                      if (html.trim() !== '') {
                          $('#subcategory_group').show(); // Show subcategory label and container
                          $('#subcategory_container').php(html);
                          recheckSubcategories();
                          recheckSubSubcategories();
                      } else {
                          $('#subcategory_group').hide();
                          $('#subcategory_container').php('');
                          $('#subsubcategory_group').hide();
                      }
                  }
              });
          } else {
              $('#subcategory_group').hide();
              $('#subcategory_container').php('<div class="checkbox"><label>Select Category first</label></div>');
              $('#subsubcategory_group').hide();
          }
      });

      // When a subcategory is selected
      $('#subcategory_container').on('change', 'input[name="subcategory_id[]"]', function () {
          var subcategory_ids = $('input[name="subcategory_id[]"]:checked').map(function () {
              return this.value;
          }).get();

          selectedSubcategories = subcategory_ids; // Store selected subcategories

          if (subcategory_ids.length > 0) {
              $.ajax({
                  type: 'POST',
                  url: 'get-values.php',
                  data: { subcategory_id: subcategory_ids.join(',') },
                  success: function (html) {
                      if (html.trim() !== '') {
                          $('#subsubcategory_group').show(); // Show sub-subcategory label and container
                          $('#subsubcategory_container').php(html);
                          recheckSubSubcategories(); // Recheck previously selected sub-subcategories
                      } else {
                          $('#subsubcategory_group').hide(); // Hide title if no data
                          $('#subsubcategory_container').php('');
                      }
                  }
              });
          } else {
              $('#subsubcategory_group').hide(); // Hide title when no subcategory is selected
              $('#subsubcategory_container').php('<div class="checkbox"><label>Select Subcategory first</label></div>');
          }
      });

      // When a sub-subcategory is selected
      $('#subsubcategory_container').on('change', 'input[name="subsubcategory_id[]"]', function () {
          var subsubcategory_ids = $('input[name="subsubcategory_id[]"]:checked').map(function () {
              return this.value;
          }).get();

          selectedSubSubcategories = subsubcategory_ids; // Store selected sub-subcategories
      });

      // Function to recheck previously selected subcategories
      function recheckSubcategories() {
          selectedSubcategories.forEach(function (id) {
              $('input[name="subcategory_id[]"][value="' + id + '"]').prop('checked', true);
          });
      }

      // Function to recheck previously selected sub-subcategories
      function recheckSubSubcategories() {
          selectedSubSubcategories.forEach(function (id) {
              $('input[name="subsubcategory_id[]"][value="' + id + '"]').prop('checked', true);
          });

          // Ensure the sub-subcategory section stays visible if any sub-subcategories are selected
          if (selectedSubSubcategories.length > 0) {
              $('#subsubcategory_group').show();
          }
      }
    });
  </script>

  <script>
    $(document).ready(function () {
        var selectedSubcategories = [];
        var selectedSubSubcategories = [];
        var productId = '<?php echo $id; ?>'; // Ensure this is outputting the correct product ID

        // Function to load initial selections
        function loadInitialSelections() {
            var selectedCategoryIds = $('input[name="update_category_id[]"]:checked').map(function () {
                return this.value;
            }).get();

            if (selectedCategoryIds.length > 0) {
                $.ajax({
                    type: 'POST',
                    url: 'get-values.php',
                    data: { update_category_id: selectedCategoryIds.join(','), product_id: productId },
                    success: function (html) {
                        $('#update_subcategory_group').show();
                        $('#update_subcategory_container').php(html);
                        
                        // Debugging: Check the initial subcategory state
                        console.log('Initial subcategories:', $('input[name="update_subcategory_id[]"]:checked').map(function () {
                            return this.value;
                        }).get());

                        recheckSubcategories(); // Ensure subcategories retain their checked state

                        // Check for selected subcategories to fetch sub-subcategories
                        var selectedSubcategoryIds = $('input[name="update_subcategory_id[]"]:checked').map(function () {
                            return this.value;
                        }).get();

                        if (selectedSubcategoryIds.length > 0) {
                            $.ajax({
                                type: 'POST',
                                url: 'get-values.php',
                                data: { update_subcategory_id: selectedSubcategoryIds.join(','), product_id: productId },
                                success: function (html) {
                                    if (html.trim() !== '') {
                                        $('#update_subsubcategory_group').show();
                                        $('#update_subsubcategory_container').php(html);
                                        
                                        // Debugging: Check the initial sub-subcategory state
                                        console.log('Initial sub-subcategories:', $('input[name="update_subsubcategory_id[]"]:checked').map(function () {
                                            return this.value;
                                        }).get());

                                        recheckSubSubcategories(); // Ensure sub-subcategories retain their checked state
                                    } else {
                                        $('#update_subsubcategory_group').hide();
                                        $('#update_subsubcategory_container').php('');
                                    }
                                }
                            });
                        } else {
                            $('#update_subsubcategory_group').hide();
                            $('#update_subsubcategory_container').php('');
                        }
                    }
                });
            } else {
                $('#update_subcategory_group').hide();
                $('#update_subcategory_container').php('<div class="checkbox"><label>Select Category first</label></div>');
                $('#update_subsubcategory_group').hide();
                $('#update_subsubcategory_container').php('');
            }
        }

        // Load initial selections on page load
        loadInitialSelections();

        // When a category is selected
        $('#update_category_container').on('change', 'input[name="update_category_id[]"]', function () {
            var category_ids = $('input[name="update_category_id[]"]:checked').map(function () {
                return this.value;
            }).get();

            if (category_ids.length > 0) {
                $.ajax({
                    type: 'POST',
                    url: 'get-values.php',
                    data: { update_category_id: category_ids.join(','), product_id: productId },
                    success: function (html) {
                        if (html.trim() !== '') {
                            $('#update_subcategory_group').show();
                            $('#update_subcategory_container').php(html);
                            recheckSubcategories(); // Ensure subcategories retain their checked state

                            // Check for selected subcategories to fetch sub-subcategories
                            var selectedSubcategoryIds = $('input[name="update_subcategory_id[]"]:checked').map(function () {
                                return this.value;
                            }).get();

                            if (selectedSubcategoryIds.length > 0) {
                                $.ajax({
                                    type: 'POST',
                                    url: 'get-values.php',
                                    data: { update_subcategory_id: selectedSubcategoryIds.join(','), product_id: productId },
                                    success: function (html) {
                                        if (html.trim() !== '') {
                                            $('#update_subsubcategory_group').show();
                                            $('#update_subsubcategory_container').php(html);
                                            recheckSubSubcategories(); // Ensure sub-subcategories retain their checked state
                                        } else {
                                            $('#update_subsubcategory_group').hide();
                                            $('#update_subsubcategory_container').php('');
                                        }
                                    }
                                });
                            } else {
                                $('#update_subsubcategory_group').hide();
                                $('#update_subsubcategory_container').php('');
                            }
                        } else {
                            $('#update_subcategory_group').hide();
                            $('#update_subcategory_container').php('<div class="checkbox"><label>Select Category first</label></div>');
                            $('#update_subsubcategory_group').hide();
                            $('#update_subsubcategory_container').php('');
                        }
                    }
                });
            } else {
                $('#update_subcategory_group').hide();
                $('#update_subcategory_container').php('<div class="checkbox"><label>Select Category first</label></div>');
                $('#update_subsubcategory_group').hide();
                $('#update_subsubcategory_container').php('');
            }
        });

        // When a subcategory is selected
        $('#update_subcategory_container').on('change', 'input[name="update_subcategory_id[]"]', function () {
            var subcategory_ids = $('input[name="update_subcategory_id[]"]:checked').map(function () {
                return this.value;
            }).get();

            selectedSubcategories = subcategory_ids; // Store selected subcategories

            if (subcategory_ids.length > 0) {
                $.ajax({
                    type: 'POST',
                    url: 'get-values.php',
                    data: { update_subcategory_id: subcategory_ids.join(','), product_id: productId },
                    success: function (html) {
                        if (html.trim() !== '') {
                            $('#update_subsubcategory_group').show();
                            $('#update_subsubcategory_container').php(html);
                            recheckSubSubcategories(); // Ensure sub-subcategories retain their checked state
                        } else {
                            $('#update_subsubcategory_group').hide();
                            $('#update_subsubcategory_container').php('<div class="checkbox"><label>Select Subcategory first</label></div>');
                        }
                    }
                });
            } else {
                $('#update_subsubcategory_group').hide();
                $('#update_subsubcategory_container').php('<div class="checkbox"><label>Select Subcategory first</label></div>');
            }
        });

        // When a sub-subcategory is selected
        $('#update_subsubcategory_container').on('change', 'input[name="update_subsubcategory_id[]"]', function () {
            var subsubcategory_ids = $('input[name="update_subsubcategory_id[]"]:checked').map(function () {
                return this.value;
            }).get();

            selectedSubSubcategories = subsubcategory_ids; // Store selected sub-subcategories
        });

        // Function to recheck previously selected subcategories
        function recheckSubcategories() {
            var selectedSubcategoryIds = $('input[name="update_subcategory_id[]"]:checked').map(function () {
                return this.value;
            }).get();

            console.log('Rechecking subcategories:', selectedSubcategoryIds);

            $('input[name="update_subcategory_id[]"]').each(function () {
                $(this).prop('checked', selectedSubcategoryIds.includes(this.value));
            });
        }

        // Function to recheck previously selected sub-subcategories
        function recheckSubSubcategories() {
        var selectedSubSubcategoryIds = $('input[name="update_subsubcategory_id[]"]:checked').map(function () {
            return this.value;
        }).get();

        console.log('Rechecking sub-subcategories:', selectedSubSubcategoryIds);

        $('input[name="update_subsubcategory_id[]"]').each(function () {
            $(this).prop('checked', selectedSubSubcategoryIds.includes(this.value));
        });

        // Ensure the sub-subcategory section stays visible if any sub-subcategories are selected
        if (selectedSubSubcategoryIds.length > 0) {
            $('#update_subsubcategory_group').show();
        }
    }
    });
  </script>

  <!-- Start Add More Images -->
  <script type="text/javascript">
    $(document).ready(function () {
      var maxField = 6; //Input fields increment limitation
      var addButton = $('.add_button'); //Add button selector
      var wrapper = $('.field_wrapper'); //Input field wrapper
      var fieldHTML = '<div><div class="form-group remove"><div class="col-sm-2"></div><div class="col-sm-5"><input type="file" name="images[]" class="form-control"></div><a href="javascript:void(0);" class="btn btn-danger remove_button" style="margin-left: 15px;">Remove</a></div></div>';
      //New input field html 
      var x = 1; //Initial field counter is 1
      //Once add button is clicked
      $(addButton).click(function () {
        //Check maximum number of input fields
        if (x < maxField) {
          x++; //Increment field counter
          $(wrapper).append(fieldHTML); //Add field html
        }
      });
      //Once remove button is clicked
      $(wrapper).on('click', '.remove_button', function (e) {
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
      });
    });
  </script>
  <!-- End Add More Images -->

  <script type="text/javascript">
    $(".removeimage").click(function () {
      var action = 'deleteImages';
      var id = $(this).parents("tr").attr("id");

      if (confirm('Are you sure to remove this image ?')) {
        $.ajax({
          url: 'get-values.php',
          type: 'GET',
          data: { deleteImages: action, image_id: id },
          success: function (data) {
            $("#" + id).remove();
            alert("Record removed successfully");
          }
        });
      }
    });
  </script>

</body>

</html>