<?php 

$server = "localhost";
$user = "root";
$pass = "";
$database = "car";

$conn = mysqli_connect($server, $user, $pass, $database);
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/car/');
define('SITE_PATH','http://localhost/car/');

define('CAR_IMAGE_SERVER_PATH',SERVER_PATH.'admin/assets/images/');
define('CAR_IMAGE_SITE_PATH',SITE_PATH.'admin/assets/images/');

if (!$conn) {
    die("<script>alert('Connection Failed.')</script>");
}



?>