<?php
if($_REQUEST['upload']==1){
  $temp = explode(".", $_FILES["img"]["name"]);
  $newfilename = round(microtime(true)) . '.' . end($temp);
  move_uploaded_file($_FILES["img"]["tmp_name"], "image/" . $newfilename);
  $update=mysqli_query($con,"UPDATE product SET pic='https://chatphet.com/system/image/".$newfilename."' WHERE pk='".$_REQUEST['pk']."'");
  if($update){
    echo "<div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
      <h1 class='h2'>อัพโหลดรูปสินค้า</h1>
    </div><div class='alert alert-success' role='alert'>
      อัพโหลดสำเร็จ
    </div>";
  }else{
    echo "<div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
      <h1 class='h2'>อัพโหลดรูปสินค้า</h1>
    </div><div class='alert alert-danger' role='alert'>
      ERROR
    </div>";
  }
}else{
$result=mysqli_query($con,"SELECT * FROM product WHERE pk='".$_REQUEST['pk']."'");
$row=mysqli_fetch_array($result);
 ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2"><?php echo $row['name']; ?></h1>
</div>

<form class="row g-3" action="main.php?page=9" method="post" target="_blank" enctype="multipart/form-data">
  <div class="col-auto">
    <img src="<?php echo $row['pic']; ?>">
  </div>
  <div class="col-auto">
    <label class="col-sm-12 col-form-label"><b>รูปใบแปะหน้า 190x270</b></label><br>
    <input type="file" name="img">
  </datalist>
  </div>
  <div class="col-auto">
    <input type="submit" class="btn btn-primary mb-3" value="อัพโหลด">
    <input type="hidden" name="upload" value="1">
    <input type="hidden" name="pk" value="<?php echo $_REQUEST['pk']; ?>">
  </div>
</form>
<?php } ?>
