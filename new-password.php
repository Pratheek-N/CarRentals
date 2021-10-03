

<?php 

include 'config.php';

// error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: login.php");
}

if (isset($_POST['submit'])) {

	if(isset($_GET['token'])){

		$token = $_GET['token'];


	$newpassword = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	
	if ($newpassword == $cpassword) {

		$updatequery = "update users set password = '$newpassword' where token = '$token'";

		
			$result = mysqli_query($conn, $updatequery );

			if ($result) {
				$_SESSION['msg']="Your Password has been Updated!";
					header('location:login.php');
				}
			else{
				$_SESSION['pwd-reset']="Your Password is not Updated!";				
				header('location: new-password.php');

			}
		}else{
				$_SESSION['pwd-reset']="Password are not matching";				
				header('location: new-password.php');
		}
	}else{
		$_SESSION['pwd-reset']="No token found";				
				header('location: new-password.php');
	}
}


?>





<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" sizes="144x144" href="images/favicon.png">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="css/login.css">

	<title>Reset Password</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Change Password</p>
			<p class="pass-msg">
			<?php 
			if(isset($_SESSION['pwd-reset']))
			{
				echo $_SESSION['pwd-reset']; 
			}else{
				echo $_SESSION['pwd-reset'] = " "; 
			}
			 
			 ?> </p>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password"required>
            </div>
            <div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Update</button>
			</div>
            <p class="login-register-text">Remember Password ? <a href="login.php">Login Here</a>.</p>
		</form>
	</div>
</body>
</html>