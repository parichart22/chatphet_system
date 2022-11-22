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
      <th scope="col">แพ็ค</th>
    </tr>
  </thead>
  <tbody>
<?php
  if($_REQUEST['search']!=''){
    $result = mysqli_query($con,"SELECT * FROM order_table WHERE id_ref='".$_REQUEST['search']."' and status='2' ORDER by datetime DESC");
  }else {
    $result = mysqli_query($con,"SELECT * FROM order_table WHERE status='2' ORDER by datetime DESC LIMIT 100");
  }

  while($row=mysqli_fetch_array($result)){
    $no++;
    switch($row['channel']){
      case '1':$ch='Shopee'; break;
      case '2':$ch='Lazada'; break;
      case '3':$ch='Facebook'; break;
    }
    echo "<tr align='center'><th scope='row'>".$no."</th>";
    echo "<td>".$row['id_ref']."</td>
    <td>".$row['customer_name']."</td>
    <td>".$row['items']."</td>
    <td class='text-center h4'>".$ch."</td>
    <td class='text-center h4'>".$row['inv_date']."</td>
    <td><input type='text' class='form-control' id='inv_no name='inv_no' size='15'> <a href='main.php?page=8&id=".$row['pk']."' class='btn btn-warning' target='_blank'>บันทึก</a></td></tr>";
} ?>
  </tbody>
</table>
