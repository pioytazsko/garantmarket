<?php include("../db.php");
$id=$_GET['id'];

$result=mysql_query("SELECT * FROM zakaz WHERE  status=$id");
$myrow=mysql_fetch_array($result);

if($myrow<1)
{
$news=mysql_query("DELETE FROM statuszakaza WHERE id=$id", $db);
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=1");
}
else
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=2");
}
?>