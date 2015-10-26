<div class="center">

<?php

echo "<p>По вашему запросу: ";

 if (isset($_POST['keyword'])) {$keyword = $_POST['keyword'];}

 $keyword = trim($keyword); 
 $keyword = stripslashes($keyword); 
 $keyword = htmlspecialchars($keyword); 
 echo "<b>$keyword</b>";


$vipitem=mysql_query("SELECT * FROM catalog WHERE name LIKE '%".strtoupper($keyword)."%' LIMIT 20");
$vipitemrez=mysql_fetch_array($vipitem);

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
$image = end(explode('/', $newname));
$name=$vipitemrez['name'];
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
			
<div class="blok_tovar">
				<div class="tovar_name"><a href="catalog/<?php echo $infocatrez['chpu']."/"; if($vipitemrez['chpu']!='') echo $vipitemrez['chpu']; else echo "item"; ?>" title="<?php echo "$name"; ?>"><?php echo "$name"; ?></a></div>
				</div>
<?php 
}
while($vipitemrez=mysql_fetch_array($vipitem));
}
else
{
echo " ничего не найдено";
}
?>	

</div>