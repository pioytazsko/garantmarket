<?php
define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
require_once(__ROOT__.'/medoo.min.php');
require_once(__ROOT__.'/config.php');
require(__ROOT__.'/send_email.php');
$database = new medoo(array(
	       // required
            'database_type' => $config_db['database_type'],
            'database_name'=> $config_db['database_name'],
            'server_name' => $config_db['server_name'],
            'username' => $config_db['username'],
            'password' => $config_db['password'],
            'charset'=>$config_db['charset']
        ));
$s=$_POST['JSON'];
$s=json_decode($s);
//сформируем отправку в бд заказов 
echo count($s->complect->items_whith_discount);
switch (count($s->complect->items_whith_discount))
{ case 3: $insert_order = $database->insert("basket", array("id_main_item"=>$s->complect->id_main_item,
                                                      "name_main_item"=>$s->complect->name_main_item,
                                                      "cost_main_item"=>$s->complect->main_item_cost,
                                                      "id_item_1"=>$s->complect->items_whith_discount[0]->id,
                                                       "name_item_1"=>$s->complect->items_whith_discount[0]->name,
                                                        "cost_item_1"=>$s->complect->items_whith_discount[0]->price,
                                                        "discount_1"=> $s->complect->items_whith_discount[0]->discount,   
                                                        "id_item_2"=>$s->complect->items_whith_discount[1]->id,
                                                       "name_item_2"=>$s->complect->items_whith_discount[1]->name,
                                                        "cost_item_2"=>$s->complect->items_whith_discount[1]->price,
                                                        "discount_2"=> $s->complect->items_whith_discount[1]->discount,   
                                                         "id_item_3"=>$s->complect->items_whith_discount[2]->id,
                                                       "name_item_3"=>$s->complect->items_whith_discount[2]->name,
                                                        "cost_item_3"=>$s->complect->items_whith_discount[2]->price,
                                                        "discount_3"=> $s->complect->items_whith_discount[2]->discount, 
                                                            "client_name"=>$s->name,
                                                            "client_phone"=>$s->phone,
                                                            "client_adress"=>$s->adress,
                                                            "note"=>$s->note,
                                                            "price"=>$s->complect->order_price,
                                                            "total_discount"=>$s->complect->economy,
                                                            "final_price"=>$s->complect->client_summ,
                                                            "url"=>$s->url                                       
                                                           ));
     
    
    ;break;
 case 2:$insert_order = $database->insert("basket", array("id_main_item"=>$s->complect->id_main_item,
                                                      "name_main_item"=>$s->complect->name_main_item,
                                                      "cost_main_item"=>$s->complect->main_item_cost,
                                                      "id_item_1"=>$s->complect->items_whith_discount[0]->id,
                                                       "name_item_1"=>$s->complect->items_whith_discount[0]->name,
                                                        "cost_item_1"=>$s->complect->items_whith_discount[0]->price,
                                                        "discount_1"=> $s->complect->items_whith_discount[0]->discount,   
                                                        "id_item_2"=>$s->complect->items_whith_discount[1]->id,
                                                       "name_item_2"=>$s->complect->items_whith_discount[1]->name,
                                                        "cost_item_2"=>$s->complect->items_whith_discount[1]->price,
                                                        "discount_2"=> $s->complect->items_whith_discount[1]->discount, 
                                                            "client_name"=>$s->name,
                                                            "client_phone"=>$s->phone,
                                                            "client_adress"=>$s->adress,
                                                            "note"=>$s->note,
                                                            "price"=>$s->complect->order_price,
                                                            "total_discount"=>$s->complect->economy,
                                                            "final_price"=>$s->complect->client_summ,
                                                            "url"=>$s->url                                       
                                                           ));    break;
 case 1: $insert_order = $database->insert("basket", array("id_main_item"=>$s->complect->id_main_item,
                                                      "name_main_item"=>$s->complect->name_main_item,
                                                      "cost_main_item"=>$s->complect->main_item_cost,
                                                      "id_item_1"=>$s->complect->items_whith_discount[0]->id,
                                                       "name_item_1"=>$s->complect->items_whith_discount[0]->name,
                                                        "cost_item_1"=>$s->complect->items_whith_discount[0]->price,
                                                        "discount_1"=> $s->complect->items_whith_discount[0]->discount, 
                                                            "client_name"=>$s->name,
                                                            "client_phone"=>$s->phone,
                                                            "client_adress"=>$s->adress,
                                                            "note"=>$s->note,
                                                            "price"=>$s->complect->order_price,
                                                            "total_discount"=>$s->complect->economy,
                                                            "final_price"=>$s->complect->client_summ,
                                                            "url"=>$s->url                                       
                                                           ));   break;
 case 0: $insert_order = $database->insert("basket", array("id_main_item"=>$s->complect->id_main_item,
                                                           "name_main_item"=>$s->complect->name_main_item,
                                                           "cost_main_item"=>$s->complect->main_item_cost,
                                                           "client_name"=>$s->name,
                                                            "client_phone"=>$s->phone,
                                                            "client_adress"=>$s->adress,
                                                            "note"=>$s->note,
                                                            "price"=>$s->complect->order_price,
                                                            "total_discount"=>(int)$s->complect->economy,
                                                            "final_price"=>$s->complect->client_summ,
                                                            "url"=>$s->url
                                                           ));   break;
 default:break;
};
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";  
$subject="Заказ комплекта товаров";
$message="<br>В комплекте:</br>".
        $s->complect->name_main_item.'<br><b>'.
        number_format($s->complect->main_item_cost,0,'.',' ').' руб.</b></br>';
$arr_items=$s->complect->items_whith_discount;
$items='';
foreach($arr_items as $val){
    $items=$items.'<br> К нему:'.$val->name.''.
     '<b>'.number_format($val->price,0,'.',' ').' руб.</b>'.
     '-скидка:'.$val->discount.'%</br>';

}
  $message=$message.$items.
      '<br>от '.$s->name.
      ' , телефон:'.$s->phone.
      ' , адрес:'.$s->adress.
      ' , примечание: '.$s->note.
      '</br><br>Цена без скидки: '.number_format($s->complect->order_price,0,'.',' ').
      ' руб. Скидка: '.number_format((int)$s->complect->economy,0,'',' ').
      ' руб. Цена со скидкой: '.number_format($s->complect->client_summ,0,'',' ').
      
      ' руб.</br><br>Ссылка на товар:<a href="'.$s->url.'">'.$s->complect->name_main_item.'</a></br>'
      ;

    
    
    foreach ($send_email as $val){ 
if(mail ( $val,  $subject ,  $message,$headers )){echo 'ok';}else {echo error;}
    }

print_r($message); ?>