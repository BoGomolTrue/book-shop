<?php
include '../connect.php';

$number = $_POST['phonenumber'];
$pass = sha1($_POST['pass']);

$select = "select * from users where _PhoneNumber='$number' and _Password='$pass'";
$query = mysqli_query($link, $select);
$num = mysqli_num_rows($query);
$row = mysqli_fetch_row($query);

if ($num == 0) {
    echo "Неверный номер телефона или пароль";
} else {
    session_start();
    $_SESSION['user_log'] = $number;
    $_SESSION['user_name'] = $row[1];
    $_SESSION['user_role'] = $row[8];
    $_SESSION['user_id'] = $row[0];
    $x = $row[8];
    if ($x == 0) {
        header("Location:../../../index.php");
    } else {
        header("Location:../../../index.php");
    }
}
