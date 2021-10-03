

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D P Car Rentals | Return Car</title>
    <link rel="shortcut icon" sizes="144x144" href="images/favicon.png">

<style>
.badge1-complete {
  background: #28A745;
}

.badge1-pending {
  background: #fb9678;
}
.badge1-edit{
  background-color: #ff4757;
}
.badge1:hover{
  color:#ffff;
  background-color: red;
}
.p1:hover{
  background-color: #28A745;
  
}

.badge1 {
  display: inline-block;
  font-size: 75%;
  line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25rem;
    color: white;
    padding: 6px;
    text-transform: uppercase;
    font-weight: 500;

}


</style>
</head>
<body>


<?php 
include('menubar.inc.php');

function get_safe_value($conn,$str){
  if($str!=''){
     $str=trim($str);
     return mysqli_real_escape_string($conn,$str);
  }
}
function dateDiff($start, $end) {
  $start_ts = strtotime($start);
  $end_ts = strtotime($end);
  $diff = $end_ts - $start_ts;
  return round($diff / 86400);
}


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
	}
  if($type=='cancel'){
		$order_id=get_safe_value($conn,$_GET['order_id']);
    $carid=get_safe_value($conn,$_GET['car_id']);
		$delete_sql="delete from rentedcars where order_id='$order_id'";
		mysqli_query($conn,$delete_sql);
    $update_sql="update cars set status='1' where id='$carid'";
		mysqli_query($conn,$update_sql);

	}
}

$login_customer = $_SESSION['username']; 

    $sql1 = "SELECT * FROM rentedcars rc, cars c
    WHERE rc.customer_username='$login_customer' AND c.id=rc.car_id AND rc.return_status='NR'";
    $result1 = $conn->query($sql1);

    if (mysqli_num_rows($result1) > 0) {
?>
<div class="container">
      <div class="jumbotron">
        <h1>Return your cars here</h1>
        <p> Hope you enjoyed our service </p>
      </div>
    </div>

    <div class="table-responsive" style="padding-left: 100px; padding-right: 100px;" >
<table class="table table-striped">
  <thead class="thead-dark">
<tr>
<th width="20%">Car</th>
<th width="20%">Brand</th>
<th width="20%">Rent Start Date</th>
<th width="20%">Rent End Date</th>
<th width="20%">Fare</th>
<th >Action</th>
<th>Bill</th>
</tr>
</thead>
<?php
        while($row = mysqli_fetch_assoc($result1)) {
?>
<tr>
<td><?php echo $row["car_name"]; ?></td>
<td><?php echo $row["brand_id"]; ?></td>
<td><?php echo $row["rent_start_date"] ?></td>
<td><?php echo $row["rent_end_date"]; ?></td>
<td>&#8377;<?php 
    if($row["charge_type"] == "day"){
        echo ($row["fare"] . "/day");
    } else {
        echo ($row["fare"] . "/km");
    }
$rent_start_date= $row["rent_start_date"];
$today_date=date("y-m-d");
$today=strtotime($today_date);
$rstart_date=strtotime($rent_start_date);
?></td>
<td><?php
								if($row['return_request']==0)
                {
                  if($today>$rstart_date){
									  echo "<a class='badge1 badge1-edit' style='text-decoration:none; color:#fff;' href='?type=return_request&operation=requested&order_id=".$row['order_id']."'>Return Request</a>&nbsp;";
                  }
                  else{
                    echo"<a class='badge1 badge1-pending' style='text-decoration:none; background-color:red; color:#fff;' href='?type=cancel&order_id=".$row['order_id']."&car_id=".$row['car_id']."'>Cancel Now</a>&nbsp;";
                  }
								}else
                {
									echo "<p class='badge1 p1 badge1-complete'>Return Requested</p>&nbsp;";
								}
               ?></td>
               <td><?php
								if($row['pay_request']==0)
                
                {
									echo "<p></p>&nbsp;";
								}else
                {
									echo "<a class='badge1 badge1-edit' style='text-decoration:none; color:#fff;' href='paybill.php?order_id=".$row['order_id']."'>Pay Bill</a>&nbsp;";
								}
               ?></td>
</tr>
<?php        } ?>
                </table>
                </div> 
        <?php } else {
            ?>
            <div class="container">
      <div class="jumbotron">
        <h1>No cars to return.</h1>
        <p> Hope you enjoyed our service </p>
      </div>
    </div>

            <?php
        } ?>   
<div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            <h6><strong>Kindly Note:</strong> Once you click <span class="text-danger">return request</span>, Admin will check your rented car and send bill, you will get bill here and through mail.</h6>
        </div>


<?php include('footer.inc.php'); ?>
</body>
</html>