<?php
session_start();

function pr($arr){
	echo '<pre>';
	print_r($arr);
}

function prx($arr){
	echo '<pre>';
	print_r($arr);
	die();
}

function get_safe_value($str){
	global $conn;
	$str=mysqli_real_escape_string($conn,$str);
	return $str;

}





include('config.php');

$name=get_safe_value($_POST['name']);
$email=get_safe_value($_POST['email']);
$message=get_safe_value($_POST['message']);
$added_on=date('Y-m-d');
mysqli_query($conn,"insert into contact_us(name,email,message,added_on) values('$name','$email','$message','$added_on')");

$_SESSION['c-msg'] = "Thank you for connecting with us, will get back to you shortly";

header('location:index.php');
?>