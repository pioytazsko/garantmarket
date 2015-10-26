<?php
include("../db.php");

$name=htmlspecialchars($_POST['name']);
$image="no_image.png";

mysql_query ("INSERT INTO params (name, image) VALUES  ('$name', '$image') ");
$url="../catalog.php?idp=19&idcom=1";
header("Location: ".$url);
?>