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
$url=$_SERVER['REQUEST_URI'];
$url=basename($url);
$datas=$database->select("catalog",array("id","image","name","price"),array("chpu"=>$url));
$complect=$database->select("complect",
                            array("item_1",
                                  "proc_low_1",
                                  "item_2",
                                  "proc_low_2",
                                  "item_3",
                                  "proc_low_3")
                            ,array("main_item"=>$datas[0]['id']));
$datas_complect=$database->select("catalog",array("id","image","name","price","chpu"),
                                  array("id"=>array($complect[0]['item_1'],
                                                    $complect[0]['item_2'],
                                                    $complect[0]['item_3']))); 
if(count($datas_complect)!=0){
echo "<div class='shop_header' ><div class='shop_opismm'>В наборе дешевле</div></div><div class=\"complect\">
<div class=\"main_item\">
<div class='image_complect'><img src=\"/shopimage/".$datas[0]['image']."\" alt=\"image\"></div>
<div class='item_name'>".$datas[0]['name']."</div>
<span id='price_item' id_item='".$datas[0]['id']."' data='".$datas[0]['price']."'>Цена:".number_format($datas[0]['price'],0,0,' ')." руб. </span>
</div>";$price=$datas[0]['price'];
$proc=array();
$proc[]=$complect[0]['proc_low_1'];
$proc[]=$complect[0]['proc_low_2'];
$proc[]=$complect[0]['proc_low_3'];
$i=0;

//print_r($proc);
foreach($datas_complect as $val){
    $select=$database->select('catalog',
                              array("[>]catecory"=>array("category"=>"id")),
                              array("catecory.chpu"),
                              array("catalog.name"=>$val['name']));
    $price=$price+$val['price'];
    echo "<div class='plus'>+</div>
<div class=\"complect_item\">
<input type='checkbox' checked id_complect='".$val['id']."' data_proc='".$proc[$i]."' data='".$val['price']."' class='check_complect'>
 <div class='image_complect'>
 <img src=\"/shopimage/".$val['image']."\" alt=\"image\">
 </div>
 <div class='item_name'>
 <a href='/catalog/".$select[0]['chpu']."/".$val['chpu']."' >".$val['name']."</a>
 </div>
 <span   >Цена:".number_format($val['price'],0,0,' ')." руб. </span></div>";++$i;};
echo "<div class='plus'>=</div><div class=\"right_complect\"><span id='general_price' data='".$price."'>
Общая сумма:<br>".number_format($price,0,0,' ')." руб.</span>
<div class=\"right_complects\">
<span id='econom' data='".$price."'>Экономия:<br> руб.</span>
</div><div class=\"right_complects\">
<span id='prise_you' data='".$price."'>Ваша цена:<br>руб.</span></div><button class='button_bay'>КУПИТЬ</button></div>";
echo "</div>";
echo "<div class='form_buy'></div><div class='zakaz'><div class='opisanie_zakaza'></div>
<form method='post' action='order.php'>
    <div class='form_name'><input type='text' name='name' placeholder='Ваше имя*' ></div>
    <div class='form_name'><input type='text' size=60 id='phone' name='phone' placeholder='Телефон*' ></div>
    <div class='form_name'><input type='text' size=60 name='adress' placeholder='Адрес доставки*' ></div> 
    <div class='form_name'><input type='text' size=50 name='note' placeholder='Примечание' ></div> 
    <div class='form_name_button_cancel'><input type='button' id='cancel_order' value='Отмена' ></div> 
    <div class='form_name_button'><input type='button' name='ok' id='confirm_order' value='Заказать'></div> 
</form></div>";};

?>
<!--<img src="" alt="">-->
