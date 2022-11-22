<?php include("../config.php"); ?>

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
    echo "<tr><th scope='row'>".$no2."</th><td><img src='".$row_p['pic']."' class='img-thumbnail'></td><td><a href='main.php?page=2&pk=".$row_p['pk']."' target='_blank'>".$row_p['name']."</a></td><td class='text-center'>".$front."</td><td class='text-center'>".$row_p['amount']."</td><td class='text-center'>".$row_p['amount_dummy']."</td><td class='text-center'>".$row_o['amount']."</td><td><a href='#' class='btn btn-danger' onclick='Delitem(".$_REQUEST['id'].",".$row_o['pk_product'].")'>ลบ</a><td></tr>";
} ?>
  </tbody>
</table>
