<?php include("../db.php");
header("Location: ".$_SERVER['HTTP_REFERER']);


$id=$_GET['id'];
$result=mysql_query("SELECT * FROM params WHERE id=$id");
$myrow=mysql_fetch_array($result);

if($myrow['gl']==1)
{
$edcat=mysql_query("UPDATE params SET gl='0' WHERE id=$id", $db);
}

if($myrow['gl']==0)
{
$edcat=mysql_query("UPDATE params SET gl='1' WHERE id=$id", $db);
}
?>