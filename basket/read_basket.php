<?php  $cookie=json_decode($_POST['json']);
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
$arr=array();
foreach($cookie as $val)
{
$arr[]=$database->select("catalog",
                         array("[>]catecory"=>
                               array('category'=>'id')),
                         array('catalog.id',
                                'catalog.name',
                               'catalog.chpu',
                               'catalog.price',
                               'catecory.chpu(cat_chpu)',
                              'catalog.image'), 
                         array(
	"catalog.id" => $val->id
));
};
//print_r($arr);

$res=json_encode($arr);echo $res;