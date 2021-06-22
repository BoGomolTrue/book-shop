<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="css/other/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="css/other/carousel.css" />
  <link rel="stylesheet" href="css/font-awesome.css" />
  <link rel="stylesheet" href="css/other/animation.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/other/media.css" />
  <link rel="stylesheet" href="css/other/hover.css" />
  <link rel="stylesheet" href="css/other/profile.css" />
  <link rel="stylesheet" href="css/other/products.css" />
  <link rel="stylesheet" href="css/other/report.css" />
  <link rel="shortcut icon" href="img/Robinweatherall-Library-Books.ico" type="image/x-icon">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <title>Букварик — интернет магазин книг</title>
</head>
  <header>
  <?php session_start(); if($_SESSION['user_role'] == 1){ ?>
    <nav class="admin-menu">
        <div class="left">
              <a class='addiction-category' href="#">Добавить категорию</a>
              <a class='addiction-publish' href="#">Добавить издательство</a>
              <a class='addiction-book' href="#">Добавить товар</a>
              <a class="reports" href="#">Отчеты</a>
              <a class="pin-menu" href="#"><i class="fa fa-thumb-tack" aria-hidden="true"></i></a>
              
      </div>
  </nav>
  <?php } ?>
    <nav class="menu">
      <div class="left">
      </div>
      <div class="right">
        <?php
        if (!isset($_SESSION['user_log'])) {
        ?>
          <a class="open-popup" href="#">Войти</a>
        <?php
        } else {
        ?>
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" id="menu1" type="button" data-toggle="dropdown"><?php session_start(); echo $_SESSION['user_name']; ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-right-user us" role="menu" aria-labelledby="menu1">
              <li role="presentation"><a role="menuitem" class="profile-page" tabindex="-1" href="str/account/profile.php"><i class="fa fa-user" style="color: black; padding-right: 10px;" aria-hidden="true"></i>Мой профиль</a></li>
              <li role="presentation"><a role="menuitem" class="go-to-history" tabindex="-1" href="../../modules/history-cart-modules/cart-content-ajax.php"><i class="fa fa-address-book" style="color: black; padding-right: 10px;" aria-hidden="true"></i>Мои заказы</a></li>
              <br>
              <li role="presentation" style="border-top: 3px solid #bbb;"></li>
              <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="fa fa-exclamation" style="color: black; padding-right: 10px;" aria-hidden="true"></i>Сообщить о проблеме</a></li>
              <li role="presentation"><a role="menuitem" tabindex="-1" href="modules/account/exit.php"><i class="fa fa-times" style="color: black; padding-right: 10px;" aria-hidden="true"></i>Выход</a></li>
            </ul>
          </div>
        <?php
        }
        ?>
      </div>
    </nav>
    <nav class="menu sub-menu">
      <div class="icon">
        <div class="rows Align-Content-Center">
          <div class="logo-popup">Ссылка на главную страницу чуть-правее :-b</div>
          <div class="logo"><img src="https://i.ibb.co/hFB6rFx/book.png"></div>
          <div class="content">
           <a href="index.php" style="text-decoration: none; color: White;">Букварик</a>
          </div>
        </div>
      </div>
      <div class="container-1">
      <form id="searchhh" method="POST" action="../../modules/user-content-modules/search.php">
        <input type="search" id="search" name="search" placeholder="Искать здесь..." />
        <span class="icon"><i class="fa fa-search searching" style="color: white;"></i></span>
        <div id="s_result">
        </div>
      </div>
      </form>
      <div class="right">
        <div class="busket-menu">
          <i class="fa fa-shopping-basket basket-click" aria-hidden="true"></i>
          <div class="content">
            <p style="font-size: 15px; font-weight: bold;">Корзина - <a class="count-basket"><?php
              include('modules/connect.php');
              session_start();
              $u_id = $_SESSION['user_id'];
              if($u_id !== null){
                $select="select count(*) FROM orders_at_the_moment where _UserID = '$u_id'";
                $query=mysqli_query($link,$select);
                $num=mysqli_num_rows($query);
                $row=mysqli_fetch_row($query);
                echo $row[0];
              }else{
                echo "0";
              }
             ?></a></p>
            <p>Резерв - 
              <?php
               if($u_id !== null){
                $select="select count(*) FROM reserve where _UserID = '$u_id'";
                $query=mysqli_query($link,$select);
                $num=mysqli_num_rows($query);
                $row=mysqli_fetch_row($query);
                echo $row[0];
              }else{
                echo "0";
              }
              ?>
            </p>
          </div>
          <?php include('str/user-content-str/basket-popup.php'); ?>
    </nav>
    <nav class="menu catalog-menu">
    <ul class="catalog-menu-items">
        <li><a class="catalog-books">Электронные книги</a></li>
    </ul>
    </nav>
    <div id="nav" class="catalog_list">
        <div class="catalog_container">
          <div class="column">
          <p class="title">Жанры</p>
          <ul class="categories">
          <?php include("modules/user-content-modules/catalog.php"); ?>
          </ul>
          </div>
          <div class="column">
          <p class="title">Издательства</p>
          <ul class="publish">
          <?php include("modules/user-content-modules/publish.php"); ?>
          </ul>
          </div>
          <div class="column">
          <p class="title">Прочее</p>
          <ul class="categories">
          <li role='presentation'><a role='menuitem' href='16'>Бесплатные книги</a></li>
          </ul>
          </div>
          
    </div>
    </div>

