
<form action="controller/new_category_news.php" method="post">

<div class="new_cait">
			<div class="left">
				<div class="remark">
					<div class="text">Название категории:</div>
					<div class="text1">Максимальный размер - 100 символов</div>
					<div class="name"><input name="name" type="text" ></div>
		</div>
		<div class="remark">
					<div class="text">Ключевые слова:</div>
					<div class="text1">Максимальный размер - 255 символов</div>
					<div class="name"><input name="keywords" type="text" ></div>
		</div>
		</div>
			<div class="right">
				<div class="remark">
					<div class="text">Описание категории:</div>
					<div class="text1">До 10000 символов</div>
					<div class="edit"><textarea name="text" cols="" rows=""></textarea></div>
				</div>
			
</div>

<div class="update">
<input name="submit" type="submit" value="Обновить"></div>
</form>