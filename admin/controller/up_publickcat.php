<?php include("../db.php");
header("Location: ".$_SERVER['HTTP_REFERER']);


$id=$_GET['id'];
$result=mysql_query("SELECT * FROM catecory WHERE id=$id");
$myrow=mysql_fetch_array($result);

if($myrow['publick']==1)
{
$edcat=mysql_query("UPDATE catecory SET publick='0' WHERE id=$id", $db);
}

if($myrow['publick']==0)
{
$edcat=mysql_query("UPDATE catecory SET publick='1' WHERE id=$id", $db);
}
?>