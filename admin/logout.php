<?php 

session_start();

unset($_SESSION['adminname']);
header('location:index.php');
die();
 // Redirecting To Home Page



?>