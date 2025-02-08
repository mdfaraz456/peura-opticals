<?php
if (!isset($_SESSION)) {
  session_start();
}
error_reporting(E_ALL);

require '../config/config.php';

$db = new dbClass();

$payId = (isset($_REQUEST['payId']) ? base64_decode($_REQUEST['payId']) : '');
$row = $db->getData("SELECT * FROM `orders_table` WHERE `order_id` = '$payId'");
$getCustomer = $db->getData("SELECT * FROM `customers` WHERE `customer_id` = '".$row['customer_id']."'");
$getProduct = $db->getAllData("SELECT * FROM `order_product_details` WHERE `order_id` = '".$row['order_id']."'");
$getShipping = $db->getData("SELECT * FROM `order_address` WHERE `id` = '".$row['address_id']."' AND `customer_id` = '".$row['customer_id']."'");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $websiteTitle; ?> | View Orders Details</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.png">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        .box-body {
            padding: 15px;
        }
        .customer-info, .shipping-info {
            padding: 15px 15px 0px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .customer-info h4, .shipping-info h4 {
            margin-bottom: 20px;
            font-weight: bold;
        }
        .customer-info .item, .shipping-info .item {
            margin-bottom: 15px;
        }
        .customer-info .name, .shipping-info .name {
            font-weight: bold;
            color: #333;
        }
        .table th, .table td {
            text-align: center;
        }
   
        .order-header {
            font-size: 16px;
            font-weight: 600;
        }
        .shipping-info .row {
            margin-bottom: 15px;
        }
        .shipping-info .col-md-6 {
            margin-bottom: 10px;
        }
        .box .row {
            margin-bottom: 20px;
        }
        .box .col-md-4, .box .col-md-6 {
            padding: 0 10px;
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
      <h1> Manage Orders <small>View Orders Details</small> </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View Orders</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><small><i class="fa fa-clock-o"></i> <?php echo $row['created_at'] ?? ''; ?></small> </h3>
        </div>
        <div class="box-body">
          
          <!-- Customer Information -->
          <div class="row">
    <div class="col-md-12">
        <div class="customer-info">
            <h4>Customer Information</h4>
            <div class="row">
                <div class="col-md-4">
                    <?php if (!empty($getCustomer['first_name']) || !empty($getCustomer['last_name'])): ?>
                    <div class="item">
                        <p class="name">Customer Name</p>
                        <p><?php echo ($getCustomer['first_name'] ?? 'N/A') . ' ' . ($getCustomer['last_name'] ?? 'N/A'); ?></p>
                    </div>
                    <?php else: ?>
                    <div class="item">
                        <p class="name">Customer Name</p>
                        <p>N/A</p>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <?php if (!empty($getCustomer['email'])): ?>
                    <div class="item">
                        <p class="name">Customer Email</p>
                        <p><?php echo $getCustomer['email'] ?? 'N/A'; ?></p>
                    </div>
                    <?php else: ?>
                    <div class="item">
                        <p class="name">Customer Email</p>
                        <p>N/A</p>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <?php if (!empty($getCustomer['phone'])): ?>
                    <div class="item">
                        <p class="name">Customer Phone</p>
                        <p><?php echo $getCustomer['phone'] ?? 'N/A'; ?></p>
                    </div>
                    <?php else: ?>
                    <div class="item">
                        <p class="name">Customer Phone</p>
                        <p>N/A</p>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <?php if (!empty($row['created_at'])): ?>
                    <div class="item">
                        <p class="name">Order Date</p>
                        <p><?php echo date('d F Y', strtotime($row['created_at'])); ?></p>
                    </div>
                    <?php else: ?>
                    <div class="item">
                        <p class="name">Order Date</p>
                        <p>N/A</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Shipping Information (Second Row) -->
<div class="row">
    <div class="col-md-12">
        <div class="shipping-info">
            <h4>Shipping Information</h4>
            <div class="row">
                <div class="col-md-4">
                    <?php if (!empty($getShipping['first_name']) || !empty($getShipping['last_name'])): ?>
                    <div class="item">
                        <p class="name">Shipping Name</p>
                        <p><?php echo ($getShipping['first_name'] ?? 'N/A') . ' ' . ($getShipping['last_name'] ?? 'N/A'); ?></p>
                    </div>
                    <?php else: ?>
                    <div class="item">
                        <p class="name">Shipping Name</p>
                        <p>N/A</p>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <?php if (!empty($getShipping['email'])): ?>
                    <div class="item">
                        <p class="name">Shipping Email</p>
                        <p><?php echo $getShipping['email'] ?? 'N/A'; ?></p>
                    </div>
                    <?php else: ?>
                    <div class="item">
                        <p class="name">Shipping Email</p>
                        <p>N/A</p>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <?php if (!empty($getShipping['phone'])): ?>
                    <div class="item">
                        <p class="name">Shipping Phone</p>
                        <p><?php echo $getShipping['phone'] ?? 'N/A'; ?></p>
                    </div>
                    <?php else: ?>
                    <div class="item">
                        <p class="name">Shipping Phone</p>
                        <p>N/A</p>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <?php if (!empty($getShipping['address'])): ?>
                    <div class="item">
                        <p class="name">Shipping Address</p>
                        <p><?php echo $getShipping['address'] ?? 'N/A'; ?></p>
                    </div>
                    <?php else: ?>
                    <div class="item">
                        <p class="name">Shipping Address</p>
                        <p>N/A</p>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <?php if (!empty($getShipping['city'])): ?>
                    <div class="item">
                        <p class="name">Shipping City</p>
                        <p><?php echo $getShipping['city'] ?? 'N/A'; ?></p>
                    </div>
                    <?php else: ?>
                    <div class="item">
                        <p class="name">Shipping City</p>
                        <p>N/A</p>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <?php if (!empty($getShipping['state'])): ?>
                    <div class="item">
                        <p class="name">Shipping State</p>
                        <p><?php echo $getShipping['state'] ?? 'N/A'; ?></p>
                    </div>
                    <?php else: ?>
                    <div class="item">
                        <p class="name">Shipping State</p>
                        <p>N/A</p>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <?php if (!empty($getShipping['postcode'])): ?>
                    <div class="item">
                        <p class="name">Shipping Postcode</p>
                        <p><?php echo $getShipping['postcode'] ?? 'N/A'; ?></p>
                    </div>
                    <?php else: ?>
                    <div class="item">
                        <p class="name">Shipping Postcode</p>
                        <p>N/A</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

        </div>

        <!-- Order Products Table -->
        <div class="box-body table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>S.No</th>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Quantity</th>
                <th>Total Amount</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $j = 1;  
              $total = 0; 
              foreach($getProduct as $Prow):
                $product_id = $Prow['product_id'];
                $getProductDetails = $db->getData("SELECT * FROM products WHERE product_id = $product_id");
                $total += $Prow['product_total_price'];
              ?>
              <tr>
                <td><?php echo $j++; ?></td>
                <td>
                  <a href="../adminuploads/products/<?php echo $getProductDetails['image']; ?>" target="_blank">
                    <img src="../adminuploads/products/<?php echo $getProductDetails['image']; ?>" width="100px" height="100%">
                  </a>
                </td>
                <td><?php echo $Prow['product_name']; ?></td>
                <td><?php echo $Prow['product_price']; ?></td>
                <td><?php echo $Prow['product_quantity']; ?></td>
                <td><?php echo $Prow['product_total_price']; ?></td>
                <td>
                  <a href="view-product-detail.php?id=<?php echo base64_encode($getProductDetails['product_id']); ?>" title="View">View</a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="4"></td>
                <td><strong>Total</strong></td>
                <td> <strong><?php echo $total; ?></strong></td>
            </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </section>
  </div>

  <?php include 'include/footer.php'; ?>
    
  <div class="control-sidebar-bg"></div>
</div>

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
<script>
  $(function () {
    $('#example1').DataTable()
  })
</script>
</body>
</html>
