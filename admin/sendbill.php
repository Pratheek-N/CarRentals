
<?php
include_once 'partials/admin-header.php';
if(isset($_GET["order_id"])){
$id = $_GET["order_id"];
$login_customer = $_SESSION['username'];
$sql0 = "UPDATE rentedcars set pay_request='1' where order_id='$id'";
$result0 = $conn->query($sql0);
$sql="select * from users where username='$login_customer'";
$result = $conn->query($sql);
$row=mysqli_fetch_assoc($result);
$email=$row['email'];
$message="<h1>Hello $login_customer,Your bill is ready to pay</h1>
     <a style='text-decoration:none; font-size:20px;' href='localhost/car/paybill.php?order_id=".$id."'>Click Here to pay</a>";

     sendingmail('Pay-Bill',$message,$email,header("Location:manage-bookings.php"));
    
}

?>

