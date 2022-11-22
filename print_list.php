<?php include("config.php"); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>Chatphet - System</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
    <link href="dist/css/bootstrap.css" rel="stylesheet">
  </head>
  <body>
    <table class="table" style="font-size:12px">
      <tr align='center'><td><b>#</b></td><td><b>รายการสินค้า</b></td><td><b>บริษัท</b></td><td><b>กล่องที่</b></td><td><b>จำนวน</b></td></tr>
      <?php
        $result=mysqli_query($con,"SELECT sum(amount),pk_product,box_no FROM order_detail WHERE status=1 GROUP by pk_product ORDER by box_no ASC");
        while($row=mysqli_fetch_array($result)){
          $no++;
          $result_p=mysqli_query($con,"SELECT * FROM product WHERE pk='".$row['pk_product']."'");
          $row_p=mysqli_fetch_array($result_p);

          echo "<tr align='center'><td>".$no."</td><td>".$row_p['name']."</td><td>".$row_p['company']."</td><td>กล่องที่ ".$row_p['box_no']."</td><td>".$row[0];
          if($row_p['amount']==0){ echo "<font color='red'>(ไม่มี)</font>"; }
          echo "</td></tr>";
        }
       ?>
    </table>
  </body>
  </html>
