<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">รอบันทึกลงบัญชี</h1>
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
    <a href="#" class="btn btn-primary mb-3" onclick="SearchOrderAccount()">ค้นหา</a>
  </div>

</form>

<div id='table_order'>
  <table class="table">
    <thead>
      <tr align='center'>
        <th scope="col">#</th>
        <th scope="col">หมายเลขคำสั่งซื้อ</th>
        <th scope="col">ชื่อลูกค้า</th>
        <th scope="col">ช่องทางขาย</th>
        <th scope="col">วันที่ออเดอร์</th>
        <th scope="col">เลขที่ใบแจ้งหนี้</th>
      </tr>
    </thead>
    <tbody>
  <?php
    $result = mysqli_query($con,"SELECT * FROM order_table WHERE status='2' ORDER by datetime DESC LIMIT 100");
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
      <td class='text-center'>".$ch."</td>
      <td class='text-center'>".$row['inv_date']."</td>
      <td><input type='text' class='form-control' id='inv_no name='inv_no' size='15'> <a href='main.php?page=8&id=".$row['pk']."' class='btn btn-warning' target='_blank'>บันทึก</a></td></tr>";
  } ?>
    </tbody>
  </table>
</div>
