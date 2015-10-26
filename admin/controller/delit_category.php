<?php include("../db.php");
$id=$_GET['id'];

$result=mysql_query("SELECT * FROM catecory WHERE parent=$id ");
$myrow=mysql_fetch_array($result);

$result2=mysql_query("SELECT * FROM catalog WHERE  category=$id ");
$myrow2=mysql_fetch_array($result2);


if($myrow<1 and $myrow2<1)
{
$news=mysql_query("DELETE FROM catecory WHERE id=$id", $db);
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=1");
}
else
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=2");
}
?>