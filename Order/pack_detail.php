<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<?php
if($_REQUEST['pack']==1){
  $result_chk = mysqli_query($con,"SELECT * FROM order_table WHERE pk='".$_REQUEST['id']."' and status=1");
  $num_chk=mysqli_num_rows($result_chk);
  if($num_chk!=0){
    $result=mysqli_query($con,"SELECT * FROM order_detail WHERE orderid='".$_REQUEST['id']."'");
    while ($row=mysqli_fetch_array($result)) {
        $amount=$row['amount'];

        $result_stock = mysqli_query($con,"SELECT sum(amount) as amount,dateexp,YEAR(dateexp) as year,MONTH(dateexp) as month,pk_product FROM stock WHERE pk_product='".$row['pk_product']."' GROUP by dateexp HAVING sum(amount) > 0 ORDER by dateexp ASC LIMIT 1");
        $row_stock=mysqli_fetch_array($result_stock);
        if($row_stock[amount]>=$amount){
          //ตัดสต๊อกได้เลย
          $result_update=mysqli_query($con,"SELECT * FROM stock WHERE pk_product='".$row['pk_product']."' ORDER by pk DESC");
          $row_update=mysqli_fetch_array($result_update);
          $balance=$row_update['balance_amount']-$amount;
          $am=$amount*(-1);
          $sql="INSERT INTO stock (pk_product,amount,balance_amount,type,dateexp,orderid) VALUES ('".$row['pk_product']."','".$am."','".$balance."','2','".$row_stock['dateexp']."','".$_REQUEST['id']."')";
          $result_stock_cut = mysqli_query($con,$sql);
        }else{
          //แบ่งตัดสต๊อกตามล็อตวันหมดอายุ
          for ($i=1; $i<=$amount ; $i++) {
            $result_stock = mysqli_query($con,"SELECT sum(amount),dateexp,YEAR(dateexp) as year,MONTH(dateexp) as month,pk_product FROM stock WHERE pk_product='".$row['pk_product']."' GROUP by dateexp HAVING sum(amount) > 0 ORDER by dateexp ASC LIMIT 1");
            $row_stock=mysqli_fetch_array($result_stock);
              //ตัดสต๊อกได้เลย
              $result_update=mysqli_query($con,"SELECT * FROM stock WHERE pk_product='".$row['pk_product']."' ORDER by pk DESC");
              $row_update=mysqli_fetch_array($result_update);
              $balance=$row_update['balance_amount']-1;
              $sql="INSERT INTO stock (pk_product,amount,balance_amount,type,dateexp,orderid) VALUES ('".$row['pk_product']."','-1','".$balance."','2','".$row_stock['dateexp']."','".$_REQUEST['id']."')";
              $result_stock_cut = mysqli_query($con,$sql);
            }
        }


        $result_s = mysqli_query($con,"SELECT * FROM product WHERE pk='".$row['pk_product']."'");
        $row_s=mysqli_fetch_array($result_s);
        $stock=$row_s['amount']-$amount;
        $stock_dummy=$row_s['amount_dummy']-$amount;
        $update_product=mysqli_query($con,"UPDATE product SET amount='".$stock."',amount_dummy='".$stock_dummy."' WHERE pk='".$row['pk_product']."'");

      }
    $update=mysqli_query($con,"UPDATE order_table SET status=2,adminid='".$_SESSION['UserID']."' WHERE pk='".$_REQUEST['id']."'");
    $update_detail=mysqli_query($con,"UPDATE order_detail SET status=2 WHERE orderid='".$_REQUEST['id']."'");
    if($update){
      echo "<div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
        <h1 class='h2'>Import Stock</h1>
      </div><div class='alert alert-success' role='alert'>
        แพ็คสำเร็จ
      </div>";
    }else{
      echo "<div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
        <h1 class='h2'>Import Stock</h1>
      </div><div class='alert alert-danger' role='alert'>
        ERROR
      </div>";
    }
  }
}elseif($_REQUEST['upload']==1){
  $temp = explode(".", $_FILES["img"]["name"]);
  $newfilename = round(microtime(true)) . '.' . end($temp);
  move_uploaded_file($_FILES["img"]["tmp_name"], "pickup/" . $newfilename);
  $update=mysqli_query($con,"UPDATE order_table SET img_pickup='".$newfilename."' WHERE pk='".$_REQUEST['orderid']."'");
  if($update){
    echo "<div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
      <h1 class='h2'>Import Stock</h1>
    </div><div class='alert alert-success' role='alert'>
      อัพโหลดสำเร็จ
    </div>";
  }else{
    echo "<div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
      <h1 class='h2'>Import Stock</h1>
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
  case '3':$ch='Facebook'; break;
}
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">หมายเลขคำสั่งซื้อ (<?php echo $ch; ?>) <?php echo $row['id_ref']." ".$row['customer_name']; ?></h1>
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

<form class="row g-3" action="main.php?page=8" method="post" target="_blank" enctype="multipart/form-data">
  <div class="col-auto">
    <label class="col-sm-12 col-form-label"><b>รูปใบแปะหน้า</b></label>
  </div>
  <div class="col-auto">
    <input type="file" name="img">
  </datalist>
  </div>
  <div class="col-auto">
    <input type="submit" class="btn btn-primary mb-3" value="อัพโหลด">
    <input type="hidden" name="upload" value="1">
    <input type="hidden" name="orderid" value="<?php echo $_REQUEST['id']; ?>">
  </div>
</form>

<div class="row">
<div class="col-12">
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
          <th scope="col" class='text-center'>จำนวน</th>
        </tr>
      </thead>
      <tbody>
    <?php
      $result_o = mysqli_query($con,"SELECT * FROM order_detail WHERE orderid='".$_REQUEST['id']."' ORDER by datetime DESC");
      while($row_o=mysqli_fetch_array($result_o)){
        $no2++;
        $result_p = mysqli_query($con,"SELECT * FROM product WHERE pk='".$row_o['pk_product']."'");
        while($row_p=mysqli_fetch_array($result_p))
        echo "<tr><th scope='row'>".$no2."</th><td><img src='".$row_p['pic']."' class='img-thumbnail'></td><td><a href='main.php?page=2&pk=".$row_p['pk']."' target='_blank'>".$row_p['name']."</a></td><td class='text-center'><h2>".$row_o['amount']."</h2></td></tr>";
    } ?>
      </tbody>
    </table>
  </div>
  <center><a href='main.php?page=8&id=<?php echo $_REQUEST['id']; ?>&pack=1' class='btn btn-success'>แพ็คเรียบร้อยแล้ว</a></center>
  <br><br>
</div>
</div>
<?php } ?>
