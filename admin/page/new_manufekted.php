<form action="controller/new_manufekted.php" method="post" ENCTYPE="multipart/form-data">
<div class="new_cait">
			<div class="left">
				<div class="remark">
					<div class="text">Название производителя:</div>
					<div class="text1">Максимальный размер - 100 символов</div>
					<div class="name"><input name="name" type="text" ></div>
		</div>
		<div class="remark">
					<div class="text">Ключевые слова:</div>
					<div class="text1">Максимальный размер - 255 символов</div>
					<div class="name"><input name="keywords" type="text" ></div>
		</div>
		<div class="remark">
			<div class="text">Логотип</div>
			<div class="text1">Рекомендуемый размер не более 1мб</div>
			<div class="name1"><input name="" type="file" /></div>
		</div>
		<div class="add_image"><img src="../manufected/no_image.png" /></div>
			</div>
			<div class="right">
				<div class="remark">
					<div class="text">Описание производителя</div>
					<div class="text1">Максимальный размер 2000</div>
					<div class="edit"><textarea name="deskripshn"></textarea></div>
				</div>
				<div style="clear:both"></div>
				<div class="update3"><input name="submit" type="submit" value="Добавить"></div>
			</div>



</div>
</form>