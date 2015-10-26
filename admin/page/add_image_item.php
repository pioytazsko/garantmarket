<form action="controller/newimageitem.php" method="post" ENCTYPE="multipart/form-data">
Добавить изображение:<br>
<input name="image" type="file" />
<input name="iditem" type="hidden" value="<?php echo $id=$_GET['id']; ?>">
<input name="submit" type="submit" value="Добавить изображение">
</form>
<br><br>
<strong>Дополнительные изображения к товару.</strong><br><br>
<?php 
$result=mysql_query("SELECT * FROM galeriitem WHERE iditem=$id ");
$myrow=mysql_fetch_array($result);
if($myrow>0)
{
do
{
echo "<a href='controller/dropimage.php?id=$myrow[id]'>$myrow[image] - Удалить изображение</a><br><img src='../shopimage/$myrow[image]' /><br><br>";
}
while($myrow=mysql_fetch_array($result));
}
else
{
echo "Дополнительные изображения к товару отсутствуют";
}
?>