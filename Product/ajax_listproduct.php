<?php include("../config.php");

  $result = mysqli_query($con,"SELECT * FROM product WHERE name LIKE '%".$_REQUEST['product_name']."%' LIMIT 10");
  while($row=mysqli_fetch_array($result)){

    echo "<option value='".$row['name']."'>";
} ?>
