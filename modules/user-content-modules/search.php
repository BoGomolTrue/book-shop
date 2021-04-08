<?php
include("../connect.php");

$search = $_POST['search'];


$select ="select * FROM books where _NameBook LIKE '%".$_POST["search"]."%'";


$query=mysqli_query($link,$select);
$num=mysqli_num_rows($query);
if($num>0){
    for($i=0; $i<$num; $i++){
     $row=mysqli_fetch_array($query);
?>
<table>
            <tbody>
            <tr>
              <td><a class="book-search" href="<?php echo $row['IdBooks']; ?>"><?php echo $row['_NameBook']; ?>.</a> <a style="text-decoration:underline;""><?php echo $row['_Author']; ?></a></td>
            </tr>
            </tbody>
          </table>
<?php }
}else{
    echo "<a>Поиск не дал результатов...</a>";
} ?>