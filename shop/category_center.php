
<?php 
$idman=$_GET['idman'];
if($idman<1)
{
?>

<?php 
$shopcat=mysql_query("SELECT * FROM catecory WHERE parent=0 and publick=1 ORDER BY levl");
$shopcatrez=mysql_fetch_array($shopcat);
do
{
?>

<div class="blokpodkat1"><a href="catalog/<?php if($shopcatrez['chpu']!='') echo $shopcatrez['chpu']."/"; else echo "element/"; ?>" title="<?php echo "$shopcatrez[name]"; ?>" >
				<div class="podkatname"><?php echo "$shopcatrez[name]"; ?></div>
				<div class="podkatimg"><img src="categoryimages/<?php echo "$shopcatrez[img]"; ?>" alt="<?php echo "$parcatres[name]"; ?>" title="<?php echo "$parcatres[name]"; ?>" /></div>
</a></div>



<?php 
}
while($shopcatrez=mysql_fetch_array($shopcat));
?>
							

<?php 
}
else
{
?>
		
<?php 
$viborcatman=mysql_query("SELECT DISTINCT category FROM catalog WHERE manufekted=$idman");
$viborcatmanrez=mysql_fetch_array($viborcatman);
$alcatman="";
do
{
$viborcatman2=mysql_query("SELECT * FROM catecory WHERE id=$viborcatmanrez[category]");
$viborcatmanrez2=mysql_fetch_array($viborcatman2);

if($viborcatmanrez2['parent']<1)
{
$alcatman="".$alcatman."".$viborcatmanrez['category'].", ";
}
else
{
$viborcatman3=mysql_query("SELECT * FROM catecory WHERE id=$viborcatmanrez2[id]");
$viborcatmanrez3=mysql_fetch_array($viborcatman3);
if($viborcatmanrez3['parent']<1)
{
$alcatman="".$alcatman."".$viborcatmanrez2['id'].", ";
}
else
{
$alcatman="".$alcatman."".$viborcatmanrez3['parent'].", ";
}
}
}
while($viborcatmanrez=mysql_fetch_array($viborcatman));
$alcatman="".$alcatman."5001";



$shopcat=mysql_query("SELECT * FROM catecory WHERE parent=0 and id IN($alcatman) ORDER BY levl");
$shopcatrez=mysql_fetch_array($shopcat);
do
{
?>
				<li><a href="item_manufactors/<?php echo "$idman"."/"; ?><?php if($shopcatrez['chpu']!='') {echo $shopcatrez['chpu'];} else { echo "element";} echo "/"."$shopcatrez[id]"; ?>"><?php if($shopcatrez['h1']){ echo "$shopcatrez[h1]"; }else{ echo "$shopcatrez[name]"; } ?></a></li><div class="sep"><img src="image/sep_2.png" alt="image"></div>
<?php 
}
while($shopcatrez=mysql_fetch_array($shopcat));
?>
							

<?php 
}?>
<div style="clear:both"></div>


<?php



//формируем запрос к товарам

$per_page=7;
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
$vipitem=mysql_query("SELECT * FROM catalog WHERE view = TRUE AND  category IN($allcat) ORDER BY $sortrez LIMIT $start, $per_page");
$vipitemrez=mysql_fetch_array($vipitem);
}

if($id_cat>0 and $man>0)
{
$vipitem=mysql_query("SELECT * FROM catalog WHERE view = TRUE AND  category IN($allcat) and manufekted=$man ORDER BY $sortrez LIMIT $start, $per_page");
$vipitemrez=mysql_fetch_array($vipitem);
}

