<div class="center">
<?php include("tpl/left.php");
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

function get_image($id_cat,$man,$database)
{ 
    $datas = $database->select("catalog", array(
	"image",
	"id"), array("AND"=>array(
	"manufekted" => $man,"category"=>$id_cat),"LIMIT"=>1,"ORDER"=>"levl"));
   //проверка на содержание массива, если есть результат. то берем картинку оттуда
   if(count($datas)!=0)
    {
       return $datas;
    }
    else //если нет -то берем подкатегории..
    {
         $get_cat=$database->select("catecory",array('id'),array("parent"=>$id_cat,"ORDER"=>"levl DESC"));
        if (count($get_cat)!=0) //если есть подкатегории , то  проходим по ним и смотрим в них картинки (рекурсивно)
        {
            foreach($get_cat as $value)
            {
              $res=get_image($value["id"],$man,$database);
             if(count($res)!=0) 
             {
             return $res;// если картинки найдены..выводим результат
             }
            }
 
        }
        
    }
 
}    
    ?>	
		
	
<div class="right">

	<?php

$viborman=mysql_query("SELECT * FROM manufekted WHERE id=$idman");
$vibormanrez=mysql_fetch_array($viborman);
?>
<div class="mannamepage"><h1>Товары от <?php echo "$vibormanrez[name]"; ?></h1></div>
			
			<?php 
			$page=$_GET['page'];
			if($page<1)
			{
			?>
			<div class="maninfopage">
			<img src="manufected/<?php echo "$vibormanrez[image]"; ?>" alt="<?php echo "$vibormanrez[name]"; ?>" title="<?php echo "$vibormanrez[name]"; ?>" /><?php echo "$vibormanrez[deskripshn]"; ?>
			</div>
			<?php 
			}
			?>
			<div style="clear:both;"></div>
			
			
			<?php 
			$id_cat=$_GET['id_cat'];
			$vdc="";
			if($id_cat>0)
			{
			$catmansel=mysql_query("SELECT DISTINCT category FROM catalog WHERE manufekted=$idman");
			$catmanselres=mysql_fetch_array($catmansel);
			do
			{
			$catmansel2=mysql_query("SELECT * FROM catecory WHERE id=$catmanselres[category]");
			$catmanselres2=mysql_fetch_array($catmansel2);
			if($catmanselres2['parent']!=$id_cat and $catmanselres2['parent']!=0)
			{
			if($catmanselres2['parent']!='')
			{
			$vdc="".$vdc."".$catmanselres2['parent'].", ";
			}
			}
			else
			{
			if($catmanselres2['id']!='')
			{
			$vdc="".$vdc."".$catmanselres2['id'].", ";
			}
			}
			}
			while($catmanselres=mysql_fetch_array($catmansel));
			$vdc="".$vdc." 5001";
			
			
			$parcat=mysql_query("SELECT * FROM catecory WHERE parent=$id_cat and id IN($vdc)");
			$parcatres=mysql_fetch_array($parcat);
			if($parcatres>0)
			{
			echo "<div class='catvl'>Подкатегории</div>";
			do
			{
			?>
<div class="blokpodkat"><a href="item_man.php?id_cat=<?php echo "$parcatres[id]"; ?>&idman=<?php echo "$idman"; ?>" title="<?php echo "$parcatres[name]"; ?>" >
				<div class="podkatname"><?php echo "$parcatres[name]"; ?></div>
				<div class="podkatimg"><img src="shopimagepreview/<?php
                   $res=0;
$data_pod=get_image($parcatres['id'],$idman,$database);
    if(count($data_pod)!=0){
foreach ($data_pod as $value){ if ($value['image']!=0){$res=$value['image'];break;}; }};  echo $res;
                    
                    
                    
                    
                    
                    
                    ?>" alt="<?php echo "$parcatres[name]"; ?>" title="<?php echo "$parcatres[name]"; ?>" /></div>
			</a></div>
			<?php 
			}
			while($parcatres=mysql_fetch_array($parcat));
			}
			}
			?>
			<div style="clear:both;"></div>
			
<div class="cat_my_man">
    
    
    <?php

//print_r($datas);


$url=explode('/', $_SERVER['REQUEST_URI']);
// сделать проверку на 

