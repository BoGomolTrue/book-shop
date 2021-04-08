<?php
  session_start();

  include('../../modules/connect.php');
  $u_id = $_SESSION['user_id'];
  $select="select * FROM reserve INNER JOIN books ON reserve._BooksID =  books.idBooks  where _UserID = '$u_id'";
  $query=mysqli_query($link,$select);
  $num=mysqli_num_rows($query);
  $date = date('d/m/Y  H:i');
  for($i=0; $i<$num; $i++){
      $row=mysqli_fetch_array($query);
      $insert = "insert into orders_at_the_moment (_UserID, _BooksID, _PriceO, _AmountO, _Photo) 
      values ('$u_id', '$row[_BooksID]', '$row[_PriceR]', '$row[_AmountO]', '$row[_Photo]')";
      $query_two=mysqli_query($link,$insert);

      $delete = "delete from reserve where _UserID = '$u_id'";
      $delete = mysqli_query($link, $delete);

  }


?>