<?php 
$idm=$_GET['id'];
$result=mysql_query("SELECT * FROM vopros WHERE id=$idm");
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

<form action="controller/up_vop.php" method="post" ENCTYPE="multipart/form-data">
<div class="new_cait">
			<div class="left">
				<div class="remark">
					<div class="text">Имя:</div>
					<div class="text1">Максимальный размер - 100 символов</div>
					<div class="name"><input name="name" type="text" value="<?php echo "$myrow[name]"; ?>"></div>
				</div>
				<div class="remark">
					<div class="text">Дата:</div>
					<div class="text1">Максимальный размер - 100 символов</div>
					<div class="name"><input name="date" type="text" value="<?php echo "$myrow[date]"; ?>"></div>
				</div>
				<div class="remark">
					<div class="text">Вопрос:</div>
					<div class="text1">Максимальный размер - 1000 символов</div>
					<div class="name"><textarea name="vopros" ><?php echo "$myrow[vopros]"; ?></textarea></div>
				</div>
				<div class="remark">
					<div class="text">Ответ:</div>
					<div class="text1">Максимальный размер - 1000 символов</div>
					<div class="name"><textarea name="otvet" ><?php echo "$myrow[otvet]"; ?></textarea></div>
				</div>
				
				<div style="clear:both"></div>
				<input name="id" type="hidden" value="<?php echo "$myrow[id]"; ?>">
				<div class="update3"><input name="submit" type="submit" value="Обновить"></div>
			</div>
</div>
</form>