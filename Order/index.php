<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">ออเดอร์ใหม่</h1>
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
<form class="row g-2">
  <div class="col-auto">
    <select id='ch' class="form-select">
      <option value="1">Shopee</option>
      <option value="2">Lazada</option>
      <option value="3">Facebook</option>
    </select>
  </div>

  <div class="col-auto">
    <label class="col-sm-12 col-form-label"><b>หมายเลขคำสั่งซื้อ</b></label>
  </div>

  <div class="col-auto">
    <input type="text" class="form-control" id="id_ref" name='id_ref' size="20">
  </div>

  <div class="col-auto">
    <label class="col-sm-12 col-form-label"><b>ชื่อ-สกุล</b></label>
  </div>

  <div class="col-auto">
    <input type="text" class="form-control" id="customer_name" name='customer_name' size="20">
  </div>

  <div class="col-auto">
    <label class="col-sm-12 col-form-label"><b>วันที่ทำออเดอร์</b></label>
  </div>

  <div class="col-auto">
    <input type="text" class="form-control" id="datepicker" name='date' value="<?php echo DATE("Y-m-d"); ?>">
  </div>

  <script>
      $('#datepicker').datepicker({
          uiLibrary: 'bootstrap',
           format: "yyyy-mm-dd"
      });
  </script>

  <div class="col-auto">
    <a href="#" class="btn btn-success mb-3" onclick="AddOrder()">สร้างออเดอร์ใหม่</a>
  </div>
</form>

<form class="row g-3">
  <div class="col-auto">
    <label class="col-sm-12 col-form-label"><b>หมายเลขคำสั่งซื้อ</b></label>
  </div>

  <div class="col-auto">
    <input type="text" class="form-control" id="search_txt" name='search_txt' size="40">
  </div>

  <div class="col-auto">
    <a href="#" class="btn btn-primary mb-3" onclick="SearchOrder(0)">ค้นหา</a>
  </div>

</form>

<div id='table_order'>
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
    $result = mysqli_query($con,"SELECT * FROM order_table WHERE status='0' ORDER by datetime DESC");
    while($row=mysqli_fetch_array($result)){
      $no++;
      switch($row['channel']){
        case '1':$ch='Shopee'; break;
        case '2':$ch='Lazada'; break;
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
</div>
