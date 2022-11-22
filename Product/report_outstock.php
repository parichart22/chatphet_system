<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">รายงานสินค้าหมดสต๊อก</h1>
</div>

<div id='table_product'>
  <table class="table">
    <thead>
      <tr align='center'>
        <th scope="col">#</th>
        <th scope="col">บริษัท</th>
        <th scope="col">รายการสินค้า</th>
        <th scope="col" class='text-center'>สต๊อก <5</th>
      </tr>
    </thead>
    <tbody>
  <?php
    $result = mysqli_query($con,"SELECT count(*),comid FROM product WHERE amount<5 GROUP by comid ORDER by count(*) DESC");
    while($row=mysqli_fetch_array($result)){
      $no++;
      $result_company = mysqli_query($con,"SELECT * FROM company WHERE comid='".$row['comid']."'");
      $row_company=mysqli_fetch_array($result_company);
      $result_outstock = mysqli_query($con,"SELECT count(*) FROM product WHERE comid='".$row['comid']."'");
      $row_outstock=mysqli_fetch_array($result_outstock);
      echo "<tr align='center'><th scope='row'>".$no."</th><td>".$row_company['company_name']."</td><td>".$row_outstock[0]."</td><td>".$row[0]."</td></tr>";
  } ?>
    </tbody>
  </table>
</div>
