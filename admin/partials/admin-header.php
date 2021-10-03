<?php 

session_start();
include 'functions.inc.php';

if (!isset($_SESSION['adminname'])) {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html class="no-js" lang="">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
  <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>



<aside id="left-panel" class="left-panel">
         <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
               <ul class="nav navbar-nav">
                  <li class="menu-title">Menu</li>
                  <li class="menu-item-has-children dropdown">
                     <a href="adminpage.php" > Dashboard</a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="manage-cars.php" > Manage Cars</a>
                  </li>

                  <li class="menu-item-has-children dropdown">
                     <a href="manage-brands.php" > Manage Brands</a>
                  </li>

                  <li class="menu-item-has-children dropdown">
                     <a href="manage-car-types.php" > Manage Car Types</a>
                  </li>

                  <li class="menu-item-has-children dropdown">
                     <a href="manage-users.php" > Manage Users</a>
                  </li>
				      <li class="menu-item-has-children dropdown">
                     <a href="manage-bookings.php" > Manage Bookings</a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="contact-us.php" > Feedback</a>
                  </li>
               </ul>
            </div>
         </nav>
      </aside>
      <div id="right-panel" class="right-panel">
         <header id="header" class="header">
            <div class="top-left">
               <div class="navbar-header">
                  <a class="navbar-brand" href="adminpage.php"><img src="../images/admin-logo.png" alt="Logo"></a>
                  <a class="navbar-brand hidden" href="adminpage.php"><img src="../images/admin-logo.png" alt="Logo"></a>
                  <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
               </div>
            </div>
            <div class="top-right">
               <div class="header-menu">
                  <div class="user-area dropdown float-right">
                     <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome <?php  echo $_SESSION['adminname'];  ?></a>
                     <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i>Logout</a>
                     </div>
                  </div>
               </div>
            </div>
         </header>