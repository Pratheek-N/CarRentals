<?php  include 'menubar.inc.php'; ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill</title>
    <link rel="shortcut icon" sizes="144x144" href="images/favicon.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bookingconfirm.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>

<?php 
$id = $_GET["order_id"];

$login_customer = $_SESSION['username'];
$sql0 = "SELECT * FROM rentedcars rc, cars c,users u WHERE rc.order_id = '$id' and c.id = rc.car_id and rc.pay_request='1' and u.username=rc.customer_username";
$result0 = $conn->query($sql0);

if(mysqli_num_rows($result0) > 0) {
    while($row0 = mysqli_fetch_assoc($result0)){
        $email=$row0["email"];
            $rent_end_date = $row0["rent_end_date"];  
            $rent_start_date = $row0["rent_start_date"];
            $car_name = $row0["car_name"];
            $car_nameplate = $row0["car_nameplate"];
            $charge_type = $row0["charge_type"];
            $total_amount = $row0["total_amount"];
            $num_of_days=$row0["no_of_days"];
            $distance=$row0["distance"];
            $fare=$row0["fare"];
            $car_return_date=$row0["car_return_date"];
            $total_fine=$row0["total_fine"];
            $max_km=$row0["max_km"];

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


if($charge_type == "day"){
    $average_km=$distance/$total_days;
    $extra_km=$average_km-$max_km;
    $fine_km=$extra_km*15;

}


?>

    <div class="container jumbotron">
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span>Final Bill</h1>
        </div>
   
    


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
                <h4> <strong>Booking Date: </strong> <?php echo date("Y-m-d"); ?> </h4>
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
                    <h4> <strong>Number of days:</strong> <?php echo $num_of_days; ?>day(s)</h4><br>
                    <h4> <strong>Distance Travelled:</strong> <?php echo $distance; ?>km(s)</h4>
                <?php } else { ?>
                    <h4> <strong>Distance Travelled:</strong> <?php echo $distance; ?>km(s)</h4>
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
        <form action="paidsuccess.php" method="POST">
        <input type="hidden" name="amount" value="<?php echo $total_amount?>">
        <input type="hidden" name="car_name" value="<?php echo $car_name?>">
        <input type="hidden" name="order_id" value="<?php echo $id?>">



            <div class="text-center">
            <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="pk_test_51JWFHASCAKEV732YxR0Zhagt9mVlFMgvpqf9zlDwAi94U6VvfATE0zkTp4NSj9kxklSmYuyyDLY0ovzqrDL0hbns00OG1mXtJo"
                data-amount=<?php echo str_replace(",","",$total_amount) * 100?>
                data-name="<?php echo "DP Car Rentals"?>"
                data-description="<?php echo $car_name?>"
		        data-image="images\favicon.png"
		        data-email="<?php echo $email?>"
                data-currency="inr"
                data-locale="auto">
                </script>
        </div></form><br><br>
        <div class="text-center" style="float: none; padding-bottom : 30px;">
        <a class='badge1 badge1-edit' href="printbillpdf.php?order_id=<?php echo $id; ?>"> PDF</a>
        <a class='badge1 badge1-delete' href="cars.php"> Back</a>
        </div>
       
    </div>
    <script>
    function goback(){
        window.history.go(-1);
    }

    $('#ph').on('keypress',function(){
         var text = $(this).val().length;
         if(text > 9){
              return false;
         }else{
            $('#ph').text($(this).val());
         }
         
    });
</script>



<?php  include 'footer.inc.php'; ?>
