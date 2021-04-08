<?php
    include("../../connect.php");
    session_start();
    $number= $_SESSION['user_log'];
    $number_rechange = $_POST['number_rechange'];

    $select="select * from users where _PhoneNumber='$number_rechange'";
    $query=mysqli_query($link,$select);
    $num=mysqli_num_rows($query);
    $row=mysqli_fetch_row($query);

    if ($num != 0){
        echo "Данный номер телефона уже зарегистрирован!";
    }else{
        $update="update users set _PhoneNumber='$number_rechange' WHERE _PhoneNumber='$number'";
        $q=mysqli_query($link,$update);
        $_SESSION['user_log'] = $number_rechange;
        echo "Номер телефона успешно изменен!";
    }
?>