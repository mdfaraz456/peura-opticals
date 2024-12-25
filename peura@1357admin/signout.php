<?php

session_start();
error_reporting(0);
require '../config/config.php';
require '../config/login.php';

$logout = new SignOut();
$logout->Logout();

?>
