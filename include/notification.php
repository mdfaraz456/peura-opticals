<?php

	// Display the success message, if available
	if (isset($_SESSION['msg'])) {
?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i>
            <?php echo $_SESSION['msg']; ?>
        </h4>
    </div>

<?php
    // Unset the session variable to prevent it from being displayed again
    unset($_SESSION['msg']);
}


// Display the error message, if available
if (isset($_SESSION['errmsg'])) {
?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i>
            <?php echo $_SESSION['errmsg']; ?>
        </h4>
    </div>

<?php
    // Unset the session variable to prevent it from being displayed again
    unset($_SESSION['errmsg']);
}
?>