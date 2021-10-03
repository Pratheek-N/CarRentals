
        
      <!DOCTYPE html>
      <html lang="en">
      <head>
              <meta charset="UTF-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Admin-Dashboard</title>
    <link rel="shortcut icon" href="../images/favicon.png">

      </head>
      <body>
      <?php include 'partials/admin-header.php';
        ?>
      <div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Dashboard </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
				 </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
                
      
        <section class="menu-content">

        <!-- Total Revenue -->
        <a class="dashboard-details" href="">
                <div class="sub-menu">
                        <?php 
                        $total_income="";
                        $sql7="select SUM(total_amount) as total_amount from rentedcars where return_status='R'";
                        $res7= mysqli_query($conn,$sql7);
                        if(mysqli_num_rows($res7)>0){
                                while($row7 = mysqli_fetch_assoc($res7)) {
                                        $total_income=$row7["total_amount"];
                                      
                                }
                        };
                        
                        ?>
                <h4 class="dash-heading"> TOTAL REVENUE</h4><br>
                <h2> Rs.<?php echo $total_income ?></h2>
                </div> 
                </a> 

                <!-- Monthly Revenue -->
                <a class="dashboard-details" href="">
                <div class="sub-menu">
                        <?php 
                        function getSale($start,$end){
                                global $conn;
                                $sql9="select sum(total_amount) as total_amount from rentedcars where car_return_date between '$start' and '$end' and return_status='R'";
                                $res9=mysqli_query($conn,$sql9);
                                
                                while($row9=mysqli_fetch_assoc($res9)){
                                        return $row9['total_amount'];
                                }
                        }
                        $start=strtotime(date('Y-m-d'));
			$start=strtotime("-30 day",$start);
			$start=date('Y-m-d',$start);
			$end=date('Y-m-d'). ' 23-59-59';
                        ?>
                <h4 class="dash-heading"> MONTHLY REVENUE</h4><br>
                <h2> Rs.<?php echo getSale($start,$end); ?></h2>
                </div> 
                </a> 

                <!-- Weekly Revenue -->
                <a class="dashboard-details" href="">
                <div class="sub-menu">
                        <?php 
                        $start=strtotime(date('Y-m-d'));
			$start=strtotime("-7 day",$start);
			$start=date('Y-m-d',$start);
			$end=date('Y-m-d'). ' 23-59-59';
                        ?>
                <h4 class="dash-heading"> WEEKLY REVENUE</h4><br>
                <h2> Rs.<?php echo getSale($start,$end); ?></h2>
                </div> 

                <!-- Daily Revenue -->
                </a>   
                <a class="dashboard-details" href="">
                <div class="sub-menu">
                        <?php 
                        $start=date('Y-m-d'). ' 00-00-00';
			$end=date('Y-m-d'). ' 23-59-59';
                        ?>
                <h4 class="dash-heading"> TODAY'S REVENUE</h4><br>
                <h2> Rs.<?php echo getSale($start,$end); ?></h2>
                </div> 
                </a> 

                <!-- BOOKINGS -->
                <a class="dashboard-details" href="manage-bookings.php">
                <div class="sub-menu">
                        <?php 
                        $sql4="SELECT * FROM rentedcars rc, users u, cars c WHERE  c.id = rc.car_id AND rc.return_status = 'R' and u.username = rc.customer_username ";
                        $res4= mysqli_query($conn,$sql4);
                        $row4= mysqli_num_rows($res4);
                        
                        $sql5="SELECT * FROM rentedcars rc, users u, cars c WHERE  c.id = rc.car_id AND rc.return_status = 'NR' and u.username = rc.customer_username ";
                        $res5= mysqli_query($conn,$sql5);
                        $row5= mysqli_num_rows($res5);

                        $sql6="SELECT * FROM rentedcars rc, users u, cars c WHERE  c.id = rc.car_id and u.username = rc.customer_username ";
                        $res6= mysqli_query($conn,$sql6);
                        $row6= mysqli_num_rows($res6);
                        ?>
                <h4 class="dash-heading"> BOOKINGS</h4><br>
                <h5>Cars Returned:<?php echo $row4 ?></h5>
                <h5>Not Returned:<?php echo $row5 ?></h5><br>
                <h4>Total:<?php echo $row6 ?></h4>
                </div> 
                </a>  

                <!-- Users -->
                <a class="dashboard-details" href="manage-users.php">
                <div class="sub-menu">
                        <?php 
                        $sql3="select * from users where status='active'";
                        $res3= mysqli_query($conn,$sql3);
                        $row3= mysqli_num_rows($res3);
                        
                        ?>
                <h4 class="dash-heading"> USERS</h4><br>
                <h1> <?php echo $row3 ?></h1>
                </div> 
                </a> 

                <!-- Available Cars -->
                <a class="dashboard-details" href="manage-cars.php">
                <div class="sub-menu">
                        <?php 
                        $sql="select * from cars where status=1";
                        $res= mysqli_query($conn,$sql);
                        $row= mysqli_num_rows($res);
                        
                        ?>
                <h4 class="dash-heading">AVAILABLE CARS</h4><br>
                <h1> <?php echo $row ?></h1>
                </div> 
                </a>    

                <!-- Car Types -->  
                <a class="dashboard-details" href="manage-car-types.php">
                <div class="sub-menu">
                        <?php 
                        $sql1="select * from car_type where status=1";
                        $res1= mysqli_query($conn,$sql1);
                        $row1= mysqli_num_rows($res1);
                        
                        ?>
                <h4 class="dash-heading"> CAR TYPES</h4><br>
                <h1> <?php echo $row1 ?></h1>
                </div> 
                </a>  

                <!-- Brands -->
                <a class="dashboard-details" href="manage-brands.php">
                <div class="sub-menu">
                        <?php 
                        $sql2="select * from BRANDS where status=1";
                        $res2= mysqli_query($conn,$sql2);
                        $row2= mysqli_num_rows($res2);
                        ?>
                <h4 class="dash-heading"> BRANDS</h4><br>
                <h1> <?php echo $row2 ?></h1>
                </div> 
                </a>  
                 
                 <!-- feedbacks -->
                 <a class="dashboard-details" href="contact-us.php">
                <div class="sub-menu">
                        <?php 
                        $sql7="select * from contact_us";
                        $res7= mysqli_query($conn,$sql7);
                        $row7= mysqli_num_rows($res7);
                        
                        ?>
                <h4 class="dash-heading"> FEEDBACKS</h4><br>
                <h1> <?php echo $row7 ?></h1>
                </div> 
                </a> 
        </section>
     
 <?php include 'partials/admin-footer.php'?>


