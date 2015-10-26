<form action="controller/new_par.php" method="post" ENCTYPE="multipart/form-data">
<div class="new_cait">
			<div class="left">
				<div class="remark">
					<div class="text">Название параметра:</div>
					<div class="text1">Максимальный размер - 50 символов</div>
					<div class="name"><input name="name" type="text" value="<?php echo "$myrow[name]"; ?>"></div>
				</div>
				
				
		
			</div>
			<div class="right">
			
				<div style="clear:both"></div></div>
				<div class="update3"><input name="submit" type="submit" value="Добавить"></div>
			</div>



</div>
</form>