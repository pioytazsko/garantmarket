<div class="center">

<?php 
$idchpu=$_GET['id'];
$item=mysql_query("SELECT * FROM catalog WHERE chpu LIKE '$idchpu' ");
$itemrez=mysql_fetch_array($item);
$id=$itemrez['id'];

$newname=$itemrez['image'];
$picture=explode('/', $newname);
$image = end($picture);
unset($picture);

$mankurs=mysql_query("SELECT * FROM manufekted WHERE id=$itemrez[manufekted]");
$mankursrez=mysql_fetch_array($mankurs);
if($mankursrez>0)
{
$curs=$curs-$mankursrez['kursman'];
}
// проверка на локальную цену   
$loc=mysql_query('SELECT local_price FROM catalog WHERE id='.$itemrez['id']);
$loc=mysql_fetch_row($loc);

if($loc[0]==1){
$itemrez['price']=$itemrez['price']-$itemrez['price']/100*$datas[0]['discount'];
}
// вывод цены
$price= str_replace(',',' ',number_format($itemrez['price']));
$price2= $itemrez['price']*$curs;
$price2= str_replace(',',' ',number_format($price2));

$selman=mysql_query("SELECT * FROM manufekted WHERE id=$itemrez[manufekted]");
$selmanrez=mysql_fetch_array($selman);
if($selmanrez>0)
{

if($selmanrez['chpu']!=''){ $chpurez=$selmanrez['chpu'];} else {$chpurez="manufactor"; }
$man="<a href='manufactors/$chpurez/$selmanrez[id]' title='$selmanrez[name]'>$selmanrez[name]</a>";
$manimage="<a href='manufactors/$chpurez/$selmanrez[id]' title='$selmanrez[name]'><img src='manufected/$selmanrez[image]' alt='$selmanrez[name]' title='$selmanrez[name]' /></a>";
}
else
{
$man="Производитель не указан";
$manimage="<img src='manufected/no_image.png' alt='image' />";
}

$item2=mysql_query("SELECT * FROM catalog WHERE price<$itemrez[price] and category=$itemrez[category]");
$itemrez2=mysql_fetch_array($item2);

$newname2=$itemrez2['image'];
$picture=explode('/', $newname2);
$image2 = end($picture);
unset($picture);

$item3=mysql_query("SELECT * FROM catalog WHERE price<$itemrez[price] and category=$itemrez[category]");
$itemrez3=mysql_fetch_array($item3);

$newname3=$itemrez3['image'];
$picture=explode('/', $newname3);
$image3 = end($picture);
unset($picture);

$sni=mysql_query("SELECT * FROM news_item_s WHERE idi=$id");
$snir=mysql_fetch_array($sni);
if($snir>0)
{
$odzor=mysql_query("SELECT * FROM news WHERE id=$snir[idn]");
$odzorrez=mysql_fetch_array($odzor);
}
else
{
$odzorrez=0;
}


$cat=mysql_query("SELECT * FROM catecory WHERE id=$itemrez[category]");
$catrez=mysql_fetch_array($cat);

?>
    <div class="catname">
    <?php include('bread_item.php');?>
    </div>	
			
			<div class="shop_text ">
			

<!--Галерея-->			
<div class="shop_galery b1c-good">
<div class="shapka1">
				<div class="blok_name b1c-name"><h1><?php echo "$itemrez[name]";$them_buy=$itemrez['h1']; ?></h1></div>
			</div>
<div id="gallery" >
	<div class="osnimg"><a href="shopimage/<?php echo "$image"; ?>" rel="lightbox[plants]"><img src="shopimage/<?php echo "$image"; ?>"  alt="<?php echo "$itemrez[name]" ?>" id="main-img" title="<?php echo "$itemrez[name]" ?>" /></a></div>
<div style="float:right">
<div style="width: 444px;">
<div class="shop_logo" style="border: 0;">Производитель:<br /><?php echo "$manimage"; ?></div> <span class="glyphicon glyphicon-star"></span>
<div class="shop_firma_name"><?php echo "$man"; ?></div>

		<div class="shop_button2">
			<div class="shop_button2_left"></div>
			<div class="shop_button2_center">
			<?php 
			     if($itemrez['publick']==1) 
				{?>
				   <span style="color:#20BE20">Есть в наличии</span>

					</div>
					<div class="shop_button2_right"></div>
						</div>	
						<div class="shop_button">
							<div class="shop_buy"><span class="b1c-name"> Цена:  <?php  echo "  $price $val1"; ?></span></div>
							<div class="shop_buy2"><?php // echo "$price2 $val2"; ?></div>
							<div class="shop_buy3"></div>
						</div>
						<div style="height:100px"><button value="<?php echo $itemrez['id']; ?>" class="b1c">КУПИТЬ</button></div>
				
				<?php } 
			     else
				{?>
				   Под заказ</div>
					<div class="shop_button2_right"></div>
					</div>	
		<div class="shop_button">
			<div class="shop_buy_no"><span class="b1c-name"> Цена:  <?php  echo "  $price"; ?>*<?php  echo "  $val1"; ?></span></div></br>
			<div class="shop_buy2"><?php // echo "$price2 $val2"; ?></div>
			<div class="shop_buy3"></div>
		</div>
		<div style="font-size: 11px;float:left;color:#333;margin-right: 8px;">*При заказе товара уточняйте цену у менеджера.</div>
		<div class="bno" style="height:100px"><button value="<?php echo $itemrez['id']; ?>" class="b1c order">ПОД ЗАКАЗ</button></div>


				<?php }?>
			






