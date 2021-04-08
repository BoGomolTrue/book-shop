<?php
include("../../modules/connect.php");
session_start();

$page = isset($_GET['page']) ? $_GET['page']: 1;

$number= $_SESSION['user_log'];

$search = $_POST['search'];

$limit = 8;
$offset = $limit * ($page-1);


$select="select * FROM books where _NameBook LIKE '%".$_POST["search"]."%' LIMIT $limit OFFSET $offset";

$query=mysqli_query($link,$select);
$num=mysqli_num_rows($query);


$select_three="select count(*) FROM books where _NameBook LIKE '%".$_POST["search"]."%'";
$query_three=mysqli_query($link,$select_three);
$num_three=mysqli_num_rows($query_three);
$row_three=mysqli_fetch_array($query_three);

$pagination = ceil($row_three[0] / $limit);

?>
<div class="container">
    <div class="row">
<?php
if($num>0){
	for($i=0; $i<$num; $i++){
		$row=mysqli_fetch_array($query);
		if($row["_Discount"] != 0){
			$disc = $row["_Price"] - ($row["_Price"]/100*$row["_Discount"]);
			echo "<div class ='col-lg-3' style='position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;padding-bottom: 15px;padding-top: 15px;border: 1px solid #DDD'><div class='b_content'><img class='bd-placeholder-img' src='img/img_books/$row[_Photo]' alt =''><h4 style='color: wheat; text-align: center; font-size: 1.1rem;'>$row[_NameBook]</h4><h4 style='color: wheat; text-align: left; font-size: 0.8rem; color: gray;'>$row[_Author]</h4><span class='amount-old'>$row[_Price]</span> <span style='text-align: center; color:rgba(240, 125, 1, 1); font-size: 20px;'>$disc Руб.</span><div class='btn-content'><a class='book_id-buy' href='$row[0]'><button type='button' class='btn btn-info buy' style='float: right; background: rgba(246, 48, 112, 1); width:113px;'>В корзину</button></a><a class='book_id-info' href='$row[0]'><button type='button' class='btn btn-info' style='float: right; background: rgba(255, 135, 4, 1) 31%;'>Посмотреть</button></a></div></div></div>";
		}else{
			if($row["_Price"] == 0){
				echo "<div class ='col-lg-3' style='position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;padding-bottom: 15px;padding-top: 15px;border: 1px solid #DDD'><div class='b_content'><img class='bd-placeholder-img' src='img/img_books/$row[_Photo]' alt =''><h4 style='color: wheat; text-align: center; font-size: 1.1rem;'>$row[_NameBook]</h4><h4 style='color: wheat; text-align: left; font-size: 0.8rem; color: gray;'>$row[_Author]</h4><span class='book-free$row[0]' style='text-align: center; color:wheat; font-size: 20px;'>Бесплатно</span><div class='btn-content'><a class='book_id-buy' href='$row[0]'><button type='button' class='btn btn-info buy' style='float: right; background: rgba(246, 48, 112, 1); width:113px;'>В корзину</button></a><a class='book_id-info' href='$row[0]'><button type='button' class='btn btn-info' style='float: right; background: rgba(255, 135, 4, 1) 31%;'>Посмотреть</button></a></div></div></div>";
			}else{
				echo "<div class ='col-lg-3' style='position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;padding-bottom: 15px;padding-top: 15px;border: 1px solid #DDD'><div class='b_content'><img class='bd-placeholder-img' src='img/img_books/$row[_Photo]' alt =''><h4 style='color: wheat; text-align: center; font-size: 1.1rem;'>$row[_NameBook]</h4><h4 style='color: wheat; text-align: left; font-size: 0.8rem; color: gray;'>$row[_Author]</h4><span style='text-align: center; color:wheat; font-size: 20px;'>$row[_Price] Руб.</span><div class='btn-content'><a class='book_id-buy' href='$row[0]'><button type='button' class='btn btn-info buy' style='float: right; background: rgba(246, 48, 112, 1); width:113px;'>В корзину</button></a><a class='book_id-info' href='$row[0]'><button type='button' class='btn btn-info' style='float: right; background: rgba(255, 135, 4, 1) 31%;'>Посмотреть</button></a></div></div></div>";
			}
		} 
	}
}
?>
</div>
</div>
<div class="center">
					<ul class="pagination">
						<?php
						for($i = 0; $i< $pagination; $i++){ ?>
						<li><a class='pageinfo' href="?page=<?php echo $i+1; ?>"><?php echo $i +1; ?></a></li>
						<?php } ?>
					</ul>
</div>