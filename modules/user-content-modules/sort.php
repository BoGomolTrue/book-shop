<?php
function get_posts($limit, $offset){

	include("modules/connect.php");
	session_start();

	$number= $_SESSION['user_log'];
	$select="select * FROM books LIMIT $limit OFFSET $offset ORDER BY _Price DESC";
    echo "ASDASD";
	$query=mysqli_query($link,$select);
	$num=mysqli_num_rows($query);
	if($num>0){
        for($i=0; $i<$num; $i++){
		$row=mysqli_fetch_array($query);
		    echo "<div class ='col-lg-3' style='position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;padding-bottom: 15px;padding-top: 15px;border: 1px solid #DDD'><div class='b_content'><img class='bd-placeholder-img' src='img/img_books/$row[10]' alt =''><h4 style='color: wheat; text-align: center; font-size: 1.1rem;'>$row[2]</h4><h4 style='color: wheat; text-align: left; font-size: 0.8rem; color: gray;'>$row[1]</h4><span style='text-align: center; color:wheat; font-size: 20px;'>$row[3] Руб.</span><div class='btn-content'><button type='button' class='btn btn-info' style='float: right; background: rgba(246, 48, 112, 1);'>в корзину</button><button type='button' class='btn btn-info' style='float: right; background: rgba(255, 135, 4, 1);'>Посмотреть</button></div></div></div>";
		}

		if(isset($_SESSION['user_log'])){
			$select_two="select _Role FROM users WHERE _PhoneNumber = '$number'";
		
			$query_two=mysqli_query($link,$select_two);
			$row_two=mysqli_fetch_array($query_two);
			if($row_two[0] == 1){
				echo "<div class ='col-lg-3' style='position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;padding-bottom: 15px;padding-top: 15px;border: 1px solid #DDD'><div class='b_content'><img src='img/img_books/default_book.png' alt =''><button type='button' class='btn btn-info' style='float: right; background: rgba(246, 48, 112, 1);'>Добавить книгу</button></div></div>";
			}	
		}
	}
}
?>