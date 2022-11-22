<?php
session_start();
session_destroy();
unset($_COOKIE['UserID']);
setcookie('UserID', null, -1, '/');
header("Location: index.php ");
?>
