<?php include("../db.php");
$status=$_POST['status'];
$id=$_POST['id'];


$ednews=mysql_query("UPDATE zakaz SET status='$status' WHERE id=$id ", $db);
header("Location: ".$_SERVER['HTTP_REFERER']);
?>