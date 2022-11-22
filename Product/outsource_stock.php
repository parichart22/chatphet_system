<?php
if($_POST['upload']==1){
$clear=mysqli_query($con,"TRUNCATE TABLE outsource_stock");

move_uploaded_file($_FILES["import_stock"]["tmp_name"],$_FILES["import_stock"]["name"]); // Copy/Upload CSV

$objCSV = fopen($_FILES["import_stock"]["name"], "r");
while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
	$strSQL = "INSERT INTO outsource_stock ";
	$strSQL .="(shopee_ref,stock) ";
	$strSQL .="VALUES ";
	$strSQL .="('".$objArr[0]."','".$objArr[1]."') ";
	$objQuery = mysqli_query($con,$strSQL);
}
fclose($objCSV);

$result_clear=mysqli_query($con,"SELECT * FROM product");
while($row_clear=mysqli_fetch_array($result_clear)){
  $update_clear=mysqli_query($con,"UPDATE product SET amount_dummy='".$row_clear['amount']."' WHERE pk='".$row_clear['pk']."'");
}

$result=mysqli_query($con,"SELECT * FROM product WHERE shopee_ref1!='' and mark_exp=0");
while($row=mysqli_fetch_array($result)){
  $result_stock=mysqli_query($con,"SELECT * FROM outsource_stock WHERE shopee_ref='".$row['shopee_ref1']."'");
  $row_stock=mysqli_fetch_array($result_stock);
  $total_stock=$row['amount']+$row_stock['stock'];
  $update=mysqli_query($con,"UPDATE product SET amount_dummy='".$total_stock."' WHERE pk='".$row['pk']."'");
}
echo "<div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
  <h1 class='h2'>Import Stock</h1>
</div><div class='alert alert-success' role='alert'>
  Upload & Import Done.
</div>";
}else{
 ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Import Stock</h1>
</div>

<form class="row g-3" action="main.php?page=3" method="post" enctype="multipart/form-data">
  <div class="col-auto">
    <label class="col-sm-12 col-form-label"><b>File .csv</b></label>
  </div>
  <div class="col-auto">
    <input type="file" name="import_stock">
  </datalist>
  </div>
  <div class="col-auto">
    <input type="submit" class="btn btn-primary mb-3" value="อัพโหลด">
    <input type="hidden" name="upload" value="1">
  </div>
</form>
<?php } ?>
