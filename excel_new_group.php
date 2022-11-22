<?php
include("config.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
<div id="SiXhEaD_Excel" align=center x:publishsource="Excel">

<table x:str>
	<tr>
	<td>et_title_product_id</td>
	<td>et_title_product_name</td>
	<td>et_title_variation_id</td>
	<td>et_title_variation_name</td>
	<td>et_title_parent_sku</td>
	<td>et_title_variation_sku</td>
	<td>et_title_variation_price</td>
	<td>et_title_variation_stock</td>
	<td>et_title_reason</td>
	</tr>
	<tr>
	<td>sales_info</td>
	<td>220408_floatingstock</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	</tr>
	<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	</tr>
	<tr>
	<td><strong>รหัสสินค้า</strong></td>
	<td><strong>ชื่อสินค้า</strong></td>
	<td><strong>รหัสตัวเลือกสินค้า</strong></td>
	<td><strong>ชื่อตัวเลือกสินค้า</strong></td>
	<td><strong>Parent SKU</strong></td>
	<td><strong>เลข SKU</strong></td>
	<td><strong>ราคา</strong></td>
	<td><strong>สินค้าในคลัง</strong></td>
	<td><strong></strong></td>
	</tr>
<?php
$resultp=mysqli_query($con,"SELECT * FROM product_group where ref_shopee!=''");
while($rowp=mysqli_fetch_array($resultp)){
$result=mysqli_query($con,"SELECT * FROM product_group_detail where pk_product_group='".$rowp[pk]."'");
while($row=mysqli_fetch_array($result)){
  $result_s=mysqli_query($con,"SELECT * FROM product WHERE pk='".$row['pk_product']."'");
	$row_s=mysqli_fetch_array($result_s);
	$result_lock=mysqli_query($con,"SELECT sum(amount) as lock_am FROM order_detail WHERE pk_product='".$row['pk_product']."' and (status=0 or status=1)");
	$row_lock=mysqli_fetch_array($result_lock);
	$amount=$row_s['amount_dummy']-$row_lock['lock_am'];
	if($amount<=10 and $row_s[mark_exp]==0){ $amount=ceil($amount/1.5);}
	if($amount<0){ $amount=0; }
?>
<tr>
<td><?php echo trim($rowp['ref_shopee']); ?></td>
<td></td>
<td><?php echo trim($row['ref_shopee_d']); ?></td>
<td></td>
<td></td>
<td><?php echo $row['peak_ref']; ?></td>
<td><?php echo $row['price']; ?></td>
<td><?php echo $amount; ?></td>
<td></td>
</tr>
<?php } } ?>
</table>
</div>
</body>
</html>
