<?php 
  session_start();
  ?>
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
            <a href="#"><img class="img-responsive ml-3" src="../img/img_books/<?php echo $row['_Photo']; ?>"
                    alt=""></a>
        </td>
        <td class="product-name"><a href="#"><?php echo $row['_NameBook']; ?></a></td>
        <td class="product-author"><a href="#"><?php echo $row['_Author']; ?></a></td>
        <td class="product-price-cart"><span class="amount"><?php
            $disc = $row["_Price"] - ($row["_Price"]/100*$row["_Discount"]);
             echo $disc;?> руб.</span></td>
        <td class="product-quantity">
            <div class="cart-plus-minus">
                <input class="cart-val<?php echo $row['_BooksID']; ?> cart-plus-minus-box" type="text" name="qtybutton"
                    value="<?php echo $row['_AmountO']; ?>">
            </div>
        </td>
        <td class="product-remove">
            <a href="<?php echo $row['_BooksID']; ?>" class="delete-book-to-cart"><i class="fa fa-close "></i></a>
        </td>
    </tr>
    <?php } ?>
</div>
