<?php include("../db.php");
//обробатываем изображение






//Обробатываем тектовую информацию
$id=$_POST['id'];
$name=htmlspecialchars($_POST['name']);
$info=$_POST['info'];
$pos=$_POST['pos'];

$ednews=mysql_query("UPDATE moduls SET name='$name', info='$info', pos='$pos' WHERE id=$id ", $db);

if($ednews=='true')
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=1");
}
else
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=2");
}
?>