<?php
include("../db.php"); 
if (isset($_POST['id'])){
$id=$_POST['id'];
$name=$_POST['name'];
$price=$_POST['price'];
$levl=$_POST['levl'];
    
    if($rating=$_POST['rating']){echo $rating;} else {echo 'error';};
if(!($edlevl=mysql_query("UPDATE catalog SET  name='$name',levl='$levl', price='$price',rating='$rating' WHERE id=$id", $db))){echo mysql_error();};//echo "Изменения внесены".$name.$price.'in id='.$id;
    echo 'Cохранено!';} else {echo "ERROR";};
?>