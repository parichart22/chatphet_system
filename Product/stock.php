<?php
$result=mysqli_query($con,"SELECT * FROM product WHERE pk='".$_REQUEST['pk']."'");
$row=mysqli_fetch_array($result);
 ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2"><?php echo $row['name']; ?></h1>
</div>
<form class="row g-3">
  <div class="col-auto">
    <label class="col-sm-12 col-form-label"><b>รับสินค้าเข้าสต๊อก</b></label>
  </div>
  <div class="col-auto">
    <input type="text" class="form-control" id="amount" name='amount' size="10">
  </div>
  <div class="col-auto">
    <label class="col-sm-12 col-form-label"><b>วันหมดอายุ/วันผลิต</b></label>
  </div>
  <div class="col-auto">
    <select id='month' class="form-select">
      <option value="">เลือกเดือน</option>
      <option value="1">มกราคม(1)</option>
      <option value="2">กุมภาพันธ์(2)</option>
      <option value="3">มีนาคม(3)</option>
      <option value="4">เมษายน(4)</option>
      <option value="5">พฤษภาคม(5)</option>
      <option value="6">มิถุนายน(6)</option>
      <option value="7">กรกฎาคม(7)</option>
      <option value="8">สิงหาคม(8)</option>
      <option value="9">กันยายน(9)</option>
      <option value="10">ตุลาคม(10)</option>
      <option value="11">พฤศจิกายน(11)</option>
      <option value="12">ธันวาคม(12)</option>
    </select>
  </div>

  <div class="col-auto">
    <select id='year' class="form-select">
      <option value="">เลือกปี</option>
      <?php
      $year_f=DATE("Y")-5;
      $year_now=DATE("Y")+5;
      for($y=$year_f;$y<=$year_now;$y++){
        $yearth=$y+543;
       ?>
      <option value="<?php echo $y; ?>"><?php echo $yearth; ?></option>
    <?php } ?>
    </select>
  </div>
  <div class="col-auto">
    <a href="#" class="btn btn-primary mb-3" onclick="AddStock(<?php echo $_REQUEST['pk']; ?>,1)">เพิ่มสต๊อก</a>
  </div>
</form>


<div id='table_stock'>
  <form class="row g-3">
    <div class="col-auto">
      <label class="col-sm-12 col-form-label"><b>ช่อง</b></label>
    </div>

    <div class="col-auto">
      <input type="text" class="form-control" id="box" name='box' size="10" value="<?php echo $row['box_no']; ?>">
    </div>

    <div class="col-auto">
      <a href="#" class="btn btn-success mb-3" onclick="AddBox(<?php echo $_REQUEST['pk']; ?>,1)">ย้ายช่อง</a>
    </div>
  </form>
  <table class="table">
    <thead class="table-dark">
      <tr>
        <th scope="col" class='text-center'>วันหมดอายุ/วันผลิต</th>
        <th scope="col" class='text-center'>จำนวนคงเหลือ</th>
        <th scope="col" class='text-center'>แก้ไข</th>
      </tr>
    </thead>
    <tbody>
  <?php
    $result = mysqli_query($con,"SELECT sum(amount),dateexp,YEAR(dateexp) as year,MONTH(dateexp) as month,pk_product FROM stock WHERE pk_product='".$_REQUEST['pk']."' GROUP by dateexp HAVING sum(amount) > 0 ORDER by dateexp ASC");
    while($row=mysqli_fetch_array($result)){
      $no++;
      echo "<tr class=".$bg."><td class='text-center h4'>".$row['dateexp']."</td><td class='text-center h4'>".$row[0]."</td><td class='text-center'>
      <form class='row g-3'>
      <div class='col-auto'>
      <input type='text' class='form-control' id='amount".$no."'>
      </div>
      <div class='col-auto'>
      <a href='#' class='btn btn-danger mb-3' onclick='VoidStock(".$_REQUEST['pk'].",2,".$row['year'].",".$row['month'].",".$no.")'>ลดสต๊อก</a>
      </div>
      </form></td></tr>";
      $total+=$row[0];
  } ?>
  <thead>
    <tr>
      <th scope="col" class='text-center h4'>รวม</th>
      <th scope="col" class='text-center h4'><?php echo $total; ?></th>
      <th scope="col" class='text-center h4'></th>
    </tr>
  </thead>
    </tbody>
  </table>

  <table class="table">
    <thead class="table-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col" class='text-center'>จำนวนคงเหลือ</th>
        <th scope="col" class='text-center'>จำนวน</th>
        <th scope="col" class='text-center'>วันหมดอายุ/วันผลิต</th>
        <th scope="col" class='text-center'>วันเวลา</th>
      </tr>
    </thead>
    <tbody>
  <?php
    $result = mysqli_query($con,"SELECT type,balance_amount,dateexp,amount,date(datetime) as date FROM stock WHERE pk_product='".$_REQUEST['pk']."' ORDER by pk DESC LIMIT 20");
    while($row=mysqli_fetch_array($result)){
      $no++;
      if($row['type']==1){ $bg='alert-success'; $sign='+'; }else{ $bg='alert-danger'; $sign=''; }
      echo "<tr class=".$bg."><th scope='row'>".$no."</th><td class='text-center h4'>".$row['balance_amount']."</td><td class='text-center h4'>".$sign.$row['amount']."</td><td class='text-center h4'>".$row['dateexp']."</td><td class='text-center h4'>".$row['date']."</td></tr>";
  } ?>
    </tbody>
  </table>
</div>
