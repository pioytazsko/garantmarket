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
$data=$_POST['data'];
$data=json_decode($data);
//print_r($data);
//отрабатываем изменение , потом  сохраняем 
foreach($data as $val){   
$database->update("location_discount", array(
    "discount"=>$val->discount    	
    ), array("city"=>$val->name));
   echo $val->name;
};
