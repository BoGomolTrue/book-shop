<?php session_start(); ?>
<div class="cart-main-area pt-100px pb-100px">
    <div class="container">
        <div class="breadcrumb flat">
            <a href="index.php">Книжный магазин</a>
            <a class='active' href="#">Резервная корзина товаров</a>
        </div>
        <h3 class="cart-page-title">Ваша резервная корзина товаров</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="#">
                    <div class="table-content table-responsive cart-table-content"
                        style="display: block; width:100%; overflow:unset;">
                        <table>
                            <thead>
                                <tr>
                                    <th>Дата</th>
                                    <th>Изображение</th>
                                    <th>Наименование товара</th>
                                    <th>Автор</th>
                                    <th>Цена</th>
                                    <th>Количество</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody class="testttt">
                                <?php
                                    include('../../modules/connect.php');
                                    $u_id = $_SESSION['user_id'];
                                    $select="select * FROM reserve INNER JOIN books ON reserve._BooksID =  books.idBooks  where _UserID = '$u_id'";
                                    $query=mysqli_query($link,$select);
                                    $num=mysqli_num_rows($query);
                                    for($i=0; $i<$num; $i++){
                                        $row=mysqli_fetch_array($query);
                                ?>
                                <tr class="book<?php echo $row['IdBooks']; ?>">
                                    <td class="product-name"><a href="#"><?php echo $row['_Date']; ?></a></td>
                                    <td class="product-thumbnail">
                                        <a href="#"><img class="img-responsive ml-3"
                                                src="../img/img_books/<?php echo $row['_Photo']; ?>" alt=""></a>
                                    </td>
                                    <td class="product-name"><a href="#"><?php echo $row['_NameBook']; ?></a></td>
                                    <td class="product-author"><a href="#"><?php echo $row['_Author']; ?></a></td>
                                    <td class="product-price-cart"><span class="amount"><?php
                                        $disc = $row["_Price"] - ($row["_Price"]/100*$row["_Discount"]);
                                        echo $disc;?> руб.</span></td>
                                    <td class="product-quantity">
                                        <div class="cart-plus-minus">
                                            <input class="cart-val<?php echo $row['_BooksID']; ?> cart-plus-minus-box" type="text" name="qtybutton" value="<?php echo $row['_AmountO']; ?>">  
                                        </div>
                                    </td>
                                    <td class="product-remove">
                                        <a href="<?php echo $row['_BooksID']; ?>" class="delete-book-to-cart-reserve"><i class="fa fa-close "></i></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-shiping-update-wrapper">
                                <div class="cart-shiping-update">
                                <a class="go-to-basket" href="">Корзина</a>
                                    <a href="index.php">Продолжить покупки</a>
                                </div>
                                <div class="cart-clear">
                                    <a class="reserve-clear" href="#">Очистить корзину</a>
                                    <a class="cart-order" href="#">Сделать заказ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>