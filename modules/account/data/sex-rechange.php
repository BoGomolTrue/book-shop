<?php
include("../../connect.php");
session_start();

$number= $_SESSION['user_log'];
$sex_rechange = $_POST['sex_rechange'];

$update="update users set _Sex='$sex_rechange' WHERE _PhoneNumber='$number'";
$q=mysqli_query($link,$update);

echo "Пол успешно изменен!";
?>