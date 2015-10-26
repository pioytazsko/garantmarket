<?php include("../db.php");
//Обробатываем тектовую информацию
$id=$_POST['id'];
$name=htmlspecialchars($_POST['name']);
$text=$_POST['text'];
$keywords=htmlspecialchars($_POST['keywords']);
$chpu=$_POST['chpu'];
$desc = $_POST['desc'];
$ednews=mysql_query("UPDATE news_category SET name='$name', text='$text', keywords='$keywords', chpu='$chpu', `desc`='$desc' WHERE id=$id ", $db);

if($ednews=='true')
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=1");
}
else
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=2");
}
?>