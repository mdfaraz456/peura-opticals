<?php
if (!isset($_SESSION)) {
  session_start();
}
error_reporting(E_ALL);
require "config/config.php";
require "config/authentication.php";
require 'config/common.php';

$conn = new dbClass();
$auth = new Authentication();
if(!isset($_SESSION['USER_LOGIN'])){
    header('Location : index.php');
}
$products = new Products();
$orderTable= new OrderPage();

$orderData=$orderTable->getAllOrder($_SESSION['USER_LOGIN']);


$auth->checkSession($_SESSION['USER_LOGIN']);
$userDetail = $auth->userDetails($_SESSION['USER_LOGIN']);
$userShipDetail = $auth->userShipLogin($_SESSION['USER_LOGIN']);

$variableForCartAndBuyNow=false;
unset($_SESSION['USER_CHECKOUT']);
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<!-- Title -->
	<title>Peura Opticals</title>
	
	<!-- Meta -->
	<meta charset="utf-8">
	 	<!-- MOBILE SPECIFIC -->
		 <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- STYLESHEETS -->
	
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/swiper/swiper-bundle.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/nouislider/nouislider.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/lightgallery/dist/css/lightgallery.css">
    <link rel="stylesheet" type="text/css" href="vendor/lightgallery/dist/css/lg-thumbnail.css">
    <link rel="stylesheet" type="text/css" href="vendor/lightgallery/dist/css/lg-zoom.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	
	<!-- GOOGLE FONTS-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
	<link href="../css2?family=DM+Sans:wght@400;500;700&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

</head>
<body>
<div class="page-wraper">

	
	<!-- Header Star -->
	<?php include("include/header.php"); ?>
	<!-- Header End -->
	
	<div class="page-content">
		<!--Banner Start-->
		<div class="dz-bnr-inr bg-secondary overlay-black-light" style="background-image:url(images/background/bg1.jpg); margin-top: 5rem;">
			<div class="container">
				<div class="dz-bnr-inr-entry">
					<h1>Orders</h1>
					<nav aria-label="breadcrumb" class="breadcrumb-row">
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php">Home</a></li>
							<li class="breadcrumb-item">Orders</li>
						</ul>
					</nav>
				</div>
			</div>	
		</div>
		<!--Banner End-->
		
		<div class="content-inner-1">
			<div class="container">
                <div class="row">
					<aside class="col-xl-3">
						<div class="toggle-info">
							<h5 class="title mb-0">Account Navbar</h5>
							<a class="toggle-btn" href="#accountSidebar">Account Menu</a>
						</div>
						<?php include("include/acount-sidebar.php") ?>
                    </aside>
                    <div class="col-xl-9 account-wrapper">
						<div class="account-card">
							<div class="table-responsive table-style-1">
								<table class="table table-hover mb-3">
									<thead>
										<tr>
											<th>Order #</th>
											<th>Order Date</th>
											<!-- <th>Order Number</th> -->
											<th>Payment Satus</th>
											<th>Actions</th>
											<!-- <th>Action</th> -->
										</tr>
									</thead>
									<tbody>
										<!-- <tr>
											<td><a href="JavaScript:void(0)" class="fw-medium">#34VB5540K83</a></td>
											<td>May 21, 2024</td>
											<td>$358.75</td>
											<td><span class="badge bg-info  m-0">In Progress</span></td>
											<td><a href="JavaScript:void(0)" class="btn-link text-underline p-0">View</a></td>
										</tr>
										<tr>
											<td><a href="JavaScript:void(0)" class="fw-medium">#78A643CD409</a></td>
											<td>December 09, 2024</td>
											<td><span>$760.50</span></td>
											<td><span class="badge bg-danger  m-0">Canceled</span></td>
											<td><a href="JavaScript:void(0)" class="btn-link text-underline p-0">View</a></td>
										</tr>
										<tr>
											<td><a href="javascript:void(0);" class="fw-medium">#112P45A90V2</a></td>
											<td>October 15, 2024</td>
											<td>$1,264.00</td>
											<td><span class="badge bg-warning  m-0">Delayed</span></td>
											<td><a href="JavaScript:void(0)" class="btn-link text-underline p-0">View</a></td>
										</tr>
										<tr>
											<td><a href="JavaScript:void(0)" class="fw-medium">#28BA67U0981</a></td>
											<td>July 19, 2024</td>
											<td>$198.35</td>
											<td><span class="badge bg-success  m-0">Delivered</span></td>
											<td><a href="JavaScript:void(0)" class="btn-link text-underline p-0">View</a></td>
										</tr>
										<tr>
											<td><a href="JavaScript:void(0)" class="fw-medium">#502TR872W2</a></td>
											<td>April 04, 2024</td>
											<td>$2,133.90</td>
											<td><span class="badge bg-success m-0">Delivered</span></td>
											<td><a href="JavaScript:void(0)" class="btn-link text-underline p-0">View</a></td>
										</tr>
										<tr>
											<td><a href="JavaScript:void(0)" class="fw-medium">#47H76G09F33</a></td>
											<td>March 30, 2024</td>
											<td>$86.40</td>
											<td><span class="badge bg-success m-0">Delivered</span></td>
											<td><a href="JavaScript:void(0)" class="btn-link text-underline p-0">View</a></td>
										</tr>
										<tr>
											<td><a href="JavaScript:void(0)" class="fw-medium">#53U76G09E38</a></td>
											<td>April 21, 2024</td>
											<td>$86.40</td>
											<td><span class="badge bg-success m-0">Delivered</span></td>
											<td><a href="JavaScript:void(0)" class="btn-link text-underline p-0">View</a></td>
										</tr> -->
										<?php  foreach($orderData as $row):  ?>
    <tr class="order-row">
        <td><a href="JavaScript:void(0)" class="fw-medium">#<?php echo $row['order_number'];?></a></td>
        <td><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
        <td>
            <span class="badge bg-info  m-0"><?php echo $row['payment_status'];?></span>
        </td>
        <td><a href="order-details.php?id=<?php echo base64_encode($row['order_id']);?>" class="btn-link text-underline p-0">View</a></td>
    </tr>
