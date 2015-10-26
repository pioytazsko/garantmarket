<?php 
$idus=$_GET['idus'];
$result=mysql_query("SELECT * FROM user WHERE id=$idus");
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
<form action="controller/up_user.php" method="post">
<div class="remark">
			<div class="text">ФИО:</div>
			<div class="text1">Фамилия, Имя, Отчество пользователя</div>
			<div class="name"><input name="foi" type="text" value="<?php echo "$myrow[foi]"; ?>"></div>
		</div>
		<div class="remark">
			<div class="text">Контактный телефон:</div>
			<div class="text1">Номер телефона пользователя</div>
			<div class="name"><input name="phone" type="text" value="<?php echo "$myrow[phone]"; ?>"></div>
		</div>
	
	
			<div class="new_cait">
			
				<div class="left">
					<div class="remark">
					<div class="text">Примечание:</div>
					<div class="text1">Максимум 500 символов</div>
					<div class="name3"><textarea name="info"><?php echo "$myrow[info]"; ?></textarea></div>
				</div>
				</div>
				<div class="right">
					<div class="remark">
						<div class="text">E-mail:</div>
						<div class="text1">Электронная почта пользователя</div>
						<div class="name"><input name="milo" type="text" value="<?php echo "$myrow[milo]"; ?>"></div>
					</div>
					<div class="remark">
						<div class="text">Пароль:</div>
						<div class="text1">Ввдедите пароль</div>
						<div class="name"><input name="pass" type="text" /></div>
					</div>
					<div class="remark">
						<div class="text">Тип пользователя:</div>
						<div class="text1">Ввдедите пароль</div>
						<div class="name">
						<select name="tip">
							<?php 
							$usertip=mysql_query("SELECT * FROM usertype WHERE id=$myrow[tip]");
							$usertiprez=mysql_fetch_array($usertip);
							if($usertiprez>0)
							{
							?>
							<option value="<?php echo "$usertiprez[id]"; ?>"><?php echo "$usertiprez[tip]"; ?></option>
							<option value="0">Не указан</option>
							<?php 
							}
							else
							{
							?>
							<option value="0">Не указан</option>
							<?php 
							}
							?>
							<?php 
							$usertip2=mysql_query("SELECT * FROM usertype WHERE id!=$myrow[tip]");
							$usertiprez2=mysql_fetch_array($usertip2);
							if($usertiprez2>0)
							do
							{
							echo "<option value='$usertiprez2[id]'>$usertiprez2[tip]</option>";
							}
							while($usertiprez2=mysql_fetch_array($usertip2));
							?>
						</select>
						</div>
					</div>
					
				</div>
			
			</div>
		<input name="id" type="hidden" value="<?php echo "$idus"; ?>">
	<div class="update"><input name="submit" type="submit" value="Обновить"></div>
</form>