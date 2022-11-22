<?php
include("../config.php");
$dateexp=$_REQUEST['year']."-".$_REQUEST['month']."-1";
$result=mysqli_query($con,"SELECT * FROM stock WHERE pk_product='".$_REQUEST['pk_product']."' ORDER by pk DESC");
$row=mysqli_fetch_array($result);
if($_REQUEST['type']==1){
$balance=$row['balance_amount']+$_REQUEST['amount'];
$sql="INSERT INTO stock (pk_product,amount,balance_amount,type,dateexp) VALUES ('".$_REQUEST['pk_product']."','".$_REQUEST['amount']."','".$balance."','".$_REQUEST['type']."','".$dateexp."')";
}else {
$balance=$row['balance_amount']-$_REQUEST['amount'];
$sql="INSERT INTO stock (pk_product,amount,balance_amount,type,dateexp) VALUES ('".$_REQUEST['pk_product']."','-".$_REQUEST['amount']."','".$balance."','".$_REQUEST['type']."','".$dateexp."')";
}

$result = mysqli_query($con,$sql);

$result_product=mysqli_query($con,"SELECT * FROM product WHERE pk='".$_REQUEST['pk_product']."'");
$row_product=mysqli_fetch_array($result_product);
if($_REQUEST['type']==1){
$balance_dummy=$balance+$row_product['amount_dummy'];
}else{
$balance_dummy=$row_product['amount_dummy']-$_REQUEST['amount'];
}
$update=mysqli_query($con,"UPDATE product SET amount='".$balance."',amount_dummy='".$balance."' WHERE pk='".$_REQUEST['pk_product']."'");
if($result){
  echo "1";
}else{
  echo "0";
}
 ?>
