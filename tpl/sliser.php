<?php // Include Medoo
require_once 'medoo.min.php';
 // Initialize
$database = new medoo(array(
	'database_type' => 'mysql',
	'database_name' => 'garantma_db',
	'server' => 'localhost',
	'username' => 'garantma_user',
	'password' => 'crKAyqBMMaEq',
	'charset' => 'utf8'
    ));
// сделаем  выборку слайдов из базы данных для нашего товара из бд для категории, и для товара
$datas = $database->select("catalog", array(
	"category"
),array(
	"id" => $id));
$category=$datas[0]['category'];
//$chpu=$datas[0]['chpu'];
//узнали категорию товара 
// товары сопровождающие выбранный товар
$whith_items = $database->select("they_buy",'*',array(
	"id" => $id));
//товары сопровождающие категорию
$whith_category=$database->select("they_buy_category",'*',array(
	"id" => $category));
if (count($whith_items[0])>2)
{
    array_splice($whith_items[0],0,2);
};
if (count($whith_category[0])>2)
{
    array_splice($whith_category[0],0,2);
};
//имеем список  товаров, которые нужно добавть в слайдер
// необходимо выбрать теперь массив для всех этих товаров из chpu , названий, картинок 
$var = array();
if (count($whith_items[0])>2)
{
        foreach ($whith_items[0] as $value)
        {
        //читаем для всех товаров список избранных параметров
                $var[]=$database->select("catalog",array("name","chpu","image","id","category","price"),array("id"=>$value));
        }
;};
if (count($whith_category[0])>2)
{
        foreach ($whith_category[0] as $value){
        //читаем для всех товаров список избранных параметров
                $var[]=$database->select("catalog",array("name","chpu","image","id","category","price"),array("id"=>$value));
                } 
;};
//имея массив с выводными значениями мы начинаем строить слайдер
// если  нет товаров в   товарах и категорях то ничего не выводим .. иначе выводим слайдер
if((count($var[0])) or (count($var[1]))  )
{
    echo '<div class="shop_head">
					<div class="shop_opis">С этим товаром покупают</div>
				</div><div class="slaider" > <div class=\'viewport_item\'>
            <ul class=\'slidewrapper_item\' data-current=0>';
   //формируем слайды для слайдеров 
    //еслм слайдов больше 5 то добавляем второй слайдер, и третий
        $items=array();
    foreach($var as $val)
    {
        foreach($val as $value){ $items[]=$value;};
    }
    array_splice($items,30);
    for($i=0;$i<count($items);$i++)
    {
        $cat_chpu=$database->select("catecory",array("chpu"),array("id"=>$items[$i]['category']));
        if ($i%5==0)
        {
            echo "<li class='slide_item'>";        
        } $name=$items[$i]['name'];
        $name = mb_substr($name, 0, 50,'UTF-8');
        	$name = rtrim($name, "!,.-");
//        	$name = substr($name, 0, strlen($name)-3);
        $name=$name.'...';
        echo "<div  class='shop_tovar2 b1c-good' style='width:190px;float:left'>
                <div style=\"height: 143px;\">
                    <a href=\"catalog/".$cat_chpu[0]['chpu']."/".$items[$i]['chpu']."\">
                        <div class='shop_tovar_kart'>
                            <img src='shopimage/".$items[$i]['image']."' alt=''>
                        </div>
                    </a>
                </div>
                <div class=\"shop_katalog_name b1c-name\" >
                    <a href=\"catalog/".$cat_chpu[0]['chpu']."/".$items[$i]['chpu']."\">".$name."</a>
                </div>
                  <div class=\"shop_cena\">";
            if($items[$i]['price']==0){
          echo  "<span class=\"b1c-name\"><span style=\"font-size:19px;font-weight:bold;  margin-left: 5px;\">
                        </span>
                    </span>
                <div>
                <button style='background:#8D918D' class=\"b1c\">ПОД ЗАКАЗ</button></div>
                </div> 
                
            </div>" ; 
            
        
        } else {
        echo  "<span class=\"b1c-name\">Цена:<span style=\"font-size:19px;font-weight:bold;  margin-left: 5px;\">".number_format($items[$i]['price'], 0, ',', ' ')." руб.
                        </span>
                    </span>
                <div>
                <button class=\"b1c\">КУПИТЬ</button></div>
                </div> 
                
            </div>"; 
        }
                  ;
        if($i%5==4)
        {
            echo"</li>";
        }
        else
        {
            if(count($items)-1==$i)
            {
            echo"</li>";
            }
        }
    
    }
echo '</ul>
</div><a id="next" class="button32" tabindex="0"></a>
<a id="prev" class="button31" tabindex="0"></a>';
} 








