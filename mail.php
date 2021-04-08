<?php
    session_start();
    include('modules/connect.php');
    $u_id = $_SESSION['user_id'];
    $select="select sum(_PriceO*_AmountO) FROM orders_at_the_moment WHERE _UserID = '$u_id'";
    $query=mysqli_query($link,$select);
    $num=mysqli_num_rows($query);
    $row = mysqli_fetch_array($query);

    $select_two="select * FROM orders_at_the_moment INNER JOIN books ON orders_at_the_moment._BooksID =  books.idBooks  where _UserID = '$u_id'";
    $query_two=mysqli_query($link,$select_two);
    $num_two=mysqli_num_rows($query_two);


    $select_three="select _EMail, _DateOfBirth, _Balance FROM users where idUser = '$u_id'";
    $query_three=mysqli_query($link,$select_three);
    $num_three=mysqli_num_rows($query_three);
    $row_three=mysqli_fetch_array($query_three);

    $select_four="select count(*) FROM orders_at_the_moment WHERE _UserID = '$u_id' and _PriceO = '0'";
    $query_four=mysqli_query($link,$select_four);
    $num_four=mysqli_num_rows($query_four);
    $row_four = mysqli_fetch_array($query_four);

    $date_now = date('Y', strtotime(date('Y/m/d')));

    $us_age = $date_now - date('Y', strtotime($row_three[1]));

if($row_three[0] !== 'none'){
    require_once('phpmailer/PHPMailerAutoload.php');
    $mail = new PHPMailer;
    $mail->CharSet = 'utf-8';

    $email = $row_three[0];
    $sum = $row[0];
    
    $mail->isSMTP();                               
    $mail->Host = 'smtp.mail.ru'; 
    $mail->SMTPAuth = true; 
    $mail->Username = 'bukvarik-shop@bk.ru';
    $mail->Password = 'H3nyMW3uzQ5ctGfcwv6f';
    $mail->SMTPSecure = 'ssl';  
    $mail->Port = 465;

    $mail->setFrom('bukvarik-shop@bk.ru');
    $mail->addAddress($row_three[0]);

   /* if($row_three[2] < $sum){
        echo "У Вас недостаточно средств на счете!";
        return;
    }*/
    for($i=0; $i<$num_two; $i++){
        $row_two=mysqli_fetch_array($query_two);
        if($us_age < $row_two['_AgeRest']){
            echo "Возраст слишком мал!";
            return;
        }
        if($row_two['_Amount'] > $row_two['_AmountO']){
            if($sum !== 0){
                $date = date('Y/m/d');
                $insert = "insert into order_history (_UserID, _BooksID, _PriceH, _AmountH, _Date) 
                values ('$u_id', '$row_two[_BooksID]', '$row_two[_PriceO]', '$row_two[_AmountO]', '$date')";
                $query_insert=mysqli_query($link,$insert);
            }
            $update_two="update orders_at_the_moment INNER JOIN books ON orders_at_the_moment._BooksID = books.idBooks set _Amount = _Amount - $row[_AmountO] where _UserID='$u_id'";
            $update_two=mysqli_query($link,$update_two);

            $delete = "delete f from orders_at_the_moment as f INNER JOIN books as test ON f._BooksID = test.idBooks where _UserID = '$u_id'";
            $delete = mysqli_query($link, $delete);

            $mail->addAttachment('books/pdf/'.$row_two['_Link'].'', ''.$row_two['_NameBook'].'.pdf');
        }else{
            echo "Одна или несколько книг не осталось на складе";
            $sum = $sum - $row_two['_PriceO'];
        }
    }
    echo "Книги успешно отправлены!";
    $mail->isHTML(true);

    $mail->Subject = 'Букварик — интернет магазин книг.';
    if($sum == '0'){
        if($row_four[0] > '1'){
            $mail->Body    = 'Вы взяли несколько бесплатных книг в нашем магазине. Для того, чтобы пользоваться книгой, необходимо
            скачать PDF файл с готовой книгой и открыть его. Обратите внимание, что данные книги являются лишь демонстрацией работы сайта Букварик - Магазин Книг.';
        }else{
            $mail->Body    = 'Вы взяли одну бесплатную книгу в нашем магазине. Для того, чтобы пользоваться книгой, необходимо
            скачать PDF файл с готовой книгой и открыть его. Обратите внимание, что данная книга является лишь демонстрацией работы сайта Букварик - Магазин Книг.';
        }
    }else{
        $mail->Body    = 'Вы совершили покупку на сумму '. number_format($sum, 2) .' рублей в нашем магазине. Для того, чтобы пользоваться книгами, необходимо
        скачать PDF файлы с готовыми книгами и открыть их. Обратите внимание, что данная книга является лишь демонстрацией работы сайта Букварик - Магазин Книг. 
        Так, как данная книга в настоящее время недоступна для свободного скачивания, в PDF файле представлен лишь фрагмент произведения.';
    }
    $mail->AltBody = '';


    $insert_two = "insert into all_orders (_UserID, _Sum, _Date) 
    values ('$u_id', '$sum', '$date')";
    $query_insert_two=mysqli_query($link,$insert_two);

    $update="update users set _Balance= _Balance - '$sum' where idUser = '$u_id'";
    $query_update=mysqli_query($link,$update);

    $mail->send();
}else{
    echo "E-Mail не был введен!";
    return;
}
?>