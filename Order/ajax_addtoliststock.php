<?php
include("../config.php");
echo $sql="INSERT INTO listaddtostock (pk_product,qty,date_time) VALUES ('".$_REQUEST['pk_product']."','".$_REQUEST['qty']."','".DATE("Y-m-d h:i:s")."')";
$result = mysqli_query($con,$sql);

if($result){
  echo "1";
}else{
  echo "0";
}
 ?>
