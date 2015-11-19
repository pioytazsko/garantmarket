<?php 
define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
require_once(__ROOT__.'/medoo.min.php');
require_once(__ROOT__.'/config.php');

$database = new medoo(array(
	       // required
            'database_type' => $config_db['database_type'],
            'database_name'=> $config_db['database_name'],
            'server_name' => $config_db['server_name'],
            'username' => $config_db['username'],
            'password' => $config_db['password'],
            'charset'=>$config_db['charset']
        ));
if($_POST['complect']==0){
$datas = $database->select("they_buy",'*',array("id"=>$_POST['id']));}
if($_POST['complect']==1){
$datas = $database->select("complect",array('item_1','item_2','item_3'),array("main_item"=>$_POST['id']));}




echo json_encode($datas);
