<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<?php
if($_GET['cancel']==1){
$update=mysqli_query($con,"UPDATE order_table SET status=99 WHERE pk='".$_REQUEST['id']."'");
if($update){
  echo "<div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
    <h1 class='h2'>ยกเลิกออเดอร์</h1>
  </div><div class='alert alert-success' role='alert'>
    สำเร็จ
  </div>";
}else{
  echo "<div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
    <h1 class='h2'>ยกเลิกออเดอร์</h1>
  </div><div class='alert alert-danger' role='alert'>
    ERROR
  </div>";
}
}else{
$result = mysqli_query($con,"SELECT * FROM order_table WHERE pk='".$_REQUEST['id']."'");
$row=mysqli_fetch_array($result);
switch($row['channel']){
  case '1':$ch='Shopee'; break;
  case '2':$ch='Lazada'; break;
}
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">หมายเลขคำสั่งซื้อ (<?php echo $ch; ?>) <?php echo $row['id_ref']; ?> <a href="main.php?page=6&id=<?php echo $_REQUEST['id']; ?>&cancel=1" class='btn btn-danger btn-sm'>ยกเลิกออเดอร์</a></h1>
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
    <label class="col-sm-12 col-form-label"><b>ค้นหา</b></label>
  </div>
  <div class="col-auto">
    <input type="text" class="form-control" id="search_txt" size="40">
  </div>
  <div class="col-auto">
    <a href="#" class="btn btn-primary mb-3" onclick="TableProductOrder(<?php echo $_REQUEST['id']; ?>)">ค้นหา</a>
  </div>
</div>

<div class="row">
<div class="col-5">
  <div id='table_product'>
    <table class="table">
      <thead>
        <tr>
          <th scope="col" colspan="6" class="text-center h4">รายการสินค้า</th>
        </tr>
        <tr>
          <th scope="col">#</th>
          <th scope="col">รูปสินค้า</th>
          <th scope="col">สินค้า</th>
          <th scope="col" class='text-center'>สต๊อกภายใน</th>
          <th scope="col" class='text-center'><a href='#' onclick='TableProductSort(1)'>สต๊อกขายรวม</a></th>
          <th scope="col">เพิ่มสินค้า</th>
        </tr>
      </thead>
      <tbody>
    <?php
      $result = mysqli_query($con,"SELECT * FROM product ORDER by datetime ASC LIMIT 20");
      while($row=mysqli_fetch_array($result)){
        $no++;
        echo "<tr><th scope='row'>".$no."</th><td><img src='".$row['pic']."' class='img-thumbnail'></td><td><a href='main.php?page=2&pk=".$row['pk']."' target='_blank'>".$row['name']."</a></td><td class='text-center'>".$row['amount']."</td><td class='text-center'>".$row['amount_dummy']."</td>
        <td><input type='text' class='form-control' id='item".$row['pk']."' value='1' size='5'> <a href='#' class='btn btn-dark' onclick='Additem(".$_REQUEST['id'].",".$row['pk'].",".$row['box_no'].")'>เพิ่ม</a><td></tr>";
    } ?>
      </tbody>
    </table>
  </div>
</div>

<div class="col-7">
  <div id='table_order_detail'>
    <table class="table">
      <thead>
        <tr>
          <th scope="col" colspan="6" class="text-center h4">สินค้าในออเดอร์</th>
        </tr>
        <tr>
          <th scope="col">#</th>
          <th scope="col">รูปสินค้า</th>
          <th scope="col">สินค้า</th>
          <th scope="col" class='text-center'>สั่งได้อีก</th>
          <th scope="col" class='text-center'>สต๊อกภายใน</th>
          <th scope="col" class='text-center'><a href='#' onclick='TableProductSort(1)'>สต๊อกขายรวม</a></th>
          <th scope="col" class='text-center'>จำนวน</th>
          <th scope="col">ลบ</th>
        </tr>
      </thead>
      <tbody>
    <?php
      $result_o = mysqli_query($con,"SELECT * FROM order_detail WHERE orderid='".$_REQUEST['id']."' ORDER by datetime DESC");
      while($row_o=mysqli_fetch_array($result_o)){
        $no2++;
        $result_p = mysqli_query($con,"SELECT * FROM product WHERE pk='".$row_o['pk_product']."'");
        $row_p=mysqli_fetch_array($result_p);
        $result_lock=mysqli_query($con,"SELECT sum(amount) as lock_am FROM order_detail WHERE pk_product='".$row_o['pk_product']."' and (status=0 or status=1)");
        $row_lock=mysqli_fetch_array($result_lock);
        $front=$row_p['amount']-$row_lock['lock_am'];
        echo "<tr><th scope='row'>".$no2."</th><td width='20%'><img src='".$row_p['pic']."' class='img-thumbnail'></td><td><a href='main.php?page=2&pk=".$row_p['pk']."' target='_blank'>".$row_p['name']."</a><hr><input type='text' class='form-control' id='qty".$row_o['pk_product']."' size='5' style='width: 40%;float: left;margin-right: 5px;'>  <a href='#' class='btn btn-success' onclick='AddListStock(".$row_o['pk_product'].")'>สั่งของ</a></td><td class='text-center'>".$front."<br></td><td class='text-center'>".$row_p['amount']."</td><td class='text-center'>".$row_p['amount_dummy']."</td><td class='text-center'>".$row_o['amount']."</td><td><a href='#' class='btn btn-danger' onclick='Delitem(".$_REQUEST['id'].",".$row_o['pk_product'].")'>ลบ</a><td></tr>";
    } ?>
      </tbody>
    </table>
  </div>
</div>
</div>
<?php } ?>
