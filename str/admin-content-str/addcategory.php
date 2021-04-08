<div class="popup-bg-category">
      <div class="popup category">
            <span class="popup_title" style="width:420px;">Добавление категории</span>
            <img class="close-popup-category" src="img/close.png" alt="">
            <form action="../modules/admin-content-modules/addcategory.php"  method="post" enctype="multipart/form-data">
                  <div class="table-body" type="body">
                        <table class="table table-hover table-inverse" style="text-align: center;">
                              <thead>
                                    <tr>
                                          <th>#</th>
                                          <th>Категория</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    <?php
                                           include("modules/connect.php");

                                           $select="select * FROM categories";
                                           $query=mysqli_query($link,$select);
                                           $num=mysqli_num_rows($query);
                                           if($num>0){
                                                for($i=1; $i<$num+1; $i++){
                                                    $row=mysqli_fetch_array($query);
                                                    $cat = $row[0];
                                                    echo "<tr><th scopre='row'>$i<td>$row[1]</td></th></tr>";
                                                }
                                          }
                                    ?>
                              </tbody>
                        </table>
                  </div>
                   <input type="text" name="categoryname" class="form-control input_user" placeholder="Название категории">
                   <span class="error-message cat" style="display: none; text-align: center; color: gray; font-size: 10pt; padding-bottom: 20;">Данное поле должно быть заполнено!</span>
                   <input class="category-button" value="Добавить" type="submit" name="sub">
            </form>
      </div>
</div>