<?php $id= $_POST['id'];
//echo $id;
  define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
require_once(__ROOT__.'/medoo.min.php');
require_once(__ROOT__.'/config.php');

$database = new medoo(array(
            'database_type' => $config_db['database_type'],
            'database_name'=> $config_db['database_name'],
            'server_name' => $config_db['server_name'],
            'username' => $config_db['username'],
            'password' => $config_db['password'],
            'charset'=>$config_db['charset']
        ));
$datas = $database->select("catalog",array(
	"name",
	"price",
    "image"
),array(
	"id" => $id
));
$datas=json_encode($datas);
echo $datas;