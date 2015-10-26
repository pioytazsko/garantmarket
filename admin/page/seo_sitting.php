<?php 
$result=mysql_query("
SELECT  `catalog_title`, `catalog_desc`, `catalog_key`, `man_title`,
		`man_desc`, `man_key`, `faq_title`, `faq_desc`, `faq_key`
 FROM `seo`
 WHERE `id`=1
 ");
$myrow=mysql_fetch_array($result);
?>
<form action="controller/up_seo_sitting.php" method="post">
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
			<div class="text">Каталог тайтл:</div>
			<div class="text1">Максимальный размер - 255 символов</div>
			<div class="name"><input name="catalog_title" type="text" value="<?php echo "$myrow[catalog_title]"; ?>"></div>
		</div>
		<div class="remark">
			<div class="text">Каталог описание:</div>
			<div class="text1">Максимальный размер - 500 символов</div>
			<div class="name"><input name="catalog_desc" type="text" value="<?php echo "$myrow[catalog_desc]"; ?>"></div>
		</div>
		<div class="remark">
			<div class="text">Каталог ключевые слова:</div>
			<div class="text1">Максимальный размер - 500 символов</div>
			<div class="name"><input name="catalog_key" type="text" value="<?php echo "$myrow[catalog_key]"; ?>"></div>
		</div>
		<div style="clear:both"></div>
		<div class="remark">
			<div class="text">Производитель тайтл:</div>
			<div class="text1">Максимальный размер - 255 символов</div>
			<div class="name"><input name="man_title" type="text" value="<?php echo "$myrow[man_title]"; ?>"></div>
		</div>
		<div class="remark">
			<div class="text">Производитель описание:</div>
			<div class="text1">Максимальный размер - 500 символов</div>
			<div class="name"><input name="man_desc" type="text" value="<?php echo "$myrow[man_desc]"; ?>"></div>
		</div>
		<div class="remark">
			<div class="text">Производитель ключевые слова:</div>
			<div class="text1">Максимальный размер - 500 символов</div>
			<div class="name"><input name="man_key" type="text" value="<?php echo "$myrow[man_key]"; ?>"></div>
		</div>
		<div style="clear:both"></div>
		<div class="remark">
			<div class="text">faq тайтл:</div>
			<div class="text1">Максимальный размер - 255 символов</div>
			<div class="name"><input name="faq_title" type="text" value="<?php echo "$myrow[faq_title]"; ?>"></div>
		</div>
		<div class="remark">
			<div class="text">faq описание:</div>
			<div class="text1">Максимальный размер - 500 символов</div>
			<div class="name"><input name="faq_desc" type="text" value="<?php echo "$myrow[faq_desc]"; ?>"></div>
		</div>
		<div class="remark">
			<div class="text">faq ключевые слова:</div>
			<div class="text1">Максимальный размер - 500 символов</div>
			<div class="name"><input name="faq_key" type="text" value="<?php echo "$myrow[faq_key]"; ?>"></div>
		</div>
		<div style="clear:both"></div>
		<div class="update"><input name="submit" type="submit" value="Обновить"></div>
</form>