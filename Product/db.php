<?php
include("../config.php");
$sql="INSERT INTO product (name,company,comid) VALUES ('".$_REQUEST['product_name']."','".$_REQUEST['company_name']."','".$_REQUEST['comid']."')";
$result = mysqli_query($con,$sql);

if($result){
  echo "1";
}else{
  echo "0";
}
 ?>
