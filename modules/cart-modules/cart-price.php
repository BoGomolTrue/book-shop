<?php
    include('../../modules/connect.php');
  session_start();
  $u_id = $_SESSION['user_id'];

  $select_two="select sum(_PriceO * _AmountO) FROM orders_at_the_moment where _UserID = '$u_id'";
  $query_two=mysqli_query($link,$select_two);
  $num_two=mysqli_num_rows($query_two);
  $row = mysqli_fetch_array($query_two);
  echo number_format($row[0], 2);
?>