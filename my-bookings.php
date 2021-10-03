

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D P Car Rentals | My Bookings</title>
    <link rel="shortcut icon" sizes="144x144" href="images/favicon.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
</head>
<body>
<?php include('menubar.inc.php'); ?>

<?php $login_customer = $_SESSION['username']; 

    $sql1 = "SELECT * FROM rentedcars rc, cars c
    WHERE rc.customer_username='$login_customer' AND c.id=rc.car_id AND rc.return_status='R'";
    $result1 = $conn->query($sql1);

    if (mysqli_num_rows($result1) > 0) {
?>
<div class="container">
      <div class="jumbotron">
        <h1>Your Bookings</h1>
        <p> Hope you enjoyed our service </p>
      </div>
    </div>

    <div class="table-responsive" style="padding-left: 100px; padding-right: 100px;" >
<table class="table table-striped">
  <thead class="thead-dark">
<tr>
<th width="15%">Car</th>
<th width="15%">Rent Start Date</th>
<th width="15%">Rent End Date</th>
<th width="10%">Fare</th>
<th width="15%">Distance (in kms)</th>
<th width="15%">Number of Days</th>
<th width="15%">Total Amount</th>
</tr>
</thead>
<?php
        while($row = mysqli_fetch_assoc($result1)) {
?>
<tr>
<td><?php echo $row["car_name"]; ?></td>
<td><?php echo $row["rent_start_date"] ?></td>
<td><?php echo $row["rent_end_date"]; ?></td>
<td>&#8377; <?php 
            if($row["charge_type"] == "day"){
                    echo ($row["fare"] . "/day");
                } else {
                    echo ($row["fare"] . "/km");
                }
            ?></td>
<td><?php             echo $row["distance"];?>
                </td>
<td><?php echo $row["no_of_days"]; ?> </td>
<td>&#8377; <?php echo $row["total_amount"]; ?></td>
</tr>
<?php        } ?>
                </table>
                </div> 
        <?php } else {
            ?>
        <div class="container">
      <div class="jumbotron">
        <h1>No booked cars</h1>
        <p> Rent some cars now </p>
      </div>
    </div>

            <?php
        } ?>   


<?php include('footer.inc.php'); ?>
</body>
</html>
