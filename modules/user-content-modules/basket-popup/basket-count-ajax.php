<?php
    include('../../connect.php');
    session_start();
    $u_id = $_SESSION['user_id'];
    $select="select count(*) FROM orders_at_the_moment";
    $query=mysqli_query($link,$select);
    $num=mysqli_num_rows($query);
    $row=mysqli_fetch_row($query);
    echo $row[0];
?>