<?php

//Include the database configuration file

require '../config/config.php';
require '../config/functions.php';
require '../config/products.php';

if (!empty($_POST["category_id"])) {
    $categories = new Categories();
    $category_ids = explode(',', $_POST["category_id"]);
    $html = '';

    foreach ($category_ids as $category_id) {
        // Fetch subcategories for the current category
        $sqlsubCatQuery = $categories->getSubCatgoriesDropdown($category_id);

        // Check if there are any subcategories before displaying the category name
        if (!empty($sqlsubCatQuery)) {
            // Display the category name
            $sqlCatQuery = $categories->allCategories(); // Fetches all categories
            foreach ($sqlCatQuery as $catRow) {
                if ($catRow['id'] == $category_id) {
                    $html .= '<div class="subtitle">' . htmlspecialchars($catRow['name']) . '</div>'; // Display category name
                }
            }

            // Display subcategories
            foreach ($sqlsubCatQuery as $sqlsubcatRow) {
                $html .= '<div class="checkbox"><label><input type="checkbox" name="subcategory_id[]" value="' . htmlspecialchars($sqlsubcatRow['id']) . '">' . htmlspecialchars($sqlsubcatRow['name']) . '</label></div>';
            }
        }
    }

    echo $html;
}

if (!empty($_POST["subcategory_id"])) {
    $categories = new Categories();
    $subcategory_ids = explode(',', $_POST["subcategory_id"]);
    $html = '';

    foreach ($subcategory_ids as $subcategory_id) {
        // Fetch sub-subcategories for the current subcategory
        $sqlsubSubCatQuery = $categories->getSubSubCatgoriesDropdown($subcategory_id);

        // Check if there are any sub-subcategories before displaying the subcategory name
        if (!empty($sqlsubSubCatQuery)) {
            // Fetch the parent category and subcategory for the subcategory
            $sqlSubCatQuery = $categories->getSubCategoryWithCategory($subcategory_id); // Updated function call
             
            // Display the category and subcategory names
            if (!empty($sqlSubCatQuery)) {
                $parentCategoryName = $sqlSubCatQuery['category_name']; // Assuming this will return the category name
                $subCategoryName = $sqlSubCatQuery['subcategory_name']; // Assuming this will return the subcategory name
                
                $html .= '<div class="subtitle">' . htmlspecialchars($parentCategoryName) . ' / ' . htmlspecialchars($subCategoryName) . '</div>'; // Display category/subcategory names
            }

            // Display sub-subcategories
            foreach ($sqlsubSubCatQuery as $sqlsubSubCatRow) {
                $html .= '<div class="checkbox"><label><input type="checkbox" name="subsubcategory_id[]" value="' . htmlspecialchars($sqlsubSubCatRow['id']) . '">' . htmlspecialchars($sqlsubSubCatRow['name']) . '</label></div>';
            }
        }
    }

    echo $html;
}


if (!empty($_POST["update_category_id"]) && !empty($_POST["product_id"])) {
    $categories = new Categories();
    $category_ids = explode(',', $_POST["update_category_id"]);
    $product_id = $_POST["product_id"];
    $html = '';

    foreach ($category_ids as $category_id) {
        $sqlsubCatQuery = $categories->getSubCatgoriesDropdown($category_id);
        $selectedSubcategories = $categories->getSelectedSubCategories($product_id);

        if (!empty($sqlsubCatQuery)) {
            $sqlCatQuery = $categories->allCategories();
            foreach ($sqlCatQuery as $catRow) {
                if ($catRow['id'] == $category_id) {
                    $html .= '<div class="subtitle">' . htmlspecialchars($catRow['name']) . '</div>';
                }
            }

            foreach ($sqlsubCatQuery as $sqlsubcatRow) {
                $isChecked = in_array($sqlsubcatRow['id'], $selectedSubcategories) ? 'checked' : '';
                $html .= '<div class="checkbox"><label><input type="checkbox" name="update_subcategory_id[]" value="' . htmlspecialchars($sqlsubcatRow['id']) . '" ' . $isChecked . '>' . htmlspecialchars($sqlsubcatRow['name']) . '</label></div>';
            }
        }
    }

    echo $html;
}

if (!empty($_POST["update_subcategory_id"]) && !empty($_POST["product_id"])) {
    $categories = new Categories();
    $subcategory_ids = explode(',', $_POST["update_subcategory_id"]);
    $product_id = $_POST["product_id"];
    $html = '';

    foreach ($subcategory_ids as $subcategory_id) {
        $sqlsubSubCatQuery = $categories->getSubSubCatgoriesDropdown($subcategory_id);
        $selectedSubSubcategories = $categories->getSelectedSubSubCategories($product_id);

        if (!empty($sqlsubSubCatQuery)) {
            $sqlSubCatQuery = $categories->getSubCategoryWithCategory($subcategory_id);

            if (!empty($sqlSubCatQuery)) {
                $parentCategoryName = $sqlSubCatQuery['category_name'];
                $subCategoryName = $sqlSubCatQuery['subcategory_name'];

                $html .= '<div class="subtitle">' . htmlspecialchars($parentCategoryName) . ' / ' . htmlspecialchars($subCategoryName) . '</div>';
            }

            foreach ($sqlsubSubCatQuery as $sqlsubSubCatRow) {
                $isChecked = in_array($sqlsubSubCatRow['id'], $selectedSubSubcategories) ? 'checked' : '';
                $html .= '<div class="checkbox"><label><input type="checkbox" name="update_subsubcategory_id[]" value="' . htmlspecialchars($sqlsubSubCatRow['id']) . '" ' . $isChecked . '>' . htmlspecialchars($sqlsubSubCatRow['name']) . '</label></div>';
            }
        }
    }

    echo $html;
}

// Delete product image 
if(isset($_REQUEST['deleteImages']) && isset($_REQUEST['image_id'])){
	$db = new dbClass();
	$imgId = $_REQUEST['image_id'];
    $selectSql = $db->getData("SELECT `image` FROM `products_images` WHERE `image_id` = '$imgId'");
    unlink("../adminuploads/products/".$selectSql['image']);
    $deleteSql = $db->execute("DELETE FROM `products_images` WHERE `image_id` = '$imgId'");
} 

// Delete workshop image 
if(isset($_REQUEST['deleteImages']) && isset($_REQUEST['id'])){
	$db = new dbClass();
	$imgId = $_REQUEST['id'];
    $selectSql = $db->getData("SELECT `image` FROM `workshop_images` WHERE `id` = '$imgId'");
    unlink("../adminuploads/workshop/".$selectSql['image']);
    $deleteSql = $db->execute("DELETE FROM `workshop_images` WHERE `id` = '$imgId'");
}

// Delete workshop video
if(isset($_REQUEST['deleteVideos']) && isset($_REQUEST['id'])){
    $db = new dbClass();
    $videoId = $_REQUEST['id'];
    $selectSql = $db->getData("SELECT `image` FROM `workshop_videos` WHERE `id` = '$videoId'");
    if (file_exists("../adminuploads/workshop/" . $selectSql['image'])) {
        unlink("../adminuploads/workshop/" . $selectSql['image']);
    }
    $deleteSql = $db->execute("DELETE FROM `workshop_videos` WHERE `id` = '$videoId'");
}
?>