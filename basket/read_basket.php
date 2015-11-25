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
//делаем скидку для локалей
require_once(__ROOT__.'/location/SxGeo.php');
$SxGeo = new SxGeo(__ROOT__.'/location/SxGeo.dat');
$ip=$_SERVER['REMOTE_ADDR'];
$city=$SxGeo->get($ip);
$datas_disc = $database->select("location_discount", '*', array('city'=>$city['city']['name_en']) );

if (count($datas)==0){
$datas_disc = $database->select("location_discount", '*', array('city'=>'Other') );
}
//учтем скидку вы цене товара 
foreach($arr as &$val){
$val[0]['price']=$val[0]['price']-$datas_disc[0]['discount']*$val[0]['price']/100;
}
//print_r($datas_disc);
//print_r($arr);

$res=json_encode($arr);echo $res;