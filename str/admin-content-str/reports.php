<div class="container">
    <div class="row" style="margin: 0 auto;">
        <form class="form-signin">
            <div class="col-md-24 col-md-offset-2">
                <div class="text-center">
                    <h3 style="color:white;">Отчет о продажах</h3>
                    <div class="customer" style="display: flex;">
                        <div class="input-group" style="width:50%;">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            <input type="date" class="form-control date_from" placeholder="Date" />
                        </div>
                        <div class="input-group" style="width:50%;">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            <input type="date" class="form-control date_to" placeholder="Date" />
                        </div>
                    </div>
                    </br><button type="button" class="btn btn-round btn-danger report-show"><span
                            class="glyphicon glyphicon-search"></span>Посмотреть</button>
                </div>
                <div class="panel-body" style="display: block;     padding: 20px 0; overflow: auto; height: 500;">
                    <table class="table table-striped table-condensed" style="color:  wheat;">
                        <thead>
                            <tr>
                                <th class="text-center" width="115px">№</th>
                                <th class="text-center" width="115px">Название книги</th>
                                <th class="text-center" width="115px">Цена</th>
                                <th class="text-center" width="115px">Дата</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        include('../../modules/connect.php');
                        $date_from = $_GET['date_from'];
                        $date_to = $_GET['date_to'];
                        $select="select * from order_history INNER JOIN books ON order_history._BooksID =  books.idBooks where _Date >= '$date_from' and _Date <= '$date_to' and _Price > 0";
                        $query=mysqli_query($link,$select);
                        $num=mysqli_num_rows($query);
                        if($num > 0){
                            for($i=0; $i<$num; $i++){
                                $row=mysqli_fetch_array($query);
                                $sum = $sum + $row['_PriceH']; 
                        ?>
                            <tr>
                                <td class="text-center" width="150px"><?= $i+1 ?></td>
                                <td class="text-center" width="150px"><?= $row['_NameBook']; ?></td>
                                <td class="text-center" width="150px" style="color: green;"><?= $row['_PriceH']; ?></span></td>
                                <td class="text-center" width="150px"><?= $row['_Date']; ?></span></td>
                            </tr>
                            <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
                    <div class="text-center" style="float: right;">
                        <h4> <label style="color:red" for="Total">ВСЕГО:</label><span style="color:  wheat;">
                                <?=number_format($sum, 2);?></span><span style="color:  wheat;"> руб.</span></h4>
                        </br>
                    </div>
        </form>