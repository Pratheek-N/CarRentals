

<!DOCTYPE html>
<html lang="en">
<head>
  <title>D P Car Rentals</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="admin/assets/css/bootstrap.min.css"> -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="shortcut icon" sizes="144x144" href="images/favicon.png">
  <style>
  /* Make the image fully responsive */
  *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
  }
  .vid{
    width: 100%;
    height: 90vh;
    object-fit: fill;
  }
  .carousel-inner img{
    background-color: #f1f2f6;
    width: 100%;
    height: 90vh;
  }
  
  .aboutimg{
      width: 100%;
      height: 300px;
  }
  #contact{
    font: 400 15px/1.8 "Lato", sans-serif;
    color: #ffff;

  }
  .submit.btn-style {
    background-color: #e02c2b;
    border: medium none;
    cursor: pointer;
    margin-top: 30px;
    color: #fff;
    font-weight: 600;
}
.btn-style {
    
    font-size: 14px;
    padding: 14px 20px 12px;
    text-align: center;
    text-transform: uppercase;
    transition: all 0.3s ease 0s;
    display: block;
}
.submit.btn-style:hover {
    background-color: #242424;
}
  </style>
</head>
<body>
<?php include 'menubar.inc.php';
// Returned cars
$sql4="SELECT * FROM rentedcars rc, users u, cars c WHERE  c.id = rc.car_id AND rc.return_status = 'R' and u.username = rc.customer_username ";
$res4= mysqli_query($conn,$sql4);
$row4= mysqli_num_rows($res4);                        
// Total Bookings

$sql6="SELECT * FROM rentedcars rc, users u, cars c WHERE  c.id = rc.car_id and u.username = rc.customer_username ";
$res6= mysqli_query($conn,$sql6);
$row6= mysqli_num_rows($res6);
// Total Cars
$sql="select * from cars";
$res= mysqli_query($conn,$sql);
$row= mysqli_num_rows($res);

// Total Users
$sql3="select * from users where status='active'";
$res3= mysqli_query($conn,$sql3);
$row3= mysqli_num_rows($res3);
                       

?>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
    <video class="vid" autoplay muted>
      <source src="images/home/banner3.mp4" type="video/mp4">
    </video>
     
    </div>
    <div class="carousel-item">
    <img src="images/home/banner5.jpg" width="1100" height="500">
   
</div>
      <div class="carousel-item">
      <img src="images\home\banner2.jpg" width="1100" height="500">
     </div>
  </div>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#carouselExampleIndicators" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>


<section  style="padding-bottom:20px;background-color: #f1f2f6; line-height:30px; font-size:16px;">
<div class="py-5">
    <h1 class="text-center">About Us</h1>
</div><div class="container-fluid">
<div class="row">
    <div class="col-lg-5 col-md-6 col-12">
        <img src="https://images.pexels.com/photos/70912/pexels-photo-70912.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="image-fluid aboutimg" alt="">
    </div>
    <div class="col-lg-7 col-md-6 col-12">
    <div class="wrapper">
    <h1 class="static-txt">DP</h1>
    <ul class="dynamic-txts">
      <li><span>Car Rentals</span></li>
      <li><span>Car Hire Agency</span></li>
      <li><span>Rental Services</span></li>
      <!-- <li><span>Freelancer</span></li> -->
    </ul>
  </div>
      
      <p class="py-2">We offer a varied fleet of cars, ranging from the compact. All our vehicles have AC and Non AC,  power steering, electric windows. All our vehicles are bought and maintained at official dealerships only. Automatic transmission cars are available in every booking class. As we are not affiliated with any specific automaker, we are able to provide a variety of vehicle makes and models for customers to rent.
ur mission is to be recognised as the global leader in Car Rental for companies and the public and private sector by partnering with our clients to provide the best and most efficient Car Rental solutions and to achieve service excellence.</p></div>
</div></div>

</section>

    <!-- Fun Facts-->
