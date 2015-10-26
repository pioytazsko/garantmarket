<?php include("../db.php");
$result=mysql_query("SELECT * FROM goods");
$myrow=mysql_fetch_array($result);
do
{
$name=htmlspecialchars($myrow['long_title']);
$iditem=$myrow['id'];
$price=$myrow['price'];
$category=$myrow['category'];
$deskripshn=$myrow['long_desc'];
$image=$myrow['img_path'];
$publick=$myrow['item_status'];
if($publick=="Доступен")
{
$publick=1;
}
else
{
$publick=0;
}

$result2=mysql_query("SELECT * FROM catalog WHERE  iditem=$iditem");
$myrow2=mysql_fetch_array($result2);
if($myrow2>0)
{
$ednews=mysql_query("UPDATE catalog SET name='$name', price='$price', category='$category', deskripshn='$deskripshn', image='$image', publick='$publick'  WHERE iditem=$iditem ", $db);
}
else
{
mysql_query ("INSERT INTO catalog (name, price, category, deskripshn, image, publick, iditem) VALUES  ('$name', '$price', '$category', '$deskripshn', '$image', '$publick', '$iditem') ");
}

}
while($myrow=mysql_fetch_array($result));
?>