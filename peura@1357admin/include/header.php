<?php



// --- Check session value --- //

$check = new LoginSession();

$check->checkSession($_SESSION['ADMIN_USER_ID']);

// --- Get logged in user detail -- //

$userOBJ = new userDetail();

$userRow = $userOBJ->loginUserDetail($_SESSION['ADMIN_USER_ID']);



?>

<a href="home.php" class="logo"> 

<span class="logo-mini" style="color:black;"><!--<img src="dist/img/logo-light-icon.png">-->PO</span> 

<span class="logo-lg" style="color:black;"><!--<img src="dist/img/logo-light-icon.png">-->Peura Opticals</span> 

<!-- <span class="logo-lg"><img src="dist/img/logo-light-text.png" style="height: 35px;"></span> -->

</a>

<nav class="navbar navbar-static-top"> <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"> <span class="sr-only">Toggle navigation</span> </a>

  <div class="navbar-custom-menu">

    <ul class="nav navbar-nav">

      <li class="dropdown user user-menu"> 

        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 

        <?php if(!empty($userRow['image'])){ ?>

        <img src="../adminuploads/user-image/<?php echo $userRow['image']; ?>" class="user-image">

        <?php }else{ ?>

        <img src="dist/img/user-image.jpg" class="user-image">

        <?php } ?> 

        <span class="hidden-xs"><?php echo $userRow['username']; ?></span> 

        </a>

        <ul class="dropdown-menu">

          <!-- User image -->

          <li class="user-header"> 

          <?php if(!empty($userRow['image'])){ ?>

          <img src="../adminuploads/user-image/<?php echo $userRow['image']; ?>" class="img-circle" alt="User Image">

          <?php }else{ ?>

          <img src="dist/img/user-image.jpg" class="img-circle" alt="User Image">

          <?php } ?> 

            <p> <?php echo $userRow['username']; ?> <small> <?php echo $userRow['email']; ?> </small> </p>

          </li>

          <!-- Menu Body -->

          <li class="user-body">

            <div class="row">

              <div class="col-xs-6 text-center"> <a href="change-password.php">Change Password</a> </div>

              <!-- <div class="col-xs-6 text-center"> <a href="db-backup.php">Database Backup</a> </div> -->

            </div>

          </li>

          <li class="user-footer">

            <div class="pull-left"> <a href="my-profile.php" class="btn btn-default btn-flat">Profile</a> </div>

            <div class="pull-right"> <a href="signout.php" class="btn btn-default btn-flat">Sign out</a> </div>

          </li>

        </ul>

      </li>

    </ul>

  </div>

</nav>





 