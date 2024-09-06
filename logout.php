<?php 

include('../config/const.php');
//1.destroy the session
session_destroy();//$_SESSION['user']
//2.redirect to login page
header('location:'.SITEURL.'admin/login.php');

?>