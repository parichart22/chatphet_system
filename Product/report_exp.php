<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">รายการวันหมดอายุ</h1>
</div>


<div class="row g-3">
  <div class="col-auto">
    <label class="col-sm-12 col-form-label"><b>ค้นหา</b></label>
  </div>
  <div class="col-auto">
    <input type="text" class="form-control" id="search_txt" size="40" onkeypress="TableProduct(event)">
  </div>
  <div class="col-auto">
    <a href="#" class="btn btn-primary mb-3" onclick="TableProductBtn()">ค้นหา</a>
  </div>
</div>

<div id='table_product_exp'>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">รูปสินค้า</th>
        <th scope="col">สินค้า</th>
        <th scope="col" class='text-center'>วันหมดอายุ</th>
        <?php if($_REQUEST['type']==1){ ?>
        <th scope="col" class='text-center'><a href='#' onclick='TableProductSort(4)'>สต๊อกภายใน</a></th>
      <?php }elseif($_REQUEST['type']==2){ ?>
          <th scope="col" class='text-center'><a href='#' onclick='TableProductSort(3)'>สต๊อกภายใน</a></th>
        <?php }else{ ?>
          <th scope="col" class='text-center'><a href='#' onclick='TableProductSort(3)'>สต๊อกภายใน</a></th>
        <?php } ?>

        <?php if($_REQUEST['type']==1){ ?>
        <th scope="col" class='text-center'><a href='#' onclick='TableProductSort(2)'>สต๊อกขายรวม</a></th>
      <?php }elseif($_REQUEST['type']==2){ ?>
          <th scope="col" class='text-center'><a href='#' onclick='TableProductSort(1)'>สต๊อกขายรวม</a></th>
        <?php }else{ ?>
          <th scope="col" class='text-center'><a href='#' onclick='TableProductSort(1)'>สต๊อกขายรวม</a></th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
  <?php
    $result = mysqli_query($con,"SELECT pk_product as pk,sum(stock.amount) as amount,dateexp FROM stock GROUP by pk_product,dateexp HAVING sum(stock.amount) > 0 ORDER by dateexp ASC LIMIT 100");
    while($row=mysqli_fetch_array($result)){
      $result_p=mysqli_query($con,"SELECT * FROM product WHERE pk='".$row[pk]."'");
      $row_p=mysqli_fetch_array($result_p);
      $no++;
      echo "<tr><th scope='row'>".$no."</th><td><a href='main.php?page=9&pk=".$row['pk']."' target='_blank'><img src='".$row_p['pic']."' class='img-thumbnail'></a></td><td><a href='main.php?page=2&pk=".$row['pk']."' target='_blank'>".$row_p['name']."</a><br><input type='text' class='form-control' name='product_name' id='product_name".$row['pk']."' size='12' value='".$row_p['name']."' ><br><hr>".$row_p['company']."<hr>";
      if($row_p['mark_exp']==1){
        echo "<a class='btn btn-danger' onclick='MarkExp(".$row['pk'].",2)'>ออกจากกำหนดวันหมดอายุ</a>";
      }else{
        echo "<a class='btn btn-dark' onclick='MarkExp(".$row['pk'].",1)'>กำหนดวันหมดอายุ</a>";
      }
      echo "</td><td class='text-center h4'>".$row['dateexp']."</td><td class='text-center h4'>".$row_p['amount']."</td><td class='text-center h4'>".$row_p['amount_dummy']."</td></tr>";
  } ?>
    </tbody>
  </table>
</div>
