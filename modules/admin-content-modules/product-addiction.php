<?php
    include('../connect.php');
    $book_name=$_POST['book_name'];
    $book_author=$_POST['book_author'];
    $book_annotation=$_POST['book_annotation'];
    $book_category = $_POST['book_category'];
    $book_publish=$_POST['book_publish'];
    $book_year=$_POST['book_year'];
    $book_page = $_POST['book_page'];
    $book_age = $_POST['book_age'];
    $book_price=$_POST['book_price'];   
    $img_str = $_FILES['file']['name'];
    $pdf_str = $_FILES['filepdf']['name'];

    $insert = "insert into books  (_Author, _NameBook, _Price, _Discount, _Amount, _Page, _CategoryID, _PublishID,  _YearPublish, _Description, _Photo, _AgeRest, _Link) 
    values ('$book_author', '$book_name', '$book_price', 0, 1, $book_page, $book_category, $book_publish, $book_year, '$book_annotation', '$img_str', '$book_age', '$pdf_str')";
    $query_one=mysqli_query($link,$insert);

    move_uploaded_file($_FILES['file']['tmp_name'], '../../img/img_books/' . $_FILES['file']['name']);
    move_uploaded_file($_FILES['filepdf']['tmp_name'], '../../books/pdf/' . $_FILES['filepdf']['name']);
    
    echo "Книга успешно добавлена!";
?>