<?php  include 'partials/admin-header.php'; 






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintainence</title>
    <link rel="shortcut icon" sizes="144x144" href="images/favicon.png">
   <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <style>
        h5{
            padding: 5px;
        }

    </style>
</head>
<body>

<?php
function dateDiff($start, $end) {
    $start_ts = strtotime($start);
    $end_ts = strtotime($end);
    $diff = $end_ts - $start_ts;
    return round($diff / 86400);
}
 $order_id = $_GET["order_id"];
 $sql1 = "SELECT c.car_name,c.brand_id ,c.car_nameplate, rc.rent_start_date, rc.rent_end_date, rc.fare, rc.charge_type FROM rentedcars rc, cars c WHERE rc.order_id = '$order_id' AND c.id=rc.car_id";
 $result1 = $conn->query($sql1);
 if (mysqli_num_rows($result1) > 0) {
    while($row = mysqli_fetch_assoc($result1)) {
        $car_name = $row["car_name"];
        $brand_name = $row["brand_id"];
        $car_nameplate = $row["car_nameplate"];
        $rent_start_date = $row["rent_start_date"];
        $rent_end_date = $row["rent_end_date"];
        $fare = $row["fare"];
        $charge_type = $row["charge_type"];
        $no_of_days = dateDiff("$rent_start_date", "$rent_end_date");
    }
}
?>
    <div class="container" style="margin-top: 65px; padding:50px;" >
    <div class="col-md-7" style="float: none; margin: 0 auto;">
      <div class="form-area">
        <form role="form" action="finalbill.php?order_id=<?php echo $order_id ?>" method="POST">
        <br style="clear: both">
          <h3 style="margin-bottom: 35px; text-align: center; font-size: 30px;"> Car Details </h3>

           <h5> Car:&nbsp;  <?php echo($brand_name); ?> <?php echo($car_name);?></h5>

           <h5> Vehicle Number:&nbsp;  <?php echo($car_nameplate);?></h5>

           <h5> Rent date:&nbsp;  <?php echo($rent_start_date);?></h5>

           <h5> End Date:&nbsp;  <?php echo($rent_end_date);?></h5>

           <h5>Fare:&nbsp;  ₹<?php 
            if($charge_type == "day"){
                    echo ($fare . "/day");
                } else {
                    echo ($fare . "/km");
                }
            ?>
            </h5>
          <?php if($charge_type == "km") { ?>
          <div class="form-group" style="margin-top: 25px;">
            <input type="number" class="form-control" id="distance_or_days" name="distance_or_days" placeholder="Enter the distance travelled (in km)" required="" autofocus>
          </div>
          <?php }  else { ?>
            <h5> Number of Day(s):&nbsp;  <?php echo($no_of_days);?></h5>
            <input type="hidden" name="distance_or_days" value="<?php echo $no_of_days; ?>">
            <div class="form-group" style="margin-top: 25px;">
            <input type="number" class="form-control" id="distance_per_day" name="distance_per_day" placeholder="Enter the distance travelled (in km)" required="" autofocus>
          </div>
          <?php } ?>
          <input type="hidden" name="hid_fare" value="<?php echo $fare; ?>">

           <input type="submit" name="submit" value="submit" class="btn btn-success pull-right">    
        </form>
      </div>
    </div>
   
    </div>


<?php include 'partials/admin-footer.php'; ?> 