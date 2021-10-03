<!DOCTYPE html>
      <html lang="en">
      <head>
              <meta charset="UTF-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Admin-Add Type</title>
    <link rel="shortcut icon" sizes="144x144" href="../images/favicon.png">

      </head>
      <body>
      <?php include 'partials/admin-header.php';

$car_type='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($conn,$_GET['id']);
	$res=mysqli_query($conn,"select * from car_type where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$car_type=$row['car_type'];
	}else{
		header('location:manage-car-types.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$car_type=get_safe_value($conn,$_POST['car_type']);
	$res=mysqli_query($conn,"select * from car_type where car_type='$car_type'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="Car Type already exist";
			}
		}else{
			$msg="Car Type already exist";
		}
	}
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			mysqli_query($conn,"update car_type set car_type='$car_type' where id='$id'");
		}else{
			mysqli_query($conn,"insert into car_type(car_type,status) values('$car_type','1')");
		}
		header('location:manage-car-types.php');
		die();
	}
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Add Car Type</strong></div>
                        <form method="post">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="car_type" class=" form-control-label"> Car Type</label>
									<input type="text" name="car_type" placeholder="Enter Car Type" class="form-control" required value="<?php echo $car_type?>">
								</div>
							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   <div class="field_error"><?php echo $msg?></div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
<?php
include 'partials/admin-footer.php';
?>