<!DOCTYPE html>
      <html lang="en">
      <head>
              <meta charset="UTF-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Admin-Contact us</title>
    <link rel="shortcut icon" sizes="144x144" href="../images/favicon.png">
<style>.widthy{ 
   min-width: 420px;
   } </style>
      </head>
      <body>
      <?php include 'partials/admin-header.php';

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($conn,$_GET['type']);
	
	if($type=='delete'){
		$id=get_safe_value($conn,$_GET['id']);
		$delete_sql="delete from contact_us where id='$id'";
		mysqli_query($conn,$delete_sql);
	}
}


    $sql1 = "SELECT * FROM contact_us";

    $result1 = $conn->query($sql1);
    if (mysqli_num_rows($result1) > 0) {
?>

<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Messages </h4>
                           <!-- <h4 class="box-link"><a href="add_cars.php">ADD CARS</a></h4> -->

                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="text-center">Sl.No</th>
                                       <th class="text-center">Name</th>
                                       <th width=8% class="text-center">Email</th>
                                       <th class="widthy text-center">Message</th>
                                       <th class="text-center" style="min-width:180px ;" >Added On</th>
                                       <th class="text-center">Delete</th>
                                       <th class="text-center">Reply</th>
                                       
                                    </tr>
                                 </thead>
                                 <?php
                                    $i=1;
                                       while($row = mysqli_fetch_assoc($result1)) {
                                 ?>
                                 <tbody>
                                 <tr>
                                    <td class="text-center"><?php echo $i; ?></td>
                                    <td class="text-center"><?php echo $row["name"]; ?></td>
                                    <td class="text-lowercase text-center"><?php echo $row["email"]; ?></td>
                                    <td class="text-center"><?php echo $row["message"]; ?></td>
                                    <td class="text-center"><?php echo $row["added_on"]; ?></td>
                                    <td class="text-center"><?php echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>";?>
                                    <td class="text-center"><?php echo "<span class='badge badge-success'><a href='replyfeedback.php?id=".$row['id']."'>Reply</a></span>";?>
							   </td>
                                    </tr>
                                 </tbody>
                                 <?php  $i++;      } ?>
                </table>
                </div> 
        <?php }else {
            ?>
        <div class="container">
      <div class="jumbotron">
        <h1>No Messages</h1>
        <p> <?php echo $conn->error; ?> </p>
      </div>
    </div>

            <?php
        } ?>   
                             
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>

         <?php include 'partials/admin-footer.php'  ?>