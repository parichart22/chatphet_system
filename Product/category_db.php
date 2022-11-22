<?php
include("../config.php");

$result=mysqli_query($con,"SELECT * FROM category ORDER by rank DESC LIMIT 1");
$row=mysqli_fetch_array($result);
$rank=$row['rank']+1;
$sql="INSERT INTO category (category_name,rank) VALUES ('".$_REQUEST['category']."','".$rank."')";
$result = mysqli_query($con,$sql);

if($result){
  echo "1";
}else{
  echo "0";
}
 ?>
