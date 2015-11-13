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

$res=$_POST['id'];
$discount=json_decode($_POST['discount']);
$res=json_decode($res); 
$select=$database->select("complect","*",array("main_item"=>$res[0]));
if(count($select)==0){
$add_item = $database->insert("complect", array(
	"main_item" => $res[0],
	"item_1" => $res[1],
	"item_2" => $res[2],
	"item_3" => $res[3],
    "proc_low_1" => $discount[0],
    "proc_low_2" => $discount[1],
    "proc_low_3" => $discount[2]
	
));}else 
{
print_r($res);
    $database->update("complect", array("item_1" => $res[1],
	"item_2" => $res[2],
	"item_3" => $res[3],
    "proc_low_1" => $discount[0],
    "proc_low_2" => $discount[1],
    "proc_low_3" => $discount[2]), array(
    	"main_item" => $res[0]
    ));

}

