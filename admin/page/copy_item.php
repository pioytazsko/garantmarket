<?php 
$id=$_GET['id'];
$result=mysql_query("SELECT * FROM catalog WHERE id=$id");
$myrow=mysql_fetch_array($result);
?>
<form action="controller/copy_item.php" method="post" ENCTYPE="multipart/form-data">
<div class="new_cait">
			<div class="left">
			<div class="remark">
					<div class="text">ID товара:</div>
					<div class="text1">Только числа </div>
					<div class="name"><input name="iditem" type="text" value="" /></div>
				</div>
				<div class="remark">
					<div class="text">Название:</div>
					<div class="text1">Максимальный размер - 100 символов</div>
					<div class="name"><input name="name" type="text" value="<?php echo "$myrow[name]"; ?>" /></div>
				</div>
					<div class="remark">
					<div class="text">Цена:</div>
					<div class="text1">Только цифры</div>
					<div class="name"><input name="price" type="text" value="<?php echo "$myrow[price]"; ?>" /></div>
				</div>
					<div class="remark">
					<div class="text">Ссылка на обзор:</div>
					<div class="text1">Максимальное значение 255 символов</div>
					<div class="name"><input name="linkodzor" type="text" value="<?php echo "$myrow[linkodzor]"; ?>" /></div>
				</div>
					<div class="remark">
					<div class="text">Подпись ссылки на обзор:</div>
					<div class="text1">Максимум 60 символов</div>
					<div class="name"><input name="linkodzortitle" type="text" value="<?php echo "$myrow[linkodzortitle]"; ?>" /></div>
				</div>
					<div class="remark">
					<div class="text">Ключевые слова:</div>
					<div class="text1">Максимальный размер - 255 символов</div>
					<div class="name"><input name="keywords" type="text" value="<?php echo "$myrow[keywords]"; ?>" /></div>
				</div>
					<div class="remark">
					<div class="text">Ссылка на отзывы:</div>
					<div class="text1">Максимальный размер - 255 символов</div>
					<div class="name"><input name="linkotziv" type="text" value="<?php echo "$myrow[linkotziv]"; ?>" /></div>
				</div>
				<div class="remark">
					<div class="text">Подпись ссылки на отзывы:</div>
					<div class="text1">Максимальный размер - 60 символов</div>
					<div class="name"><input name="linkotzivtitle" type="text" value="<?php echo "$myrow[linkotzivtitle]"; ?>" /></div>
				</div>
				<div class="remark">
			<div class="text">Файловое приложение:</div>
			<div class="text1">Рекомендуемый размер не болие 3,5Мб</div>
			<div class="name1"><input name="file" type="file" /></div>
		</div>
		<div class="remark">
			<div class="text">Подпись файла:</div>
			<div class="text1">Рекомендуемый размер 90px на 90px</div>
			<div class="name1"><input name="filetitle" type="text" value="<?php echo "$myrow[filetitle]"; ?>" /></div>
		</div>
		<!--start dopparans-->
		<div class="remark"><hr>Дополнительные параметры</div><br><br>
		<?php 
		$doppar=mysql_query("SELECT * FROM paramskat WHERE idcat=$myrow[category] ORDER BY idpar");
		$dopparrez=mysql_fetch_array($doppar);
		$co=0;
		if($dopparrez>0)
		{
		do
		{
		$doppar2=mysql_query("SELECT * FROM params WHERE id=$dopparrez[idpar]");
		$dopparrez2=mysql_fetch_array($doppar2);
		$dop="dop$co";
		
		$doppar3=mysql_query("SELECT * FROM paramsitem WHERE idparams=$dopparrez[idpar] and iditem=$myrow[id]");
		$dopparrez3=mysql_fetch_array($doppar3);
		?>
		
		<div class="remark">
			<div class="text"><?php echo "$dopparrez2[name]"; ?>:</div>
			<div class="name1"><input name="<?php echo $dop; ?>" type="text" value="<?php echo "$dopparrez3[val]"; ?>" /></div>
		</div>
		<?php 
		$co++;
		}
		while($dopparrez=mysql_fetch_array($doppar));
		}
		else
		{
		echo "Нет дополнительных параметров";
		}
		?>
		<!--end dopparans-->
		
			</div>
			<div class="right">
			<div class="remark">
					<div class="text">Производитель:</div>
					<div class="text1">Выберите из списка</div>
					<div class="name"><select name="manufekted">
					<?php 
					$result2=mysql_query("SELECT * FROM manufekted WHERE id=$myrow[manufekted]");
					$myrow2=mysql_fetch_array($result2);
					if($myrow2>0)
					{
					echo "<option value='$myrow2[id]'>$myrow2[name]</option>";
					echo "<option value='0'>Нет производителя</option>";
					}
					else
					{
					echo "<option value='0'>Нет производителя</option>";
					}
					$result3=mysql_query("SELECT * FROM manufekted WHERE id!=$myrow[manufekted]");
					$myrow3=mysql_fetch_array($result3);
					if($myrow3>0)
					{
					do
					{
					echo "<option value='$myrow3[id]'>$myrow3[name]</option>";
					}
					while($myrow3=mysql_fetch_array($result3));
					}
					?>
					</select></div>
		</div>
		<div class="remark">
					<div class="text">Категория:</div>
					<div class="text1">Выберите из списка</div>
					<div class="name"><select name="category"><?php include("controller/cat_item.php"); ?></select></div>
		</div>
				<div class="remark">
					<div class="text">Описание:</div>
					<div class="text1">Рекомендуемое значение от 2 слов</div>
					<div class="edit"><textarea name="deskripshn"><?php echo "$myrow[deskripshn]"; ?></textarea></div>
				</div>
			
		<div class="remark">
					<div class="text">Скидка:</div>
					<div class="text1">В процентах, только число</div>
					<div class="name"><input name="spase" type="text" value="<?php echo "$myrow[spase]"; ?>" /></div>
		</div>
		<div class="remark">
					<div class="text">Уровень:</div>
					<div class="text1">Только число</div>
					<div class="name"><input name="levl" type="text" value="<?php echo "$myrow[levl]"; ?>" /></div>
		</div>
		<div class="remark">
					<div class="text">VIP статус:</div>
					<div class="text1">0 - нет, 1 - да.</div>
					<div class="name"><input name="vip" type="text" value="<?php echo "$myrow[vip]"; ?>" /></div>
		</div>
		<div class="remark">
					<div class="text">Еденица измерения:</div>
					<div class="text1">Максимум 10 символов</div>
					<div class="name"><input name="unit" type="text" value="<?php echo "$myrow[unit]"; ?>" /></div>
		</div>
		<div class="remark">
			<div class="text">Изображение:</div>
			<div class="text1">Рекомендуемый размер 90px на 90px</div>
			<div class="name1"><input name="image" type="file" /></div>
		</div>
		<div class="add_image"><img src="../shopimage/no_image.png"></div>
		
<div class="update4"><input name="submit" type="submit" value="Обновить позицию"></div>
		
</div>
	
	
	
	
	</div></form>