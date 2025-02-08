<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL);

require '../config/config.php';
require "../config/order.php";

$db = new dbClass();
$or = new Order();

$filter = isset($_GET['filter']) ? $_GET['filter'] : 'Completed';  // default to 'Completed'

$orders = $or->getFiteredOrder($filter);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $websiteTitle; ?> | View Orders</title>
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
        .nav-link.active {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        .nav-link {
            display: inline-block;
            width: 150px;
            text-align: center;
            padding: 5px;
            border: 1px solid #007bff;
            border-radius: 5px;
            margin-right: 10px;
            text-decoration: none;
        }

        .nav-link:hover {
            background-color: #0056b3;
            color: white;
        }

        .nav {
            display: flex;
            justify-content: center;
        }
        .nav>li>a {
    padding: 5px 1px;
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
            <h1> Manage Orders <small>View Orders</small> </h1>
            <ol class="breadcrumb">
                <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">View Orders</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">View Orders</h3>
                        </div>
                        <div>
                            <ul class="nav">
                                <li class="nav-item">
                                    <a href="?filter=Completed" class="nav-link <?php echo ($filter == 'Completed') ? 'active' : ''; ?>">Complete Payment</a>
                                </li>
                                <li class="nav-item">
                                    <a href="?filter=Pending" class="nav-link <?php echo ($filter == 'Pending') ? 'active' : ''; ?>">Pending Payment</a>
                                </li>
                            </ul>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <!-- <th>Email</th> -->
                                        <th>Phone</th>
                                        <th>Order Number</th>
                                        <th>Transaction Id</th>
                                        <th>Payment Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php 
                                    $i = 1;
                                    foreach ($orders as $row) {
                                    ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo ($row['first_name'] ?? '') . ' ' . ($row['last_name'] ?? ''); ?></td>
                                            <!-- <td><?php // echo $row['email'] ?? ''; ?></td> -->
                                            <td><?php echo $row['phone'] ?? ''; ?></td>
                                            <td><?php echo $row['order_number'] ?? ''; ?></td>
                                            <td><?php echo $row['transaction_id']; ?></td>
                                            <td><?php echo $row['payment_status']; ?></td>
                                            <td><?php echo date('d-F-Y', strtotime($row['created_at'])); ?></td>
                                            <td>
                                                <a href="view-orders-details.php?payId=<?php echo base64_encode($row['order_id'] ?? ''); ?>" title="View">View</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
        $('#example1').DataTable();
    });
</script>

</body>
</html>
