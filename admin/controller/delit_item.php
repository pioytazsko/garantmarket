<?php include("../db.php");
$id=$_GET['id'];
$news=mysql_query("DELETE FROM catalog WHERE id=$id", $db);
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=1");
?>