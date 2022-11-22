<?php
include("../config.php");

$update_rank=mysqli_query($con,"UPDATE category SET rank='".$_REQUEST['rank']."' WHERE pk='".$_REQUEST['pk']."'");
  /****** Loop rank ******/
  $rank=$_REQUEST['rank'];
  $result_rank=mysqli_query($con,"SELECT * FROM category WHERE rank>='".$_REQUEST['rank']."' and pk!='".$_REQUEST['pk']."' ORDER by rank ASC");
  while ($row_rank=mysqli_fetch_array($result_rank)) {
    $rank++;
    $sql="UPDATE category SET rank='".$rank."' WHERE pk='".$row_rank['pk']."'";
    $result = mysqli_query($con,$sql);

  }
  /****** Loop rank ******/



$sql="UPDATE category SET category_name='".$_REQUEST['category']."' WHERE pk='".$_REQUEST['pk']."'";
$result = mysqli_query($con,$sql);


if($result){
  echo "1";
}else{
  echo "0";
}
 ?>
