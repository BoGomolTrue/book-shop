<?php
    include("modules/connect.php");
    $select="select * FROM publishies";
    $query=mysqli_query($link,$select);
    $num=mysqli_num_rows($query);
    
    if($num>0){
        for($i=0; $i<$num; $i++){
            $row=mysqli_fetch_array($query);
            $pub = $row[0];
            echo "<li role='presentation'><a role='menuitem' href='$row[0]'>$row[1]</a></li>";
        }
    }
?>