<?php 

session_start();

unset($_SESSION['username']);
header('location:index.php');
die();
 // Redirecting To Home Page


?>