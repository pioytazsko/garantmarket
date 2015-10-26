<?php 
header("Location: ".$_SERVER['HTTP_REFERER']);
include("../db.php");
$id=$_GET['id'];
$result=mysql_query("SELECT * FROM galeriitem WHERE id=$id ");
$myrow=mysql_fetch_array($result);

unlink('../shopimage/'.$myrow['image']);

$news=mysql_query("DELETE FROM galeriitem WHERE id=$id", $db);
?>