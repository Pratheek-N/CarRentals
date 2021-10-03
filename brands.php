


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D P Car Rentals | Cars</title>
    <link rel="shortcut icon" sizes="144x144" href="images/favicon.png">

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="admin/assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/cars.css">
</head>
<body>


    <?php include('menubar.inc.php');  
                $brand_id = $_GET["brands"];
                ?>


    <!-- Available Cars Section Starts Here -->
    <section class="latest-cars">
        <div class="container1">
            <h2 class="text-center"><?php echo $brand_id ?></h2>
            <div id="sec2">
                      <br>
                      <section class="menu-content">
                <?php  
                $sql="select *from cars where status=1";
                $res=mysqli_query($conn,$sql);
                $count=mysqli_num_rows($res);
                if($count>0)
                {
                    
                    // Cars Available
                    while($row1 = mysqli_fetch_assoc($res)){
                        if($brand_id==$row1['brand_id']){
                                            
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

                            $count=$row2['count'];}
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
                        
                <?php }
                 }}
                else
                {?>
                   <h1> Data Not Found :( </h1>
                    
                <?php }

                ?>
                
                     

</section>
            

</div>
<div class="clearfix"></div> 

            

</div>

</section>



           
    <!-- Available Cars Section Ends Here -->



<?php include('footer.inc.php'); ?>
