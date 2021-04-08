<?php
    include('../connect.php');

    $book_id=$_POST['book_id'];
    $book_amount = $_POST['book_amount'];

    $select="select * from books where idBooks='$book_id'";
    $query=mysqli_query($link,$select);
    $num=mysqli_num_rows($query);
    $row=mysqli_fetch_row($query);
   
    $update="update books set _Amount = _Amount + '$book_amount' where idBooks='$book_id'";
    $update=mysqli_query($link,$update);
    echo "Книга была обновлена!";

?>