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
                            array("item_1","proc_low_1","item_2","proc_low_2","item_3","proc_low_3")
                            ,array("main_item"=>$datas[0]['id']));
$datas_complect=$database->select("catalog",array("id","image","name","price"),array("id"=>array($complect[0]['item_1'],$complect[0]['item_2'],
                                                                               $complect[0]['item_3'])));
echo "<div class=\"complect\"><div><h4>В наборе дешевле</h4></div>
<div class=\"main_item\"><div class='image_complect'><img src=\"/shopimage/".$datas[0]['image']."\" alt=\"\"></div><div class='item_name'>".$datas[0]['name']."</div><span data='".$datas[0]['price']."'>Цена:".number_format($datas[0]['price'],0,0,' ')." руб. </span></div>";$price=$datas[0]['price'];
$proc=array();
$proc[]=$complect[0]['proc_low_1'];
$proc[]=$complect[0]['proc_low_2'];
$proc[]=$complect[0]['proc_low_3'];
$i=0;
//print_r($proc);
foreach($datas_complect as $val){
    $price=$price+$val['price'];
    echo "<div class='plus'>+</div>
<div class=\"complect_item\"><input type='checkbox' checked data_proc='".$proc[$i]."' data='".$val['price']."' class='check_complect'> <div class='image_complect'><img src=\"/shopimage/".$val['image']."\" alt=\"\"></div><div class='item_name'><a href='/catalog/' >".$val['name']."</a></div><span   >Цена:".number_format($val['price'],0,0,' ')." руб. </span></div>";++$i;};
echo "<div class='plus'>=</div><div class=\"right_complect\"><span data='".$price."'>Общая сумма:<br>".number_format($price,0,0,' ')." руб.</span><div class=\"right_complects\"><span id='econom' data='".$price."'>Экономия:<br> руб.</span></div><div class=\"right_complects\"><span id='prise_you' data='".$price."'>Ваша цена:<br>руб.</span></div></div>";

echo "</div>";

?>
<!--<img src="" alt="">-->