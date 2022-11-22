<?php
session_start();
if(isset($_COOKIE['UserID'])){	$_SESSION['UserID'] = $_COOKIE['UserID']; }

if ($_SESSION['UserID']){
  Header("Location: main.php");
}else{
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="robots" content="noindex">
    <title>Chatphet System</title>
    <link rel="icon" href="favicon.ico">
    <!-- Bootstrap CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet" integrity="" crossorigin="anonymous">
    <link href="dist/css/signin.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>


    <!-- Custom styles for this template -->
  </head>
  <body class="text-center">

<main class="form-signin">
  <form method="post" action="login.php">
    <img class="mb-4" src="image/logo.jpg" alt="" width="72">
    <h1 class="h3 mb-3 fw-normal">เข้าสู่ระบบ</h1>
    <label for="inputEmail" class="visually-hidden">Username</label>
    <input type="text" id="inputEmail" class="form-control" placeholder="Username" name="Username" required autofocus>
    <label for="inputPassword" class="visually-hidden">Password</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="Password" required>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
    <p class="mt-5 mb-3 text-muted">Since 2021</p>
  </form>
</main>


  </body>
</html>
<?php } ?>
