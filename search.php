<?php
require_once ("tpl/header.php");
require_once ("tpl/top.php");
//require_once ("tpl/centersearch-1.php");

?>

<div class="center" id="center">

<?php
//$_POST['keyword']="дрель";
echo "<p>По вашему запросу: ";

 if (isset($_POST['keyword'])) {$keyword = $_POST['keyword'];}

 $keyword = trim($keyword); 
 $keyword = stripslashes($keyword); 
 $keyword = htmlspecialchars($keyword); 
 echo "<b>$keyword</b>";


$vipitem=mysql_query("SELECT * FROM catalog WHERE name LIKE '%".strtoupper($keyword)."%'  ORDER BY levl DESC LIMIT 20 ");
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
$id=$vipitemrez['id'];
$newname=$vipitemrez['image'];
$temp=explode('/', $newname);
    $image = end($temp);
    unset($temp);
$name=$vipitemrez['name'];
$price= str_replace(',',' ',number_format($vipitemrez['price']));
$price2= $vipitemrez['price']*$curs;
$price2= str_replace(',',' ',number_format($price2));
$desc = $vipitemrez['deskripshn'];

//$string = strip_tags($desc);
//$desc = implode(array_slice(explode('<br>',wordwrap($string,230,'<br>',false)),0,1));
//if($desc!=$string)
//{
//$desc=$desc." ...";
//}
$infocat=mysql_query("SELECT * FROM catecory WHERE id = $vipitemrez[category] ");
$infocatrez=mysql_fetch_array($infocat);
 ?>			
			
<div class="blok_tovar" id="block_tovar" >
    <div id="image_product"><img src="/shopimage/<?php echo $newname;?>" alt="<?php echo "$name"; ?>">
    </div>
    
    <div class="tovar_name"><a href="catalog/<?php echo $infocatrez['chpu']."/"; if($vipitemrez['chpu']!='') echo $vipitemrez['chpu']; else echo "item"; ?>" title="<?php echo "$name"; ?>"><?php echo rtrim($name,' '); ?><div id="about_product"><?php
    // формирование вывода товара
$query="SELECT * FROM paramsitem WHERE iditem='".$id."'";
    $parametrs=mysql_query($query); 
  $i=0;
    while(($parametrss=mysql_fetch_array($parametrs)) AND ($i<5) ){
     $query_params="SELECT* FROM params WHERE id=".$parametrss['idparams'];
        $res_param=mysql_query($query_params);echo mysql_error();
        $params_name=mysql_fetch_array($res_param);
        if ($parametrss['val']){
            if($i%2==1){echo '<span id="line">'.$params_name['name'].': ';
                        echo $parametrss['val'].'</span><br>';}else {
                        echo '<span id="line1">'.$params_name['name'].': ';
                        echo $parametrss['val'].'</span><br>'; 
            };} ;++$i;
    };
     $rating='';
            for($i=$vipitemrez['rating'];$i>0;$i--){
                $rating='<span class="rate_active"></span>'.$rating;};
            for($i=5-$vipitemrez['rating'];$i>0;$i--){
                $rating=$rating.'<span class="rate_inactive"></span>';};
    
    
    

    
            
            
        ?><div id="space"></div><span id="product_price" ><?php  if($price==0){echo 'ПОД ЗАКАЗ';}else{ echo'ЦЕНА: '. $price.' бел.руб.';};?> </span><div id="star-five"><?php echo $rating;?></div></div></div>
</a>
  
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
<?php require_once ("tpl/bottom.php");?>