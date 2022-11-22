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
<!--<tr>
<td><strong>Product ID</strong></td>
<td><strong>catId</strong></td>
<td><strong>*ชื่อผลิตภัณฑ์</strong></td>
<td><strong>currencyCode</strong></td>
<td><strong>sku.skuId</strong></td>
<td><strong>Variations Combo</strong></td>
<td><strong>Shop SKU</strong></td>
<td><strong>status</strong></td>
<td><strong>*จำนวน</strong></td>
<td><strong>SpecialPrice</strong></td>
<td><strong>SpecialPrice Start</strong></td>
<td><strong>SpecialPrice End</strong></td>
<td><strong>*ราคา</strong></td>
<td><strong>SellerSKU</strong></td>
<td><strong>tr(s-wb-product@md5key)</strong></td>
</tr>-->
<?php
$result=mysqli_query($con,"SELECT * FROM product where lz_productid!=''");
while($row=mysqli_fetch_array($result)){
	if($row['lz_productid']!='no_lz_productid'){
	$result_lock=mysqli_query($con,"SELECT sum(amount) as lock_am FROM order_detail WHERE pk_product='".$row['pk']."' and (status=0 or status=1)");
	$row_lock=mysqli_fetch_array($result_lock);
	$amount=$row['amount_dummy']-$row_lock['lock_am'];
	if($amount<=10 and $row[mark_exp]==0){
		$am=ceil($amount/1.5);
		$amount=$amount-$am;
	}elseif($row[mark_exp]==1){
		$amount=0;
	}
	if($amount<0){ $amount=0; }
?>
<tr>
<td><?php echo $row['lz_productid']; ?></td>
<td><?php echo $row['catid']; ?></td> <!-- catId -->
<td></td> <!-- ชื่อผลิตภัณฑ์ -->
<td></td> <!-- currencyCode -->
<td><?php echo $row['lz_skuid']; ?></td> <!-- sku.skuId -->
<td></td> <!-- Variations Combo -->
<td></td> <!-- Shop SKU -->
<td></td> <!-- status -->
<td><?php echo $amount; ?></td>
<td></td> <!-- SpecialPrice -->
<td></td> <!-- SpecialPrice Start -->
<td></td> <!-- SpecialPrice End -->
<td></td> <!-- ราคา -->
<td><?php if($row['peak_ref']!='no_peak'){ echo $row['peak_ref']; } ?></td> <!-- SellerSKU (peak_ref) -->
<td><?php echo $row['s_wb_product']; ?></td> <!-- md5key -->
</tr>
<?php } } ?>
</table>
</div>
</body>
</html>
