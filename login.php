<?php
session_start();
        if(isset($_POST['Username'])){
				//connection
                  include("config.php");
				//รับค่า user & password
                  $Username = $_POST['Username'];
                  $Password = md5($_POST['Password']);
				//query
                  $sql="SELECT * FROM user Where Username='".$Username."' and Password='".$Password."' ";

                  $result = mysqli_query($con,$sql);

                  if(mysqli_num_rows($result)==1){

                      $row = mysqli_fetch_array($result);

                      $_SESSION["UserID"] = $row["ID"];
                      $cookie_name = "UserID";
                  		$cookie_value = $row["ID"];
                  		setcookie($cookie_name, $cookie_value, time() + (86400 * 3650), "/");
                      Header("Location: main.php");

                  }else{
                    echo "<script>";
                        echo "alert(\" user หรือ  password ไม่ถูกต้อง\");";
                        echo "window.history.back()";
                    echo "</script>";

                  }

        }
?>
