<?php include("../db.php");

$name=htmlspecialchars($_POST['name']);

mysql_query ("INSERT INTO statuszakaza (name) VALUES  ('$name') ");
$url="../catalog.php?idp=7";
header("Location: ".$url);
?>