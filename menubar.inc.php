<?php 

include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {?>

<!-- Front Page -->
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D P Car Rentals</title>
    <link rel="shortcut icon" sizes="144x144" href="images/favicon.png">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    
</head>
<body>
<a href="#" class="to-top">
    <i class="fas fa-chevron-up"></i>
  </a>
       <div class="navigation-bar-container">
      <div class="nav-container">
        <div class="logo">
       
                   <a href="index.php" title="Logo">
                       <img src="images/admin-logo.png" alt=" Car Rental Logo" class="img-responsive">
                   </a>
             
        </div>

        <div class="navbar1">
          <div class="nav-mobile">
            <a href="#" id="nav-toggle"><span></span></a>
          </div>
          <ul class="nav-list text-uppercase">
          <li><a href="index.php">Home</a></li>
          <li><a href="cars.php">Cars</a></li>

          <li><a href="faq.php">FAQ</a></li>


            <li>
              <a href="#">Login / Register <i class="fa fa-caret-down"></i></a>
              <ul class="nav-dropdown">
              <li><a style="width: 210px;" href="login.php">Login</a></li>
              <li><a style="width: 210px;"  href="register.php">Register</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>

   
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/main.js"></script>
<?php } else { ?>




<!-- After Logging In -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D P Car Rentals</title>
    <link rel="shortcut icon" sizes="144x144" href="images/favicon.png">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">


</head>
<body>
<a href="#" class="to-top">
    <i class="fas fa-chevron-up"></i>
  </a>
        <!-- Navbar Section Starts Here -->
        
        <div class="navigation-bar-container">
      <div class="nav-container">
        <div class="logo">
       
                   <a href="index.php" title="Logo">
                       <img src="images/admin-logo.png" alt=" Car Rental Logo" class="img-responsive">
                   </a> 
             
        </div>

        <div class="navbar1">
          <div class="nav-mobile">
            <a href="#" id="nav-toggle"><span></span></a>
          </div>
          <ul class="nav-list text-uppercase">
          <li><a href="index.php">Home</a></li>
          <li><a href="cars.php">Cars</a></li>
          <li><a href="faq.php">FAQ</a></li>

            <li>
              <a href="#">Bookings <i class="fa fa-caret-down"></i></a>
              <ul class="nav-dropdown">
                <li><a href="returncar.php">Return Car</a></li>
                <li><a href="my-bookings.php">My Bookings</a></li>
              </ul>
            </li>

            <li>
              <a href="#"> <?php echo $_SESSION['username'] ?><i class="fa fa-caret-down"></i></a>
              <ul class="nav-dropdown">
              <li><a href="my-profile.php">View Profile</a></li>
                <li><a href="change-password.php">Change Password</a></li>
                <li><a href="logout.php">Logout</a></li>
              </ul>
            </li>

          </ul>
        </div>
      </div>
    </div>

   
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/main.js"></script>
<?php } ?>
    <!-- Navbar Section Ends Here -->