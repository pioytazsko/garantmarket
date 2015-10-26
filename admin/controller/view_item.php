<?php 
require('medoo.min.php');
$id=$_POST['id'];
$view=$_POST['view'];
echo $id.$view; 
//print_r($_POST);
$database = new medoo(array(
	'database_type' => 'mysql',
	'database_name' => 'garantmarket',
	'server' => 'localhost',
	'username' => 'root',
	'password' => '',
	'charset' => 'utf8'
    ));
//$database = new medoo(array(
//	'database_type' => 'mysql',
//	'database_name' => 'garantma_db',
//	'server' => 'localhost',
//	'username' => 'garantma_user',
//	'password' => 'crKAyqBMMaEq',
//	'charset' => 'utf8'
//    ));
if ($view=='not'){
$database->update("catalog", array("view" => false),array("id" => $id));
} else { $database->update("catalog", array("view" => true),array("id" => $id));};