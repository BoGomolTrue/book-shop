<?php
    include('../connect.php');

    $book_id=$_POST['book_id'];
    $book_discount = $_POST['book_discount'];

    $select="select * from books where idBooks='$book_id'";
    $query=mysqli_query($link,$select);
    $num=mysqli_num_rows($query);
    $row=mysqli_fetch_row($query);
   
    $update="update books set _Discount = '$book_discount' where idBooks='$book_id'";
    $update=mysqli_query($link,$update);
    echo "Скидка была установлена!";

?>