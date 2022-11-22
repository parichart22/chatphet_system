<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">เตรียมแพ็ค</h1>
  <!--<div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group me-2">
      <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
      <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
    </div>
    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
      <span data-feather="calendar"></span>
      This week
    </button>
  </div>-->
</div>
<form class="row g-3">
  <div class="col-auto">
    <label class="col-sm-12 col-form-label"><b>หมายเลขคำสั่งซื้อ</b></label>
  </div>

  <div class="col-auto">
    <input type="text" class="form-control" id="search_txt" name='search_txt' size="40">
  </div>

  <div class="col-auto">
    <a href="#" class="btn btn-primary mb-3" onclick="SearchOrder(1)">ค้นหา</a>
  </div>

  <div class="col-auto">
    <a href='../system/print_list.php' class='btn btn-dark' target="_blank">พิมพ์รายการแพ็ค</a>
  </div>
</form>

<div id='table_pack'>
  <table class="table">
    <thead>
      <tr align='center'>
        <th scope="col">#</th>
        <th scope="col">ใบแปะหน้า</th>
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
    $result = mysqli_query($con,"SELECT * FROM order_table WHERE status='1' ORDER by inv_date ASC");
    while($row=mysqli_fetch_array($result)){
      $no++;
      switch($row['channel']){
        case '1':$ch='Shopee'; break;
        case '2':$ch='Lazada'; break;
        case '3':$ch='Facebook'; break;
      }
      echo "<tr align='center'><th scope='row'>".$no."</th>
      <td>";
      if($row['img_pickup']!=''){
      echo "<a href='pickup/".$row['img_pickup']."' class='btn btn-info' target='_blank' download>เซฟใบแปะหน้า</a>";
      }
      echo "</td>
      <td>".$row['id_ref']."</td>
      <td>".$row['customer_name']."</td>
      <td>".$row['items']."</td>
      <td class='text-center h4'>".$ch."</td>
      <td class='text-center h4'>".$row['inv_date']."</td>
      <td><a href='#' class='btn btn-secondary' onclick='PackStatus(".$row['pk'].",0)'>แก้ไข</a> <a href='main.php?page=8&id=".$row['pk']."' class='btn btn-warning' target='_blank'>ดำเนินการแพ็ค</a></td></tr>";
  } ?>
    </tbody>
  </table>
</div>
