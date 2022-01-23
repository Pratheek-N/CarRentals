
<?php include 'menubar.inc.php' ;
$username=$_SESSION['username'];
$sql="SELECT * from users u where u.username='$username'";
$res=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($res)){
    $name=$row['username'];
    $email=$row['email'];
    $mblno=$row['mblno'];
    $dlno=$row['dl_no'];
  $date=$row['date'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
	<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">

</head>
<body >
	<div class="container">
     	<div class="row d-flex justify-content-center">
            <div class="col-md-10 mt-5 pt-5">
             	<div class="row z-depth-3">
                 	<div class="col-sm-4 rounded-left" style="background-color: #E05A47;">
        		        <div class="card-block text-center text-white">
                		    <i class="fas fa-user-tie fa-7x mt-5"></i>
							
                    		<h2 class="font-weight-bold text-white mt-4 "><?php echo "$name"?></h2>
                    		<a href="change-password.php" style="color:white">Change Password</a><br><br>
                            <!-- <i class="far fa-edit fa-2x mb-4"></i> -->
                		</div>
            		</div>
            		<div class="col-sm-8 bg-white rounded-right">
                    	<h2 class="mt-3 text-center">Profile Information</h2>
                        <hr style=" background-color:#E05A47;">

                   		<div class="row">
                        	<div class="col-sm-6">
                            	<p class="font-weight-bold">Email:</p>
                           		<h6 class=" text-muted"><?php echo "$email" ?></h6>
                        	</div>
                            <div class="col-sm-6">
                            	<p class="font-weight-bold">Phone:</p>
                           		<h6 class="text-muted"><?php echo "$mblno" ?></h6>
                        	</div><br>
                            <div class="col-sm-6">
                            	<p class="font-weight-bold">Driving License Number:</p>
                           		<h6 class=" text-muted"><?php echo "$dlno" ?></h6>
                        	</div>
                        	<div class="col-sm-6">
                            	<p class="font-weight-bold">Date Of Registration:</p>
                           		<h6 class=" text-muted"><?php echo "$date" ?></h6>
                        	</div>
                        	
                    	</div>
                    		<h4 class="mt-3 text-center">Bookings</h4>
                	   	<hr style=" background-color:#E05A47;">
                    		
                   		<div class="row">
                        	<div class="col-sm-4">
                           		<p class="font-weight-bold">Returned</p>
                                   <?php 
                        $sql2="select * from rentedcars rc ,users u where rc.customer_username='$name' and u.email='$email' and rc.return_status='R'";
                        $res2= mysqli_query($conn,$sql2);
                        $row2= mysqli_num_rows($res2);
                        
                        ?>
                          	  	<h6 class="text-muted"><?php echo"$row2"; ?></h6>
                        	</div>
                        	<div class="col-sm-4">
                            	<p class="font-weight-bold">Not Returned</p>
                                <?php 
                        $sql3="select * from rentedcars rc ,users u where rc.customer_username='$name' and u.email='$email' and rc.return_status='NR'";
                        $res3= mysqli_query($conn,$sql3);
                        $row3= mysqli_num_rows($res3);
                        
                        ?>
                            	<h6 class="text-muted"><?php echo"$row3"; ?></h6>
                        	</div>
                            <div class="col-sm-4">
                            	<p class="font-weight-bold">Total Bookings</p>
                                <?php 
                        $sql4="select * from rentedcars rc ,users u where rc.customer_username='$name' and u.email='$email'";
                        $res4= mysqli_query($conn,$sql4);
                        $row4= mysqli_num_rows($res4);
                        
                        ?>
                            	<h6 class="text-muted "><?php echo"$row4"; ?></h6>
                        	</div>
                    	</div>
                        <hr style=" background-color:#E05A47;">

                	    <ul class="list-unstyled d-flex justify-content-center mt-4">
            	        	
	               		</ul>  
              		</div>
             	</div>
            </div>
        </div>
	</div>
    <br><br>
</body>
</html>

<?php include 'footer.inc.php' ?>


