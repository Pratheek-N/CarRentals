<?php  include 'partials/admin-header.php'; 
error_reporting(0);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Bill</title>
    <link rel="shortcut icon" sizes="144x144" href="images/favicon.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bookingconfirm.css" />

</head>
<body>

<?php 
$id = $_GET["order_id"];
$distance = NULL;
$distance_or_days = $conn->real_escape_string($_POST['distance_or_days']);
$fare = $conn->real_escape_string($_POST['hid_fare']);
$total_amount = $distance_or_days * $fare;
$car_return_date = date('Y-m-d');
$return_status = "R";

// $login_customer = $_SESSION['username'];

$sql0 = "SELECT * FROM rentedcars rc, cars c WHERE rc.order_id = '$id' AND c.id = rc.car_id";
$result0 = $conn->query($sql0);

if(mysqli_num_rows($result0) > 0) {
    while($row0 = mysqli_fetch_assoc($result0)){
            $rent_end_date = $row0["rent_end_date"];  
            $rent_start_date = $row0["rent_start_date"];
            $car_name = $row0["car_name"];
            $car_nameplate = $row0["car_nameplate"];
            $charge_type = $row0["charge_type"];
            $max_km=$row0["max_km"];
            $bookingdate=$row0["booking_date"];
    }
}

function dateDiff($start, $end) {
    $start_ts = strtotime($start);
    $end_ts = strtotime($end);
    $diff = $end_ts - $start_ts;
    return round($diff / 86400);
}

$duration = dateDiff("$rent_start_date","$rent_end_date");
$total_days=dateDiff("$rent_start_date","$car_return_date");
$extra_days = dateDiff("$rent_end_date", "$car_return_date");
$advance_return=dateDiff("$car_return_date","$rent_end_date");
$total_fine = $extra_days*200;
$advance_return_payback=$advance_return*($fare/2);
if($extra_days>0) {
    $total_amount = $total_amount + $total_fine;  
    $result5 = $conn->query("update rentedcars set total_fine='$total_fine' where order_id='$id'");
}

if($charge_type == "day"){
    $distance_per_day= $conn->real_escape_string($_POST['distance_per_day']);
    $average_km=$distance_per_day/$total_days;
    $extra_km=$average_km-$max_km;
    $fine_km=$extra_km*15;

    if($average_km>$max_km){
        $total_amount = $total_amount + $fine_km;  
        $result6 = $conn->query("update rentedcars set total_fine='$fine_km' where order_id='$id'");
    }
    if($advance_return>0){
        $total_amount = $total_amount - $advance_return_payback;  
    }
    $no_of_days = $distance_or_days;
    $sql1 = "UPDATE rentedcars SET car_return_date='$car_return_date', no_of_days='$no_of_days', distance='$distance_per_day', total_amount='$total_amount' WHERE order_id = '$id' ";
} else {
    $distance = $distance_or_days;
    $sql1 = "UPDATE rentedcars SET car_return_date='$car_return_date', distance='$distance', no_of_days='$duration', total_amount='$total_amount' WHERE order_id = '$id' ";
}

$result1 = $conn->query($sql1);


?>

    <div class="container">
        <div class="jumbotron">
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span>Final Bill</h1>
        </div>
    </div>
    <br>


    <h3 class="text-center"> <strong>Order Number:</strong> <span style="color: blue;"><?php echo "$id"; ?></span> </h3>


    <div class="container">
        <div class="box">
            <div class="col-md-10" style="float: none; margin: 0 auto; text-align: center;">
               
                <h3 style="color: orange;">Invoice</h3>
                <br>
            </div>
            <div class="col-md-10" style="float: none; margin: 0 auto; ">
                <h4> <strong>Vehicle Name: </strong> <?php echo $car_name;?></h4>
                <br>
                <h4> <strong>Vehicle Number:</strong> <?php echo $car_nameplate; ?></h4>
                <br>
                <h4> <strong>Fare:&nbsp;</strong>  ₹<?php 
            if($charge_type == "day"){
                    echo ($fare . "/day");
                } else {
                    echo ($fare . "/km");
                }
            ?></h4>
                <br>
                <h4> <strong>Booking Date: </strong> <?php echo $bookingdate ?> </h4>
                <br>
                <h4> <strong>Start Date: </strong> <?php echo $rent_start_date; ?></h4>
                <br>
                <h4> <strong>Rent End Date: </strong> <?php echo $rent_end_date; ?></h4>
                <br>
                <h4> <strong>Car Return Date: </strong> <?php echo $car_return_date; ?> </h4>
                <br>
                <?php if($charge_type == "day"){
                    if($advance_return>0){?>
                    <h4> <strong>Discount:</strong> <label class="text-success">₹<?php echo $advance_return_payback; ?></label> for advance return of <?php echo $advance_return;?> Day</h4><br>

    <?php }?>
                    <h4> <strong>Number of days:</strong> <?php echo $distance_or_days; ?>day(s)</h4><br>
                    <h4> <strong>Distance Travelled:</strong> <?php echo $distance_per_day; ?>km(s)</h4>
                <?php } else { ?>
                    <h4> <strong>Distance Travelled:</strong> <?php echo $distance_or_days; ?>km(s)</h4>
                <?php } ?>
                <br>
                <?php
                    if($extra_days > 0){
                        if($charge_type=='day' && $average_km>$max_km){?>
                <h4> <strong>Extra Km Fine:</strong> <label class="text-danger"> ₹<?php echo $fine_km; ?>/- </label>for <?php echo $extra_km;?> extra Km(s) /Day.</h4><br>
                <h4> <strong>Extra Day Fine:</strong> <label class="text-danger"> ₹<?php echo $total_fine; ?>/- </label> for <?php echo $extra_days;?> extra days.</h4><br>
                <h4> <strong>Total Fine:</strong> <label class="text-danger"> ₹<?php echo $total_fine+$fine_km; ?>/- </label></h4>
                <br>
                       <?php }else{
                ?>
                <h4> <strong>Total Fine:</strong> <label class="text-danger"> ₹<?php echo $total_fine; ?>/- </label> for <?php echo $extra_days;?> extra days.</h4>
                <br>
                <?php }}elseif($charge_type=='day' && $average_km>$max_km){?>
                <h4> <strong>Total Fine:</strong> <label class="text-danger"> ₹<?php echo $fine_km; ?>/- </label>for <?php echo $extra_km;?> extra Km(s) /Day.</h4><br>
                    
                    <?php } ?>
                <h4> <strong>Total Amount: </strong> ₹<?php echo $total_amount; ?>/-</h4>
                <br>
            </div>

            <div class="text-center">
        <a class='btn btn-success' onclick="alert('Bill Sent')" href="sendbill.php?order_id=<?php echo $id; ?>">Send Bill </a></div>
       
        </div>
       
    </div>




<?php  include 'partials/admin-footer.php'; ?>