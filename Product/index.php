<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">รายการสินค้า</h1>
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
    <input type="text" class="form-control" list="datalistOptions" id="product_name" name='product_name' size="30">
  </div>

  <div class="col-auto">
    <label class="col-sm-12 col-form-label"><b>ชื่อยี่ห้อ</b></label>
  </div>

  <div class="col-auto">
    <input type="text" class="form-control" list="datalistOptions" id="company_name" size="10">
  </div>

  <div class="col-auto">
  <select id='comid' class="form-select">
    <option value="">เลือกบริษัท</option>
    <?php
    $result_com = mysqli_query($con,"SELECT * FROM company ORDER by company_name ASC");
    while($row_com=mysqli_fetch_array($result_com)){
      echo "<option value='".$row_com[comid]."'>".$row_com[company_name]."</option>";
    }
     ?>
  </select>
  </div>
  <div class="col-auto">
    <a href="#" class="btn btn-primary mb-3" onclick="AddProduct()">เพิ่มสินค้า</a>
  </div>
</div>

<div class="row g-3">
  <div class="col-auto">
    <label class="col-sm-12 col-form-label"><b>ค้นหา</b></label>
  </div>
  <div class="col-auto">
    <input type="text" class="form-control" id="search_txt" size="40" onkeypress="TableProduct(event)">
  </div>
  <div class="col-auto">
    <input type="checkbox" id="mark_exp" value="1"> กำหนดวันหมดอายุ
  </div>
  <div class="col-auto">
    <a href="#" class="btn btn-primary mb-3" onclick="TableProductBtn()">ค้นหา</a>
  </div>
  <div class="col-auto">
    <label class="col-sm-12 col-form-label"><b>ช่องสินค้า</b></label>
  </div>
  <div class="col-auto">
    <input type="text" class="form-control" id="box_no" size="10">
  </div>
  <div class="col-auto">
    <a href="#" class="btn btn-primary mb-3" onclick="TableProductBtn()">ค้นหา</a>
  </div>
</div>

<div id='table_product'>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">รูปสินค้า</th>
        <th scope="col">สินค้า</th>
        <th scope="col">จองของ</th>
        <?php if($_REQUEST['type']==1){ ?>
        <th scope="col" class='text-center'><a href='#' onclick='TableProductSort(4)'>สต๊อกภายใน</a></th>
      <?php }elseif($_REQUEST['type']==2){ ?>
          <th scope="col" class='text-center'><a href='#' onclick='TableProductSort(3)'>สต๊อกภายใน</a></th>
        <?php }else{ ?>
          <th scope="col" class='text-center'><a href='#' onclick='TableProductSort(3)'>สต๊อกภายใน</a></th>
        <?php } ?>

        <?php if($_REQUEST['type']==1){ ?>
        <th scope="col" class='text-center'><a href='#' onclick='TableProductSort(2)'>สต๊อกขายรวม</a></th>
      <?php }elseif($_REQUEST['type']==2){ ?>
          <th scope="col" class='text-center'><a href='#' onclick='TableProductSort(1)'>สต๊อกขายรวม</a></th>
        <?php }else{ ?>
          <th scope="col" class='text-center'><a href='#' onclick='TableProductSort(1)'>สต๊อกขายรวม</a></th>
        <?php } ?>
        <th scope="col">ref1</th>
        <th scope="col">Price Shopee</th>
        <th scope="col">แก้ไข</th>
      </tr>
    </thead>
    <tbody>
  <?php
    $result = mysqli_query($con,"SELECT * FROM product ORDER by datetime ASC LIMIT 20");
    while($row=mysqli_fetch_array($result)){
      $no++;
      $result_lock=mysqli_query($con,"SELECT sum(amount) as lock_am FROM order_detail WHERE pk_product='".$row['pk']."' and (status=0 or status=1)");
      $row_lock=mysqli_fetch_array($result_lock);
      echo "<tr><th scope='row'>".$no."</th><td><a href='main.php?page=9&pk=".$row['pk']."' target='_blank'><img src='".$row['pic']."' class='img-thumbnail'></a></td><td><a href='main.php?page=2&pk=".$row['pk']."' target='_blank'>".$row['name']."</a><br>
      <textarea class='form-control' name='product_name' id='product_name".$row['pk']."'>".$row['name']."</textarea><br><hr>".$row['company']."</td><td class='text-center h4'>".$row_lock['lock_am']."</td><td class='text-center h4'>".$row['amount']."</td><td class='text-center h4'>".$row['amount_dummy']."</td>
      <td>
      <div class='row g-2'>
      <div class='col-auto'><b>shopee_ref1</b></div>
      <div class='col-auto'><input type='text' class='form-control' name='shopee_ref1' id='shopee_ref1".$row['pk']."' value=".$row['shopee_ref1']."></div>
      </div><br>
      <div class='row g-2'>
      <div class='col-auto'><b>shopee_ref2</b></div>
      <div class='col-auto'><input type='text' class='form-control' name='shopee_ref2' id='shopee_ref2".$row['pk']."' value=".$row['shopee_ref2']."></div>
      </div><br>
      <div class='row g-2'>
      <div class='col-auto'><b>lazada_ref</b></div>
      <div class='col-auto'><input type='text' class='form-control' name='lazada_ref' id='lazada_ref".$row['pk']."' value=".$row['lazada_ref']."></div>
      </div><br>
      <div class='row g-2'>
      <div class='col-auto'><b>lazada_productid</b></div>
      <div class='col-auto'><input type='text' class='form-control' name='lz_productid' id='lz_productid".$row['pk']."' value=".$row['lz_productid']."></div>
      </div><br>
      <div class='row g-2'>
      <div class='col-auto'><b>lz_skuid</b></div>
      <div class='col-auto'><input type='text' class='form-control' name='lz_skuid' id='lz_skuid".$row['pk']."' value=".$row['lz_skuid']."></div>
      </div><br>
      <div class='row g-2'>
      <div class='col-auto'><b>lz_md5</b></div>
      <div class='col-auto'><input type='text' class='form-control' name='s_wb_product' id='s_wb_product".$row['pk']."' value=".$row['s_wb_product']."></div>
      </div><br>";
      if($row['peak_ref']==''){
      echo "<div class='row g-2' style='background:red'>
        <div class='col-auto'><b>peak_ref</b></div>
        <div class='col-auto'><input type='text' class='form-control' name='peak_ref' id='peak_ref".$row['pk']."' value='no_peak'></div>
        </div>";
      }else{
      echo "<div class='row g-2'>
      <div class='col-auto'><b>peak_ref</b></div>
      <div class='col-auto'><input type='text' class='form-control' name='peak_ref' id='peak_ref".$row['pk']."' value=".$row['peak_ref']."></div>
      </div>";
      }
      echo "</td>
      <td><input type='number' class='form-control' name='price' id='price".$row['pk']."' value=".$row['shopee_price']." size='3'></td>
      <td><a class='btn btn-dark' onclick='EditProduct(".$row['pk'].")'>แก้ไข</a><td></tr>";
  } ?>
    </tbody>
  </table>
</div>
