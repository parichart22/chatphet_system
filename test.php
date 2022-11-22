<?php include("config.php");

$result=mysqli_query($con,"SELECT * FROM product WHERE amount=0");
while ($row=mysqli_fetch_array($result)) {
    echo $row[pk]." ".$row[name]."<br>";
    $update=mysqli_query($con,"DELETE FROM stock WHERE pk_product='".$row[pk]."'");
  }


?>
