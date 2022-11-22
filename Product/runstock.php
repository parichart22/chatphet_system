<?php

$result=mysqli_query($con,"SELECT * FROM product WHERE shopee_ref1!=''");
while($row=mysqli_fetch_array($result)){
  $result_lock=mysqli_query($con,"SELECT sum(amount) as lock_am FROM order_detail WHERE pk_product='".$row[pk]."' and (status=0 or status=1)");
  $row_lock=mysqli_fetch_array($result_lock);
  $total_stock=$row[amount]-$row_lock[lock_am];
  $update=mysqli_query($con,"UPDATE product SET amount_dummy='".$total_stock."' WHERE pk='".$row[pk]."'");
}
echo "<div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
  <h1 class='h2'>Run Stock</h1>
</div><div class='alert alert-success' role='alert'>
  Stock Done.
</div>";
?>