if($id_cat<1)
{
$vipitem=mysql_query("SELECT * FROM catalog WHERE view = TRUE  ORDER BY $sortrez LIMIT $start, $per_page  ");
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
$name=$vipitemrez['name'];
$view=$vipitemrez['publick'];
$price= str_replace(',',' ',number_format($vipitemrez['price']));
$price2= $vipitemrez['price']*$curs;
$price2= str_replace(',',' ',number_format($price2));
$desc = $vipitemrez['deskripshn'];
$info1 = $vipitemrez['chpu'];
$string = strip_tags($desc);
$desc = implode(array_slice(explode('<br>',wordwrap($string,210,'<br>',false)),0,1));
if($desc!=$string)
{
$desc=$desc." ...";
}

 ?>	



				<div class="blok_tovar b1c-good">
				<div class="tovar_name b1c-name"><a href="catalog/<?php echo $vipitemrez['chpu']."/"; if($vipitemrez['chpu']!='') echo $vipitemrez['chpu']; else echo "$item"; ?>" title="<?php echo "$name"; ?>"><?php echo "$name"; ?></a></div>
				<div class="tovar_image"><a href="catalog/<?php echo $vipitemrez['chpu']."/"; if($vipitemrez['chpu']!='') echo $vipitemrez['chpu']; else echo "$item"; ?>" title="<?php echo "$name"; ?>"><img src="shopimagepreview/<?php echo "$image"; ?>" alt="<?php echo "$name"; ?>" title="<?php echo "$name"; ?>" /></a></div>
				
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
				
				if ($paramsitemrez[val]!=''){$i++; echo '<div class="opis_punct">'.$paramsitemrez2['name'].':<span style="margin-left:7px" >'. $paramsitemrez['val'].'</span></div>';}?>
				<?php
				}
				}
				while(($paramsitemrez=mysql_fetch_array($paramsitem)) and ($i<8));
				}
					?>
				</div>
				<div style="clear:both"></div>
				<div class="description"><?php echo "$desc"; ?><a href="catalog/<?php echo $vipitemrez['chpu']."/"; if($vipitemrez['chpu']!='') echo $vipitemrez['chpu']; else echo "$item"; ?>" title="<?php echo "$name"; ?>">Подробнее</a></div>
				



	

		
<?php if($view==0) {?>
				<div class="cena22">
				


<div style="float:left;padding-top: 7px;" class="cena-h b1c-name">
					<span class="cena2"></span><span class="cena2"></span></div><div class="b1c-sm2"><button class="b1c order" value="<?php echo $vipitemrez['id']; ?>" >ПОД ЗАКАЗ</button><span class="rating">Рейтинг:</span><?php $id=$vipitemrez['id']; include('rating.php');?></div>
				</div><?php } else{ ?>
				
<div class="cena">
				


<div style="float:left;padding-top: 7px;" class="cena-h b1c-name">
					<span class="cena2"> Цена: </span><?php echo "$price" ?> <span class="cena2"><?php echo "$val1" ?></span></div><div><button class="b1c" value="<?php echo $vipitemrez['id']; ?>" >КУПИТЬ</button><span class="rating">Рейтинг:</span> <?php $id=$vipitemrez['id']; include('rating.php');?></div>
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
    echo '<div class="navi_number"><a href="'.$_SERVER['PHP_SELF'].'?id_cat='.$id_cat.'&man='.$man.'&page='.$i.'">'.$i."</a></div> ";
  }
  else
  {
    echo '<div class="navi_number"><a href="'.$_SERVER['PHP_SELF'].'?id_cat='.$id_cat.'&page='.$i.'">'.$i."</a></div> ";
  }
  }
  else
  {
 if($man>0)
 {
  echo '<div class="navi_number"><a href="'.$_SERVER['PHP_SELF'].'?id_cat='.$id_cat.'&man='.$man.'&page='.$i.'&sort='.$sort.'">'.$i."</a></div> ";
 }
 else
 {
    echo '<div class="navi_number"><a href="'.$_SERVER['PHP_SELF'].'?id_cat='.$id_cat.'&page='.$i.'&sort='.$sort.'">'.$i."</a></div> ";
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
  echo '<div class="navi_number"><a href="'.$_SERVER['PHP_SELF'].'?id_cat='.$id_cat.'&man='.$man.'&page='.$i.'">'.$i."</a></div> ";
  }
  else
  {
    echo '<div class="navi_number"><a href="'.$_SERVER['PHP_SELF'].'?id_cat='.$id_cat.'&page='.$i.'">'.$i."</a></div> ";
	}
  }
  else
  {
  if($man>0)
  {
  echo '<div class="navi_number"><a href="'.$_SERVER['PHP_SELF'].'?id_cat='.$id_cat.'&man='.$man.'&page='.$i.'&sort='.$sort.'">'.$i."</a></div> ";
  }
  else
  {
   echo '<div class="navi_number"><a href="'.$_SERVER['PHP_SELF'].'?id_cat='.$id_cat.'&page='.$i.'&sort='.$sort.'">'.$i."</a></div> ";
  }

  }
  }
}
}
?>






