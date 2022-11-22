<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">รายการสินค้าแบบกลุ่ม</h1>
  <!--<div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group me-2">
      <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
      <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
    </div>
    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
      <span data-feather="calendar"></span>
      This week
    </button>
  </div>-->
</div>

<div class="row g-3">
  <div class="col-auto">
    <label class="col-sm-12 col-form-label"><b>ชื่อสินค้า</b></label>
  </div>
  <div class="col-auto">
    <input type="text" class="form-control" list="datalistOptions" id="product_name" name="product_name" size="30">
  </div>

  <div class="col-auto">
    <label class="col-sm-12 col-form-label"><b>รหัสสินค้า Shopee</b></label>
  </div>

  <div class="col-auto">
    <input type="text" class="form-control" list="datalistOptions" id="ref_shopee" size="30">
  </div>

  <div class="col-auto">
    <a href="#" class="btn btn-primary mb-3" onclick="AddProductGroup()">เพิ่มสินค้า</a>
  </div>
</div>

<div id="table_product">
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
      echo "</td><td><a class='btn btn-dark' onclick='EditGroup(".$row['pk'].")'>แก้ไข</a><td></tr>";
  } ?>
    </tbody>
  </table>
</div>
