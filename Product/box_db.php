<?php
include("../config.php");
$update=mysqli_query($con,"UPDATE product SET box_no='".$_REQUEST['box']."' WHERE pk='".$_REQUEST['pk_product']."'");
if($update){
  echo "1";
}else{
  echo "0";
}
 ?>
