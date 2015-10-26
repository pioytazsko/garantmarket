<?php 
// Устанавливаем соединение с базой данных
include("../db.php");
unset($_SESSION['id_user']);
header("Location: ".$_SERVER['HTTP_REFERER']);
?>