
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin-Manage Cars</title>
<link rel="shortcut icon" sizes="144x144" href="../images/favicon.png">

</head>
<body>
<?php include 'partials/admin-header.php';


if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($conn,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($conn,$_GET['operation']);
		$id=get_safe_value($conn,$_GET['id']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status_sql="update cars set status='$status' where id='$id'";
		mysqli_query($conn,$update_status_sql);
	}
	
	if($type=='delete'){
		$id=get_safe_value($conn,$_GET['id']);
		$delete_sql="delete from cars where id='$id'";
		mysqli_query($conn,$delete_sql);
	}
}

$sql="select * from cars ";
$res=mysqli_query($conn,$sql);
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Manage Cars </h4>
				   <h4 class="box-link"><a href="add_cars.php">ADD CAR</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table id="order-listing" class="table ">
						 <thead>
							<tr>
							  
							   <th >No</th>
							   <th>Brand</th>
							   <th >Name</th>
							   <th>Image</th>
							   <th>Type</th>
							   <th>Nameplate</th>
							   <th width=8%>AC/Km </th>
							   <th width=10%>Non-AC/Km</th>
							   <th width=8%>AC/Day</th>
							   <th width=10%>Non-AC/Day</th>
                        	   <th width=20%>Status</th>
                           	   <th width=1%>Update/Delete</th>

							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){?>
							
							<tr>
							  
							   <td><?php echo $i?></td>
							   <td><?php echo $row['brand_id']?></td>
							   <td><?php echo $row['car_name']?></td>
							   <td><img src="<?php echo CAR_IMAGE_SITE_PATH.$row['image']?>"/></td>
							   <td><?php echo $row['type_id']?></td>
							   <td><?php echo $row['car_nameplate']?></td>
							   <td><?php echo $row['ac_price']?></td>
							   <td><?php echo $row['non_ac_price']?></td>
							   <td><?php echo $row['ac_price_per_day']?></td>
							   <td><?php echo $row['non_ac_price_per_day']?></td>

							   <td>
								<?php
								if($row['status']==1){
									echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
								}else{
									echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Inactive</a></span>&nbsp;";
								}?></td>
								 <td><?php echo "<span class='badge badge-edit'><a href='add_cars.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
								
								echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>";
								
								?>
							   </td>
							</tr>
							<?php $i++;} ?>
						 </tbody>
					  </table>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
<?php
require('partials/admin-footer.php');
?>