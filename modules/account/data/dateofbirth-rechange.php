<?php
    include("../../connect.php");
    session_start();

    $number= $_SESSION['user_log'];
    $date_rechange = $_POST['date_rechange'];

    $update="update users set _DateOfBirth='$date_rechange' WHERE _PhoneNumber='$number'";
    $q=mysqli_query($link,$update);


    echo "Дата рождения успешно изменена!";
?>