<!--Авторизация !-->
  <div class="popup-bg-auth">
    <div class="popup">
      <span class="popup_title">Войти</span>
      <img class="close-popup-auth" src="img/close.png" alt="">
      <br>
      <br>
      <br>
      <?php
      ?>
      <form action="modules/account/auth_bd.php" method="post">
        <div type="body">
          <input type="text" name="phonenumber" id="inputphonenumber-auth" style="height: 50px;" class="form-control input_user" placeholder="Номер телефона">
          <span class="error-message-auth num"style="display: block; text-align: center; color: gray; font-size: 10pt;">Данное поле должно быть заполнено!</span>
          <input type="password" name="pass" id="inputPassword" class="form-control input_pass" placeholder="Пароль">
          <span class="error-message-auth pass"style="display: block; text-align: center; color: gray;  font-size: 10pt;">Данное поле должно быть заполнено!</span>
          <nav id="error-message-auths" style="color: red; text-align: center; font-size: 12pt;">
          </nav>
        </div>
        <br>
        <input class="auth-button" value="Войти" type="submit" name="sub">
        <div class="popup-button">
          <a class="reg-popup">Регистрация</a>
          <a class="re-password">Забыли пароль?</a>
        </div>
      </form>
    </div>
  </div>
  </div>
  </div>
  <?php include('str/admin-content-str/addcategory.php'); ?>
  <?php include('str/admin-content-str/addpublish.php'); ?>
  <!--Регистрация !-->
  <div class="popup-bg-reg">
    <div class="popup">
      <span class="popup_title">Регистрация</span>
      <img class="close-popup-reg" src="img/close.png" alt="">
      <br>
      <br>
      <br>
      <form action="modules/account/reg_bd.php" id="test" method="post"  enctype="multipart/form-data">
        <div type="body">
          <input type="text" name="UsLastName" id="inputLastName" class="form-control" placeholder="Фамилия">
          <span class="error-message-reg lastname"style="display: block; text-align: center; color: gray; font-size: 10pt;">Данное поле должно быть заполнено!</span>
          <input type="text" name="UsName" id="inputName" class="form-control" placeholder="Имя">
          <span class="error-message-reg name"style="display: block; text-align: center; color: gray; font-size: 10pt;">Данное поле должно быть заполнено!</span>
          <input type="text" name="UsPhoneNumber" id="inputPhoneNumber-reg" class="form-control input_user" placeholder="Номер телефона">
          <span class="error-message-reg number"style="display: block; text-align: center; color: gray; font-size: 10pt;">Данное поле должно быть заполнено!</span>
          <input type="password" name="UsPasswordOne" id="inputPasswordOne" class="form-control input_password" placeholder="Пароль">
          <span class="error-message-reg passone"style="display: block; text-align: center; color: gray; font-size: 10pt;">Данное поле должно быть заполнено!</span>
          <input type="password" name="UsPasswordTwo" id="inputPasswordTwo" class="form-control input_password" placeholder="Повторите Пароль">
          <span class="error-message-reg passtwo"style="display: block; text-align: center; color: gray; font-size: 10pt;">Данное поле должно быть заполнено!</span>
          <select class="user-sex" style="margin: 0 210;">
            <option атрибуты>Мужской</option>
            <option атрибуты>Женский</option> 
          </select>
          <nav class="error-message-reg" id="error-message-reg" style="color: red; text-align: center; font-size: 12pt;">
          <h4 class="h4"style="text-align: center; font-size: 12pt;"></h4>
          </nav>
        </div>
        <br>
        <input class="reg-button" value="Зарегистрироваться" type="submit" name="sub">
        <div style="margin:10px auto 5px;" class="popup-button">
          <a class="re-password">Забыли пароль?</a>
        </div>
      </form>
    <script>
  	$(document).ready(function(){
    $("#inputPhoneNumber-reg").mask("+7(999) 999-9999");
    $("#inputphonenumber-auth").mask("+7(999) 999-9999");
	  });
    </script>
  </header>
  <?php if($_SESSION['user_role'] == 0){ ?>
 <script>!function(e,t,a){var c=e.head||e.getElementsByTagName("head")[0],n=e.createElement("script");n.async=!0,n.defer=!0, n.type="text/javascript",n.src=t+"/static/js/chat_widget.js?config="+JSON.stringify(a),c.appendChild(n)}(document,"https://app.engati.com",{bot_key:"3987889cd0bd4918",welcome_msg:true,branding_key:"default",server:"https://app.engati.com",e:"p" });</script>
 <?php }  ?>