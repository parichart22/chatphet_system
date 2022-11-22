<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">ค่าธรรมเนียม Shopee</h1>
</div>

<div class="mb-3 row">
  <label for="staticEmail" class="col-sm-2 col-form-label"><strong>ค่าสินค้า</strong></label>
  <div class="col-sm-10">
    <label for="staticEmail" class="col-sm-2 col-form-label"><?php echo $_REQUEST['price']; ?></label>
  </div>
</div>
<div class="mb-3 row">
  <label for="staticEmail" class="col-sm-2 col-form-label"><strong>ค่าส่ง</strong></label>
  <div class="col-sm-10">
    <label for="staticEmail" class="col-sm-2 col-form-label"><?php echo $_REQUEST['shipping']; ?></label>
  </div>
</div>
<?php $com=round($_REQUEST['price']*0.0214); ?>
<div class="mb-3 row">
  <label for="staticEmail" class="col-sm-2 col-form-label"><strong>ค่าคอมมิชชั่น</strong></label>
  <div class="col-sm-10">
    <label for="staticEmail" class="col-sm-2 col-form-label"><?php echo $com; ?></label>
  </div>
</div>
<?php
$total=$_REQUEST['price']+$_REQUEST['shipping'];
$fee=round($total*0.0321);
 ?>
<div class="mb-3 row">
  <label for="staticEmail" class="col-sm-2 col-form-label"><strong>Transaction Fee</strong></label>
  <div class="col-sm-10">
    <label for="staticEmail" class="col-sm-2 col-form-label"><?php echo $fee; ?></label>
  </div>
</div>
<?php
$total2=$_REQUEST['price']-($com+$fee);
 ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">ยอดสุทธิ <?php echo $total2; ?> บาท</h1>
</div>
