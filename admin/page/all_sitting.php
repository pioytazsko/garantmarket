<?php 
$result=mysql_query("SELECT * FROM sitting");
$myrow=mysql_fetch_array($result);
?>
<form action="controller/up_sitting.php" method="post">
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

<div class="remark">
			<div class="text">Название сайта:</div>
			<div class="text1">Максимальный размер - 255 символов</div>
			<div class="name"><input name="namesite" type="text" value="<?php echo "$myrow[namesite]"; ?>"></div>
		</div>
		<div class="remark">
			<div class="text">Ключевые слова:</div>
			<div class="text1">Максимальный размер - 255 символов</div>
			<div class="name"><input name="keywords" type="text" value="<?php echo "$myrow[keywords]"; ?>"></div>
		</div>
		<div class="remark">
			<div class="text">Основная валюта сайта:</div>
			<div class="text1">Максимальный размер - 20 символов</div>
			<div class="name"><input name="oneval" type="text" value="<?php echo "$myrow[oneval]"; ?>"></div>
		</div>
		<div class="remark">
			<div class="text">Вторая валюта сайта:</div>
			<div class="text1">Максимальный размер - 20 символов</div>
			<div class="name"><input name="towval" type="text" value="<?php echo "$myrow[towval]"; ?>"></div>
		</div>
		<div class="remark">
			<div class="text">Курс валюты:</div>
			<div class="text1">Максимальный размер - 7 символов</div>
			<div class="name"><input name="curs" type="text" value="<?php echo "$myrow[curs]"; ?>"></div>
		</div>
		<div class="remark">
			<div class="text">e-mail сайта:</div>
			<div class="text1">Максимальный размер - 100 символов</div>
			<div class="name"><input name="milo" type="text" value="<?php echo "$myrow[milo]"; ?>"></div>
		</div>
		<div class="remark">
			<div class="text">title сайта:</div>
			<div class="text1">Максимальный размер - 100 символов</div>
			<div class="name"><input name="title" type="text" value="<?php echo "$myrow[title]"; ?>"></div>
		</div>
		<div class="remark">
			<div class="text">description сайта:</div>
			<div class="text1">Максимальный размер - 100 символов</div>
			<div class="name"><input name="desc" type="text" value="<?php echo "$myrow[desc]"; ?>"></div>
		</div>
		<div class="remark">
			<div class="text">Описание сайта:</div>
			<div class="text1">Максимальный размер - 2000 символов</div>
			<div class="description"><textarea name="opisanie"><?php echo "$myrow[opisanie]"; ?></textarea></div>
		</div>
		<div style="clear:both"></div>
		
		<div class="new_cait">
			<div class="left">
				<div class="remark">
					<div class="text">Название компании:</div>
					<div class="text1">Максимальный размер - 100 символов</div>
					<div class="name"><input name="companiname" type="text" value="<?php echo "$myrow[companiname]"; ?>"></div>
		</div>
		<div class="remark">
					<div class="text">Контактные телефоны:</div>
					<div class="text1">Максимальный размер - 255 символов</div>
					<div class="name"><input name="phone" type="text" value="<?php echo "$myrow[phone]"; ?>"></div>
		</div>
		<div class="remark">
					<div class="text">Ставка НДС:</div>
					<div class="text1">Максимальный размер - 2 символа</div>
					<div class="name"><input name="nds" type="text" value="<?php echo "$myrow[nds]"; ?>"></div>
		</div>
			</div>
			<div class="right">
				<div class="remark">
					<div class="text">Информация для электронного счета:</div>
					<div class="text1">Максимальный размер - 1000 символов</div>
					<div class="name2"><textarea name="infoshet" ><?php echo "$myrow[infoshet]"; ?></textarea></div>
				</div>
			</div>
			<div class="remark">
			<div class="text">Примечание к счету:</div>
			<div class="text1">Максимальный размер - 1000 символов</div>
			<div class="description"><textarea name="primechanie" ><?php echo "$myrow[primechanie]"; ?></textarea></div>
		</div>
		<div style="clear:both"></div>
		</div>
		<div class="update"><input name="submit" type="submit" value="Обновить"></div>
</form>