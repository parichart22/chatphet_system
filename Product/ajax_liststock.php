<?php include("../config.php");
$result_box=mysqli_query($con,"SELECT * FROM product WHERE pk='".$_REQUEST['pk']."'");
$row_box=mysqli_fetch_array($result_box);
?>
<form class="row g-3">
  <div class="col-auto">
    <label class="col-sm-12 col-form-label"><b>ช่อง</b></label>
  </div>

  <div class="col-auto">
    <input type="text" class="form-control" id="box" name='box' size="10" value="<?php echo $row_box['box_no']; ?>">
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
    echo "<tr class=".$bg."><td class='text-center h4'>".$row['dateexp']."</td><td class='text-center h4'>".$row[0]."</td><td class='text-center'>
    <form class='row g-3'>
    <div class='col-auto'>
    <input type='text' class='form-control' id='amount".$row['pk_product']."'>
    </div>
    <div class='col-auto'>
    <a href='#' class='btn btn-danger mb-3' onclick='VoidStock(".$_REQUEST['pk'].",2,".$row['year'].",".$row['month'].")'>ลดสต๊อก</a>
    </div>
    </form></td></tr>";
    $total+=$row[0];
} ?>
  </tbody>
  <thead>
    <tr>
      <th scope="col" class='text-center h4'>รวม</th>
      <th scope="col" class='text-center h4'><?php echo $total; ?></th>
      <th scope="col" class='text-center h4'></th>
    </tr>
  </thead>
</table>

<table class="table">
  <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col" class='text-center'>จำนวนคงเหลือ</th>
      <th scope="col" class='text-center'>จำนวน</th>
      <th scope="col" class='text-center'>วันหมดอายุ/วันผลิต</th>
    </tr>
  </thead>
  <tbody>
<?php
  $result = mysqli_query($con,"SELECT * FROM stock WHERE pk_product='".$_REQUEST['pk']."' ORDER by pk DESC LIMIT 20");
  while($row=mysqli_fetch_array($result)){
    $no++;
    if($row['type']==1){ $bg='alert-success'; $sign='+'; }else{ $bg='alert-danger'; $sign=''; }
    echo "<tr class=".$bg."><th scope='row'>".$no."</th><td class='text-center h4'>".$row['balance_amount']."</td><td class='text-center h4'>".$sign.$row['amount']."</td><td class='text-center h4'>".$row['dateexp']."</td></tr>";
} ?>
  </tbody>
</table>
