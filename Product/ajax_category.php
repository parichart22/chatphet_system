<?php include("../config.php"); ?>

<table class="table">
    <thead>
      <tr align='center'>
        <th scope="col">#</th>
        <th scope="col">หมวดหมู่</th>
        <th scope="col">ตำแหน่ง</th>
        <th scope="col">ดูสินค้า</th>
        <th scope="col">แก้ไข</th>
      </tr>
    </thead>
    <tbody>
  <?php
    $result = mysqli_query($con,"SELECT * FROM category ORDER by rank ASC");
    while($row=mysqli_fetch_array($result)){
      $no++;

      echo "<tr align='center'><th scope='row'>".$no."</th>
      <td width='300'><input type='text' class='form-control' id='category".$row['pk']."' value=".$row['category_name']."></td>
      <td width='100'><input type='text' class='form-control' id='rank".$row['pk']."' size='5' value=".$row['rank']."></td>
      <td><a href='main.php?page=25&pk=".$row['pk']."' target='_blank' class='btn btn-dark'>ดูสินค้า</a></td>
      <td><a class='btn btn-dark' onclick='EditCategory(".$row['pk'].")'>แก้ไข</a></td></tr>";
  } ?>
    </tbody>
  </table>
