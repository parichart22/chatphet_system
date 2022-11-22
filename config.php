<?php
$con= mysqli_connect("localhost","chatphet_admin","Hbd22031992","chatphet_system") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
date_default_timezone_set('Asia/Bangkok');
?>
