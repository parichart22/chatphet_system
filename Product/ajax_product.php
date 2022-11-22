<?php include("../config.php"); ?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">รูปสินค้า</th>
      <th scope="col">สินค้า</th>
      <th scope="col">จองของ</th>
      <?php if($_REQUEST['type']==3){ ?>
      <th scope="col" class='text-center'><a href='#' onclick='TableProductSort(4)'>สต๊อกภายใน</a></th>
    <?php }elseif($_REQUEST['type']==4){ ?>
        <th scope="col" class='text-center'><a href='#' onclick='TableProductSort(3)'>สต๊อกภายใน</a></th>
      <?php }else{ ?>
        <th scope="col" class='text-center'><a href='#' onclick='TableProductSort(4)'>สต๊อกภายใน</a></th>
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
  if($_REQUEST['search']!=''){
    $search=trim($_REQUEST['search']);
    $result = mysqli_query($con,"SELECT * FROM product WHERE name LIKE '%".$_REQUEST['search']."%' ORDER by pk DESC");
  }elseif($_REQUEST['boxno']!=''){
    $result = mysqli_query($con,"SELECT * FROM product WHERE box_no='".$_REQUEST['boxno']."' ORDER by pk DESC");
  }elseif($_REQUEST['mark_exp']==1){
    $result = mysqli_query($con,"SELECT * FROM product WHERE mark_exp=1 ORDER by pk DESC");
  }elseif($_REQUEST['type']==1) {
    $result = mysqli_query($con,"SELECT * FROM product ORDER by amount_dummy DESC");
  }elseif($_REQUEST['type']==2) {
    $result = mysqli_query($con,"SELECT * FROM product ORDER by amount_dummy ASC");
  }elseif($_REQUEST['type']==3) {
    $result = mysqli_query($con,"SELECT * FROM product ORDER by amount DESC");
  }elseif($_REQUEST['type']==4) {
    $result = mysqli_query($con,"SELECT * FROM product ORDER by amount ASC");
  }else {
    $result = mysqli_query($con,"SELECT * FROM product ORDER by datetime ASC LIMIT 20");
  }

  while($row=mysqli_fetch_array($result)){
    $no++;
    $result_lock=mysqli_query($con,"SELECT sum(amount) as lock_am FROM order_detail WHERE pk_product='".$row['pk']."' and (status=0 or status=1)");
    $row_lock=mysqli_fetch_array($result_lock);
    echo "<tr><th scope='row'>".$no."</th><td><a href='main.php?page=9&pk=".$row['pk']."' target='_blank'><img src='".$row['pic']."' class='img-thumbnail'></a><hr><b>รหัสสินค้า : ".$row['pk']."</b></td><td><a href='main.php?page=2&pk=".$row['pk']."' target='_blank'>".$row['name']."</a><br><textarea class='form-control' name='product_name' id='product_name".$row['pk']."'>".$row['name']."</textarea><br><hr>".$row['company']."<hr>";
    if($row['mark_exp']==1){
      echo "<a class='btn btn-danger' onclick='MarkExp(".$row['pk'].",2)'>ออกจากกำหนดวันหมดอายุ</a>";
    }else{
      echo "<a class='btn btn-dark' onclick='MarkExp(".$row['pk'].",1)'>กำหนดวันหมดอายุ</a>";
    }
    echo "</td><td class='text-center h4'>".$row_lock['lock_am']."</td><td class='text-center h4'>".$row['amount']."</td><td class='text-center h4'>".$row['amount_dummy']."</td>
    <td>";
    if($row['shopee_ref1']==''){
      echo "<div class='row g-2' style='background:red'>
      <div class='col-auto'><b>shopee_ref1</b></div>
      <div class='col-auto'><input type='text' class='form-control' name='shopee_ref1' id='shopee_ref1".$row['pk']."' value='no_shopee'></div>
      </div><br>";
    }else {
      echo "<div class='row g-2'>
      <div class='col-auto'><b>shopee_ref1</b></div>
      <div class='col-auto'><input type='text' class='form-control' name='shopee_ref1' id='shopee_ref1".$row['pk']."' value=".$row['shopee_ref1']."></div>
      </div><br>";
    }

    echo "<div class='row g-2'>
    <div class='col-auto'><b>shopee_ref2</b></div>
    <div class='col-auto'><input type='text' class='form-control' name='shopee_ref2' id='shopee_ref2".$row['pk']."' value=".$row['shopee_ref2']."></div>
    </div><br>";
    if($row['lazada_ref']==''){
      echo "<div class='row g-2' style='background:red'>
      <div class='col-auto'><b>lazada_ref</b></div>
      <div class='col-auto'><input type='text' class='form-control' name='lazada_ref' id='lazada_ref".$row['pk']."' value='no_lazada'></div>
      </div><br>";
    }else {
      echo "<div class='row g-2'>
      <div class='col-auto'><b>lazada_ref</b></div>
      <div class='col-auto'><input type='text' class='form-control' name='lazada_ref' id='lazada_ref".$row['pk']."' value=".$row['lazada_ref']."></div>
      </div><br>";
    }

    if($row['lz_productid']==''){
    echo "<div class='row g-2'>
    <div class='col-auto'><b>lazada_productid</b></div>
    <div class='col-auto'><input type='text' class='form-control' name='lz_productid' id='lz_productid".$row['pk']."' value='no_lz_productid'></div>
    </div><br>";
    }else {
      echo "<div class='row g-2'>
      <div class='col-auto'><b>lazada_productid</b></div>
      <div class='col-auto'><input type='text' class='form-control' name='lz_productid' id='lz_productid".$row['pk']."' value=".$row['lz_productid']."></div>
      </div><br>";
    }
    echo "<div class='row g-2'>
    <div class='col-auto'><b>lz_skuid</b></div>
    <div class='col-auto'><input type='text' class='form-control' name='lz_skuid' id='lz_skuid".$row['pk']."' value=".$row['lz_skuid']."></div>
    </div><br>
    <div class='row g-2'>
    <div class='col-auto'><b>lz_md5</b></div>
    <div class='col-auto'><input type='text' class='form-control' name='s_wb_product' id='s_wb_product".$row['pk']."' value=".$row['s_wb_product']."></div>
    </div><br>";
    if($row['lnwshop_ref']==''){
      echo "<div class='row g-2' style='background:red'>
      <div class='col-auto'><b>lnwshop_ref</b></div>
      <div class='col-auto'><input type='text' class='form-control' name='lnwshop_ref' id='lnwshop_ref".$row['pk']."' value='no_lnwshop_ref'></div>
      </div><br>";
    }else{
    echo "<div class='row g-2'>
    <div class='col-auto'><b>lnwshop_ref</b></div>
    <div class='col-auto'><input type='text' class='form-control' name='lnwshop_ref' id='lnwshop_ref".$row['pk']."' value=".$row['lnwshop_ref']."></div>
    </div><br>";
    }
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
