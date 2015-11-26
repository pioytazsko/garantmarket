<div class="center">
<div class="center">
<?php include("tpl/left.php");?>


<div class="right">


<?php
			$id_cat2=$_GET['id_cat'];
			if($id_cat>0)
                echo  $id_cat2;
			{
			$infocat=mysql_query("SELECT * FROM catecory WHERE chpu LIKE '$id_cat2' ");
			$infocatrez=mysql_fetch_array($infocat);
            $id_cat=$infocatrez['id'];
			?>
			<div class="infocat">
            <div class="catname" ><?php include('bread.php') ?></div>
			<div class="catname"><h1><?php echo "$infocatrez[h1]"; ?></h1></div>
			<div class="catimg"><img src="categoryimages/<?php echo "$infocatrez[img]"; ?>" alt="<?php echo "$infocatrez[name]"."/"; ?>" title="<?php echo "$infocatrez[name]"; ?>" /></div>
			<div class="catinfo"><?php echo "$infocatrez[deskripshn]"; ?></div>
			</div>
			<div style="clear:both;"></div>


			<?php
			}
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
if($id_cat>0)
{
$mancat=mysql_query("SELECT DISTINCT * FROM manufekted WHERE id IN(SELECT manufekted FROM catalog WHERE category IN($allcat))");
$mancatres=mysql_fetch_array($mancat);
}




			if($id_cat>0)
			{
			$parcat=mysql_query("SELECT * FROM catecory WHERE parent=$id_cat");
			$parcatres=mysql_fetch_array($parcat);
			if($parcatres>0)
			{
			echo "<div class='catvl'>Подкатегории</div>";
			do
			{
			?>
<div class="blokpodkat"><a href="catalog/<?php  if($parcatres['chpu']!='') echo $parcatres['chpu']; else echo "element";?><?php echo "/"; ?>" title="<?php echo "$parcatres[name]"; ?>" >
				<div class="podkatname"><?php echo "$parcatres[name]"; ?></div>
				<div class="podkatimg"><img src="categoryimages/<?php echo "$parcatres[img]"; ?>" alt="<?php echo "$parcatres[name]"; ?>" title="<?php echo "$parcatres[name]"; ?>" /></div>
			</a></div>
			<?php
			}
			while($parcatres=mysql_fetch_array($parcat));
			}
			}
			?>
			<div style="clear:both;"></div>
			<div class="spmancat">
<?php 
//Достаем производителей данной категории
if($mancatres>0)
{
do
{
?>
<div class="man_v_cat"><a href="manufactors/<?php echo $mancatres['chpu']; ?><?php echo "/"."$mancatres[id]"; ?>"><?php echo "$mancatres[name]"; ?></a></div>
<?php 
}
while($mancatres=mysql_fetch_array($mancat));
}
?>	
<div style="clear:both;"></div>
</div>		
		
<?php



//формируем запрос к товарам

$per_page=50;
if (isset($_GET['page'])) {$page=($_GET['page']-1);} else {$page=0;};
$start=abs($page*$per_page);

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

if($id_cat>0 and $man<1)
{
$vipitem=mysql_query("SELECT * FROM catalog WHERE view = TRUE AND category IN($allcat) ORDER BY $sortrez LIMIT $start, $per_page");
$vipitemrez=mysql_fetch_array($vipitem);
}

if($id_cat>0 and $man>0)
{
$vipitem=mysql_query("SELECT * FROM catalog WHERE view = TRUE AND category IN($allcat) and manufekted=$man ORDER BY $sortrez LIMIT $start, $per_page");
$vipitemrez=mysql_fetch_array($vipitem);
}

