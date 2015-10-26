<?php 
$idm=$_GET['idm'];
$result=mysql_query("SELECT * FROM params WHERE id=$idm");
$myrow=mysql_fetch_array($result);

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

<form action="controller/up_par.php" method="post" ENCTYPE="multipart/form-data">
<div class="new_cait">
			<div class="left">
				<div class="remark">
					<div class="text">Название параметра:</div>
					<div class="text1">Максимальный размер - 50 символов</div>
					<div class="name"><input name="name" type="text" value="<?php echo "$myrow[name]"; ?>"></div>
				</div>
				<div class="remark">
					<div class="text">Связать с категорией:</div>
					<div class="text1">Выберите категорию</div>
					<div class="name">
					<select name="idcat">
					<?php 
					echo "<option value='0'>Не указано</option>";
					$result3=mysql_query("SELECT * FROM catecory ORDER BY name");
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
				<div class="remark">
			<div class="text">Изображение:</div>
			<div class="text1">Рекомендуемый размер 25px на 25px</div>
			<div class="name1"><input name="image" type="file"></div>
		</div>
		<div class="add_image"><img src="../icon/<?php echo "$myrow[image]"; ?>" /></div>
		
			</div>
			<div class="right">
			<div class="remark">
				<strong>Параметр привязан к категориям</strong>:<br><br>
				<?php 
					$result4=mysql_query("SELECT * FROM paramskat WHERE idpar=$idm");
					$myrow4=mysql_fetch_array($result4);
					if($myrow4>0)
					{
					do
					{
					$result5=mysql_query("SELECT * FROM catecory WHERE id=$myrow4[idcat]");
					$myrow5=mysql_fetch_array($result5);
					?>
					<?php echo "$myrow5[name]"; ?> <a href="controller/delit_svparcat.php?idcat=<?php echo "$myrow5[id]"; ?>&idpar=<?php echo "$idm"; ?>">Удалить</a><br>					
					<?php
					}
					while($myrow4=mysql_fetch_array($result4));
					}
					else
					{
					echo "Связей с категориями не установлено";
					}
					?>
				<div style="clear:both"></div></div>
				<input name="id" type="hidden" value="<?php echo "$myrow[id]"; ?>">
				<div class="update3"><input name="submit" type="submit" value="Обновить"></div>
			</div>



</div>
</form>