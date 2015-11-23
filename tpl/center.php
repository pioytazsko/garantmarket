<div class="center">
<?php include("tpl/left.php");?>	
		
	
		<div class="right">

<?php require_once ("tpl/slider.php"); ?>
			
<div class="header_big">Популярные товары</div>
			
			
<?php
//формируем запрос к товарам
$sort=$_GET['sort'];
$sortrez="levl";

if($sort==1)
{
$sortrez="price";
}

if($sort==2)
{
$sortrez="name";
}

$man=$_GET['man'];


$vipitem=mysql_query("SELECT * FROM catalog  WHERE view = TRUE AND  vip=1 ORDER BY levl LIMIT 10 ");
$vipitemrez=mysql_fetch_array($vipitem);


do
{
$mankurs=mysql_query("SELECT * FROM manufekted WHERE id=$vipitemrez[manufekted]");
$mankursrez=mysql_fetch_array($mankurs);
if($mankursrez>0)
{
$curs=$curs-$mankursrez['kursman'];
}

$newname=$vipitemrez['image'];
    $view=$vipitemrez['publick'];
$temp=explode('/', $newname);    
$image = end($temp);
$name=$vipitemrez['name'];
$price= str_replace(',',' ',number_format($vipitemrez['price']));
$price2= $vipitemrez['price']*$curs;
$price2= str_replace(',',' ',number_format($price2));
$desc = $vipitemrez['deskripshn'];

$string = strip_tags($desc);//
$desc = implode(array_slice(explode('<br>',wordwrap($string,310,'<br>',false)),0,1));
if($desc!=$string)
{
$desc=$desc." ...";
}

$infocat=mysql_query("SELECT * FROM catecory WHERE id = $vipitemrez[category] ");
$infocatrez=mysql_fetch_array($infocat);
 ?>			
			
				
			
				<div class="blok_tovar b1c-good">
				<div class="tovar_name b1c-name"><a href="catalog/<?php echo $infocatrez['chpu']."/"; if($vipitemrez['chpu']!='') echo $vipitemrez['chpu']; else echo "item"; ?>" title="<?php echo "$name"; ?>"><?php echo "$name"; ?></a></div>
				<div class="tovar_image">
				<a href="catalog/<?php echo $infocatrez['chpu']."/"; if($vipitemrez['chpu']!='') echo $vipitemrez['chpu']; else echo "item"; ?>" title="<?php echo "$name"; ?>">
				<?php
					if($vipitemrez['share']){
				?>
				<div style="position: absolute;right: 8px;bottom: -25px;">
				<img src="image/act_krug.png" style="width: 50px; height: 50px;padding:0 7px 30px 0px;" alt="image/act_krug.png"/>
				</div>
				<?php } ?>
				<img src="shopimagepreview/<?php echo "$image"; ?>" alt="<?php echo "$name"; ?>" title="<?php echo "$name"; ?>" />
				</a>
				</div>
				<div class="tovar_opis">
				<?php 
					$paramsitem=mysql_query("SELECT * FROM paramsitem WHERE iditem=$vipitemrez[id]");
					$paramsitemrez=mysql_fetch_array($paramsitem);
					if($paramsitemrez>0)
					{ $i=0;
					do
					{ 
					$paramsitem2=mysql_query("SELECT * FROM params WHERE id=$paramsitemrez[idparams] and gl=1");
					$paramsitemrez2=mysql_fetch_array($paramsitem2);
					if($paramsitemrez2>0)
					{
				
				if ($paramsitemrez['val']!=''){ $i++;echo '<div class="opis_punct">'.$paramsitemrez2['name'].':<span style="margin-left:7px" >'. $paramsitemrez['val'].'</span></div>';}?>
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
<div class="header_big">О компании</div>
			<?php echo "$sitrez[opisanie]"; ?>
		</div>	</div>
