<?php  include 'partials/admin-header.php';
error_reporting(0);
if(isset($_GET['id'])){
$id=$_GET['id'];

$sql="select * from contact_us where id='$id'";
$res=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($res);
$email=$row['email'];
$name=$row['name'];		
}

?>

<?php
if(isset($_POST['reply'])){
    $message=$_POST['reply'];
        // Sending Mail
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
        $mail->addAddress("$email");
        $mail->IsHTML(true);
        $mail->Subject="Reply-feedback";
        $mail->Body=$message;
        $mail->SMTPOptions=array('ssl'=>array(
            'verify_peer'=>false,
            'verify_peer_name'=>false,
            'allow_self_signed'=>false
        ));
        if($mail->send()){
        header("Location: replyfeedback.php?success=Message sent to $email");
        exit();
            // echo "Mail send";
        }else{
            echo "Mail not sent";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Reply-Feedback
    </title>
    <link rel="stylesheet" href="../css/change-password.css">
</head>
<body>

<div class="body1">
    <form action="" method="post">
     	<h2>Reply Message</h2>
     	
     	<?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
           
     	<a style="
         margin-left:170px;
  background: #555;
  padding: 10px 15px;
  color: #fff;
  border-radius: 5px;
  margin-right: 10px;
  border: none;
" href="contact-us.php">Back</a>

        <?php }else{ ?>

     	<label>Message</label>
     	<script src="assets/richtexteditor/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<textarea name="reply" id="descriptions" class="form-control"  rows="6" placeholder=" Description *">Hello <?php echo $name?>, Thank you for your lovely feedback.</textarea>
             <br>   <!-- <textarea name="reply" cols="51" rows="5"></textarea> -->
     	<button type="submit">REPLY</button>
        <?php } ?>
     </form>
     </div>
         
</body>
</html>
<?php include 'partials/admin-footer.php' ?>
