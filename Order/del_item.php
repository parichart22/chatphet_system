<?php
include("../config.php");

  $sql="DELETE FROM order_detail WHERE orderid='".$_REQUEST['orderid']."' and pk_product='".$_REQUEST['pk_product']."'";
  $result = mysqli_query($con,$sql);

  $result_item = mysqli_query($con,"SELECT sum(amount) FROM order_detail WHERE orderid='".$_REQUEST['orderid']."'");
  $row_item=mysqli_fetch_array($result_item);
  $update_item = mysqli_query($con,"UPDATE order_table SET items='".$row_item[0]."' WHERE pk='".$_REQUEST['orderid']."'");
if($result){
  echo "1";
}else{
  echo "0";
}
 ?>
