<?php 
$idm=$_GET['idm'];
$result=mysql_query("SELECT * FROM moduls WHERE id=$idm");
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

<form action="controller/up_mod.php" method="post" ENCTYPE="multipart/form-data">
<div class="new_cait">
			<div class="left">
				<div class="remark">
					<div class="text">Название модуля:</div>
					<div class="text1">Максимальный размер - 100 символов</div>
					<div class="name"><input name="name" type="text" value="<?php echo "$myrow[name]"; ?>"></div>
				</div>
				<div class="remark">
					<div class="text">Позиция:</div>
					<div class="text1">Выберите позицию</div>
					<div class="name">
					<select name="pos">
					<?php 
					$result2=mysql_query("SELECT * FROM pos_mod WHERE id=$myrow[pos]");
					$myrow2=mysql_fetch_array($result2);
					echo "<option value='$myrow2[id]'>$myrow2[name]</option>";
					
					$result3=mysql_query("SELECT * FROM pos_mod WHERE id!=$myrow[pos]");
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
					<div class="edit"><textarea name="info" cols="" rows=""><?php echo "$myrow[info]"; ?></textarea></div>
				</div>
				<div style="clear:both"></div>
				<input name="id" type="hidden" value="<?php echo "$myrow[id]"; ?>">
				<div class="update3"><input name="submit" type="submit" value="Обновить"></div>
			</div>



</div>
</form>