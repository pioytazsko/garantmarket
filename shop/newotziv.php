<?php include("../db.php");
//обробатываем изображение




//Обробатываем тектовую информацию
$name=htmlspecialchars($_POST['name']);
$milo=htmlspecialchars($_POST['milo']);
$text=htmlspecialchars($_POST['text']);
preg_match("|[a-zA-Z]+|U", $text, $out);
if(count($out)>0){
 header("Location: ".$_SERVER['HTTP_REFERER']);
}
$iditem=$_POST['iditem'];
$cod=$_POST['cod'];
$date=date("Y-m-d H:i:s");

if($cod==4)
{
$ednews=mysql_query ("INSERT INTO otzivi (name, text, milo, iditem, date) VALUES  ('$name', '$text', '$milo', '$iditem', '$date') ");
}

if($ednews=='true')
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=o1");
}
else
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=o2");
}
?>