<!-- Sidebar user panel -->
<div class="user-panel">
  <div class="pull-left image">
    <?php if (!empty($userRow['image'])) { ?>
      <img src="../adminuploads/user-image/<?php echo $userRow['image']; ?>" class="img-circle">
    <?php } else { ?>
      <img src="dist/img/user-image.jpg" class="img-circle" alt="User Image">
    <?php } ?>
  </div>
  <div class="pull-left info">
    <p>
      <?php echo $userRow['username']; ?>
    </p>
    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
  </div>
</div>

<section class="slimScrollDiv">
  <div class="side-menu-scroll">
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>

      <li class="treeview <?php echo basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active' : ''; ?>">
        <a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span> </a>
      </li>

      <li
        class="treeview <?php echo basename($_SERVER['PHP_SELF']) == 'add-banner1.php' || basename($_SERVER['PHP_SELF']) == 'view-banner1.php' ? 'active' : ''; ?>">
        <a href="#"> <i class="fa fa-file-image-o"></i> <span>Banner</span> <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i> </span> </a>
        <ul class="treeview-menu">
          <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'add-banner1.php' ? 'active' : ''; ?>">
            <a href="add-banner1.php"><i class="fa fa-circle-o"></i> Add Banner</a>
          </li>
          <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'view-banner1.php' ? 'active' : ''; ?>">
            <a href="view-banner1.php"><i class="fa fa-circle-o"></i> View Banner</a>
          </li>
        </ul>
      </li>
      <li
        class="treeview <?php echo basename($_SERVER['PHP_SELF']) == 'add-product-type.php' || basename($_SERVER['PHP_SELF']) == 'view-product-type.php' ? 'active' : ''; ?>">
        <a href="#"> <i class="fa fa-th-large"></i> <span>Product Type</span> <span class="pull-right-container"> <i
              class="fa fa-angle-left pull-right"></i> </span> </a>
        <ul class="treeview-menu">
          <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'add-product-type.php' ? 'active' : ''; ?>">
            <a href="add-product-type.php"><i class="fa fa-circle-o"></i> Add Product Type</a>
          </li>
          <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'view-product-type.php' ? 'active' : ''; ?>">
            <a href="view-product-type.php"><i class="fa fa-circle-o"></i> View Product Type</a>
          </li>
        </ul>
      </li>
      <li
        class="treeview <?php echo basename($_SERVER['PHP_SELF']) == 'add-product-category.php' || basename($_SERVER['PHP_SELF']) == 'view-product-category.php' ? 'active' : ''; ?>">
        <a href="#"> <i class="fa fa-th"></i> <span>Category</span> <span class="pull-right-container"> <i
              class="fa fa-angle-left pull-right"></i> </span> </a>
        <ul class="treeview-menu">
          <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'add-product-category.php' ? 'active' : ''; ?>">
            <a href="add-product-category.php"><i class="fa fa-circle-o"></i> Add Category</a>
          </li>
          <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'view-product-category.php' ? 'active' : ''; ?>">
            <a href="view-product-category.php"><i class="fa fa-circle-o"></i> View Category</a>
          </li>
        </ul>
      </li>
      <li
        class="treeview <?php echo basename($_SERVER['PHP_SELF']) == 'add-products.php' || basename($_SERVER['PHP_SELF']) == 'view-products.php' ? 'active' : ''; ?>">
        <a href="#"> <i class="fa fa-folder"></i> <span>Products</span> <span class="pull-right-container"> <i
              class="fa fa-angle-left pull-right"></i> </span> </a>
        <ul class="treeview-menu">
          <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'add-products.php' ? 'active' : ''; ?>">
            <a href="add-products.php"><i class="fa fa-circle-o"></i> Add Products</a>
          </li>
          <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'view-products.php' ? 'active' : ''; ?>">
            <a href="view-products.php"><i class="fa fa-circle-o"></i> View Products</a>
          </li>
        </ul>
      </li>
      <li
        class="treeview <?php echo basename($_SERVER['PHP_SELF']) == 'add-testimonial.php' || basename($_SERVER['PHP_SELF']) == 'view-testimonial.php' ? 'active' : ''; ?>">
        <a href="#"> <i class="fa fa-comments"></i> <span>Testimonial</span> <span class="pull-right-container"> <i
              class="fa fa-angle-left pull-right"></i> </span> </a>
        <ul class="treeview-menu">
          <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'add-testimonial.php' ? 'active' : ''; ?>">
            <a href="add-testimonial.php"><i class="fa fa-circle-o"></i> Add Testimonial</a>
          </li>
          <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'view-testimonial.php' ? 'active' : ''; ?>">
            <a href="view-testimonial.php"><i class="fa fa-circle-o"></i> View Testimonial</a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</section>