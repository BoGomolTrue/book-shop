<?php session_start(); ?>
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12">
            <div class="card mx-auto">
            <?php
                include('connect.php');
                $u_id = $_SESSION['user_id'];
                $select="select sum(_PriceO*_AmountO) FROM orders_at_the_moment WHERE _UserID = '$u_id'";
                $query=mysqli_query($link,$select);
                $num=mysqli_num_rows($query);
                $row = mysqli_fetch_array($query);
            ?>
                <p class="heading">Оплата заказа на сумму <span><?php echo number_format($row[0], 2); ?> </span> рублей.</p>
                <form class="card-details ">
                    <div class="form-group mb-0">
                        <p class="text-warning mb-0">Номер карты</p> <input type="text" name="card-num" placeholder="1234 5678 9012 3457" size="17" id="cno" minlength="19" maxlength="19"> <img src="https://img.icons8.com/color/48/000000/visa.png" width="64px" height="60px" />
                    </div>
                    <div class="form-group">
                        <p class="text-warning mb-0">Cardholder's Name</p> <input type="text" name="name" placeholder="Name" size="17">
                    </div>
                    <div class="form-group pt-2">
                        <div class="row d-flex">
                            <div class="col-sm-4">
                                <p class="text-warning mb-0">Expiration</p> <input type="text" name="exp" placeholder="MM/YYYY" size="7" id="exp" minlength="7" maxlength="7">
                            </div>
                            <div class="col-sm-3">
                                <p class="text-warning mb-0">Cvv</p> <input type="password" name="cvv" placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3">
                            </div>
                            <div class="col-sm-5 pt-0"> <button type="button" class="btn btn-primary payment">Оплатить</button> </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>