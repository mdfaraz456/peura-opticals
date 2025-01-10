<div class="sticky-top account-sidebar-wrapper">
							<div class="account-sidebar" id="accountSidebar">
								<div class="profile-head">
									<div class="user-thumb">
										<img class="rounded-circle" src="adminuploads/user-image/<?php echo $userDetail['image'];?>" alt="Susan Gardner">
									</div>
									<h5 class="title mb-0"><?php echo $userDetail['first_name']." ".$userDetail['last_name'];?></h5>
									<span class="text text-primary"><?php echo $userDetail['email'];?></span>
								</div>
								<div class="account-nav">
									<div class="nav-title bg-light">DASHBOARD</div>
									<ul>
										
										<li><a href="account-orders.php">Orders</a></li>
										
									</ul>
									<div class="nav-title bg-light">ACCOUNT SETTINGS</div>
									<ul class="account-info-list">
										<li><a href="account-dashboard.php">Profile</a></li>
										<li><a href="change-password.php">Change Password</a></li>
										<li class="" style="background-color: #ff4764; margin: 0 .5rem; border-radius: 10px;"><a href="signout.php" style="color:#fff;"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
										
									</ul>
								</div>
							</div>
						</div>