<section class="fun-facts-section">
  <div class="container div_zindex">
    <div class="row">
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><?php if($row3>0){
               echo $row3 ;
              }else{ echo '0';} ?></h2>
            <p>Registered Users</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><?php if($row>0){
               echo $row ;
              }else{ echo '0';} ?></h2>
            <p>Total Cars</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><?php if($row6>0){
               echo $row6 ;
              }else{ echo '0';} ?></h2>
            <p>Total Bookings</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><?php if($row4>0){
               echo $row4 ;
              }else{ echo '0';} ?></h2>
            <p>Satisfied Customers</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Fun Facts--> 

<!--Testimonial -->
<section class="section-padding testimonial-section parallex-bg">
  <!-- Container (Contact Section) -->
<div class="w3-content w3-container w3-padding-64" id="contact">
        <h2 class="w3-center" style="color:white;">WHERE WE WORK</h2>
        <p class="w3-center"><?php
			                 echo $_SESSION['c-msg']; 
                            
                                $_SESSION['c-msg'] = "We love your feedback!!"; ?>
                             </p>
        <div class="w3-row w3-padding-32 w3-section">
            <div class="w3-col m4 w3-container">
                <!-- Add Google Maps -->
                <div id="googleMap" class="w3-round-large" style="position:relative; right:120px;">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.948256785641!2d75.03907531413458!3d12.911047219699062!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba4a619d91ee0b5%3A0xfdb962cb4b511ad7!2sShri%20Venkatramana%20Swami%20College!5e0!3m2!1sen!2sin!4v1631515081437!5m2!1sen!2sin" class="w3-greyscale" width="400" height="270" style="border:1; opacity:0.8;" 
                allowfullscreen="" loading="lazy"></iframe></div>
              </div>
            <div class="w3-col m8 w3-panel">
                <div class="w3-large w3-margin-bottom">
                    <i class="fa fa-map-marker fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Bantwal, India<br>
                    <i class="fa fa-phone fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Phone: 9448167685,8197180139<br>
                    <i class="fa fa-envelope fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Email: dpcarrentals.svs@gmail.com<br>
                </div>
                <p>New to DP Car Rentals ? Drop Your Details and Leave it on us We'll Revert</p>
<?php if (!isset($_SESSION['username'])){?>

                <form action="contact-us-submit.php" method="POST">
                    <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
                        <div class="w3-half input1">
                            <input class="w3-input w3-border" type="text" placeholder="Name" required name="name">
                        </div>
                        <div class="w3-half input1">
                            <input class="w3-input w3-border" type="text" placeholder="Email" required name="email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" >
                        </div>
                    </div>
                    <div class="input1">
                    <input class="w3-input w3-border"  type="text" placeholder="Message"  required name="message">
                    </div>
                    
                    <button class="submit btn-style" type="submit">
                <i class="fa fa-paper-plane"></i> SEND MESSAGE
              </button>
                </form>
                <?php }else{
      $username=$_SESSION['username']; 
      $sql="select * from users where username='$username'";
      $res=mysqli_query($conn,$sql);
      while($row=mysqli_fetch_assoc($res)){
        $name=$row['username'];
        $email=$row['email'];
      } ?>
       <form action="contact-us-submit.php" method="POST">
                    <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
                        <div class="w3-half input1">
                            <input class="w3-input w3-border" type="text" placeholder="Name"  name="name" value="<?php echo "$name" ?>">
                        </div>
                        <div class="w3-half input1">
                            <input class="w3-input w3-border" type="text" placeholder="Email"  name="email" value="<?php echo "$email"?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" >
                        </div>
                    </div>
                    <div class="input1">
                    <input class="w3-input w3-border"  type="text" placeholder="Message"  required name="message">
                    </div>
                    <button class="submit btn-style" type="submit">
                <i class="fa fa-paper-plane"></i> SEND MESSAGE
              </button>
           
              
                </form>
    <?php } ?>

            </div>
        </div>
    </div>
     
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Testimonial--> 


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php include 'footer.inc.php';?>
