
<form action="controller/new_mod.php" method="post" ENCTYPE="multipart/form-data">
<div class="new_cait">
			<div class="left">
				<div class="remark">
					<div class="text">Название модуля:</div>
					<div class="text1">Максимальный размер - 100 символов</div>
					<div class="name"><input name="name" type="text"></div>
				</div>
				<div class="remark">
					<div class="text">Позиция:</div>
					<div class="text1">Выберите позицию</div>
					<div class="name">
					<select name="pos">
					<?php 
					$result3=mysql_query("SELECT * FROM pos_mod ");
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
					<div class="text">Содержание модуля</div>
					<div class="text1">Максимальный размер 2000</div>
					<div class="edit"><textarea name="info" cols="" rows=""></textarea></div>
				</div>
				<div style="clear:both"></div>
				
				<div class="update3"><input name="submit" type="submit" value="Добавить"></div>
			</div>



</div>
</form>