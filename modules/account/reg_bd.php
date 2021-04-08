<?php
    include('../connect.php');
    $UsPhoneNumber=$_POST['UsPhoneNumber'];

    $UsName = $_POST['UsName'];
    $UsLastName = $_POST['UsLastName'];
    $UsPasswordOne = sha1($_POST['UsPasswordOne']);
    $UsPasswordTwo = sha1($_POST['UsPasswordTwo']);
    $UsSex = $_POST['UsSex'];

    if($UsSex == 'Мужской'){
        $UsSex = 1;
    }else{
        $UsSex = 0;
    }
    $date = date("Y/m/d");

    $select="select * from users where _PhoneNumber='$UsPhoneNumber'";
    $query=mysqli_query($link,$select);
    $num=mysqli_num_rows($query);
    $row=mysqli_fetch_row($query);
    
    if ($num != 0){
        echo "Данный номер телефона уже зарегистрирован!";
    }
    else{
        $insert = "insert into users  (_Name, _LastName, _PhoneNumber, _Balance, _EMail, _Password, _DateOfBirth,  _Role, _DateOfRegister, _Sex) 
        values ('$UsName', '$UsLastName', '$UsPhoneNumber', 0, 'none', '$UsPasswordTwo', 'none', 0, '$date', '$UsSex')";
        $query_one=mysqli_query($link,$insert);
    }
?>