<?php 
    include("../../connect.php");
    session_start();
    $book_id = $_GET['book_id'];
    $u_id = $_SESSION['user_id'];
    $select_one="select * FROM books where idBooks= '$book_id'";
    $query_one=mysqli_query($link,$select_one);
    $num_one=mysqli_num_rows($query_one);
    for($i=0; $i<$num_one; $i++){
        $row_one=mysqli_fetch_array($query_one);
    }

    $select_two="select * FROM orders_at_the_moment where  _UserID = '$u_id' and _BooksID= '$book_id'";
    $query_two=mysqli_query($link,$select_two);
    $num_two=mysqli_num_rows($query_two);
    for($i=0; $i<$num_two; $i++){
        $row_two=mysqli_fetch_array($query_two);
    }

    if($num_two > 0){
        $update="update orders_at_the_moment set _AmountO = _AmountO - 1 where _BooksID='$book_id'";
        $update=mysqli_query($link,$update);
        echo "Книга успешно обновлена!";
        if($row_two['_AmountO'] <= 1){
            $delete = "delete from orders_at_the_moment where _UserID = '$u_id' and _BooksID = '$book_id'";
            $delete = mysqli_query($link, $delete);
        }
    }
?>