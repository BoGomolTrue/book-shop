<?php
    include('../connect.php');

    $categoryname=$_POST['categoryname'];

    $select="select * from category where _NameCategory='$categoryname'";
    $query=mysqli_query($link,$select);
    $num=mysqli_num_rows($query);
    $row=mysqli_fetch_row($query);
    
    if ($num != 0){
        echo "Данная категория уже существует!";
    }else{
        $insert = "insert into categories  (_NameCategory) 
        values ('$categoryname')";
        $query_one=mysqli_query($link,$insert);
    }

?>