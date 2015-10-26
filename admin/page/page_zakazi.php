<?php
$id=$_GET['id']; 
$result=mysql_query("SELECT * FROM zakaz WHERE id=$id");
$myrow=mysql_fetch_array($result);
?>
<strong>Содержание заказа:</strong><br>
<?php echo "$myrow[info]"; ?><br>
<strong>Примечание к заказу:</strong><br>
<?php echo "$myrow[primechanie]"; ?><br>
<strong>Дата:</strong><br>
<?php echo "$myrow[date]"; ?><br>
<strong>Статус заказа:</strong><br>
<form action="controller/up_zakaz.php" method="post"><select name="status">
<?php 
$result2=mysql_query("SELECT * FROM statuszakaza WHERE id=$myrow[status]");
$myrow2=mysql_fetch_array($result2);
if($myrow2>0)
{
?>
<option value="<?php echo "$myrow2[id]"; ?>"><?php echo "$myrow2[name]"; ?></option>
<?php 
}
else
{
echo "<option value='0'>Не указан</option>";
}
$result3=mysql_query("SELECT * FROM statuszakaza WHERE id!=$myrow[status] AND publick=1");
$myrow3=mysql_fetch_array($result3);
do
{
?>
<option value="<?php echo "$myrow3[id]"; ?>"><?php echo "$myrow3[name]"; ?></option>
<?php 
}
while($myrow3=mysql_fetch_array($result3));
?>
</select><br>
<input name="id" type="hidden" value="<?php echo "$myrow[id]"; ?>"></form>
<strong>Информация о заказчике:</strong><br>
<?php 
$result4=mysql_query("SELECT * FROM user WHERE id=$myrow[iduser]");
$myrow4=mysql_fetch_array($result4);
?>
<strong>e-mail:</strong><br><?php echo "$myrow4[milo]"; ?><br>
<strong>Телефон:</strong><br><?php echo "$myrow4[phone]"; ?><br>
<strong>Примечание к пользователю:</strong><br><?php echo "$myrow4[info]"; ?><br>
<strong>ФИО:</strong><br><?php echo "$myrow4[foi]"; ?><br>
<strong>Дата регистрации:</strong><br><?php echo "$myrow4[datereg]"; ?><br>