if ($url[1]=='manufactors'){
foreach($arr_man as $val)
{
    $res=0;
$data=get_image($val['id'],$idman,$database);
    if(count($data)!=0){
foreach ($data as $value){ if ($value['image']!=0){$res=$value['image'];break;}; }};
   
//    print_r($data);
echo '<div class="blokpodkat1"><a href="/item_manufactors/'.$idman.'/'.$val['chpu'].'/'.$val['id'].'"><div class="podkatname">'.$val['name'].'</div><div class="podkatimg"><img src="shopimage/'.$res.'" alt="'.$val['name'].'" title="'.$val['name'].'"/></div> </a></div>';


}}

			

;?>
    </div>		
			
<?php
//находим вложенные категории
if($id_cat>0)
{
$catit=mysql_query("SELECT id FROM catecory WHERE parent=$id_cat");
$catitres=mysql_fetch_array($catit);
if($catitres>0)
{
do
{
$allcat=$allcat."$catitres[id], ";
}
while($catitres=mysql_fetch_array($catit));



$catit2=mysql_query("SELECT id FROM catecory WHERE parent IN(SELECT id FROM catecory WHERE parent=$id_cat)");
$catitres2=mysql_fetch_array($catit2);
if($catitres2>0)
{
do
{
$allcat=$allcat."$catitres2[id], ";
}
while($catitres2=mysql_fetch_array($catit2));
}
$allcat=$allcat."0";
}
else
{
$allcat=$id_cat;
}
}
//формируем запрос к товарам

$per_page=50;
if (isset($_GET['page'])) {$page=($_GET['page']-1);} else {$page=0;};
$start=abs($page*$per_page);

if($id_cat>0)
{
$vipitem=mysql_query("SELECT * FROM catalog WHERE view = TRUE AND category IN($allcat) and manufekted=$idman ORDER BY levl LIMIT $start, $per_page");
$vipitemrez=mysql_fetch_array($vipitem);
}
else
{
$vipitem=mysql_query("SELECT * FROM catalog WHERE view = TRUE AND  manufekted=$idman ORDER BY levl LIMIT $start, $per_page");
$vipitemrez=mysql_fetch_array($vipitem);
}

