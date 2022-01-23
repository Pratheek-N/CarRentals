<?php
	session_start();
	error_reporting(0);
	include 'config.php';
	
	if (isset($_POST['submit'])) {

			$email = $_POST['email'];
			$sql = "SELECT * FROM users WHERE email='$email'";
			$result = mysqli_query($conn, $sql);
			$emailcount = mysqli_num_rows($result);

			if ($emailcount) {
						$userdata = mysqli_fetch_assoc($result);
						$username = $userdata['username'];
						$token = $userdata['token'];
						$subject = "Reset Password";
						$body = "<body><h3>Hello $username.</h3><br><a href='http://localhost/car/new-password.php?token=$token'>Click here to Reset your password</a></body>";
						sendingmail($subject,$body,$email,$_SESSION['msg']="Check your mail to reset your password $email",header("Location:login.php"));
						} 
			else {
				$_SESSION['pwd-msg']="Invalid Email";
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

	<title>Forgot Password</title>
    <style>
        .container{
    		width: 380px;
    		min-height: 300px;
   			background: #FFF;
    		border-radius: 5px;
    		box-shadow: 0 0 5px rgba(0,0,0,.3);
    		padding: 40px 30px;
        }
		

    </style>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 1.5rem; font-weight: 800;">Recover Password</p>
			<p class="pass-msg"><?php
			echo $_SESSION['pwd-msg']; 
			$_SESSION['pwd-msg'] = "<strong>DP Car Rentals</strong>"; ?> </p>
			<div class="input-group">
			<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
            </div> 
			<div class="input-group">
				<button name="submit" class="btn">Send Mail</button>
			</div>
			<p class="login-register-text">Remember Password ?  <a href="login.php">Login Here</a>.</p>
		</form>
	</div>
</body>
</html>