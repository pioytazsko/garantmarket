<?php include("../db.php");
$idcat=$_GET['idcat'];
$idpar=$_GET['idpar'];


$news=mysql_query("DELETE FROM paramskat WHERE idcat=$idcat and idpar=$idpar", $db);
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=1");



?>