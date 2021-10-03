<!DOCTYPE html>
      <html lang="en">
      <head>
              <meta charset="UTF-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Admin-Add Cars</title>
    <link rel="shortcut icon" sizes="144x144" href="../images/favicon.png">

      </head>
      <body>
      <?php include 'partials/admin-header.php';

 $brand_id='';
$car_name='';
$type_id='';
$car_nameplate='';
$ac_price='';
$image='';
$ac_price_per_day	='';
$non_ac_price_per_day	='';
$non_ac_price='';
$max_km='';
$msg='';
$image_required='required';
if(isset($_GET['id']) && $_GET['id']!=''){
	$image_required='';
	$id=get_safe_value($conn,$_GET['id']);
	$res=mysqli_query($conn,"select * from cars where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$brand_id=$row['brand_id'];
		$car_name=$row['car_name'];
		$type_id=$row['type_id'];
		$car_nameplate=$row['car_nameplate'];
		$ac_price=$row['ac_price'];
		$ac_price_per_day=$row['ac_price_per_day'];
		$non_ac_price_per_day=$row['non_ac_price_per_day'];
		$non_ac_price=$row['non_ac_price'];
		$max_km=$row['max_km'];

	}else{
		header('location:manage-cars.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$brand_id=get_safe_value($conn,$_POST['brand_id']);
	$car_name=get_safe_value($conn,$_POST['car_name']);
	$type_id=get_safe_value($conn,$_POST['type_id']);
	$car_nameplate=get_safe_value($conn,$_POST['car_nameplate']);
	$ac_price=get_safe_value($conn,$_POST['ac_price']);
	$ac_price_per_day=get_safe_value($conn,$_POST['ac_price_per_day']);
	$non_ac_price_per_day=get_safe_value($conn,$_POST['non_ac_price_per_day']);
	$non_ac_price=get_safe_value($conn,$_POST['non_ac_price']);
	$max_km=get_safe_value($conn,$_POST['max_km']);



	
	$res=mysqli_query($conn,"select * from cars where car_nameplate='$car_nameplate'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="Car already exist";
			}
		}else{
			$msg="Car already exist";
		}
	}
	
	
	// if($_GET['id']==0){
	// 	if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
	// 		$msg="Please select only png,jpg and jpeg image formate";
	// 	}
	
		if($_FILES['image']['type']!=''){
				if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
				$msg="Please select only png,jpg and jpeg image formate";
				}
		
	}
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			if($_FILES['image']['name']!=''){
				$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
				move_uploaded_file($_FILES['image']['tmp_name'],CAR_IMAGE_SERVER_PATH.$image);
				$update_sql="update cars set brand_id='$brand_id',car_name='$car_name',type_id='$type_id',car_nameplate='$car_nameplate',ac_price='$ac_price',ac_price_per_day='$ac_price_per_day',non_ac_price_per_day='$non_ac_price_per_day',non_ac_price='$non_ac_price',max_km='$max_km',image='$image' where id='$id'";
			}else{
				$update_sql="update cars set brand_id='$brand_id',car_name='$car_name',type_id='$type_id',car_nameplate='$car_nameplate',ac_price='$ac_price',ac_price_per_day='$ac_price_per_day',non_ac_price_per_day='$non_ac_price_per_day',non_ac_price='$non_ac_price',max_km='$max_km' where id='$id'";
			}
			mysqli_query($conn,$update_sql);
		}else{
			$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'],CAR_IMAGE_SERVER_PATH.$image);
			mysqli_query($conn,"insert into cars(brand_id,car_name,type_id,car_nameplate,ac_price,ac_price_per_day,non_ac_price_per_day,non_ac_price,max_km,status,image) values('$brand_id','$car_name','$type_id','$car_nameplate','$ac_price','$ac_price_per_day','$non_ac_price_per_day','$non_ac_price','$max_km',1,'$image')");
		}
		header('location:manage-cars.php');
		die();
	}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta car_name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Manage Cars | Add Cars</title>
</head>
<body>


<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Add Car Details</strong></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="cars" class=" form-control-label">Brands</label>
									<select class="form-control" name="brand_id" required>
										<option value="1">Select Brand</option>
										<?php
										$res=mysqli_query($conn,"select id,brands from brands where status= 1");
										while($row=mysqli_fetch_assoc($res)){
											if($row['brands']==$brand_id){
												echo "<option selected value=".$row['brands'].">".$row['brands']."</option>";
											}else{
												echo "<option value=".$row['brands'].">".$row['brands']."</option>";
											}
										}
										
										?>
									</select>
								</div>

								<div class="form-group">
									<label for="cars" class=" form-control-label">Car Name</label>
									<input type="text" name="car_name" placeholder="Enter Car Name" class="form-control" required value="<?php echo $car_name?>">
								</div>
								

								<div class="form-group">
								<label for="cars" class=" form-control-label">Type</label>
									<select class="form-control" name="type_id" required>
										<option value="1">Select Type</option>
										<?php
										$res=mysqli_query($conn,"select id,car_type from car_type");
										while($row=mysqli_fetch_assoc($res)){
											if($row['car_type']==$type_id){
												echo "<option selected value=".$row['car_type'].">".$row['car_type']."</option>";
											}else{
												echo "<option value=".$row['car_type'].">".$row['car_type']."</option>";
											}
											
										}
										?>
									</select>
								</div>
								
							
								<div class="form-group">
									<label for="cars" class=" form-control-label">Car Name Plate</label>
									<input type="text" name="car_nameplate" placeholder="Enter Name Plate" class="form-control" required value="<?php echo $car_nameplate?>">
								</div>
								
								<div class="form-group">
									<label for="cars" class=" form-control-label">AC Price/Km</label>
									<input type="text" name="ac_price" placeholder="Enter AC Price/Km" class="form-control" required value="<?php echo $ac_price?>">
								</div>
									
								<div class="form-group">
									<label for="cars" class=" form-control-label">Non-AC Price/Km</label>
									<input type="text" name="non_ac_price" placeholder="Enter Non-AC Price/Km" class="form-control" required value="<?php echo $non_ac_price?>">
								</div>
								
								<div class="form-group">
									<label for="cars" class=" form-control-label">AC Price/Day</label>
									<input type="text" name="ac_price_per_day" placeholder="Enter AC Price/Day" class="form-control" required value="<?php echo $ac_price_per_day?>">
								</div>
								
							
								<div class="form-group">
									<label for="cars" class=" form-control-label">Non-AC Price/Day</label>
									<input type="text" name="non_ac_price_per_day" placeholder="Enter Non-AC Price/Day" class="form-control" required value="<?php echo $non_ac_price_per_day?>">
								</div>
								<div class="form-group">
									<label for="cars" class=" form-control-label">Maximum Km / Day</label>
									<input type="text" name="max_km" placeholder="Enter Max Km / Day" class="form-control" required value="<?php echo $max_km?>">
								</div>
							
               					<div class="form-group">
									<label for="cars" class=" form-control-label">Image</label>
									<input type="file" name="image" class="form-control" <?php echo  $image_required?>>
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
         

       


<?php include 'partials/admin-footer.php' ?>