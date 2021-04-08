<?php 
    include("../../modules/connect.php");
    session_start();
    $number = $_SESSION['user_log'];

    $book_id = $_GET['book_id'];
    $select="select * FROM books INNER JOIN categories ON books._CategoryID = categories.idCategory INNER JOIN publishies ON books._PublishID = publishies.idPublish where IdBooks = '$book_id'";
    $query=mysqli_query($link,$select);
    $num=mysqli_num_rows($query);
    if($num>0){
        for($i=0; $i<$num; $i++){
            $row=mysqli_fetch_array($query);
        }
    }

    $select_two="select _Role FROM users where _PhoneNumber = '$number'";
    $query_two=mysqli_query($link,$select_two);
    $num_two=mysqli_num_rows($query_two);
    if($num_two>0){
        $row_two=mysqli_fetch_array($query_two);
    }
?>
    <div class="container bootdey" id="cont">
    <div class="row">
    <div class="breadcrumb flat">
	<a href="index.php">Книжный магазин</a>
    <a class='book-breadcrumb' href="#">Книги</a>
	<a href="<?php echo $row["idCategory"]; ?>" class="category-breadcrumb"><?php echo $row["_NameCategory"]; ?></a>
    <a href="#" class="active"><?php echo $row["_NameBook"]; ?></a>    
    </div>
        <div class="col-md-12">
            <section class="panel">
                <div class="panel-body">
                    <div class="col-md-6">
                        <div class="pro-img-details">
                            <img src="../../img/img_books/<?php echo $row['_Photo'];?>" alt="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h2 class="pro-d-title">
                            <a href="#" class="">
                               <?php echo $row["_NameBook"]; ?>
                            </a>
                        </h2>
                        <h6>
                        <a href="#" class="">
                        <?php echo $row["_Author"]; ?>
                            </a>
                        </h6>
                        <span>Аннотация:</span>
                        <p>
                            <?php echo $row["_Description"]; ?>
                        </p>
                        <div class="product_meta">
                            <span class="amount-bo"> <strong>№ книги:</strong> <a class='id-boo' rel="tag" href="<?php echo $book_id; ?>"><?php echo $book_id; ?></a>.</span>
                            <span class="category"> <strong>Категория:</strong> <a rel="tag" href="#"><?php echo $row["_NameCategory"]; ?></a>.</span>
                            <span class="publish"><strong>Издательство:</strong> <a rel="tag" href="#"><?php  echo $row["_NamePublish"]; ?></a></span>
                            <span class="isbn"><strong>Год издания:</strong> <a rel="tag" href="#"><?php echo $row["_YearPublish"]; ?></a></span>
                            <span class="page"><strong>Количество страниц:</strong> <a rel="tag" href="#"><?php echo $row["_Page"]; ?></a></span>
                            <span class="age"><strong>Возрастные ограничения:</strong> <a rel="tag" href="#"><?php 
                            if($row["_AgeRest"] == null){
                                echo "Нет";
                            }else{
                                echo $row["_AgeRest"];
                            }
                            ?>+</a></span>
                            <form id="addamount" action="" method="post" enctype="multipart/form-data">
                            <?php if($row_two['_Role'] == 1){ ?>
                            <span class="amountttt"><strong>Кол-во на складе:</strong> <a class='am-boo' style="color: white;" rel="tag">
                            <?php echo $row['_Amount']; ?></a> <a  style="cursor:pointer; color: rgba(246, 48, 112, 1); padding: 20px;" class="m-l-10 amounts">Изменить</a>
                            </a></span>
                            <span class="error-message-addiction-book amountsss"style="display: block; text-align: center; color: gray; font-size: 10pt;"></span>
                            </form>
                            <form id="adddisc" action="" method="post" enctype="multipart/form-data">
                            <span class="discountttt"><strong>Скидка:</strong>
                             <a class='discc' style="color: white;"><?php echo $row["_Discount"]; ?> %</a><a style="cursor:pointer; color: rgba(246, 48, 112, 1); padding: 20px;" class="m-l-10 discounts">Изменить</a></span>
                             <span class="error-message-addiction-book discountsss"style="display: block; text-align: center; color: gray; font-size: 10pt;"></span>
                             <?php } ?>
                            </form>
                        </div>
                        <div class="m-bot15"> <strong>Цена:</strong>
                        <?php 
	                            if($row["_Discount"] != 0){
                                    $disc = $row["_Price"] - ($row["_Price"]/100*$row["_Discount"]); ?>
                                      <span class="amount-old" style="color: white;"> <?php echo $row["_Price"]; ?> руб.</span>
                                      <span class="pro-price" style="color: rgba(240, 125, 1, 1);"> <?php echo $disc; ?> руб.</span>
                                    <?php  }
                                    else{ ?>
                                    <span class="pro-price" style="color: white;"> <?php echo $row["_Price"]; ?> руб.</span>
                                    <?php } ?>
                       
                        </div>
                        <p style="padding: 20px 0px;">
                            <button class="btn btn-round btn-danger" type="button">Добавить в корзину</button>
                            <?php if($row['_Price'] == 0){
                        ?>
                            <button class="btn btn-round btn-danger" type="button"><a style="color: #fff; text-decoration: none;" href="../../modules//book-content/<?php echo $row['_Link']; ?>">Читать бесплатно</a></button>
                        <?php } ?>
                        </p>
                    </div>
                </div>
            </section>
        </div>
    </div>
                        </div>
<script src="js/other/jquery.min.js"></script>
<script src="js/script.js"></script>
<script src="js/other/jquery.maskedinput.js"></script>