<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">รายการสินค้าที่ต้องสั่ง</h1>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">รูปสินค้า</th>
      <th scope="col">สินค้า</th>
      <th scope="col" class='text-center'>สั่งได้อีก</th>
      <th scope="col" class='text-center'>สต๊อกภายใน</th>
      <th scope="col" class='text-center'><a href='#' onclick='TableProductSort(1)'>สต๊อกขายรวม</a></th>
      <th scope="col" class='text-center'>จำนวน</th>
      <th scope="col" class='text-center'>สั่งของ</th>
    </tr>
  </thead>
  <tbody>
<?php
  $sql='';
  $result_o = mysqli_query($con,"SELECT count(*) as amount,pk_product FROM order_detail WHERE status=0 GROUP by pk_product");
  while($row_o=mysqli_fetch_array($result_o)){

    $result_p = mysqli_query($con,"SELECT * FROM product WHERE pk='".$row_o['pk_product']."'");
    $row_p=mysqli_fetch_array($result_p);
    $result_lock=mysqli_query($con,"SELECT sum(amount) as lock_am FROM order_detail WHERE pk_product='".$row_o['pk_product']."' and (status=0 or status=1)");
    $row_lock=mysqli_fetch_array($result_lock);
    $front=$row_p['amount']-$row_lock['lock_am'];
    $am=$front*(-1);
    if($front<0){
        $no2++;
    echo "<tr><th scope='row'>".$no2."</th><td width='20%'><img src='".$row_p['pic']."' class='img-thumbnail'></td><td><a href='main.php?page=2&pk=".$row_p['pk']."' target='_blank'>".$row_p['name']."</a><hr>".$row_p['name']."<hr>".$row_p['shopee_ref1']."</td><td class='text-center'>".$front."<br></td><td class='text-center'>".$row_p['amount']."</td><td class='text-center'>".$row_p['amount_dummy']."</td><td class='text-center'>".$row_o['amount']."</td><td><a href='https://www.allkaset.com/ajaxaddcart_reseller.php?ref=".$row_p['shopee_ref1']."&am=".$am."' class='btn btn-success' target='_blank'>สั่งของ</a><td></tr>";

    $sql.="&ref".$no2."=".$row_p['shopee_ref1']."&am".$no2."=".$am;
    }
  }

  echo "<tr><td colspan='8'><a href='https://www.allkaset.com/ajaxaddcart_reseller.php?no=".$no2."&".$sql."' class='btn btn-success' target='_blank'>สั่งของทั้งหมด</a></td></tr>";
 ?>
</tbody>
</table>
