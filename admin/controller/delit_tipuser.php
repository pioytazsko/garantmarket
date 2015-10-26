<?php include("../db.php");
$id=$_GET['id'];

$result=mysql_query("SELECT * FROM user WHERE tip=$id");
$myrow=mysql_fetch_array($result);

if($myrow>0)
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=3");
}
else
{
$news=mysql_query("DELETE FROM usertype WHERE id=$id", $db);
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=1");
}


?>