<?php include("../db.php");
//обробатываем изображение






//Обробатываем тектовую информацию
$id=$_POST['id'];
$name=htmlspecialchars($_POST['name']);
$info=$_POST['info'];
$pos=htmlspecialchars($_POST['pos']);


$ednews=mysql_query ("INSERT INTO moduls (info, name, pos) VALUES  ('$info', '$name', '$pos') ");

if($ednews=='true')
{
$url="../sitting.php?idp=11&idcom=1";
header("Location: ".$url);
}
else
{
$url="../sitting.php?idp=11&idcom=2";
header("Location: ".$url);
}
?>