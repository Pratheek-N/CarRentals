<?php

require('paymentconfig.php');
if(isset($_POST['stripeToken'])){
	\Stripe\Stripe::setVerifySslCerts(false);
    $amount          = $_POST["amount"]; 
	$car_name=$_POST['car_name'];
	$id=$_POST['order_id'];

	$token=$_POST['stripeToken'];
	$data=\Stripe\Charge::create(array(
		"amount"=>str_replace(",","",$amount) * 100,
		"currency"=>"inr",
		"description"=>"$car_name",
		"source"=>$token,
	));
	
}
if($data){
      header("Location:paysuccessmsg.php?order_id=$id");

  }
?>
