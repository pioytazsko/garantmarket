<?php include("../db.php");
//Обробатываем тектовую информацию
$name=htmlspecialchars($_POST['name']);
$text=$_POST['text'];
$keywords=htmlspecialchars($_POST['keywords']);


$ednews=mysql_query ("INSERT INTO news_category (name, text, keywords) VALUES  ('$name', '$text', '$keywords') ");

if($ednews=='true')
{
$url="../news.php?idp=1&idcom=1";
header("Location: ".$url);
}
else
{
$url="../news.php?idp=1&idcom=2";
header("Location: ".$url);
}
?>