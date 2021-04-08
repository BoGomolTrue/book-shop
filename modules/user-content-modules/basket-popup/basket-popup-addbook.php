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

    $select_user="select * FROM users where idUser= '$u_id'";
    $query_user=mysqli_query($link,$select_user);
    $num_user=mysqli_num_rows($query_user);
    for($i=0; $i<$num_user; $i++){
        $row_user=mysqli_fetch_array($query_user);
    }
    $select_two="select * FROM orders_at_the_moment where  _UserID = '$u_id' and _BooksID= '$book_id'";
    $query_two=mysqli_query($link,$select_two);
    $num_two=mysqli_num_rows($query_two);
    $price_discount = ($row_one['_Price']/100)*$row_one['_Discount'];
    $book_amount = 1;
    if(($num_two > 0 && $row_one['_Price'] !== '0')){
        $update="update orders_at_the_moment set _AmountO = _AmountO + 1 where _BooksID='$book_id'";
        $update=mysqli_query($link,$update);
        echo "Книга успешно обновлена!";
    }else if(($num_two <= 0 && $row_one['_Price'] == '0') || $num_two <= 0){
        $pr = $row_one['_Price']-$price_discount;
        $insert = "insert into orders_at_the_moment (_UserID, _BooksID, _PriceO, _AmountO, _Photo) 
        values ('$u_id', '$book_id', '$pr', 1, '$row_one[_Photo]')";
        $query_two=mysqli_query($link,$insert);
    }
    
    
?>