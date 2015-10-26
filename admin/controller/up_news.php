<?php include("../db.php");
//обробатываем изображение






//Обробатываем тектовую информацию
$id=$_POST['id'];
$name=htmlspecialchars($_POST['name']);
$text=$_POST['text'];
$keywords=htmlspecialchars($_POST['keywords']);
$category=$_POST['category'];
$svias2=$_POST['svias'];
$chpu = $_POST['chpu'];
$desc = $_POST['desc'];
mysql_query("DELETE FROM news_item_s WHERE idn=$id");

if($svias2!='')
{
foreach ($svias2 as $value) {
mysql_query ("INSERT INTO news_item_s (idn, idi) VALUES  ('$id', '$value')");
}
}

$ednews=mysql_query("UPDATE news SET name='$name', text='$text', keywords='$keywords', category='$category' , chpu='$chpu', `desc`='$desc' WHERE id=$id ", $db);

if($ednews=='true')
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=1");
}
else
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=2");
}
?>