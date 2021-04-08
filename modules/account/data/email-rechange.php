<?php
    include("../../connect.php");
    session_start();
    $number= $_SESSION['user_log'];
    $email_rechange = $_POST['email_rechange'];

    $select="select * from users where _EMail='$email_rechange'";
    $query=mysqli_query($link,$select);
    $num=mysqli_num_rows($query);
    $row=mysqli_fetch_row($query);

    if ($num != 0){
        echo "Данный E-Mail уже зарегистрирован!";
    }else{
        $update="update users set _EMail='$email_rechange' WHERE _PhoneNumber='$number'";
        $q=mysqli_query($link,$update);
        echo "E-Mail успешно изменен!";
    }
?>