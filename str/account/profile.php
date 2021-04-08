<?php 
  include("../../modules/connect.php");
  session_start();
  $number= $_SESSION['user_log'];
  $query="select * from users where _PhoneNumber='$number'";
  $result=mysqli_query($link,$query);
  $row=mysqli_fetch_array($result);
?>
<div class="container">
    
<div id="content" class="content p-0">
<div class="breadcrumb flat">
	<a href="index.php">Книжный магазин</a>
	<a href="#" class="active">Моя страница</a>
    </div>
    <div class="profile-header">
        <div class="profile-header-cover"></div>

        <div class="profile-header-content">
            <div class="profile-header-img">
                <?php if($row[10] == 1){
                    ?>
            <img src="../../modules/account/profile-icon/avatar_male.png" alt="" />
            <?php }else{?>
                <img src="../../modules/account/profile-icon/avatar_female.png" alt="" />
                <?php } ?>
        </div>

            <div class="profile-header-info">
                <h4 class="m-t-sm"><?php echo $row[1],' ',$row[2]; ?></h4>
            </div>
        </div>
    </div>
    <div class="profile-container">
        <div class="row row-space-20">
            <div class="col-md-8">
                <div class="tab-content p-0">
                    <div class="tab-pane active show" id="profile-about">
                        <table class="table table-profile">
                            <thead>
                                <tr>
                                    <th colspan="2"><i class="fa fa-phone" aria-hidden="true"></i> Контактная информация</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="field">Номер телефона</td>
                                    <td class="value t-number">
                                        <?php echo "<span class='s-number'>$row[3]</span>"; ?>
                                        <a href="#" class="m-l-10 numbers">Изменить</a>
                                        <span class="error-message-profile num"style="display: flex; text-align: center; color: gray; font-size: 10pt;"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">E-Mail</td>
                                    <td class="value t-email">
                                        <?php echo "<span class='s-email'>$row[5]</span>"; ?>
                                        <a href="#" class="m-l-10 emails">Изменить</a>
                                        <span class="error-message-profile em"style="display: flex; text-align: center; color: gray; font-size: 10pt;"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-profile">
                            <thead>
                                <tr>
                                    <th colspan="2"><i class="fa fa-user-secret" aria-hidden="true"></i> Общая информация</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="field">Дата рождения</td>
                                    <td class="value t-dateofbirth">
                                    <?php echo "<span class='s-dateofbirth'>$row[7]</span>"; ?>
                                        <a href="#" class="m-l-10 dateofbirths">Изменить</a>
                                        <span class="error-message-profile dt"style="display: flex; text-align: center; color: gray; font-size: 10pt;"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Пол</td>
                                    <td class="value">
                                    <?php if($row[10] == 1){
                                          echo "<span class='s-sex'>Мужской</span>";
                                    }else{
                                        echo "<span class='s-sex'>Женский</span>";
                                    } ?>
                                        <a href="#" class="m-l-10 sexs">Изменить</a>
                                        <span class="error-message-profile se"style="display: flex; text-align: center; color: gray; font-size: 10pt;"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Дата регистрации</td>
                                    <td class="value">
                                       <?php echo $row[9]; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Пароль</td>
                                    <td class="value t-pass_one">
                                        <span class="s-password">
                                       <?php echo str_repeat("*", strlen($row[6]));?>
                                    </span>
                                       <a href="#" class="m-l-10 link_pass_ones">Изменить</a>
                                        <span class="error-message-profile pass_one"style="display: flex; text-align: center; color: gray; font-size: 10pt;"></span>
                                    </td>
                                </tr>
                                <tr class="twopass">
                                    <td class="field fd-pass">Повторите пароль</td>
                                    <td class="value t-pass_two">
                                        <span class="error-message-profile pass_two"style="display: flex; text-align: center; color: gray; font-size: 10pt;"></span>
                                    </td>
                                </tr>  
                                <tr>
                                    <td class="field">Баланс</td>
                                    <td class="value">
                                       <?php echo $row[4]; ?> руб.  
                                       <a href="#" class="m-l-10 top-up">Пополнить</a>     
                                    </td>
                                </tr>                 
                            </tbody>
                        </table>
                        <table class="table table-profile">
                            <thead>
                                <tr>
                                    <th colspan="2"><i class="fa fa-cart-plus" aria-hidden="true"></i> Информация о заказах</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="field">Мои заказы</td>
                                    <td class="value">
                                        0
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Количество покупок</td>
                                    <td class="value">
                                        0
                                    </td>
                                </tr>
                            </tbody>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>