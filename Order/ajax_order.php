<?php include("../config.php"); ?>

<table class="table">
  <thead>
    <tr align='center'>
      <th scope="col">#</th>
      <th scope="col">หมายเลขคำสั่งซื้อ</th>
      <th scope="col">ชื่อลูกค้า</th>
      <th scope="col">จำนวนสินค้า</th>
      <th scope="col">ช่องทางขาย</th>
      <th scope="col">วันที่ออเดอร์</th>
      <th scope="col">แก้ไข</th>
      <th scope="col">เตรียมแพ็ค</th>
    </tr>
  </thead>
  <tbody>
<?php
  if($_REQUEST['search']!=''){
  $result = mysqli_query($con,"SELECT * FROM order_table WHERE id_ref='".$_REQUEST['search']."' and status='".$_REQUEST['status']."' ORDER by datetime DESC");
  }else{
  $result = mysqli_query($con,"SELECT * FROM order_table WHERE status='0' ORDER by datetime DESC");
  }
  while($row=mysqli_fetch_array($result)){
    $no++;
    switch($row['channel']){
      case '1':$ch='Shopee'; break;
      case '2':$ch='Lazada'; break;
      case '3':$ch='Facebook'; break;
    }
    echo "<tr align='center'><th scope='row'>".$no."</th>
    <td>".$row['id_ref']."</td>
    <td>".$row['customer_name']."</td>
    <td>".$row['items']."</td>
    <td class='text-center h4'>".$ch."</td>
    <td class='text-center h4'>".$row['inv_date']."</td>
    <td><a href='main.php?page=6&id=".$row['pk']."' class='btn btn-dark' target='_blank'>แก้ไข</a></td>
    <td><a href='#' class='btn btn-success' onclick='PackStatus(".$row['pk'].",1)'>เตรียมแพ็ค</a></td></tr>";
} ?>
  </tbody>
</table>
