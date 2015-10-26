<?php 
$idm=$_GET['idm'];
$result=mysql_query("SELECT * FROM manufekted WHERE id=$idm");
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

<form action="controller/up_manufekted.php" method="post" ENCTYPE="multipart/form-data">
<div class="new_cait">
			<div class="left">
				<div class="remark">
					<div class="text">Название производителя:</div>
					<div class="text1">Максимальный размер - 100 символов</div>
					<div class="name"><input name="name" id="name" type="text" value="<?php echo "$myrow[name]"; ?>"></div>
				</div>
				<div class="remark" id="chpu">
					<div class="text">Псевдоним:</div>
					<div class="text1">Только английские символы, цифры</div>
					<div class="name"><input name="chpu" type="text"  value="<?php echo "$myrow[chpu]"; ?>"/></div>
				</div>
		<div class="remark">
					<div class="text">Ключевые слова:</div>
					<div class="text1">Максимальный размер - 255 символов</div>
					<div class="name"><input name="keywords" type="text" value="<?php echo "$myrow[keywords]"; ?>"></div>
		</div>
		<div class="remark">
					<div class="text">Разница в курсе:</div>
					<div class="text1">Курс сайта минус введенное значение</div>
					<div class="name"><input name="kursman" type="text" value="<?php echo "$myrow[kursman]"; ?>"></div>
		</div>
		<div class="remark">
			<div class="text">Логотип</div>
			<div class="text1">Рекомендуемый размер не более 1мб</div>
			<div class="name1"><input name="image" type="file" /></div>
		</div>
		<div class="add_image"><img src="../manufected/<?php echo "$myrow[image]"; ?>" /></div>
			</div>
			<div class="right">
				<div class="remark">
					<div class="text">Описание производителя</div>
					<div class="text1">Максимальный размер 2000</div>
					<div class="edit"><textarea name="deskripshn" cols="" rows=""><?php echo "$myrow[deskripshn]"; ?></textarea></div>
				</div>
				<div style="clear:both"></div>
				<input name="id" type="hidden" value="<?php echo "$myrow[id]"; ?>">
				<div class="update3"><input name="submit" type="submit" value="Обновить"></div>
			</div>



</div>
</form>
<script type="text/javascript">
$('#name').live('keyup', function(){
        $.ajax({  
            type: "POST",
            url: "chpu/nameman.php",
            data: $('#name').serialize(),
            cache:false,
            success: function(html){  
                $("#chpu").html(html);  
            }  
        });  
        return false;  
    });
</script>