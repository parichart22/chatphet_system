<link href="dist/css/datepicker.css" rel="stylesheet">
<script src="//getbootstrap.com/2.3.2/assets/js/jquery.js"></script>
<script src="//getbootstrap.com/2.3.2/assets/js/google-code-prettify/prettify.js"></script>
<script src="dist/js/bootstrap-datepicker.js"></script>
<script src="dist/js/bootstrap-datepicker-thai.js"></script>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">สินค้าเข้าใหม่</h1>
</div>
<div class="row g-3">
  <div class="col-auto">
    <label class="col-sm-12 col-form-label"><b>วันที่เข้าสต๊อก</b></label>
  </div>
  <div class="col-auto" id="example_html">
    <input class="form-control" type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" id="datestart">
  </div>
  <div class="col-auto" id="example_html">
    <input class="form-control" type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" id="dateend">
  </div>
  <div class="col-auto">
    <a href="#" class="btn btn-primary mb-3" onclick="ReportImportSale()">ดูรายการ</a>
  </div>
</div>

<div id='table_importsale'>

</div>
