<?php
    session_start();
    include('../../modules/connect.php');
    $u_id = $_SESSION['user_id'];
    $delete = "delete from orders_at_the_moment where _UserID = '$u_id'";
    $delete = mysqli_query($link, $delete);
    echo "Корзина очищена!";
?>