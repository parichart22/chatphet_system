<?php include("config.php");

  echo "<table>";
  $result=mysqli_query($con,"SELECT * FROM product WHERE peak_ref!='' and peak_ref!='no_peak'");
  while ($row=mysqli_fetch_array($result)) {

      echo "<tr><td>".$row[peak_ref]."</td><td>".$row[name]."</td><td></td><td></td><td>".$row[shopee_price]."</td><td></td><td></td><td></td></tr>";

    }
  echo "</table>";
?>
