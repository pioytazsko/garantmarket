
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
				<li><a href="catalog/<?php if($shopcatrez['chpu']!='') echo $shopcatrez['chpu']."/"; else echo "element/"; ?>" title="<?php echo "$shopcatrez[name]"; ?>"><?php if($shopcatrez['h1']){ echo "$shopcatrez[h1]"; }else{ echo "$shopcatrez[name]"; } ?></a></li><div class="sep"><img src="image/sep_2.png" alt='image'></div>
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
//print_r($viborcatmanrez2);
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
    //создаем массив для использования при формировании подкатегорий
    $arr_man=array();
do
{
    $arr_man[]=$shopcatrez;
?>
				<li><a href="item_manufactors/<?php echo "$idman"."/"; ?><?php if($shopcatrez['chpu']!='') {echo $shopcatrez['chpu'];} else { echo "element";} echo "/"."$shopcatrez[id]"; ?>"><?php if($shopcatrez['h1']){ echo "$shopcatrez[h1]"; }else{ echo "$shopcatrez[name]"; } ?></a></li><div class="sep"><img src="image/sep_2.png" alt="image"></div>
<?php 
}
while($shopcatrez=mysql_fetch_array($shopcat));
//    print_r($arr_man);

?>
							

<?php 
}?>