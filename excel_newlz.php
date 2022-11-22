<?php

include("config.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
<table x:str>
<tr>
<td><strong>SellerSku</strong></td>
<td><strong>Quantity</strong></td>
<td><strong>Name</strong></td>
</tr>
<?php
$result=mysqli_query($con,"SELECT * FROM product where lazada_ref!=''");
while($row=mysqli_fetch_array($result)){
	$result_lock=mysqli_query($con,"SELECT sum(amount) as lock_am FROM order_detail WHERE pk_product='".$row['pk']."' and (status=0 or status=1)");
	$row_lock=mysqli_fetch_array($result_lock);
	$amount=$row['amount_dummy']-$row_lock['lock_am'];
?>
<tr>
<td><?php echo $row['lazada_ref']; ?></td>
<td><?php echo $amount; ?></td>
<td></td>
</tr>
<?php }?>
</table>
</div>
</body>
</html>
