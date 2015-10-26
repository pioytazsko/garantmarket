<?php include("../db.php");
//обробатываем изображение






//Обробатываем тектовую информацию
$id=$_POST['id'];
$name=htmlspecialchars($_POST['name']);
$text=$_POST['text'];
$keywords=htmlspecialchars($_POST['keywords']);
$category=$_POST['category'];
$svias=$_POST['svias'];
$date=date('Y-m-d H:i:s');

$ednews=mysql_query ("INSERT INTO news (name, text, keywords, category, svias, date) VALUES  ('$name', '$text', '$keywords', '$category', '$svias', '$date') ");

if($ednews=='true')
{
$url="../news.php?idp=3&idcom=1";
header("Location: ".$url);
}
else
{
$url="../news.php?idp=3&idcom=2";
header("Location: ".$url);
}
?>