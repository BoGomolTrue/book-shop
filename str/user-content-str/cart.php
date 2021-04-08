<?php session_start(); ?>
<div class="cart-main-area pt-100px pb-100px">
    <div class="container">
        <div class="breadcrumb flat">
            <a href="index.php">Книжный магазин</a>
            <a class='active' href="#">Корзина товаров</a>
        </div>
        <h3 class="cart-page-title">Ваша корзина товаров</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="#">
                    <div class="table-content table-responsive cart-table-content"
                        style="display: block; width:100%; overflow:unset;">
                        <table>
                            <thead>
                                <tr>
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
                                    $select="select * FROM orders_at_the_moment INNER JOIN books ON orders_at_the_moment._BooksID =  books.idBooks  where _UserID = '$u_id'";
                                    $query=mysqli_query($link,$select);
                                    $num=mysqli_num_rows($query);
                                    for($i=0; $i<$num; $i++){
                                        $row=mysqli_fetch_array($query);
                                ?>
                                <tr class="book<?php echo $row['IdBooks']; ?>">
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
                                            <input readonly class="cart-val<?php echo $row['_BooksID']; ?> cart-plus-minus-box" type="text" name="qtybutton" value="<?php echo $row['_AmountO']; ?>">  
                                        </div>
                                    </td>
                                    <td class="product-remove">
                                        <a href="<?php echo $row['_BooksID']; ?>" class="delete-book-to-cart"><i class="fa fa-close "></i></a>
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
                                <a class="reserve-cart" href="">Резервная корзина</a>
                                    <a href="index.php">Продолжить покупки</a>
                                </div>
                                <div class="cart-clear">
                                    <a class="clear" href="#">Очистить корзину</a>
                                    <a class="reserve-order" href="#">Зарезервировать заказ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-lg-4 col-md-12 mt-md-30px" style="margin: 0 67%;">
                        <div class="grand-totall">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gary-cart">ИТОГО</h4>
                            </div>
                            <?php
                                  $select_two="select sum(_PriceO*_AmountO) FROM orders_at_the_moment WHERE _UserID = '$u_id'";
                                  $query_two=mysqli_query($link,$select_two);
                                  $num_two=mysqli_num_rows($query_two);
                                  $row_two = mysqli_fetch_array($query_two);

                                  $select_three="select count(*) FROM orders_at_the_moment WHERE _UserID = '$u_id'";
                                  $query_three=mysqli_query($link,$select_three);
                                  $num_three=mysqli_num_rows($query_three);
                                  $row_three = mysqli_fetch_array($query_three);
                            ?>
                            <h4 class="grand-totall-title">Цена: <span  class="price-result"><?php echo number_format($row_two[0], 2); ?></span></h4>
                            <?php if($row_two[0] == 0 && $row_three[0] >= 1){
                                ?>
                                 <a class="form-email" href="#">Отправить книгу по E-Mail <i style="display:none;" class="fa fa-circle-o-notch fa-spin post"></i><i style="display:none;" class="fa fa-check post-end" aria-hidden="true"></i></a>
                            <?php }else{ ?>
                            <a class="form-email" href="#">Совершить покупку <i style="display:none;" class="fa fa-circle-o-notch fa-spin post"></i><i style="display:none;" class="fa fa-check post-end" aria-hidden="true"></i> </a>
                            <select class="order-pay" >
                            <option атрибуты>Баланс на сайте</option>
                            <option атрибуты>Банковская карта</option> 
                            </select>
                            <?php } ?>
                            <span class="error-message-emailprofile" style="display: block; text-align: center; color: red; font-size: 10pt;"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>