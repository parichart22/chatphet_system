<?php include("../config.php"); ?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">รูปสินค้า</th>
      <th scope="col">สินค้า</th>
      <th scope="col">จองของ</th>
      <th scope="col" class='text-center'>สต๊อกภายใน</th>
    </tr>
  </thead>
  <tbody>
<?php
    $result = mysqli_query($con,"SELECT * FROM product WHERE amount>0 ORDER by amount DESC");
  while($row=mysqli_fetch_array($result)){
    $result_nosale = mysqli_query($con,"SELECT sum(amount) FROM order_detail WHERE DATE(datetime) BETWEEN '".$_REQUEST['datestart']."' and '".$_REQUEST['dateend']."' and pk_product='".$row['pk']."' GROUP by pk_product ORDER by sum(amount) DESC");
    $row_nosale=mysqli_fetch_array($result_nosale);
    if($row_nosale[0]==0){
    $no++;
    $result_lock=mysqli_query($con,"SELECT sum(amount) as lock_am FROM order_detail WHERE pk_product='".$row['pk']."' and (status=0 or status=1)");
    $row_lock=mysqli_fetch_array($result_lock);
    echo "<tr><th scope='row'>".$no."</th><td><a href='main.php?page=9&pk=".$row['pk']."' target='_blank'><img src='".$row['pic']."' class='img-thumbnail'></a></td><td><a href='main.php?page=2&pk=".$row['pk']."' target='_blank'>".$row['name']."</a><hr>".$row['company']."<hr>";
    if($row_p['mark_exp']==1){
      echo "<a class='btn btn-danger' onclick='MarkExp(".$row['pk'].",2)'>ออกจากกำหนดวันหมดอายุ</a>";
    }else{
      echo "<a class='btn btn-dark' onclick='MarkExp(".$row['pk'].",1)'>กำหนดวันหมดอายุ</a>";
    }
    echo "</td><td class='text-center h4'>".$row_lock['lock_am']."</td><td class='text-center h4'>".$row['amount']."</td></tr>";
}
}
?>
  </tbody>
</table>
