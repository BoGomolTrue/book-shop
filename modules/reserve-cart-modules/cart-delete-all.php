<?php
    session_start();
    include('../../modules/connect.php');
    $u_id = $_SESSION['user_id'];
    $delete = "delete from reserve where _UserID = '$u_id'";
    $delete = mysqli_query($link, $delete);
    echo "Корзина очищена!";
?>