


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D P Car Rentals | Cars</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="admin/assets/css/bootstrap.min.css">
    <link rel="shortcut icon" sizes="144x144" href="images/favicon.png">

    <link rel="stylesheet" href="css/cars.css">
</head>
<body>


    <?php include('menubar.inc.php'); ?>


  <!-- Car sEARCH Section Starts Here -->
  <section class="search text-center">
        <div class="container">
            
            <form action="search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Cars.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-secondary">
            </form>

        </div>
    </section>
    <!-- Car sEARCH Section Ends Here -->

    

<!-- Brands Section Starts Here -->
<section class="brands">
    <h2 class="text-center container">Brands</h2>

        <div class="brands-content">
        
    <?php   
        $sql = "SELECT * FROM BRANDS WHERE STATUS=1";                                                     
        $result= mysqli_query($conn,$sql);

        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)){
                                            
                
                $car_brand = $row["brands"];
                $image = $row["image"];
    ?>
        <a class="brand-details" href="brands.php?brands=<?php echo $row["brands"]; ?>">
            <div class="brands-menu">
            <img class="card-img" src="<?php echo CAR_IMAGE_SITE_PATH.$image?>" alt="Card image cap">
            <h6 class="brand-details"><?php echo $car_brand; ?></h6>
            
            </div> 
        </a>
        <?php }}
            else {
        ?>
        <h1> No Brands available :( </h1>
        <?php
            }
        ?>    
        </div>                               
    </section>
    <!-- Brands Section Ends Here -->


    
    <!-- Car Types secion Starts Here -->
    <section class="car-types">
        <h2 class="text-center container">Car Types</h2>
        <div class="type-content">
        
    <?php   
        $sql2 = "SELECT * FROM car_type WHERE STATUS=1";                                                     
        $result2= mysqli_query($conn,$sql2);

        if(mysqli_num_rows($result2) > 0) {
            while($row2 = mysqli_fetch_assoc($result2)){
                                            
                
                $car_type = $row2["car_type"];
                
    ?>
        <a  class="type-details" href="car_type.php?car_type=<?php echo $row2["car_type"]; ?>">
            <div class="type-menu">
           
            <h4 class="type-details"><?php echo $car_type; ?></h4>
            
            </div> 
        </a>
        <?php }}
            else {
        ?>
        <h1> No Car Types available :( </h1>
        <?php
            }
        ?>    
        </div>     

    </section>
    <!-- Car Types section ends Here -->


    <!-- Available Cars Section Starts Here -->
    <?php $sql2="select count(car_name) as count from cars where status=1";
                                    $result2= mysqli_query($conn,$sql2);
                                    while($row2=mysqli_fetch_assoc($result2)){

                                        $count=$row2['count'];

                                    }  ?>
    <section class="latest-cars">
        <div class="container1">
            <h2 class="text-center">Currently Available Cars</h2>
            <h4 class="text-center">(<?php echo $count ?>)</h4>

                <div id="sec2">
                     
                        <br>
                            <section class="menu-content">
                                  
                                      <!-- Available Cars               -->
                                <?php   
                                    
                                    $sql1 = "select * from cars where status=1 order by id desc";    
                                                 
                                    $result1 = mysqli_query($conn,$sql1);
                                    
                                    
                                            
                                    if(mysqli_num_rows($result1) > 0) {
                                        while($row1 = mysqli_fetch_assoc($result1)){
                                            
                                            
                                            $car_id = $row1["id"];                                   
                                            $car_name = $row1["car_name"];
                                            $car_brand = $row1["brand_id"];
                                            $car_type = $row1["type_id"];
                                            $ac_price = $row1["ac_price"];
                                            $ac_price_per_day = $row1["ac_price_per_day"];
                                            $non_ac_price = $row1["non_ac_price"];
                                            $non_ac_price_per_day = $row1["non_ac_price_per_day"];
                                            $image = $row1["image"];
                                            
										
                                            $sql2="select count(car_name) as count from cars where status=1 and car_name='$car_name'";
                                    $result2= mysqli_query($conn,$sql2);
                                    while($row2=mysqli_fetch_assoc($result2)){

                                        $count=$row2['count'];

                                    }
                                   
                                       
                                            ?>
                                            <a class="car-details" href="bookings.php?id=<?php echo $car_id ?>">
                                            <div class="sub-menu">
                                            

                                                <img class="card-img-top" src="<?php echo CAR_IMAGE_SITE_PATH.$image?>" alt="Card image cap">
                                                <h5 class="car-details"> <?php echo $car_name; ?> </h5>
                                                <h6><?php echo $car_brand; ?></h6>
                                                <h6> Car Type: <?php echo $car_type; ?></h6>
                                                <h6> AC Fare: <?php echo ("₹" . $ac_price . "/km & ₹" . $ac_price_per_day . "/day"); ?></h6>
                                                <h6> Non-AC Fare: <?php echo ("₹" . $non_ac_price . "/km & ₹" . $non_ac_price_per_day . "/day"); ?></h6>
                                                <h6>No. of <?php echo $car_name ?> car available: <?php echo $count; ?></h6>
            
                                            </div> 
                                            </a>
                                            <?php }}
                                              else {
                                                    ?>
                                                    <h1> No cars available :( </h1>
                                                    <?php
                                                    }
                                                    ?>


                                <!-- Car Not Available -->

                                    <?php   
                                   
                                    $sql5 = "select * from cars where status=0 order by id desc";    
                                                 
                                    $result5 = mysqli_query($conn,$sql5);
                                    
                                    
                                            
                                    if(mysqli_num_rows($result5) > 0) {
                                        while($row5 = mysqli_fetch_assoc($result5)){
                                            
                                            
                                            $car_id = $row5["id"];                                   
                                            $car_name = $row5["car_name"];
                                            $car_brand = $row5["brand_id"];
                                            $car_type = $row5["type_id"];
                                            $ac_price = $row5["ac_price"];
                                            $ac_price_per_day = $row5["ac_price_per_day"];
                                            $non_ac_price = $row5["non_ac_price"];
                                            $non_ac_price_per_day = $row5["non_ac_price_per_day"];
                                            $image = $row5["image"];
                                            
										
                                            $sql6="select count(car_name) as count from cars where status=0 and car_name='$car_name'";
                                    $result6= mysqli_query($conn,$sql6);
                                    while($row6=mysqli_fetch_assoc($result6)){

                                        $count2=$row6['count'];

                                    }
                                         ?>
                                            
                                            <div class="sub-menu" style="opacity: 0.6;">
                                            

                                                <img class="card-img-top" src="<?php echo CAR_IMAGE_SITE_PATH.$image?>" alt="Card image cap">
                                                <h5 class="car-details"> <?php echo $car_name; ?> </h5>
                                                <h6><?php echo $car_brand; ?></h6>
                                                <h6> Car Type: <?php echo $car_type; ?></h6>
                                                <h6> AC Fare: <?php echo ("₹" . $ac_price . "/km & ₹" . $ac_price_per_day . "/day"); ?></h6>
                                                <h6> Non-AC Fare: <?php echo ("₹" . $non_ac_price . "/km & ₹" . $non_ac_price_per_day . "/day"); ?></h6>
                                                
                                                <h6 style="color:red;">This Car Is Not available now...Please Stay Tuned.!</h6>
            
                                            </div> 
                                            
                                            <?php }}
                                              
                                                    ?>   
                            </section>
                    
                </div>

           
            <div class="clearfix"></div> 

            

        </div>

    </section>
    <!-- Available Cars Section Ends Here -->
    

<?php include('footer.inc.php'); ?>
