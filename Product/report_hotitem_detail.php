<link href="dist/css/datepicker.css" rel="stylesheet">
<script src="//getbootstrap.com/2.3.2/assets/js/jquery.js"></script>
<script src="//getbootstrap.com/2.3.2/assets/js/google-code-prettify/prettify.js"></script>
<script src="dist/js/bootstrap-datepicker.js"></script>
<script src="dist/js/bootstrap-datepicker-thai.js"></script>

<?php
$result_company = mysqli_query($con,"SELECT * FROM company WHERE comid='".$_REQUEST['comid']."'");
$row_company=mysqli_fetch_array($result_company);
 ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">สินค้าขายดี : <?php echo $row_company['company_name']; ?></h1>
</div>
<div class="row g-3">
  <div class="col-auto">
    <label class="col-sm-12 col-form-label"><b>วันที่ขาย</b></label>
  </div>
  <div class="col-auto" id="example_html">
    <input class="form-control" type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" id="datestart">
  </div>
  <div class="col-auto" id="example_html">
    <input class="form-control" type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" id="dateend">
  </div>
  <div class="col-auto">
    <a href="#" class="btn btn-primary mb-3" onclick="ReportHotitem(<?php echo $_REQUEST['comid']; ?>)">ดูรายการ</a>
  </div>
</div>

<div id='table_hotitem'>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">รูปสินค้า</th>
      <th scope="col">สินค้า</th>
      <th scope="col">จองของ</th>
      <th scope="col" class='text-center'>สต๊อกภายใน</th>
      <th scope="col" class='text-center'>จำนวนขาย</th>
      <th scope="col" class='text-center'>เฉลี่ย 1 เดือน</th>
    </tr>
  </thead>
  <tbody>
<?php
    $result = mysqli_query($con,"SELECT sum(amount),pk_product FROM order_detail WHERE comid='".$_REQUEST['comid']."' GROUP by pk_product ORDER by sum(amount) DESC");
  while($row=mysqli_fetch_array($result)){
    $no++;
    $result_lock=mysqli_query($con,"SELECT sum(amount) as lock_am FROM order_detail WHERE pk_product='".$row['pk_product']."' and (status=0 or status=1)");
    $row_lock=mysqli_fetch_array($result_lock);
    $result_p=mysqli_query($con,"SELECT * FROM product WHERE pk='".$row['pk_product']."'");
    $row_p=mysqli_fetch_array($result_p);
    echo "<tr><th scope='row'>".$no."</th><td><a href='main.php?page=9&pk=".$row_p['pk']."' target='_blank'><img src='".$row_p['pic']."' class='img-thumbnail'></a></td><td><a href='main.php?page=2&pk=".$row_p['pk']."' target='_blank'>".$row_p['name']."</a> | รหัสสินค้า <b>".$row_p['pk']."</b><hr>".$row_p['name']."<hr>".$row_p['company']."<hr>";
    if($row_p['mark_exp']==1){
      echo "<a class='btn btn-danger' onclick='MarkExp(".$row_p['pk'].",2)'>ออกจากกำหนดวันหมดอายุ</a>";
    }else{
      echo "<a class='btn btn-dark' onclick='MarkExp(".$row_p['pk'].",1)'>กำหนดวันหมดอายุ</a>";
    }
    $avg=floor($row['0']/12);
    echo "</td><td class='text-center h4'>".$row_lock['lock_am']."</td><td class='text-center h4'>".$row_p['amount']."<hr>All ".$row_p['amount_dummy']."</td><td class='text-center h4'>".$row['0']."</td><td class='text-center h4'>".$avg."</td></tr>";
} ?>
  </tbody>
</table>
</div>
