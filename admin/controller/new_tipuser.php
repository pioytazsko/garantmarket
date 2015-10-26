<?php include("../db.php");
//обробатываем изображение






//Обробатываем тектовую информацию

$tip=htmlspecialchars($_POST['tip']);


$ednews=mysql_query ("INSERT INTO usertype (tip) VALUES  ('$tip') ");

if($ednews=='true')
{
$url="../sitting.php?idp=7&idcom=1";
header("Location: ".$url);
}
else
{
$url="../sitting.php?idp=7&idcom=2";
header("Location: ".$url);
}
?>