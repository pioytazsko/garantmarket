<?php
  define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
require_once(__ROOT__.'/medoo.min.php');
require_once(__ROOT__.'/config.php');
require(__ROOT__.'/send_email.php');
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";  
$subject="Заказ  товаров";
$database = new medoo(array(
            'database_type' => $config_db['database_type'],
            'database_name'=> $config_db['database_name'],
            'server_name' => $config_db['server_name'],
            'username' => $config_db['username'],
            'password' => $config_db['password'],
            'charset'=>$config_db['charset']
        ));

$json=json_decode($_POST['json']);
//print_r( $json);
$arr=array();
    
foreach($json->items as $val)
{ //print_r($val->id);
$arr[]=$database->select("catalog",
                         array("[>]catecory"=>
                               array('category'=>'id')),
                         array('catalog.id',
                                'catalog.name',
                               'catalog.chpu',
                               'catalog.price',
                               'catalog.local_price',
                               'catecory.chpu(cat_chpu)'
                              ), 
                         array(
	"catalog.id" => $val->id
));
};
//формируем письмо  для отправки менеджеру
require_once(__ROOT__.'/location/SxGeo.php');
$SxGeo = new SxGeo(__ROOT__.'/location/SxGeo.dat');
$ip=$_SERVER['REMOTE_ADDR'];
$city=$SxGeo->get($ip);
$data = $database->select("location_discount", '*', array('city'=>$city['city']['name_en']) );
if (count($datas)==0){
$data = $database->select("location_discount", '*', array('city'=>'Other') );
}




$message="<p>
Принят заказ от клиента :<b>".$json->name."</b>, телефон:<b> ".$json->phone."</b>, адрес:<b>".$json->adress.'</b>, Примечание:'.$json->note.'</p>';
//далеедобавляем описания товаров 
$description='';
//print_r($arr);
foreach($arr as &$val){
     if($val[0]['local_price']==1){ 
$val[0]['price']=$val[0]['price']-$val[0]['price']/100*$data[0]['discount'];   
     }

 

    
    $description=$description.'<span>Товар:<b>'.$val[0]['name'].'</b> По цене: <b>'.number_format($val[0]['price'],0,'.',' ').'руб.</b><a href="http://garantmarket.by/catalog/'.$val[0]['cat_chpu'].'/'.$val[0]['chpu'].'" > Просмотреть товар</a></span><br>';
};
$message=$message.$description;
//echo " Спасибо!!! Ваш заказ принят!";
foreach ($send_email as $val){ 
if(mail ( $val,  $subject ,  $message,$headers )){  }else {echo 'error';}
    }
echo " Спасибо!!! Ваш заказ принят!";