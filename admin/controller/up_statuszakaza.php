<?php include("../db.php");

$id=$_POST['id'];
$name=htmlspecialchars($_POST['name']);

$ednews=mysql_query("UPDATE statuszakaza SET name='$name' WHERE id=$id ", $db);
if($ednews=='true')
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=1");
}
else
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=2");
}
?>