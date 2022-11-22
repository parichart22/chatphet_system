<?php
include("../config.php");

$result_p = mysqli_query($con,"SELECT * FROM product WHERE pk='".$_REQUEST[pk_product]."'");
$row_p=mysqli_fetch_array($result_p);

$sql="INSERT INTO product_group_detail (pk_product_group,pk_product,peak_ref) VALUES ('".$_REQUEST['pk']."','".$_REQUEST['pk_product']."','".$row_p[peak_ref]."')";
$result = mysqli_query($con,$sql);

if($result){
  echo "1";
}else{
  echo "0";
}
 ?>
