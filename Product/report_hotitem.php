<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">สินค้าขายดี</h1>
</div>

<div id='table_product'>
  <table class="table">
    <thead>
      <tr align='center'>
        <th scope="col">#</th>
        <th scope="col">บริษัท</th>
        <th scope="col">จำนวนขาย</th>
        <th scope="col">สินค้าทั้งบริษัท</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
  <?php

    //$result = mysqli_query($con,"SELECT count(*),comid FROM product GROUP by comid ORDER by count(*) DESC");
    $result=mysqli_query($con,"SELECT sum(amount),comid FROM order_detail GROUP by comid ORDER by sum(amount) DESC");
    while($row=mysqli_fetch_array($result)){
      $no++;
      $result_company = mysqli_query($con,"SELECT * FROM company WHERE comid='".$row['comid']."'");
      $row_company=mysqli_fetch_array($result_company);
      $result_company_product = mysqli_query($con,"SELECT count(*),comid FROM product WHERE comid='".$row['comid']."'");
      $row_company_product=mysqli_fetch_array($result_company_product);
      echo "<tr align='center'><th scope='row'>".$no."</th><td>".$row_company['company_name']."</td><td>".$row[0]."</td><td>".$row_company_product[0]."</td><td><a href='main.php?page=15&comid=".$row['comid']."' target='_blank' class='btn btn-dark'>ดูรายการ</a></td></tr>";
  }
    $no++;
    echo "<tr align='center'><th scope='row'>".$no."</th><td>แสดงผลทั้งหมด</td><td></td><td></td><td><a href='main.php?page=20' target='_blank' class='btn btn-dark'>ดูรายการ</a></td></tr>";
  ?>
    </tbody>
  </table>
</div>
