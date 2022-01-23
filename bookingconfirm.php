<?php
 include 'menubar.inc.php';
$user_check=$_SESSION['username'];
$query = "SELECT * FROM users WHERE username='$user_check'";
$ses_sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($ses_sql);
$email= $row['email'];
$mblno=$row['mblno'];
$login_session =$row['username'];
if(!$_SESSION['username']){

    header('location:login.php');
    $_SESSION['msg']="You must login to book a car!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a car</title>
    <link rel="shortcut icon" sizes="144x144" href="images/favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="css/bookingconfirm.css" />
</head>
<body>
    

<?php

if($_SESSION['username']){
    $type = $_POST['radio'];
    $charge_type = $_POST['radio1'];
    $customer_username = $_SESSION["username"];
    $car_id = $conn->real_escape_string($_POST['hidden_carid']);
    $rent_start_date = date('y-m-d', strtotime($_POST['rent_start_date']));
    $rent_end_date = date('y-m-d', strtotime($_POST['rent_end_date']));
    $return_status = "NR"; // not returned
    $fare = "NA";


    function dateDiff($start, $end) {
        $start_ts = strtotime($start);
        $end_ts = strtotime($end);
        $diff = $end_ts - $start_ts;
        return round($diff / 86400);
    }
    
    $err_date = dateDiff("$rent_start_date", "$rent_end_date");

    $sql0 = "SELECT * FROM cars WHERE id = '$car_id'";
    $result0 = $conn->query($sql0);

    if (mysqli_num_rows($result0) > 0) {
        while($row0 = mysqli_fetch_assoc($result0)) {

            if($type == "ac" && $charge_type == "km"){
                $fare = $row0["ac_price"];
            } else if ($type == "ac" && $charge_type == "day"){
                $fare = $row0["ac_price_per_day"];
            } else if ($type == "non_ac" && $charge_type == "km"){
                $fare = $row0["non_ac_price"];
            } else if ($type == "non_ac" && $charge_type == "day"){
                $fare = $row0["non_ac_price_per_day"];
            } else {
                $fare = "NA";
            }
        }
    }
    if($err_date >= 0) { 
    $sql1 = "INSERT into rentedcars(customer_username,car_id,booking_date,rent_start_date,rent_end_date,fare,charge_type,return_status) 
    VALUES('" . $customer_username . "','" . $car_id . "','" . date("Y-m-d") ."','" . $rent_start_date ."','" . $rent_end_date . "','" . $fare . "','" . $charge_type . "','" . $return_status . "')";
    $result1 = $conn->query($sql1);

    $sql2 = "UPDATE cars SET status = 0 WHERE id = '$car_id'";
    $result2 = $conn->query($sql2);


    $sql4 = "SELECT * FROM  cars, rentedcars WHERE cars.id = '$car_id'";
    $result4 = $conn->query($sql4);


    if (mysqli_num_rows($result4) > 0) {
        while($row = mysqli_fetch_assoc($result4)) {
            $id = $row["id"];
            $car_name = $row["car_name"];
            $car_brand=$row["brand_id"];
            $car_type=$row["type_id"];
            $car_nameplate = $row["car_nameplate"];
            $charge_type1=$row["charge_type"];
        }
    }

    if (!$result1 | !$result2){
        die("Couldnt enter data: ".$conn->error);
    }
    // creating pdf

    // Sending Mail

    $html="<h2>Hello $login_session ,Thank you for visiting DP Car Rentals! We wish you have a safe ride.</h2>
    <h4>Your Booking Details</h4>
    <table>
    <tr><td>Car:</td><td>$car_brand $car_name</td></tr>
    <tr><td>Nameplate:</td><td>$car_nameplate</td></tr>
    <tr><td>Rent Start Date:</td><td>$rent_start_date</td></tr>
    <tr><td>Rent End Date:</td><td>$rent_end_date</td></tr>
    <tr><td>Fare:</td><td>Rs.$fare/$charge_type1</td></tr>
    </table>";
    sendingmail('Booking Confirmed',$html,$email,'')
	
?>


    <div class="container">
        <div class="jumbotron">
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Booking Confirmed.</h1>
        </div>
    </div>
    <br>

    <h2 class="text-center"> Thank you for visiting DP Car Rentals! We wish you have a safe ride. </h2>

 

    <h3 class="text-center"> <strong>Your Order Number:</strong> <span style="color: blue;"><?php echo "$id"; ?></span> </h3>

    <div class="container">
        <h5 class="text-center">Please read the following information about your order.</h5>
        <div class="box">
            <div class="col-md-10" style="float: none; margin: 0 auto; text-align: center;">
                <h3 style="color: orange;">Your booking has been received and placed into out order processing system.</h3>
                <br>
                <h4>Please make a note of your <strong>order number</strong> now and keep in the event you need to communicate with us about your order.</h4>
                <br>
                <h3 style="color: orange;">Invoice</h3>
                <br>
            </div>
            <div class="col-md-10" style="float: none; margin: 0 auto; ">
                <h4> <strong>Car Name: </strong> <?php echo $car_name; ?></h4>
                <br>
                <h4> <strong>Brand: </strong> <?php echo $car_brand; ?></h4>
                <br>
                <h4> <strong>Type: </strong> <?php echo $car_type; ?></h4>
                <br>
                <h4> <strong>Car Number:</strong> <?php echo $car_nameplate; ?></h4>
                <br>
                
                <?php     
                if($charge_type == "day"){
                ?>
                     <h4> <strong>Fare:</strong> ₹<?php echo $fare; ?>/day</h4>
                <?php } else {
                    ?>
                    <h4> <strong>Fare:</strong> ₹<?php echo $fare; ?>/km</h4>

                <?php } ?>

                <br>
                <h4> <strong>Booking Date: </strong> <?php echo date("y-m-d"); ?> </h4>
                <br>
                <h4> <strong>Start Date: </strong> <?php echo $rent_start_date; ?></h4>
                <br>
                <h4> <strong>Return Date: </strong> <?php echo $rent_end_date; ?></h4>
                <br>
            </div>
        </div>
        <div class="text-center" style="float: none; padding-bottom : 30px;">
        <a class='badge1 badge1-edit' href="bookingconfirmpdf.php?id=<?php echo $id; ?>"> PDF</a>
        <a class='badge1 badge1-delete' href="cars.php"> Back</a>
        </div>
        <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            <h6>Warning! <strong>Do not reload this page</strong> or the above display will be lost. If you want a hardcopy of this page, please print it now.</h6>
        </div>
    </div>
</body>
<?php } else {
    echo "<script>alert('Oops..Invalid Date !!')</script>";
    ?>
    <div class="text-center"  style=" padding : 30px;">
    <h1  style="margin : 30px;" >Please enter valid date</h1>
    <a class='badge1 badge1-delete ' href="bookings.php?id=<?php echo $car_id ?>"> Back</a>
    </div>
    <?php
} }
 
 include 'footer.inc.php';
 
 ?>
