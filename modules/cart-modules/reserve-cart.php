<?php
  session_start();

  include('../../modules/connect.php');
  $u_id = $_SESSION['user_id'];
  $select="select * FROM orders_at_the_moment INNER JOIN books ON orders_at_the_moment._BooksID =  books.idBooks  where _UserID = '$u_id'";
  $query=mysqli_query($link,$select);
  $num=mysqli_num_rows($query);
  $date = date('d/m/Y  H:i');
  for($i=0; $i<$num; $i++){
      $row=mysqli_fetch_array($query);
      $insert = "insert into reserve (_UserID, _BooksID, _PriceR, _AmountO, _Photo, _Date) 
      values ('$u_id', '$row[_BooksID]', '$row[_PriceO]', '$row[_AmountO]', '$row[_Photo]', '$date')";
      $query_two=mysqli_query($link,$insert);

      $delete = "delete from orders_at_the_moment where _UserID = '$u_id'";
      $delete = mysqli_query($link, $delete);

  }


?>