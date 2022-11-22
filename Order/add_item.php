<?php
include("../config.php");
$result=mysqli_query($con,"SELECT * FROM order_detail WHERE orderid='".$_REQUEST['orderid']."' and pk_product='".$_REQUEST['pk_product']."'");
$num=mysqli_num_rows($result);
if($num==0){
  //ADD
  $result_p=mysqli_query($con,"SELECT * FROM product WHERE pk='".$_REQUEST['pk_product']."'");
  $row_p=mysqli_fetch_array($result_p);
  $amount=$_REQUEST['item'];
  $sql="INSERT INTO order_detail (orderid,pk_product,amount,datetime,box_no,comid) VALUES ('".$_REQUEST['orderid']."','".$_REQUEST['pk_product']."','".$amount."','".DATE('Y-m-d H:i:s')."','".$_REQUEST['box_no']."','".$row_p['comid']."')";
  $result = mysqli_query($con,$sql);

  $result_item = mysqli_query($con,"SELECT sum(amount) FROM order_detail WHERE orderid='".$_REQUEST['orderid']."'");
  $row_item=mysqli_fetch_array($result_item);
  $update_item = mysqli_query($con,"UPDATE order_table SET items='".$row_item[0]."' WHERE pk='".$_REQUEST['orderid']."'");
}else{
  //UPDATE
  $row=mysqli_fetch_array($result);
  $amount=$row['amount']+$_REQUEST['item'];
  $sql="UPDATE order_detail SET amount='".$amount."' WHERE orderid='".$_REQUEST['orderid']."' and pk_product='".$_REQUEST['pk_product']."'";
  $result = mysqli_query($con,$sql);

  $result_item = mysqli_query($con,"SELECT sum(amount) FROM order_detail WHERE orderid='".$_REQUEST['orderid']."'");
  $row_item=mysqli_fetch_array($result_item);
  $update_item = mysqli_query($con,"UPDATE order_table SET items='".$row_item[0]."' WHERE pk='".$_REQUEST['orderid']."'");
}
if($result){
  echo "1";
}else{
  echo "0";
}
 ?>
