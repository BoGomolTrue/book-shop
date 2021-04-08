<?php
include("../../connect.php");
session_start();

$number= $_SESSION['user_log'];
$password_rechange = sha1($_POST['password_rechange']);

$update="update users set _Password='$password_rechange' WHERE _PhoneNumber='$number'";
$q=mysqli_query($link,$update);

echo "Пароль успешно изменен!";
?>