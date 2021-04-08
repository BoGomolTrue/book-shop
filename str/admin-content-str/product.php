<?php 
    include("../../modules/connect.php");
    $book_id = $_GET['book_id'];
    $select="select * FROM books INNER JOIN categories ON books._CategoryID = categories.idCategory INNER JOIN publishies ON books._PublishID = publishies.idPublish where IdBooks = '$book_id'";
    $query=mysqli_query($link,$select);
    $num=mysqli_num_rows($query);
    if($num>0){
        for($i=0; $i<$num; $i++){
            $row=mysqli_fetch_array($query);
        }
    }
?>
<div class="container bootdey" id="cont">
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
            <form id="addbook" action="" method="post" enctype="multipart/form-data">
                    <div class="panel-body">
                    <div class="col-md-6">
                        <div class="pro-img-details">
                            <img class="new-img" alt="">
                        </div>
                    </div>          
                        <div class="col-md-6">
                            <h2 class="pro-d-title">
                                <input type="text" name="book_name" class="form-control input_user"
                                    placeholder="Название">
                                    <span class="error-message-addiction-book namebook"style="display: block; text-align: center; color: gray; font-size: 10pt;"></span>
                            </h2>
                            <h6>
                                <input type="text" name="book_author" class="form-control input_user"
                                    placeholder="Автор">
                                    <span class="error-message-addiction-book author"style="display: block; text-align: center; color: gray; font-size: 10pt;"></span>
                            </h6>
                            <span>Аннотация:</span>
                            <p>
                                <textarea rows="5" cols="100" name="book_annotation" placeholder="Аннотация"
                                    style="width:350px;"></textarea>
                                    <span class="error-message-addiction-book annotation"style="display: block; text-align: center; color: gray; font-size: 10pt;"></span>
                            </p>
                            <div class="product_meta">
                                <span class="category"> <strong>Категория:</strong>
                                    <div class="dropdown" style="width: 202px; place-self: center;">
                                        <input name="book_category"
                                            style="background: transparent; border: transparent;"
                                            class="btn btn-primary dropdown-toggle cat" type="button" value="Категория"
                                            data-toggle="dropdown">
                                        </input>
                                        <ul class="dropdown-menu dropdown-menu-right-cat" role="menu"
                                            aria-labelledby="menu1">
                                            <li style="overflow: auto; height: 120px;">
                                                <?php 
                                                $select =" select * FROM categories";
                                                $query=mysqli_query($link,$select);
                                                $num=mysqli_num_rows($query);
                                                if($num>0){
                                                    for($i=0; $i<$num; $i++){
                                                    $row=mysqli_fetch_array($query);
                                                        echo "<a href='$row[0]'>$row[1]</a>";
                                                    }
                                                }
                                            ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <span class="error-message-addiction-book category"style="display: block; text-align: center; color: gray; font-size: 10pt;"></span>
                                </span>
                                <span class="publishs"><strong>Издательство:</strong>
                                    <div class="dropdown" style="width: 202px; place-self: center;">
                                        <input name="book_publish" style="background: transparent; border: transparent;"
                                            class="btn btn-primary dropdown-toggle pub" type="button"
                                            value="Издательство" data-toggle="dropdown">
                                        </input>
                                        <ul class="dropdown-menu dropdown-menu-right-pub" role="menu"
                                            aria-labelledby="menu1">
                                            <li style="overflow: auto; height: 120px;">
                                                <?php 
                                                $select =" select * FROM publishies";
                                                $query=mysqli_query($link,$select);
                                                $num=mysqli_num_rows($query);
                                                if($num>0){
                                                    for($i=0; $i<$num; $i++){
                                                    $row=mysqli_fetch_array($query);
                                                        echo "<a href='$row[0]'>$row[1]</a>";
                                                    }
                                                }
                                            ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <span class="error-message-addiction-book publish"style="display: block; text-align: center; color: gray; font-size: 10pt;"></span>
                                </span>
                                <span class="year"><strong>Год издания:</strong>
                                    <input type="text" name="book_year" class="form-control input_user"
                                        placeholder="Год издания">
                                        <span class="error-message-addiction-book year"style="display: block; text-align: center; color: gray; font-size: 10pt;"></span>
                                </span>
                                <span class="page"><strong>Количество страниц:</strong>

                                    <input type="text" name="book_page" class="form-control input_user"
                                        placeholder="30">
                                        <span class="error-message-addiction-book page"style="display: block; text-align: center; color: gray; font-size: 10pt;"></span>
                                </span>
                                <span class="age"><strong>Возрастные ограничения:</strong>
                                    <input type="text" name="book_age" style="width:43px; display: inline;"
                                        class="form-control input_user" placeholder="6">+
                                </span>
                                <span class="error-message-addiction-book age"style="display: block; text-align: center; color: gray; font-size: 10pt;"></span>
                            </span>
                            <label for=book_file></label>
                            <span class="imgfile"><strong>Изображение:</strong><input type="file" id="book_file">
                            </span>
                            <span class="pdffile"><strong>PDF файл:</strong><input type="file" id="book_pdf">
                            </span>
                            </div>
                            <div class="m-bot15"> <strong>Стоимость:</strong><span class="pro-price"
                                    style="color: wheat;">
                                    <input type="text" name="book_price" style="width:64px; display: inline;"
                                        class="form-control input_user" placeholder="0.00"> руб.</span>
                                    </div>
                                    <span class="error-message-addiction-book price"style="display: block; text-align: center; color: gray; font-size: 10pt;"></span>
                            <p>
                                <input class="btn btn-round btn-danger addbook" value="Добавить книгу" type="submit">
                            </p>
                            <span class="error-message-addiction-book addiction"style="display: block; text-align: center; color: gray; font-size: 10pt;"></span>
                        </div>
                    </div>
            </form>
            </section>
        </div>
    </div>
</div>