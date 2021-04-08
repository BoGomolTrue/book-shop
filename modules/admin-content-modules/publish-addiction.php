<?php
    include('../connect.php');

    $publishname=$_POST['publishname'];

    $select="select * from publishies where _NamePublish='$publishname'";
    $query=mysqli_query($link,$select);
    $num=mysqli_num_rows($query);
    $row=mysqli_fetch_row($query);
    
    if ($num != 0){
        echo "Данное издательство уже существует!";
    }else{
        $insert = "insert into publishies  (_NamePublish) 
        values ('$publishname')";
        $query_one=mysqli_query($link,$insert);
    }

?>