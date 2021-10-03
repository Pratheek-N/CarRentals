<?php 

session_start();

include 'config.php';

if(isset($_GET['token'])){


    $token = $_GET['token'];

    $updatequery = "update users set status = 'Active' where token='$token'";

    $query = mysqli_query($conn,$updatequery);

    if($query){
            if(isset($_SESSION['msg'])){

                $_SESSION['msg'] = "Account activated successfully";
                header('location: login.php');
            }
            else
            $_SESSION['msg'] = "You are Logged Out!";
                header('location: login.php');
    }
    else
    $_SESSION['msg'] = "Account not activated";
                header('location: login.php');
}



 ?>
