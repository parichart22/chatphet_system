<?php
include("../config.php");
$sql="INSERT INTO product_group (name,ref_shopee) VALUES ('".$_REQUEST['product_name']."','".$_REQUEST['ref_shopee']."')";
$result = mysqli_query($con,$sql);

if($result){
  echo "1";
}else{
  echo "0";
}
 ?>