</div>
</div>
<?php 
$dopimg=mysql_query("SELECT * FROM galeriitem WHERE iditem=$id LIMIT 3");
$dopimgrez=mysql_fetch_array($dopimg);
if($dopimgrez>0)
{
echo "<ul><li>";
?>

<?php
echo "<img src='shopimage/$image' / alt='image'></li>";
do
{
echo "<li>";
?>
<a href="shopimage/<?php echo "$dopimgrez[image]"; ?>" rel="lightbox[plants]">
<?php
echo"<img src='shopimage/$dopimgrez[image]' alt='image'/></a></li>";
}
while($dopimgrez=mysql_fetch_array($dopimg));
echo "</ul>";
}
?>	

</div>
</div>

<!--Конец галереи-->
<!--Все параметыр-->
		<div class="shop_right">
			<div class="shop_right_top">
				
				
				<div id="speedzakaz">
				<?php include("shop/speedform.php");?>
				</div>
				<div id="voprozad">
				<?php include("shop/voprosform.php");?>
				</div>
				<div id="voprozad2">
				<?php include("shop/voproscena.php");?>
				</div>
				<?php 
				if($itemrez['linkodzor']!='')
				{
				?>
				<div class="shop_button3">
					<div class="shop_button2_left4"></div>
					<div class="shop_button2_center2"><a href="<?php echo $itemrez['linkodzor']; ?>" rel="nofollow"><?php echo $itemrez['linkodzortitle']; ?></a></div>
					<div class="shop_button2_right"></div>
				</div>
				<?php }?>
				<?php 
				if($itemrez['linkotziv']!='')
				{
				?>
				<div class="shop_button3">
					<div class="shop_button2_left5"></div>
					<div class="shop_button2_center2"><a href="<?php echo $itemrez['linkotziv']; ?>" rel="nofollow"><?php echo $itemrez['linkotzivtitle']; ?></a></div>
					<div class="shop_button2_right"></div>
				</div>
				<?php }?>
				
				
				<div style="clear:both"></div>						
			</div>
			
			<?php  include('complect.php');
			$paramsitem=mysql_query("SELECT * FROM paramsitem WHERE iditem=$id");
				$paramsitemrez=mysql_fetch_array($paramsitem);
				if($paramsitemrez>0)
				{
			 ?>
			<div class="shop_opisanie2">
				<div class="shop_header">
					<div class="shop_opismm">Параметры</div>
				</div>
				<?php 
				
				do
				{
				$paramsitem2=mysql_query("SELECT * FROM params WHERE id=$paramsitemrez[idparams] and publick=1 ORDER BY lvl");
				$paramsitemrez2=mysql_fetch_array($paramsitem2);
				if($paramsitemrez2>0)
				{
				if($paramsitemrez['val']){
				?>
				<div class="shop_button5"><div class="shop_buttonim"><img src="icon/<?php echo "$paramsitemrez2[image]"; ?>" alt="image"/></div><div class="shop_buttonval"><strong><?php echo "$paramsitemrez2[name]"; ?></strong> : <span style="  color: #2DACDD;
  padding-left: 5px;
  /* font-weight: bold; */
  font-size: 16px;"><?php echo "$paramsitemrez[val]"; ?></span></div></div>
				<?php 
				}
				}
				}
				while($paramsitemrez=mysql_fetch_array($paramsitem));
				?>
				</div>	
				
		<?php 
		};
		?>		
		<div class="shop_opisanie">
            <?php if ($itemrez[deskripshn]==''){} else{
				echo'<div class="shop_head">
					<div class="shop_opis">Описание</div>
                    </div>';}?>
				<div class="shop_opisanie_text"><?php echo "$itemrez[deskripshn]" ?><br>
				<?php
				if($itemrez['filetitle']!='')
				{
				 echo "<a href='file/$itemrez[filename]' title='$itemrez[filetitle]'>$itemrez[filetitle]</a>";
				 }
				  ?>
				 </div>
			</div>	
		<?php include('sliser.php');?>	
			<div class="shop_bottom">
		<div class="shop_opisanie1">
				
				<?php 
				$item4=mysql_query("SELECT * FROM catalog WHERE id!=$id and category=$itemrez[category] LIMIT 5");
				$itemrez4=mysql_fetch_array($item4);
				if($itemrez4>0)
				{
				echo "<div class='shop_head1'><div class='shop_opis3'>Похожие товары</div></div>";
				do
				{
				$newname4=$itemrez4['image'];
				$picture=explode('/', $newname4);
                    $image4 = end($picture);
                    unset($picture);
                    
                    
                    
				$infocat=mysql_query("SELECT * FROM catecory WHERE id = $itemrez4[category] ");
				$infocatrez=mysql_fetch_array($infocat);
				?>



				<div class="shop_tovar2 b1c-good">
					
					<div style="height: 143px;"><a href="catalog/<?php echo $infocatrez['chpu']."/"; if($itemrez4['chpu']!='') echo $itemrez4['chpu']; else echo "item"; ?>" title="<?php echo "$itemrez4[name]"; ?>"><div class="shop_tovar_kart"><img src="shopimage/<?php echo "$image4"; ?>" alt="image"/></div></a></div>

					<div class="shop_katalog_name b1c-name"><a href="catalog/<?php echo $infocatrez['chpu']."/"; if($itemrez4['chpu']!='') echo $itemrez4['chpu']; else echo "item"; ?>" title="<?php echo "$itemrez4[name]"; ?>"><?php echo "$itemrez4[name]"; ?></a></div>
					

				<?php 
                    $loc=mysql_query('SELECT local_price FROM catalog WHERE id='.$itemrez4['id']);
$loc=mysql_fetch_row($loc);
$datas = $database->select("location_discount", '*', array('city'=>$city['city']['name_en']) );
if (count($datas)==0){
$datas = $database->select("location_discount", '*', array('city'=>'Other') );
}
if($loc[0]==1){
$itemrez4['price']=$itemrez4['price']-$itemrez4['price']/100*$datas[0]['discount'];
};
                    
			     if($itemrez4[price]==0) 
				{?>
							<div class="shop_cena"><span class="b1c-name">  <span style="font-size:19px;font-weight:bold;  margin-left: 10px;"></span></span><div class="b1c-sm"><button class="b1c" value="<?php echo $itemrez4['id'];?>">ПОД ЗАКАЗ</button></div></div>
				
<?php } 
			     else
				{?>
	<div class="shop_cena"><span class="b1c-name"> Цена: <span style="font-size:19px;font-weight:bold;  margin-left: 10px;"><?php

                 
                 
                 
                 
                 $cena=number_format($itemrez4['price'],0,'',' '); echo $cena.' '.$val1; ?></span></span><div><button class="b1c" value="<?php echo $itemrez4['id'];?>">КУПИТЬ</button></div></div>
                    
<?php } ?>
				</div>









				<?php 
				}
				while($itemrez4=mysql_fetch_array($item4));
				}
				?>
				
				
				
		</div>		

</div>
            
            
           <br>

<div style="clear:both;"></div>
			
			<div style="clear:both;"></div>	
			
			
		</div>

	
		
		
		
		
		<div style="clear:both; padding-top:20px;"></div>
	</div>
<!--Конец параметыр-->
<div class="shop_center">
	<?php 
	if($odzorrez>0)
	{
	?>
		<div class="shop_opisanie1">
				<div class="shop_head1">
					<div class="shop_opis2" id="obzor">Обзор</div>
				</div>
				<div class="shop_opisanie_text"><?php echo "$odzorrez[text]"; ?></div>
				
			</div>
	<?php }?>
	
	
			<div class="shop_opisanie1">
				<div class="shop_head1">
					<div class="shop_opis1" id="otziv">Отзывы</div>
				</div>
				<?php 
				$otziv=mysql_query("SELECT * FROM otzivi WHERE iditem=$id and publick=1 ORDER BY date DESC");
				$otzivrez=mysql_fetch_array($otziv);
				if($otzivrez>0)
				{
				do
				{
				$name = $otzivrez['name'];
				if($name=='')
				{
				$name="Не указано";
				}
				?>
				<div class="shop_head3"><?php echo $name; ?></div>
				<div class="shop_date"><?php echo $otzivrez['date']; ?></div>
				<div class="shop_opisanie_text"><?php echo "$otzivrez[text]"; ?><br><br></div>
				
				<?php 
				}
				while($otzivrez=mysql_fetch_array($otziv));
				}
				?>
				
				<div class="add_otziv">Добавить отзыв</div>
				<div class="add_otzivform"><?php include("shop/formotziva.php");?></div>
			</div>
	</div>
</div>
