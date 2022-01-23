<?php 

include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: login.php");
}

if (isset($_POST['submit'])) {
	if($_FILES['image']['type']!=''){
		if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
			echo "<script>alert('Please select only valid image format like png,jpg,jpeg.')</script>";
		
		}else{
			$username = $_POST['username'];
			$email = $_POST['email'];
			$mblno = $_POST['mblno'];
			$password = md5($_POST['password']);
			$cpassword = md5($_POST['cpassword']);
			$dl_no= $_POST['dl_no'];
			$token = bin2hex(random_bytes(15));
			$image_required='required';
		
			if ($password == $cpassword) {
				$sql = "SELECT * FROM users WHERE email='$email'";
				$result = mysqli_query($conn, $sql);
				if (!$result->num_rows > 0  ) {
			$image_required='';
		
					$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
					move_uploaded_file($_FILES['image']['tmp_name'],CAR_IMAGE_SERVER_PATH.$image);
					$sql = "INSERT INTO users (username, email, mblno, password,dl_no,image,token,status)
							VALUES ('$username', '$email','$mblno', '$password','$dl_no','$image','$token','Inactive')";
					$result = mysqli_query($conn, $sql);
					
					if ($result) {
							
							$subject = "Email Activation";
							$body = "<h2>Hello $username</h2><br><a href=' http://localhost/car/email-activate.php?token=$token'>Click here to activate your account</a>";
								
							sendingmail($subject,$body,$email,$_SESSION['msg']="Check your mail to activate your account $email",header('location:login.php'));
							
						
					} else {
						echo "<script>alert('Woops! Something Went Wrong.')</scrip;>";
					}
				} else {
					echo "<script>alert('Woops! Email Already Exists.')</script>";
				}
				
			} else {
				echo "<script>alert('Password Not Matched.')</script>";
			}
		}

	}
	
	


}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" sizes="144x144" href="images/favicon.png">

	<link rel="stylesheet" type="text/css" href="css/login.css">

	<title>Register Form</title>
	<style>
		.input-group1{
  width: 100%;
  height: 40px;
  margin-bottom: 25px;
}

.input-group1 input {
  width: 100%;
  height: 100%;
  border: none;
  padding: 15px 25px;
  font-size: .9rem;
 
}


	</style>
</head>
<body>
	<div class="container">
		<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" class="login-email" enctype="multipart/form-data">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
			<div class="input-group">
				<input type="text" placeholder="Username" name="username" value="<?php echo $username; ?>" required pattern="[a-zA-Z][a-zA-Z ]{2,}">
			</div>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>"pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
			</div>
			<div class="input-group">
				<input type="tel" placeholder="Mobile Number" name="mblno" value="<?php echo $mblno; ?>"pattern="^\d{10}$" required="required">
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
			</div>
			<div class="input-group">
				<input type="tel" placeholder="Driving License Number" name="dl_no" value="<?php echo $_POST['dl_no']; ?>" pattern = "^(([A-Z]{2}[0-9]{2})( )|([A-Z]{2}-[0-9]{2}))((19|20)[0-9][0-9])[0-9]{7}$" required>
			</div>
			
			<p style="position:relative;left:25px;font-size:15px; opacity:0.8;">Please Upload Driving License here</p>
			<div class="input-group1">
            	<input type="file" name="image" <?php echo  $image_required ?> >
			</div> 
			<div class="input-group">
				<button name="submit" class="btn">Register</button>
			</div>
			<p class="login-register-text">Have an account? <a href="login.php">Login Here</a>.</p>
		</form>
	</div>
</body>
</html>