<?php
include("../config.php");

$update_item = mysqli_query($con,"UPDATE order_table SET status='".$_REQUEST['status']."' WHERE pk='".$_REQUEST['orderid']."'");
$update_detail= mysqli_query($con,"UPDATE order_detail SET status='".$_REQUEST['status']."' WHERE orderid='".$_REQUEST['orderid']."'");
if($update_item){
  echo "1";
}else{
  echo "0";
}
 ?>
