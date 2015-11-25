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

require_once(__ROOT__.'/location/SxGeo.php');
$SxGeo = new SxGeo(__ROOT__.'/location/SxGeo.dat');
$ip=$_SERVER['REMOTE_ADDR'];
$city=$SxGeo->get($ip);
$datas = $database->select("location_discount", '*', array('city'=>$city['city']['name_en']) );
if (count($datas)==0){
$datas = $database->select("location_discount", '*', array('city'=>'Other') );
}
//print_r($datas);