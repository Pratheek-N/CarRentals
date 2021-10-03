
<?php 

include '../config.php';

session_start();

error_reporting(0);

if (isset($_SESSION['adminname'])) {
    header("Location: adminpage.php");
}

if (isset($_POST['submit'])) {
	$admin = $_POST['adminname'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM admin WHERE adminname='$admin' and password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['adminname'] = $row['adminname'];
		header("Location: adminpage.php");
	} else {
		echo "<script>alert('Oops..Invalid Username or Password !!')</script>";
	}
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" sizes="144x144" href="../images/favicon.png">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="../css/login.css">
	<style>
	
	.container{
		min-height: 360px;
	}

	
	</style>

	<title>Admin Login Form</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Admin Login</p>
			<div class="input-group">
				<input type="text" placeholder="Admin Name" name="adminname" value=""  required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Login</button>
			</div>
			
		</form>
	</div>
</body>
</html>