if($id_cat<1)
{
$vipitem=mysql_query("SELECT * FROM catalog  WHERE view = TRUE ORDER BY $sortrez LIMIT $start, $per_page");
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

$newname=$vipitemrez['image'];
$picture=explode('/', $newname);
    $image = end($picture);
unset($picture);
 
    //локали для цен читаем 
    $loc=mysql_query('SELECT local_price FROM catalog WHERE id='.$vipitemrez['id']);
    $loc=mysql_fetch_row($loc);
//    print_r($loc);
    if($loc[0]==1){
    
    $vipitemrez['price']=$vipitemrez['price']-$vipitemrez['price']/100*$datas[0]['discount'];}


    
    
$name=$vipitemrez['name'];
$price= str_replace(',',' ',number_format($vipitemrez['price']));
    $view=$vipitemrez['publick'];
$price2= $vipitemrez['price']*$curs;
$price2= str_replace(',',' ',number_format($price2));
$desc = $vipitemrez['deskripshn'];

$string = strip_tags($desc);
$desc = implode(array_slice(explode('<br>',wordwrap($string,210,'<br>',false)),0,1));
if($desc!=$string)
{
$desc=$desc." ...";
}


 ?>	



				<div class="blok_tovar b1c-good">
				<div class="tovar_name b1c-name"><a href="catalog/<?php echo $infocatrez['chpu']."/"; if($vipitemrez['chpu']!='') echo $vipitemrez['chpu']; else echo "item"; ?>" title="<?php echo "$name"; ?>"><?php echo "$name"; ?></a></div>
				<div class="tovar_image"><a href="catalog/<?php echo $infocatrez['chpu']."/"; if($vipitemrez['chpu']!='') echo $vipitemrez['chpu']; else echo "item"; ?>" title="<?php echo "$name"; ?>"><img src="shopimagepreview/<?php echo "$image"; ?>" alt="<?php echo "$name"; ?>" title="<?php echo "$name"; ?>" /></a></div>
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
				
				if ($paramsitemrez[val]!=''){ $i++;echo '<div class="opis_punct">'.$paramsitemrez2['name'].':<span style="margin-left:7px" >'. $paramsitemrez['val'].'</span></div>';}?>
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
					<span class="cena2">  </span><span class="cena2"></span></div><div class="b1c-sm2"><button class="b1c order" value="<?php echo $vipitemrez['id']; ?>" >ПОД ЗАКАЗ</button><span class="rating">Рейтинг:</span> <?php $id=$vipitemrez['id']; include('rating.php');?></div>
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
if($id_cat>0 and $man<1)
{
$q="SELECT count(*) FROM catalog WHERE category IN($allcat) ";
}

if($id_cat>0 and $man>0)
{
$q="SELECT count(*) FROM catalog WHERE category IN($allcat) and manufekted=$man";
}

if($id_cat<1)
{
$q="SELECT count(*) FROM catalog";
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
  if($sort<1)
  {
  if($man>0)
  {
    echo '<div class="navi_number"><a href="manufactors/'.$infocatrez['chpu'].'/&page='.$i.'">'.$i."</a></div> ";
  }
  else
  {
    echo '<div class="navi_number"><a href="catalog/'.$infocatrez['chpu'].'/&page='.$i.'">'.$i."</a></div> ";
  }
  }
  else
  {
 if($man>0)
 {
  echo '<div class="navi_number"><a href="manufactors/'.$infocatrez['chpu'].'/&page='.$i.'">'.$i."</a></div> ";
 }
 else
 {
    echo '<div class="navi_number"><a href="catalog/'.$infocatrez['chpu'].'/&page='.$i.'">'.$i."</a></div> ";
	}
  }
  }
}

for($i=$page;$i<=$page2;$i++) {
  if ($i == $page) {
    echo "<div class='navi_number_active'>$i</div>";
  } else {
  if($sort<1)
  {
  if($man>0)
  {
  echo '<div class="navi_number"><a href="manufactors/'.$infocatrez['chpu'].'/&page='.$i.'">'.$i."</a></div> ";
  }
  else
  {
    echo '<div class="navi_number"><a href="catalog/'.$infocatrez['chpu'].'/&page='.$i.'">'.$i."</a></div> ";
	}
  }
  else
  {
  if($man>0)
  {
  echo '<div class="navi_number"><a href="manufactors/'.$infocatrez['chpu'].'/&page='.$i.'">'.$i."</a></div> ";
  }
  else
  {
   echo '<div class="navi_number"><a href="catalog/'.$infocatrez['chpu'].'/&page='.$i.'">'.$i."</a></div>  ";
  }

  }
  }
}
}
?>

	</div>

</div>
</div>

