<?php
include("../config.php");
if($_REQUEST['type']==1){
  $update=mysqli_query($con,"UPDATE product SET mark_exp='1' WHERE pk='".$_REQUEST['pk_product']."'");
}else{
  $update=mysqli_query($con,"UPDATE product SET mark_exp='0' WHERE pk='".$_REQUEST['pk_product']."'");
}

if($update){
  echo "1";
}else{
  echo "0";
}
 ?>
