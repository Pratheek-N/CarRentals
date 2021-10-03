<!DOCTYPE html>
      <html lang="en">
      <head>
              <meta charset="UTF-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Admin-Manage Users</title>
    <link rel="shortcut icon" sizes="144x144" href="../images/favicon.png">

      </head>
      <body>
      <?php include 'partials/admin-header.php';


function get_sf_value($str){
	global $conn;
	$str=mysqli_real_escape_string($conn,$str);
	return $str;

}

if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
	$type=get_sf_value($_GET['type']);
	$id=get_sf_value($_GET['id']);
	if($type=='active' || $type=='deactive'){
		$status='Active';
		if($type=='deactive'){
			$status='Deactive';
		}
		mysqli_query($conn,"update users set status='$status' where id='$id'");
		header("location:manage-users.php");
	}
   if($type=='delete'){
		$id=get_safe_value($conn,$_GET['id']);
		$delete_sql="delete from users where id='$id'";
		mysqli_query($conn,$delete_sql);
	}

}

$sql="select * from users order by id asc";
$res=mysqli_query($conn,$sql);

?>


<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Manage Users </h4>
                           <!-- <h4 class="box-link"><a href="add_cars.php">ADD CARS</a></h4> -->

                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th>Sl.No</th>
                                       <th>Username</th>
                                       <th>Email</th>
                                       <th>Phone Number</th>
                                       <th>Dl Number</th>
                                       <th>Dl Image</th>
                                       <th>Date Of Registered</th>
                                       <th>Status</th>
                                    </tr>
                                 </thead>
                                 <?php if(mysqli_num_rows($res)>0){
						               $i=1;
						               while($row=mysqli_fetch_assoc($res)){
						               ?>
                                 <tbody>
                                    <tr>
                                       <td><?php echo $i ?></td>
                                       <td><?php echo $row['username']?></td>
                                       <td class="text-lowercase"><?php echo $row['email']?></td>
                                       <td><?php echo $row['mblno']?></td>
                                       <td><?php echo $row['dl_no']?></td>
							   <td><img src="<?php echo CAR_IMAGE_SITE_PATH.$row['image']?>"/></td>

                                       
                                       <td><?php 
							               $dateStr=strtotime($row['date']);
							               echo date('d-m-Y',$dateStr);
							               ?></td>
                                       <td>
                                       <?php
								if($row['status']=='Active'){
								?>
								<a href="?id=<?php echo $row['id']?>&type=deactive"><label class="badge badge-complete hand_cursor">Active</label></a>
								<?php
								}else{
								?>
								<a href="?id=<?php echo $row['id']?>&type=active"><label class="badge badge-pending hand_cursor">Inactive</label></a>
								<?php
								}
								echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>";
								?>
                                       </td>
                                    </tr>
                                    <?php 
						                     $i++;
						                  } }  ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>
         <div class="clearfix"></div>



         <?php include 'partials/admin-footer.php'  ?>