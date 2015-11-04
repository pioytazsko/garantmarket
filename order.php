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
                                                           ));break;
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
    
//if(mail ( string $to , string $subject , string $message [, string $additional_headers [, string $additional_parameters ]] )){echo 'ok';}else {echo error;}

print_r($s); ?>