

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a car</title>
    <link rel="shortcut icon" sizes="144x144" href="images/favicon.png">
    <script type="text/javascript" src="assets/ajs/angular.min.js"> </script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>  
  <script type="text/javascript" src="assets/js/custom.js"></script> 
 <link rel="stylesheet" type="text/css" media="screen" href="css/car-book.css" />
</head>
<body ng-app="">
    
<?php include 'menubar.inc.php' ?>



        <?php
        function dateDiff($start, $end) {
          $start_ts = strtotime($start);
          $end_ts = strtotime($end);
          $diff = $end_ts - $start_ts;
          return round($diff / 86400);
      }
        $car_id = $_GET["id"];
        $sql1 = "select * from cars where status=1 and cars.id = '$car_id'";
        

        $result1 = mysqli_query($conn, $sql1);
       


        if(mysqli_num_rows($result1)){
            while($row1 = mysqli_fetch_assoc($result1)){
                
                $car_name = $row1["car_name"];
                $car_brand = $row1["brand_id"];
                $car_type = $row1["type_id"];
                $car_nameplate = $row1["car_nameplate"];
                $ac_price = $row1["ac_price"];
                $non_ac_price = $row1["non_ac_price"];
                $ac_price_per_day = $row1["ac_price_per_day"];
                $non_ac_price_per_day = $row1["non_ac_price_per_day"];
                $max_km = $row1["max_km"];              
                $car_img = $row1["image"];
            
          }?>
          
<div class="container1" style="margin-top: 65px;" >
    <div class="col-md-7" style="float: none; margin: 0 auto;">
      <div class="form-area">
        <form role="form" action="bookingconfirm.php" method="post">
        <br style="clear: both">
          <h2 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Rent your dream car here </h2><br>
          <img class="card-img-top" src="<?php echo CAR_IMAGE_SITE_PATH.$car_img?>" alt="Card image cap">
          
              <h5> Car Name:&nbsp;  <?php echo($car_name);?></h5>
         
                <h5>Brand:&nbsp; <?php  echo($car_brand); ?></h5>
                <h5>Car Type:&nbsp; <?php  echo($car_type); ?></h5>
            <h5> Vehicle Number:&nbsp; <?php echo($car_nameplate);?></h5>
        <?php $today = date("Y-m-d") ?>
          <label><h5>Start Date:</h5></label>
            <input type="date" name="rent_start_date" placeholder="Enter date" min="<?php echo($today);?>" required="">
            &nbsp;
          <label><h5>End Date:</h5></label>
          <input type="date" name="rent_end_date" min="<?php echo($today);?>" required="">
        
        <h5> Choose your preference:  &nbsp;
            <input onclick="reveal()" type="radio" name="radio" value="ac" ng-model="myVar" required> AC &nbsp;
            <input onclick="reveal()" type="radio" name="radio" value="non_ac" ng-model="myVar"> Non-AC
                
        
        <div ng-switch="myVar"> 
        <div ng-switch-default>
                    

                     </div>
                    <div ng-switch-when="ac">
                   
                <h5>Fare: <?php echo("₹" . $ac_price . "/km and ₹" . $ac_price_per_day . "/day");?><h5>    
        <h5> Fuels Not Included</h5>
               
                     </div>
                     <div ng-switch-when="non_ac">
                     
                <h5>Fare: <?php echo("₹" . $non_ac_price . "/km and ₹" . $non_ac_price_per_day . "/day");?><h5>    
        <h5> Fuels Not Included</h5>
               
                     </div>
        </div>


         <h5> Choose charge type:  &nbsp;
            <input onclick="reveal()" type="radio" name="radio1" value="km" ng-model="charge" required> per km(s) &nbsp;
            <input onclick="reveal()" type="radio" name="radio1" value="day" ng-model="charge"> per day(s)
            <div ng-switch="charge"> 
        <div ng-switch-default>

                </div>
               <div ng-switch-when="km">

                </div>
                <div ng-switch-when="day">
           <h5>Max Km:  <?php echo( $max_km . "/day");?><h5>    
           
          
                </div>
   </div>
                <br>

            
            <input type="hidden" name="hidden_carid" value="<?php echo $car_id; ?>"> 
            <input type="checkbox" name="c" required> I Hereby,Accepts <a class="w3-text-red w3-hover-text-green" href="terms_and_conditions.php"> Terms & Conditions</a>
            <br><br>
            <div class="text-center ">         
           <input type="submit"name="submit" value="Book Now" class="btn btn-success w3-margin-top">   </div>  
        </form>
        
      </div>
      <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            <h6><strong>Kindly Note:</strong>1) You will be charged <span class="text-danger">₹200/-</span> for each day after the due date.</h6>
            <h6><strong></strong>2) You will be charged <span class="text-danger">₹15/-</span> for each extra km(s).</h6>

        </div>
    </div>
        <?php }else{  header('location:cars.php'); } ?>

        
             


<?php 
include 'footer.inc.php'  ?>

</body>
</html>