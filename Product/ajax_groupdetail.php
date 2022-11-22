<?php include("../config.php"); ?>

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
  $result = mysqli_query($con,"SELECT * FROM product_group_detail WHERE pk_product_group='".$_REQUEST['pk']."' ORDER by pk DESC");
  while($row=mysqli_fetch_array($result)){
    $no++;
      $result_p = mysqli_query($con,"SELECT * FROM product WHERE pk='".$row[pk_product]."'");
      $row_p=mysqli_fetch_array($result_p);
    echo "<tr class=".$bg."><th scope='row'>".$no."</th><td class='text-center'><img src='".$row_p['pic']."' class='img-thumbnail'></td><td class='text-center'><a href='main.php?page=2&pk=".$row_p['pk']."' target='_blank'>".$row_p['name']."</a></td><td><input type='text' class='form-control' name='ref_shopee_d' id='ref_shopee_d".$row['pk']."' value=".$row['ref_shopee_d']."><hr><b>".$row[peak_ref]."</b></td><td><input type='text' class='form-control' name='price' id='price".$row['pk']."' value=".$row['price']."></td><td><a class='btn btn-dark' onclick='EditProductGroup(".$row['pk'].")'>แก้ไข</a><td></tr>";
} ?>
  </tbody>
</table>
