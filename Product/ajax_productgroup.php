<?php include("../config.php"); ?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">สินค้า</th>
      <th scope="col">ref1</th>
      <th scope="col">แก้ไข</th>
    </tr>
  </thead>
  <tbody>
<?php
  $result = mysqli_query($con,"SELECT * FROM product_group ORDER by pk ASC");
  while($row=mysqli_fetch_array($result)){
    $no++;
    echo "<tr><th scope='row'>".$no."</th><td><a href='main.php?page=19&pk=".$row['pk']."' target='_blank'>".$row['name']."</a><br>
    <textarea class='form-control' name='product_name' id='product_name".$row['pk']."'>".$row['name']."</textarea></td>
    <td>
    <div class='row g-2'>
    <div class='col-auto'><b>shopee_ref1</b></div>
    <div class='col-auto'><input type='text' class='form-control' name='shopee_ref1' id='shopee_ref1".$row['pk']."' value=".$row['ref_shopee']."></div>
    </div>";
    echo "</td><td><a class='btn btn-dark' onclick='EditProduct(".$row['pk'].")'>แก้ไข</a><td></tr>";
} ?>
  </tbody>
</table>
</table>
