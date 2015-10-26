<?php include("../db.php");

$id=$_POST['id'];
$name=htmlspecialchars($_POST['name']);
$date=$_POST['date'];
$vopros=$_POST['vopros'];
$otvet=$_POST['otvet'];

$ednews=mysql_query("UPDATE vopros SET name='$name', date='$date', vopros='$vopros', otvet='$otvet' WHERE id=$id ", $db);

if($ednews=='true')
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=1");
}
else
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=2");
}
?>