<?php endforeach;?>
									</tbody>
								</table>
							</div>
							
							<!-- Pagination-->
							<div class="d-flex justify-content-center mt-5 mt-sm-0">
							<nav aria-label="Table Pagination" id="pagination-nav">
    <ul class="pagination style-1" id="pagination">
        <li class="page-item"><a class="page-link" href="javascript:void(0);" id="prev">Prev</a></li>
        <li class="page-item"><a class="page-link" href="javascript:void(0);" id="next">Next</a></li>
    </ul>
</nav>
							</div>
                        </div>
                    </div>
                </div>
      		</div>
		</div>
		
	</div>

	
	<!-- Footer -->
	<?php include("include/footer.php"); ?>
	<!-- Footer End -->
	
	<button class="scroltop" type="button"><i class="fas fa-arrow-up"></i></button>

</div>

<!-- JAVASCRIPT FILES ========================================= -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="vendor/wow/wow.min.js"></script><!-- WOW JS -->
<script src="vendor/toastr/js/toastr.min.js"></script>
<script src="js/toastr-init.js"></script>
<script src="vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script><!-- BOOTSTRAP MIN JS -->
<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script><!-- BOOTSTRAP SELECT MIN JS -->
<script src="vendor/bootstrap-touchspin/bootstrap-touchspin.js"></script><!-- BOOTSTRAP TOUCHSPIN JS -->
<script src="vendor/swiper/swiper-bundle.min.js"></script><!-- SWIPER JS -->
<script src="vendor/countdown/jquery.countdown.js"></script><!-- COUNTDOWN FUCTIONS  -->
<script src="vendor/wnumb/wNumb.js"></script><!-- WNUMB -->
<script src="vendor/nouislider/nouislider.min.js"></script><!-- NOUSLIDER MIN JS-->
<script src="js/dz.carousel.js"></script><!-- DZ CAROUSEL JS -->
<script src="js/dz.ajax.js"></script><!-- AJAX -->
<script src="js/custom.min.js"></script><!-- CUSTOM JS -->

