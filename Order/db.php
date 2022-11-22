<?php
include("../config.php");
$sql="INSERT INTO order_table (id_ref,customer_name,channel,inv_date) VALUES ('".$_REQUEST['id_ref']."','".$_REQUEST['customer_name']."','".$_REQUEST['ch']."','".$_REQUEST['datepicker']."')";
$result = mysqli_query($con,$sql);

if($result){
  echo "1";
}else{
  echo "0";
}
 ?>
