<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">คำนวณค่าธรรมเนียม Shopee/Lazada</h1>
</div>

<div class="row g-3">
  <div class="col-auto">
    <label class="col-sm-12 col-form-label"><b>ค่าสินค้า</b></label>
  </div>
  <div class="col-auto">
    <input type="text" class="form-control" list="datalistOptions" id="price" name='price' size="10">
  </div>

  <div class="col-auto">
    <label class="col-sm-12 col-form-label"><b>ค่าส่ง</b></label>
  </div>

  <div class="col-auto">
    <input type="text" class="form-control" list="datalistOptions" id="shipping" size="10">
  </div>

  <div class="col-auto">
    <a href="#" class="btn btn-warning mb-3" onclick="CalShopee()">คำนวณ Shopee</a>
  </div>

  <div class="col-auto">
    <a href="#" class="btn btn-primary mb-3" onclick="CalLazada()">คำนวณ Lazada</a>
  </div>
</div>


<div id='form_cal'>

</div>
