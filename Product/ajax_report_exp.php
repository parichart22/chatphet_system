<?php include("../config.php"); ?>

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
      $result_exp = mysqli_query($con,"SELECT sum(amount),dateexp,YEAR(dateexp) as year,MONTH(dateexp) as month,pk_product FROM stock WHERE pk_product='".$row['pk']."' GROUP by dateexp HAVING sum(amount) > 0 ORDER by dateexp ASC LIMIT 1");
      $row_exp=mysqli_fetch_array($result_exp);
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
