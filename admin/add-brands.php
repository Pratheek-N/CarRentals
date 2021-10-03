<!DOCTYPE html>
      <html lang="en">
      <head>
              <meta charset="UTF-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Admin-Add Brands</title>
    <link rel="shortcut icon" sizes="144x144" href="../images/favicon.png">

      </head>
      <body>
      <?php include 'partials/admin-header.php';



$brands='';
$msg='';
$image_required='required';
if(isset($_GET['id']) && $_GET['id']!=''){
	$image_required='';
	$id=get_safe_value($conn,$_GET['id']);
	$res=mysqli_query($conn,"select * from brands where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$brands=$row['brands'];
	}else{
		header('location:manage-cars.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$brands=get_safe_value($conn,$_POST['brands']);
	
	$res=mysqli_query($conn,"select * from brands where brands='$brands'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="Brand already exist";
			}
		}else{
			$msg="Brand already exist";
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
				$update_sql="update brands set brands='$brands',image='$image' where id='$id'";
			}else{
				$update_sql="update brands set brands='$brands' where id='$id'";
			}
			mysqli_query($conn,$update_sql);
		}else{
			$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'],CAR_IMAGE_SERVER_PATH.$image);
			mysqli_query($conn,"insert into brands(brands,status,image) values('$brands',1,'$image')");
		}
		header('location:manage-brands.php');
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
    <title>Manage Brands | Add Brand</title>
</head>
<body>


<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Add Brand Details</strong></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   
								<div class="form-group">
									<label for="brands" class=" form-control-label">Brand Name</label>
									<input type="text" name="brands" placeholder="Enter Brand Name" class="form-control" required value="<?php echo $brands?>">
								</div>
								

               					<div class="form-group">
									<label for="brands" class=" form-control-label">Image</label>
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