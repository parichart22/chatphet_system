<?php
include("../config.php");
$sql="UPDATE product SET name='".$_REQUEST['product_name']."',shopee_ref1='".$_REQUEST['shopee_ref1']."',shopee_ref2='".$_REQUEST['shopee_ref2']."',lazada_ref='".$_REQUEST['lazada_ref']."',lz_productid='".$_REQUEST['lz_productid']."',lz_skuid='".$_REQUEST['lz_skuid']."',s_wb_product='".$_REQUEST['s_wb_product']."',lnwshop_ref='".$_REQUEST['lnwshop_ref']."',peak_ref='".$_REQUEST['peak_ref']."',shopee_price='".$_REQUEST['price']."',datetime='".DATE('Y-m-d h:i:s')."' WHERE pk='".$_REQUEST['pk']."'";
$result = mysqli_query($con,$sql);

if($result){
  echo "1";
}else{
  echo "0";
}
 ?>
