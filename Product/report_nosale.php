<link href="dist/css/datepicker.css" rel="stylesheet">
<script src="//getbootstrap.com/2.3.2/assets/js/jquery.js"></script>
<script src="//getbootstrap.com/2.3.2/assets/js/google-code-prettify/prettify.js"></script>
<script src="dist/js/bootstrap-datepicker.js"></script>
<script src="dist/js/bootstrap-datepicker-thai.js"></script>

<?php
$result_company = mysqli_query($con,"SELECT * FROM company WHERE comid='".$_REQUEST['comid']."'");
$row_company=mysqli_fetch_array($result_company);
 ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">สินค้าขายไม่ได้</h1>
</div>
<div class="row g-3">
  <div class="col-auto">
    <label class="col-sm-12 col-form-label"><b>วันที่ขาย</b></label>
  </div>
  <div class="col-auto" id="example_html">
    <input class="form-control" type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" id="datestart">
  </div>
  <div class="col-auto" id="example_html">
    <input class="form-control" type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" id="dateend">
  </div>
  <div class="col-auto">
    <a href="#" class="btn btn-primary mb-3" onclick="ReportnoSale(<?php echo $_REQUEST['comid']; ?>)">ดูรายการ</a>
  </div>
</div>

<div id='table_nosale'>

</div>
