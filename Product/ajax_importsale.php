<?php include("../config.php"); ?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">รูปสินค้า</th>
      <th scope="col">สินค้า</th>
      <th scope="col">จองของ</th>
      <th scope="col" class='text-center'>สต๊อกรวม</th>
    </tr>
  </thead>
  <tbody>
<?php
    $result = mysqli_query($con,"SELECT * FROM stock WHERE type=1 and date(datetime) BETWEEN '".$_REQUEST['datestart']."' and '".$_REQUEST['dateend']."' GROUP by pk_product ORDER by datetime ASC");
  while($row=mysqli_fetch_array($result)){
    $no++;
    $result_p = mysqli_query($con,"SELECT * FROM product WHERE pk='".$row['pk_product']."'");
    $row_p=mysqli_fetch_array($result_p);
    $result_lock=mysqli_query($con,"SELECT sum(amount) as lock_am FROM order_detail WHERE pk_product='".$row['pk_product']."' and (status=0 or status=1)");
    $row_lock=mysqli_fetch_array($result_lock);
    echo "<tr><th scope='row'>".$no."</th><td><a href='main.php?page=9&pk=".$row['pk_product']."' target='_blank'><img src='".$row_p['pic']."' class='img-thumbnail'></a></td><td><a href='main.php?page=2&pk=".$row['pk_product']."' target='_blank'>".$row_p['name']."</a><hr>".$row_p['company']."<hr>";
    if($row_p['mark_exp']==1){
      echo "<a class='btn btn-danger' onclick='MarkExp(".$row['pk_product'].",2)'>ออกจากกำหนดวันหมดอายุ</a>";
    }else{
      echo "<a class='btn btn-dark' onclick='MarkExp(".$row['pk_product'].",1)'>กำหนดวันหมดอายุ</a>";
    }
    echo "</td><td class='text-center h4'>".$row_lock['lock_am']."</td><td class='text-center h4'>".$row_p['amount_dummy']."</td></tr>";

}
?>
  </tbody>
</table>