if($vipitemrez>0)
{

do
{
$mankurs=mysql_query("SELECT * FROM manufekted WHERE id=$vipitemrez[manufekted]");
$mankursrez=mysql_fetch_array($mankurs);
if($mankursrez>0)
{
$curs=$curs-$mankursrez['kursman'];
}
$view=$vipitemrez['publick'];
$newname=$vipitemrez['image'];
    $end=explode('/', $newname);
$image = end($end);
$name=$vipitemrez['name'];
    
      $loc=mysql_query('SELECT local_price FROM catalog WHERE id='.$vipitemrez['id']);
    $loc=mysql_fetch_row($loc);
//    print_r($loc);
    if($loc[0]==1){
    
    $vipitemrez['price']=$vipitemrez['price']-$vipitemrez['price']/100*$datas[0]['discount'];}
    
$price= str_replace(',',' ',number_format($vipitemrez['price']));
$price2= $vipitemrez['price']*$curs;
$price2= str_replace(',',' ',number_format($price2));
$desc = $vipitemrez['deskripshn'];

$string = strip_tags($desc);
$desc = implode(array_slice(explode('<br>',wordwrap($string,230,'<br>',false)),0,1));
if($desc!=$string)
{
$desc=$desc." ...";
}
$infocat=mysql_query("SELECT * FROM catecory WHERE id = $vipitemrez[category] ");
$infocatrez=mysql_fetch_array($infocat);
 ?>			
			
				<div class="blok_tovar b1c-good">
				<div class="tovar_name b1c-name"><a href="catalog/<?php echo $infocatrez['chpu']."/"; if($vipitemrez['chpu']!='') echo $vipitemrez['chpu']; else echo "item"; ?>" title="<?php echo "$name"; ?>"><?php echo "$name"; ?></a></div>
				<div class="tovar_image"><a href="catalog/<?php echo $infocatrez['chpu']."/"; if($vipitemrez['chpu']!='') echo $vipitemrez['chpu']; else echo "item"; ?>" title="<?php echo "$name"; ?>"><img src="shopimagepreview/<?php echo "$image"; ?>" alt="<?php echo "$name"; ?>" title="<?php echo "$name"; ?>" /></a></div>
				<div class="tovar_opis">
				<?php 
					$paramsitem=mysql_query("SELECT * FROM paramsitem WHERE iditem=$vipitemrez[id]");
					$paramsitemrez=mysql_fetch_array($paramsitem);
					if($paramsitemrez>0)
					{$i=0;
					do
					{
					$paramsitem2=mysql_query("SELECT * FROM params WHERE id=$paramsitemrez[idparams] and gl=1");
					$paramsitemrez2=mysql_fetch_array($paramsitem2);
					if($paramsitemrez2>0)
					{
				if ($paramsitemrez[val]!=''){ $i++; echo '<div class="opis_punct">'.$paramsitemrez2['name'].':<span style="margin-left:7px" >'. $paramsitemrez['val'].'</span></div>';}?>
				<?php 
				}
				}
								while(($paramsitemrez=mysql_fetch_array($paramsitem)) and ($i<7));
				}
					?>
				</div>
				<div style="clear:both"></div>
				<div class="description"><?php echo "$desc"; ?><a href="catalog/<?php echo $infocatrez['chpu']."/"; if($vipitemrez['chpu']!='') echo $vipitemrez['chpu']; else echo "item"; ?>" title="<?php echo "$name"; ?>">Подробнее</a></div>

<?php if($view==0) {?>
				<div class="cena22">
				


<div style="float:left;padding-top: 7px;" class="cena-h b1c-name">
					<span class="cena2"></span><span class="cena2"></span></div><div class="b1c-sm2"><button class="b1c order" value="<?php echo $vipitemrez['id']; ?>" >ПОД ЗАКАЗ</button><span class="rating">Рейтинг:</span> <?php $id=$vipitemrez['id']; include('rating.php');?></div>
				</div><?php } else{ ?>
				
<div class="cena">
				


<div style="float:left;padding-top: 7px;" class="cena-h b1c-name">
					<span class="cena2"> Цена: </span><?php echo "$price" ?> <span class="cena2"><?php echo "$val1" ?></span></div><div><button class="b1c" value="<?php echo $vipitemrez['id']; ?>" >КУПИТЬ</button><span class="rating">Рейтинг:</span> <?php $id=$vipitemrez['id']; include('rating.php');?> </div>
				</div>
<?php }?>


				<div style="clear:both"></div>
			</div>
<?php 
}
while($vipitemrez=mysql_fetch_array($vipitem));
?>	
<div style="clear:both;"></div>	
<div class="navigation">
<div class="navi_text">Страницы:</div>
<?php 
//сами ссылки
if($id_cat>0)
{
$q="SELECT count(*) FROM catalog WHERE  category IN($allcat) and manufekted=$idman";
}
else
{
$q="SELECT count(*) FROM catalog WHERE manufekted=$idman";
}



$res=mysql_query($q);
$row=mysql_fetch_row($res);
$total_rows=$row[0];
$num_pages=ceil($total_rows/$per_page);
$page=$_GET['page'];
if($page<1)
{
$page=1;
}
$page2=$page+6;
$page3=$page-6;
if($page3<1)
{
$page3=1;
}

if($page2>$num_pages)
{
$page2=$num_pages;
}

for($i=$page3;$i<$page;$i++) {
  if ($i == $page) {
    echo "<div class='navi_number_active'>$i</div>";
  } else {
    echo '<div class="navi_number"><a href="'.$_SERVER['PHP_SELF'].'?id_cat='.$id_cat.'&page='.$i.'&idman='.$idman.'">'.$i."</a></div> ";
  }
}

for($i=$page;$i<=$page2;$i++) {
  if ($i == $page) {
    echo "<div class='navi_number_active'>$i</div>";
  } else {
    echo '<div class="navi_number"><a href="'.$_SERVER['PHP_SELF'].'?id_cat='.$id_cat.'&page='.$i.'&idman='.$idman.'">'.$i."</a></div> ";
  }
}

?>
			
			</div>		
	<?php 
	}
else
{
echo "Товаров от производителя не найдено";
}
	?>		
	
	
</div>
</div>
