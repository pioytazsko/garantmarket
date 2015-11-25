<?php define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
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
//example
//include("SxGeo.php");
// $SxGeo = new SxGeo();
// $ip="178.172.146.77";
// $city = $SxGeo->get($ip);
//
//print_r( $city);
require_once(__ROOT__.'/location/SxGeo.php');
$SxGeo = new SxGeo(__ROOT__.'/location/SxGeo.dat');
$ip=$_SERVER['REMOTE_ADDR'];
$city=$SxGeo->get($ip);
$state=$city['country']['iso'];
$datas = $database->select("location", '*', array('ip'=>$ip) );
if(count($datas)==0){


    $insert_data = $database->insert("location",array(
    	"ip" => $ip,
        "state"=>$state,
    	"location" => $city['city']['name_en'],
        "city" => $city['city']['name_ru'],
    	"date" => date("d.m.y H.i")));}
else {
$database->update("location",array(
	"num_of_visit" => ($datas[0]['num_of_visit']+1)),array("ip"=>$ip));

}
//print_r($city);
