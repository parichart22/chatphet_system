<?php
include("../config.php");
$sql="UPDATE product_group_detail SET ref_shopee_d='".$_REQUEST['ref_shopee_d']."',price='".$_REQUEST['price']."' WHERE pk='".$_REQUEST['pk']."'";
$result = mysqli_query($con,$sql);

if($result){
  echo "1";
}else{
  echo "0";
}
 ?>
