
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
        <a style='text-decoration:none; font-size:10px;' href='localhost/car/paybill.php?order_id=".$id."'>Click Here to pay</a>";
include('../smtp/PHPMailerAutoload.php');
        $mail=new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host="smtp.gmail.com";
        $mail->Port=587;
        $mail->SMTPSecure="tls";
        $mail->SMTPAuth=true;
        $mail->Username="dpcarrentals.svs@gmail.com";
        $mail->Password="svscollege";
        $mail->SetFrom("dpcarrentals.svs@gmail.com");
        $mail->addAddress($email);
        $mail->IsHTML(true);
        $mail->Subject="Pay Bill";
        $mail->Body=$message;
        $mail->SMTPOptions=array('ssl'=>array(
            'verify_peer'=>false,
            'verify_peer_name'=>false,
            'allow_self_signed'=>false
        ));
        if($mail->send()){

            // echo "Mail send";
        }else{
            echo "<script>alert('Mail not sent')</script>";
        }
header("location:manage-bookings.php");}

?>

