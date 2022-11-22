<?php
$result=mysqli_query($con,"SELECT * FROM product_group WHERE pk='".$_REQUEST['pk']."'");
$row=mysqli_fetch_array($result);
 ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2"><?php echo $row['name']; ?></h1>
</div>
<form class="row g-3">
  <div class="col-auto">
    <label class="col-sm-12 col-form-label"><b>รหัสสินค้า</b></label>
  </div>
  <div class="col-auto">
    <input type="text" class="form-control" id="pk_product" name='pk_product' size="10">
  </div>

  <div class="col-auto">
    <a href="#" class="btn btn-primary mb-3" onclick="AddGroupDetail(<?php echo $_REQUEST['pk']; ?>)">เพิ่มสินค้า</a>
  </div>
</form>


<div id='table_stock'>
  <table class="table">
    <thead class="table-dark">
      <tr>
        <th scope="col" class='text-center'>no</th>
        <th scope="col" class='text-center'>รูปสินค้า</th>
        <th scope="col" class='text-center'>สินค้า</th>
        <th scope="col" class='text-center'>ref_shopee_d</th>
        <th scope="col" class='text-center'>Price Shopee</th>
        <th scope="col" class='text-center'>แก้ไข</th>
      </tr>
    </thead>
    <tbody>
  <?php
    $result = mysqli_query($con,"SELECT * FROM product_group_detail WHERE pk_product_group='".$_REQUEST['pk']."' ORDER by pk ASC");
    while($row=mysqli_fetch_array($result)){
      $no++;
        $result_p = mysqli_query($con,"SELECT * FROM product WHERE pk='".$row['pk_product']."'");
        $row_p=mysqli_fetch_array($result_p);
      echo "<tr class=".$bg."><th scope='row'>".$no."</th><td class='text-center'><img src='".$row_p['pic']."' class='img-thumbnail'></td><td class='text-center'><a href='main.php?page=2&pk=".$row_p['pk']."' target='_blank'>".$row_p['name']."</a><hr>".$row_p['name']."</td><td><input type='text' class='form-control' name='ref_shopee_d' id='ref_shopee_d".$row['pk']."' value=".$row['ref_shopee_d']."><hr><b>".$row['peak_ref']."</b></td><td><input type='text' class='form-control' name='price' id='price".$row['pk']."' value=".$row['price']."></td><td><a class='btn btn-dark' onclick='EditProductGroup(".$row['pk'].")'>แก้ไข</a><td></tr>";
  } ?>
    </tbody>
  </table>

</div>
