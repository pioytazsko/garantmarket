<?php include("../db.php");
$id=$_GET['id'];

$news=mysql_query("DELETE FROM vopros WHERE id=$id", $db);

if($news=='true')
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=1");
}
else
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=2");
}
?>