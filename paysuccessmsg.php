<?php include 'menubar.inc.php';
           if(isset($_GET["order_id"]) && !empty($_GET["order_id"])){
$id=$_GET['order_id'];
$sql= "UPDATE rentedcars rc,cars c SET rc.return_status='R', rc.payment='paid',c.status='1' WHERE  c.id = rc.car_id and rc.order_id='$id'";

mysqli_query($conn,$sql);?>

<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
  </head>
    <style>
      .bdy {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
      }
        .head1 {
          color: #88B04B;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        .para {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
        .checkmark {
            color: #9ABC66;
            font-size: 200px;
            line-height: 200px;
            margin-left:-15px;
        }
        .card {
            margin: 10px;
            background: white;
            padding: 60px;
            border-radius: 4px;
            box-shadow: 0 2px 3px #C8D0D8;
            display: inline-block;
            margin: 0 auto;
        }
        .badge1-delete {
            background: #9ABC66;
        }
        .badge1-delete:hover {
            background-color: rgb(134, 0, 0);
            color: #fff;
            text-decoration: none;
        }

        .badge1 {
            color: #fff;
            padding: 10px 20px;
            text-transform: uppercase;
            font-weight: 500;
            margin-bottom: 40px;
            border-radius: 30px;
        }

      
    </style>
    <body>
        <div class="bdy">
      <div class="card">
      <div style="border-radius:200px; height:200px; width:200px; margin:0 auto;">
        <i class="checkmark">✓</i>
      </div>
        <h1 class="head1">Transaction Successfull</h1> 
        <p class="para">We received your payment;<br/> we'll be in touch shortly!</p><br>
        <a href="index.php" class="badge1 badge1-delete">Back</a>
      </div></div>
    </body>
</html>


<?php
$sql1="SELECT * from rentedcars rc,cars c,users u where c.id=rc.car_id and rc.order_id='$id' and u.username=rc.customer_username";
$res=mysqli_query($conn,$sql1);
$row=mysqli_fetch_assoc($res);
$email=$row['email'];
$name=$row['username'];
$total_amount=$row['total_amount'];
$car_brand=$row['brand_id'];
$car_nameplate=$row['car_nameplate'];
$car_name=$row['car_name'];
$rent_start_date=$row['rent_start_date'];
$rent_end_date=$row['rent_end_date'];
$car_return_date=$row['car_return_date'];
$fare=$row['fare'];
$charge_type1=$row['charge_type'];
$fine=$row['total_fine'];
$km=$row['distance'];
$days=$row['no_of_days'];
// Sending Mail

$html="<h1>Thank You $name ,Your transaction has been successfully completed.</h1>
<h2>Bill Reciept</h2>
<table style='border:2px;'>
<tr><td>Car:</td><td>$car_brand $car_name</td></tr>
<tr><td>Nameplate:</td><td>$car_nameplate</td></tr>
<tr><td>Rent Start Date:</td><td>$rent_start_date</td></tr>
<tr><td>Rent End Date:</td><td>$rent_end_date</td></tr>
<tr><td>Car Return Date:</td><td>$car_return_date</td></tr>
<tr><td>Fare:</td><td>Rs.$fare/$charge_type1</td></tr>
<tr><td>Distance:</td><td>$km Km</td></tr>
<tr><td>Number Of Days:</td><td>$days days</td></tr>
<tr><td>Fine:</td><td>Rs.$fine</td></tr>
<tr><td>Total Amount</td><td>Rs.$total_amount</td></tr>
</table>";

sendingmail('Payment Successfull',$html,$email,'');


include 'footer.inc.php';}?>
