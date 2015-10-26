<form action="controller/new_news.php" method="post">



<div class="new_cait">
			<div class="left">
				<div class="remark">
					<div class="text">Название новости:</div>
					<div class="text1">Максимальный размер - 100 символов</div>
					<div class="name"><input name="name" type="text" ></div>
		</div>
		<div class="remark">
					<div class="text">Ключевые слова:</div>
					<div class="text1">Максимальный размер - 255 символов</div>
					<div class="name"><input name="keywords" type="text"></div>
		</div>
		<div class="remark">
			<div class="text">Категория:</div>
			<div class="text1">Выберите категорию из выподающего списка</div>
			<div class="name">
			<select name="category">
<?php 
echo "<option value='0'>Без категории</option>";

$result3=mysql_query("SELECT * FROM news_category");
$myrow3=mysql_fetch_array($result3);
do
{
echo "<option value='$myrow3[id]'>$myrow3[name]</option>";
}
while($myrow3=mysql_fetch_array($result3));
?>
</select>
			</div>
		</div>
					</div>
			<div class="right">
				<div class="remark">
					<div class="text">Текст новости:</div>
					<div class="text1">До 10000 символов</div>
					<div class="edit"><textarea name="text" ></textarea></div>
				</div>
			<div class="remark">
					<div class="text">Установить связь с товарной позицией:</div>
					<div class="text1">Прикрепить обзор к товару</div>
					<div class="name">
					<select name="svias">
<?php 

echo "<option value='0'>Без категории</option>";

$result5=mysql_query("SELECT * FROM catalog ORDER BY name");
$myrow5=mysql_fetch_array($result5);
do
{
echo "<option value='$myrow5[id]'>$myrow5[name]</option>";
}
while($myrow5=mysql_fetch_array($result5));
?>
</select>
					</div>
		</div>
		
		
</div>

<div class="update">
<input name="submit" type="submit" value="Добавить"></div>
</form>