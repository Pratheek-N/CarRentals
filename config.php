<?php 

$server = "localhost";
$user = "root";
$pass = "";
$database = "car";

$conn = mysqli_connect($server, $user, $pass, $database);
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/car/');
define('SITE_PATH','http://localhost/car/');

define('CAR_IMAGE_SERVER_PATH',SERVER_PATH.'admin/assets/images/');
define('CAR_IMAGE_SITE_PATH',SITE_PATH.'admin/assets/images/');

if (!$conn) {
    die("<script>alert('Connection Failed.')</script>");
}

function sendingmail($subject,$message,$reciever,$header){
    
    // Sending Mail
    include('smtp/PHPMailerAutoload.php');
    $mail=new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host="smtp.gmail.com";
    $mail->Port=587;
    $mail->SMTPSecure="tls";
    $mail->SMTPAuth=true;
    $mail->Username="dpcarrentals.svs@gmail.com";
    $mail->Password="nwmbzqalhsduyfpq";
    $mail->SetFrom("dpcarrentals.svs@gmail.com");
    $mail->addAddress("$reciever");
    $mail->IsHTML(true);
    $mail->Subject=$subject;
    $mail->Body=$message;
    $mail->SMTPOptions=array('ssl'=>array(
        'verify_peer'=>false,
        'verify_peer_name'=>false,
        'allow_self_signed'=>false
    ));
 if($mail->send()){
    $header;
 }else{
    echo "Mail not sent";
 
 }
                
 }


?>