<!-- <script>
    const rowsPerPage = 5; // Number of rows per page
    const rows = document.querySelectorAll('.order-row');
    const totalPages = Math.ceil(rows.length / rowsPerPage);
    let currentPage = 1;

    // Hide the pagination if there's only one page
    if (totalPages <= 1) {
        document.getElementById('pagination-nav').style.display = 'none';
    }

    // Function to display the rows for the current page
    function displayRows(page) {
        // Hide all rows
        rows.forEach((row, index) => {
            row.style.display = 'none';
        });

        // Show rows for the current page
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const visibleRows = Array.from(rows).slice(start, end);

        visibleRows.forEach(row => {
            row.style.display = '';
        });

        // Update page number styles
        document.querySelectorAll('.page-link').forEach(link => {
            link.classList.remove('active');
        });
        document.querySelector(`#page-${page}`)?.classList.add('active');
    }

    // Initialize pagination
    function createPagination() {
        const pagination = document.getElementById('pagination');

        // Create page numbers dynamically
        for (let i = 1; i <= totalPages; i++) {
            const pageItem = document.createElement('li');
            pageItem.classList.add('page-item');
            const pageLink = document.createElement('a');
            pageLink.classList.add('page-link');
            pageLink.href = 'javascript:void(0);';
            pageLink.id = `page-${i}`;
            pageLink.innerText = i;

            pageLink.addEventListener('click', () => {
                currentPage = i;
                displayRows(i);
            });

            pageItem.appendChild(pageLink);
            pagination.insertBefore(pageItem, document.getElementById('next').parentNode);
        }
    }

    // Handle prev and next buttons
    document.getElementById('prev').addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            displayRows(currentPage);
        }
    });

    document.getElementById('next').addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            displayRows(currentPage);
        }
    });

    // Initialize pagination only if more than 1 page exists
    if (totalPages > 1) {
        createPagination();
        displayRows(currentPage);
    }
</script> -->

<script>
	const rowsPerPage = 5; // Number of rows per page
const rows = document.querySelectorAll('.order-row');
const totalPages = Math.ceil(rows.length / rowsPerPage);
let currentPage = 1;
const maxPagesToShow = 5; // Maximum number of pages to show at once

// Hide the pagination if there's only one page
if (totalPages <= 1) {
    document.getElementById('pagination-nav').style.display = 'none';
}

// Function to display the rows for the current page
function displayRows(page) {
    // Hide all rows
    rows.forEach((row, index) => {
        row.style.display = 'none';
    });

    // Show rows for the current page
    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const visibleRows = Array.from(rows).slice(start, end);

    visibleRows.forEach(row => {
        row.style.display = '';
    });

    // Update page number styles
    document.querySelectorAll('.page-link').forEach(link => {
        link.classList.remove('active');
    });
    document.querySelector(`#page-${page}`)?.classList.add('active');
}

// Function to create page numbers dynamically
function createPagination() {
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = ''; // Clear existing pagination

    // Calculate the page range to display
    const startPage = Math.max(1, currentPage - Math.floor(maxPagesToShow / 2));
    const endPage = Math.min(totalPages, startPage + maxPagesToShow - 1);

    // Create page numbers dynamically
    for (let i = startPage; i <= endPage; i++) {
        const pageItem = document.createElement('li');
        pageItem.classList.add('page-item');
        const pageLink = document.createElement('a');
        pageLink.classList.add('page-link');
        pageLink.href = 'javascript:void(0);';
        pageLink.id = `page-${i}`;
        pageLink.innerText = i;

        pageLink.addEventListener('click', () => {
            currentPage = i;
            displayRows(i);
            createPagination(); // Recreate pagination with updated page range
        });

        pageItem.appendChild(pageLink);
        pagination.appendChild(pageItem);
    }

    // Add prev and next buttons
    const prevButton = document.createElement('li');
    prevButton.classList.add('page-item');
    const prevLink = document.createElement('a');
    prevLink.classList.add('page-link');
    prevLink.href = 'javascript:void(0);';
    prevLink.id = 'prev';
    prevLink.innerText = 'Prev';

    prevLink.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            displayRows(currentPage);
            createPagination(); // Recreate pagination with updated page range
        }
    });

    prevButton.appendChild(prevLink);
    pagination.insertBefore(prevButton, pagination.firstChild);

    const nextButton = document.createElement('li');
    nextButton.classList.add('page-item');
    const nextLink = document.createElement('a');
    nextLink.classList.add('page-link');
    nextLink.href = 'javascript:void(0);';
    nextLink.id = 'next';
    nextLink.innerText = 'Next';

    nextLink.addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            displayRows(currentPage);
            createPagination(); // Recreate pagination with updated page range
        }
    });

    nextButton.appendChild(nextLink);
    pagination.appendChild(nextButton);
}

// Initialize pagination only if more than 1 page exists
if (totalPages > 1) {
    createPagination();
    displayRows(currentPage);
}

</script>
</body>
</html>