<?php include("../config.php"); ?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">รูปสินค้า</th>
      <th scope="col">สินค้า</th>
      <th scope="col" class='text-center'>สต๊อกภายใน</th>
      <th scope="col" class='text-center'><a href='#' onclick='TableProductSort(1)'>สต๊อกขายรวม</a></th>
      <th scope="col">เพิ่มสินค้า</th>
    </tr>
  </thead>
  <tbody>
<?php
  if($_REQUEST['search']!=''){
    $search=trim($_REQUEST['search']);
    $result = mysqli_query($con,"SELECT * FROM product WHERE name LIKE '%".$search."%' ORDER by pk DESC");
  }else {
    $result = mysqli_query($con,"SELECT * FROM product ORDER by datetime ASC LIMIT 20");
  }

  while($row=mysqli_fetch_array($result)){
    $no++;
    echo "<tr><th scope='row'>".$no."</th><td><img src='".$row['pic']."' class='img-thumbnail'></td><td><a href='main.php?page=2&pk=".$row['pk']."' target='_blank'>".$row['name']."</a></td><td class='text-center'>".$row['amount']."</td><td class='text-center'>".$row['amount_dummy']."</td>
    <td><input type='text' class='form-control' id='item".$row['pk']."' value='1' size='5'> <a href='#' class='btn btn-dark' onclick='Additem(".$_REQUEST['id'].",".$row['pk'].",".$row['box_no'].")'>เพิ่ม</a><td></tr>";
} ?>
  </tbody>
</table>
