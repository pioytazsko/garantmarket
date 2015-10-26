<?php 
$idcom=$_GET['idcom'];
if($idcom==1)
{
echo "<div class='yescoment'>Выполнено успешно</div>";
}
if($idcom==2)
{
echo "<div class='nocoment'>Произошла ошибка</div>";
}
?>
<?php 
$result=mysql_query("SELECT * FROM usertype");
$myrow=mysql_fetch_array($result);
?>
<strong>Выберите тип пользователя</strong><br>
<form action="controller/rassilka.php" method="post"><select name="tip">
<option value="0">Все пользователи</option>
<?php 
if($myrow>0)
{
do
{
echo "<option value=''>$myrow[tip]</option>";
}
while($myrow=mysql_fetch_array($result));
}
?>
</select><br>
<strong>Тема</strong><br>
<input name="title" type="text" size="51"><br>
<strong>Сообщение</strong><br>
<textarea name="mess"></textarea>
<br>
<input name="submit" type="submit" value="Отправить">
</form>