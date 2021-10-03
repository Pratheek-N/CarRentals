
<!DOCTYPE html>
      <html lang="en">
      <head>
              <meta charset="UTF-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Admin-Manage Bookings</title>
    <link rel="shortcut icon" sizes="144x144" href="../images/favicon.png">
      <body>

<?php include 'partials/admin-header.php';



if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($conn,$_GET['type']);
	if($type=='return_request'){
		$operation=get_safe_value($conn,$_GET['operation']);
		$order_id=get_safe_value($conn,$_GET['order_id']);
		if($operation=='requested'){
			$retreq='1';
		}else{
			$retreq='0';
		}
		$update_status_sql="update rentedcars set return_request='$retreq' where order_id='$order_id'";
		mysqli_query($conn,$update_status_sql);
	}}


        $sql2 = "SELECT * FROM rentedcars rc, users u, cars c WHERE  c.id = rc.car_id AND rc.return_status = 'NR' and u.username = rc.customer_username ";
    $result2 = $conn->query($sql2);
    
   $sql1 = "SELECT * FROM rentedcars rc, users u, cars c WHERE  c.id = rc.car_id AND rc.return_status = 'R' and u.username = rc.customer_username ";

   $result1 = $conn->query($sql1);
    if (mysqli_num_rows($result1) > 0) {
      ?>
      
      <div class="content pb-0" id="test">
              <div class="orders">
                 <div class="row">
                    <div class="col-xl-12">
                       <div class="card">
                          <div class="card-body">
                             <h4 class="box-title">Returned Cars </h4>
                             <!-- <h4 class="box-link"><a href="add_cars.php">ADD CARS</a></h4> -->
      
                          </div>
                          <div class="card-body--">
                             <div class="table-stats order-table ov-h">
                                <table class="table ">
                                   <thead>
                                      <tr>
                                         <th>Sl.No</th>
                                         <th>Username</th>
                                         <th>Email</th>
                                         <th>Phone Number</th>
                                         <th>Car Name</th>
                                         <th>Brand</th>
                                         <th>Number Plate</th>
                                         <th>Rent Start date</th>
                                         <th>Rent End date</th>
                                         <th>Car Returned Date</th>
                                         <th>Distance</th>
                                         <th>Price</th>
      
                                      </tr>
                                   </thead>
                                   <?php
                                      $i=1;
                                         while($row = mysqli_fetch_assoc($result1)) {
                                   ?>
                                   <tbody>
                                   <tr>
                                      <td><?php echo $i; ?></td>
                                      <td><?php echo $row["username"]; ?></td>
                                      <td class="text-lowercase"><?php echo $row["email"]; ?></td>
                                      <td><?php echo $row["mblno"]; ?></td>
                                      <td><?php echo $row["car_name"]; ?></td>
                                      <td><?php echo $row["brand_id"]; ?></td>
                                      <td><?php echo $row["car_nameplate"]; ?></td>
                                      <td><?php echo $row["rent_start_date"] ?></td>
                                      <td><?php echo $row["rent_end_date"]; ?></td>
                                      <td><?php echo $row["car_return_date"]; ?></td>
                                      <td><?php if($row["distance"]>0){ 
                                         echo $row["distance"]; ?> km
                                         <?php }else{ 
                                            echo"Null"; 
                                            } ?></td>
                                      <td>&#8377; <?php echo $row["total_amount"]; ?></td>
                                      </tr>
                                   </tbody>
                                   <?php  $i++;      } ?>
                  </table>
                  </div> 
          <?php 
      
              
          }else {
            ?>
        
      <div class="content pb-0" id="test">
              <div class="orders">
                 <div class="row">
                    <div class="col-xl-12">
                       <div class="card">
                          <div class="card-body">
                             <h4 class="box-title text-center">Cars Returned</h4>
                             <!-- <h4 class="box-link"><a href="add_cars.php">ADD CARS</a></h4> -->
      
                          </div>
                          <div class="card-body--">
                             <div class="table-stats order-table ov-h">
                                <table class="table ">
                                   <thead>
                                      <tr>
                                <div class="jumbotron">
                                <h3 class="text-center">No cars returned</h3>
      
                                 </div>
      
                                      </tr>
                                   </thead>
                                   
                                   
                  </table>
                  </div> 
        <p> <?php echo $conn->error; ?> </p>
      </div>
      </div> <?php } ?>
      
                               
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
          </div>
          <?php

        if (mysqli_num_rows($result2) > 0) {
          
?>

<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Non Returned Cars </h4>
                           <!-- <h4 class="box-link"><a href="add_cars.php">ADD CARS</a></h4> -->

                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table">
                                 <thead>
                                    <tr>
                                       <th>Sl.No</th>
                                       <th>Username</th>
                                       <th width=8%>Email</th>
                                       <th>Phone Number</th>
                                       <th>Car Name</th>
                                       <th>Brand</th>
                                       <th>Number Plate</th>
                                       <th>Rent Start date</th>
                                       <th>Rent End date</th>
                                       <th>Return Request</th>
                                       <th>Check Car</th>
                                    </tr>
                                 </thead>
                                 <?php
                                    $i=1;
                                       while($row1 = mysqli_fetch_assoc($result2)) {
                                 ?>
                                 <tbody>
                                 <tr>
		                              

                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row1["username"]; ?></td>
                                    <td class="text-lowercase"><?php echo $row1["email"]; ?></td>
                                    <td><?php echo $row1["mblno"]; ?></td>
                                    <td><?php echo $row1["car_name"]; ?></td>
                                    <td><?php echo $row1["brand_id"]; ?></td>
                                    <td><?php echo $row1["car_nameplate"]; ?></td>
                                    <td><?php echo $row1["rent_start_date"] ?></td>
                                    <td><?php echo $row1["rent_end_date"]; ?></td>
                                    <td><?php
								                  if($row1['return_request']==1){
								                  	echo "<p class='badge badge-success'>Requested</p>";
								                  }else{
								                  	echo "<p class='badge badge-pending's>Not requested</p>";
								                  }?></td>
                                    <td><?php
                                    if($row1['pay_request']==1){
                                       echo"<p class='badge badge-success'>Checked</p>";
                                       }elseif($row1['return_request']==1){
								               echo"<a class='badge badge-edit hand_cursor' href='checkcar.php?order_id=".$row1['order_id']."'>Check</a>";
                                       }else{
                                          echo "<p></p>";
                                       }
                                       ?>
                                    </td>
                                    
								
                                    </tr>
                                 </tbody>
                                 <?php  $i++;      } ?>
                </table>
                </div> 
        <?php  
    }else {
      ?>
  
<div class="content pb-0" id="test">
        <div class="orders">
           <div class="row">
              <div class="col-xl-12">
                 <div class="card">
                    <div class="card-body">
                       <h4 class="box-title text-center">Non Returned Cars</h4>
                       <!-- <h4 class="box-link"><a href="add_cars.php">ADD CARS</a></h4> -->

                    </div>
                    <div class="card-body--">
                       <div class="table-stats order-table ov-h">
                          <table class="table ">
                             <thead>
                                <tr>
                          <div class="jumbotron">
                          <h3 class="text-center">No Data Found</h3>

                           </div>

                                </tr>
                             </thead>
                             
                             
            </table>
            </div> 
  <p> <?php echo $conn->error; ?> </p>
</div>
</div> <?php } ?>
        
                             
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>


         <?php include 'partials/admin-footer.php'  ?>