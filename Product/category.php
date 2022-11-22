<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">หมวดหมู่สินค้า</h1>
</div>
<form class="row g-2">
  <div class="col-auto">
    <label class="col-sm-12 col-form-label"><b>ชื่อหมวดหมู่</b></label>
  </div>

  <div class="col-auto">
    <input type="text" class="form-control" id="category" name='category' size="20">
  </div>

  <div class="col-auto">
    <a href="#" class="btn btn-success mb-3" onclick="AddCategory()">สร้างใหม่</a>
  </div>
</form>

<div id='table_category'>
  <table class="table">
    <thead>
      <tr align='center'>
        <th scope="col">#</th>
        <th scope="col">หมวดหมู่</th>
        <th scope="col">ตำแหน่ง</th>
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
      <td><a class='btn btn-dark' onclick='EditCategory(".$row['pk'].")'>แก้ไข</a></td></tr>";
  } ?>
    </tbody>
  </table>
</div>
