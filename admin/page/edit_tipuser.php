<?php
$id=$_GET['id']; 
$result=mysql_query("SELECT * FROM usertype WHERE id=$id");
$myrow=mysql_fetch_array($result);
?>
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
<form action="controller/up_tipuser.php" method="post">



			<div class="left">
				<div class="remark">
					<div class="text">Имя типа пользователя:</div>
					<div class="text1">Максимальный размер - 100 символов</div>
					<div class="name"><input name="tip" type="text" value="<?php echo "$myrow[tip]"; ?>"></div>
		</div>
		
		
		


<div class="update"><input name="id" type="hidden" value="<?php echo "$myrow[id]"; ?>">
<input name="submit" type="submit" value="Обновить"></div>
</form>