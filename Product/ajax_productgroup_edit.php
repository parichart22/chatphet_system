<?php
include("../config.php");
$sql="UPDATE product_group SET name='".$_REQUEST['product_name']."',ref_shopee='".$_REQUEST['ref_shopee']."' WHERE pk='".$_REQUEST[pk]."'";
$result = mysqli_query($con,$sql);

if($result){
  echo "1";
}else{
  echo "0";
}
 ?>
