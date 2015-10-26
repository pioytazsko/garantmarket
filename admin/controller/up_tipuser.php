<?php include("../db.php");
//обробатываем изображение






//Обробатываем тектовую информацию
$id=$_POST['id'];
$tip=htmlspecialchars($_POST['tip']);


$ednews=mysql_query("UPDATE usertype SET tip='$tip' WHERE id=$id ", $db);

if($ednews=='true')
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=1");
}
else
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=2");
}
?>