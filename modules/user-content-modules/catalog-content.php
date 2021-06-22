<?php 
   include("../../modules/connect.php");
   $cat_id = $_GET['cat_id'];

   $page = isset($_GET['page']) ? $_GET['page']: 1;
   $limit = 8;


   $offset = $limit * ($page-1);

   $select_two ="select * FROM categories where idCategory='$cat_id'";
   $query_two=mysqli_query($link,$select_two);
   $num_two=mysqli_num_rows($query_two);


    $select_three="select count(*) FROM books where _CategoryID='$cat_id'";
    $query_three=mysqli_query($link,$select_three);
    $num_three=mysqli_num_rows($query_three);
    $row_three=mysqli_fetch_array($query_three);

    $pagination = ceil($row_three[0] / $limit);
  
    if($num_two>0){
       for($i=0; $i<$num_two; $i++){
        $row_two=mysqli_fetch_array($query_two);
       }
    }
?>
<div class="container">
<div class="breadcrumb flat">
	<a href="index.php">Книжный магазин</a>
    <a href="#" class='book-breadcrumb'>Книги</a>
    <?php if($row_two["_NameCategory"] !== null){ ?>
	<a href="#" class="active"><?php echo $row_two["_NameCategory"]; ?></a>
    <?php }else {?>
        <a href="#" class="active">Бесплатные книги</a>
    <?php } ?>
    </div>
<div class="row">
<?php
    if(isset($_GET['cat_id'])){
        if($cat_id !== '16'){
            $select =" select * FROM books where _CategoryID='$cat_id' LIMIT $limit OFFSET $offset";
            $query=mysqli_query($link,$select);
            $num=mysqli_num_rows($query);
        }else{
            $select =" select * FROM books where _Price='0' LIMIT $limit OFFSET $offset";
            $query=mysqli_query($link,$select);
            $num=mysqli_num_rows($query);
        }
        if($num>0){
            for($i=0; $i<$num; $i++){
                $row=mysqli_fetch_array($query);
                if($row['_Amount'] > 1){
                    if($row["_Discount"] != 0){
                        $disc = $row["_Price"] - ($row["_Price"]/100*$row["_Discount"]);
                        echo "<div class ='col-lg-3' style='position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;padding-bottom: 15px;padding-top: 15px;border: 1px solid #DDD'><div class='b_content'><img class='bd-placeholder-img' src='img/img_books/$row[_Photo]' alt =''><h4 style='color: wheat; text-align: center; font-size: 1.1rem;'>$row[_NameBook]</h4><h4 style='color: wheat; text-align: left; font-size: 0.8rem; color: gray;'>$row[_Author]</h4><span class='amount-old'>$row[_Price]</span> <span style='text-align: center; color:rgba(240, 125, 1, 1); font-size: 20px;'>$disc Руб.</span><div class='btn-content'><a class='book_id-buy' href='$row[0]'><button type='button' class='btn btn-info buy' style='float: right; background: rgba(246, 48, 112, 1); width:113px;'>В корзину</button></a><a class='book_id-info' href='$row[0]'><button type='button' class='btn btn-info' style='float: right; background: rgba(255, 135, 4, 1) 31%;'>Посмотреть</button></a></div></div></div>";
                    }else{
                        if($row["_Price"] == 0){
                            echo "<div class ='col-lg-3' style='position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;padding-bottom: 15px;padding-top: 15px;border: 1px solid #DDD'><div class='b_content'><img class='bd-placeholder-img' src='img/img_books/$row[_Photo]' alt =''><h4 style='color: wheat; text-align: center; font-size: 1.1rem;'>$row[_NameBook]</h4><h4 style='color: wheat; text-align: left; font-size: 0.8rem; color: gray;'>$row[_Author]</h4><span class='book-free$row[0]' style='text-align: center; color:wheat; font-size: 20px;'>Бесплатно</span><div class='btn-content'><a class='book_id-info' href='$row[0]'><button type='button' class='btn btn-info' style='float: right; background: rgba(255, 135, 4, 1) 31%;'>Посмотреть</button></a></div></div></div>";
                        }else{
                            echo "<div class ='col-lg-3' style='position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;padding-bottom: 15px;padding-top: 15px;border: 1px solid #DDD'><div class='b_content'><img class='bd-placeholder-img' src='img/img_books/$row[_Photo]' alt =''><h4 style='color: wheat; text-align: center; font-size: 1.1rem;'>$row[_NameBook]</h4><h4 style='color: wheat; text-align: left; font-size: 0.8rem; color: gray;'>$row[_Author]</h4><span style='text-align: center; color:wheat; font-size: 20px;'>$row[_Price] Руб.</span><div class='btn-content'><a class='book_id-buy' href='$row[0]'><button type='button' class='btn btn-info buy' style='float: right; background: rgba(246, 48, 112, 1); width:113px;'>В корзину</button></a><a class='book_id-info' href='$row[0]'><button type='button' class='btn btn-info' style='float: right; background: rgba(255, 135, 4, 1) 31%;'>Посмотреть</button></a></div></div></div>";
                        }
                    } 
                }else if($row['_Amount'] == 1 && $row['_Price'] !== 0){
                    echo "<div class ='col-lg-3' style='position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;padding-bottom: 15px;padding-top: 15px;border: 1px solid #DDD'><div class='b_content'><img class='bd-placeholder-img' src='img/img_books/$row[_Photo]' alt =''><h4 style='color: wheat; text-align: center; font-size: 1.1rem;'>$row[_NameBook]</h4><h4 style='color: wheat; text-align: left; font-size: 0.8rem; color: gray;'>$row[_Author]</h4><span style='text-align: center; color:wheat; font-size: 20px;'>$row[_Price] Руб.</span> <span style='color: white;'>(нет в наличии)</span><div class='btn-content'><a class='book_id-info' href='$row[0]'><button type='button' class='btn btn-info' style='float: right; background: rgba(255, 135, 4, 1) 31%;'>Посмотреть</button></a></div></div></div>";
                }
            }
        }
        if($num == 0){
            echo "<div class ='col-md-3' style='position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;padding-bottom: 15px;padding-top: 15px;border: 1px solid #DDD'><div class='b_content'><img class='bd-placeholder-img' src='img/img_books/default_book.png' alt =''><h4 style='color: wheat; text-align: center;'>Книги данного жанра еще не были добавлены</h4><h4 style='color: wheat; text-align: left; font-size: 14px; color: gray;'>Вы можете оставить заявку на добавление</h4><button type='button' class='btn btn-info' style='float: right; background: rgba(246, 48, 112, 1);;'>Заказать</button></div></div>";
        }
    }
?>
</div>
</div>
<div class="center">
					<ul class="pagination">
						<?php
						for($i = 0; $i< $pagination; $i++){ ?>
						<li><a class='cat-page-info' href="?page=<?php echo $i+1; ?>"><?php echo $i +1; ?></a></li>
                        <a class="cat-page-info-two" style="display: none;" href="?cat_id=<?php echo $cat_id; ?>"></a>
						<?php } ?>
					</ul>
		</div>