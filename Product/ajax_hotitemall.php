<?php include("../config.php"); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h4>รายงานยอดขาย <?php echo $_REQUEST['datestart']." ".$_REQUEST['dateend']; ?></h4>
</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">รูปสินค้า</th>
      <th scope="col">สินค้า</th>
      <th scope="col">จองของ</th>
      <th scope="col" class='text-center'>สต๊อกภายใน</th>
      <th scope="col" class='text-center'>จำนวนขาย</th>
    </tr>
  </thead>
  <tbody>
<?php
    $result = mysqli_query($con,"SELECT sum(amount),pk_product FROM order_detail WHERE DATE(datetime) BETWEEN '".$_REQUEST['datestart']."' and '".$_REQUEST['dateend']."' GROUP by pk_product ORDER by sum(amount) DESC");
  while($row=mysqli_fetch_array($result)){
    $no++;
    $result_lock=mysqli_query($con,"SELECT sum(amount) as lock_am FROM order_detail WHERE pk_product='".$row['pk']."' and (status=0 or status=1)");
    $row_lock=mysqli_fetch_array($result_lock);
    $result_p=mysqli_query($con,"SELECT * FROM product WHERE pk='".$row['pk_product']."'");
    $row_p=mysqli_fetch_array($result_p);
    echo "<tr><th scope='row'>".$no."</th><td><a href='main.php?page=9&pk=".$row_p['pk']."' target='_blank'><img src='".$row_p['pic']."' class='img-thumbnail'></a></td><td><a href='main.php?page=2&pk=".$row_p['pk']."' target='_blank'>".$row_p['name']."</a><hr>".$row_p['name']."<hr>".$row_p['company']."<hr>";
    if($row_p['mark_exp']==1){
      echo "<a class='btn btn-danger' onclick='MarkExp(".$row_p['pk'].",2)'>ออกจากกำหนดวันหมดอายุ</a>";
    }else{
      echo "<a class='btn btn-dark' onclick='MarkExp(".$row_p['pk'].",1)'>กำหนดวันหมดอายุ</a>";
    }

    echo "</td><td class='text-center h4'>".$row_lock['lock_am']."</td><td class='text-center h4'>".$row_p['amount']."<hr>All ".$row_p[amount_dummy]."</td><td class='text-center h4'>".$row[0]."</td></tr>";
} ?>
  </tbody>
</table>
