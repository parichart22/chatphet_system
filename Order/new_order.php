<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">สร้างออเดอร์ใหม่</h1>
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
    <a href="#" class="btn btn-primary mb-3" onclick="AddOrder()">สร้างออเดอร์ใหม่</a>
  </div>
</form>

<div id='table_order'>

</div>
