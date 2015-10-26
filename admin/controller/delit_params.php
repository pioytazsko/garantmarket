<?php include("../db.php");
$id=$_GET['id'];


$news=mysql_query("DELETE FROM params WHERE id=$id", $db);
$news2=mysql_query("DELETE FROM paramskat WHERE idpar=$id", $db);
$news3=mysql_query("DELETE FROM paramsitem WHERE idparams=$id", $db);
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=1");

?>