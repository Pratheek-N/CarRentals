<?php 
include '../config.php';


function get_safe_value($conn,$str){
                        if($str!=''){
                           $str=trim($str);
                           return mysqli_real_escape_string($conn,$str);
                        }
                     }

function pr($arr){                        
      echo '<pre>';  
      print_r($arr);
    }
                     
    function prx($arr){
    echo '<pre>';
    print_r($arr);
    die();
   }

   function get_cars($conn,$limit='',$brand_id='',$cars_id='',$search_str='',$sort_order='',$car_type=''){
      $sql="select cars.*,brands.brands from cars,brands where cars.status=1 ";
      if($brand_id!=''){
         $sql.=" and cars.brand_id=$brand_id ";
      }
      if($cars_id!=''){
         $sql.=" and cars.id=$cars_id ";
      }
      if($car_type!=''){
         $sql.=" and cars.car_type=$car_type ";
      }
     
      $sql.=" and cars.brand_id=brands.id ";
      if($search_str!=''){
         $sql.=" and (cars.car_name like '%$search_str%' or cars.car_type like '%$search_str%' or cars.brand_id like '%$search_str%') ";
      }
      if($sort_order!=''){
         $sql.=$sort_order;
      }else{
         $sql.=" order by cars.id desc ";
      }
      if($limit!=''){
         $sql.=" limit $limit";
      }
      //echo $sql;
      $res=mysqli_query($conn,$sql);
      $data=array();
      while($row=mysqli_fetch_assoc($res)){
         $data[]=$row;
      }
      return $data;
   }
        
?>