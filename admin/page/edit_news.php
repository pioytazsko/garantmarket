<?php
$id=$_GET['id']; 
$result=mysql_query("SELECT * FROM news WHERE id=$id");
$myrow=mysql_fetch_array($result);
?>
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
<form action="controller/up_news.php" method="post">



<div class="new_cait">
			<div class="left">
				<div class="remark">
					<div class="text">Название новости:</div>
					<div class="text1">Максимальный размер - 100 символов</div>
					<div class="name"><input name="name" id="name" type="text" value="<?php echo "$myrow[name]"; ?>"></div>
		</div>
						<div class="remark" id="chpu">
					<div class="text">Псевдоним:</div>
					<div class="text1">Только английские символы, цифры</div>
					<div class="name"><input name="chpu" type="text" value="<?php echo "$myrow[chpu]"; ?>"/></div>
				</div>
		<div class="remark">
					<div class="text">Ключевые слова:</div>
					<div class="text1">Максимальный размер - 255 символов</div>
					<div class="name"><input name="keywords" type="text" value="<?php echo "$myrow[keywords]"; ?>"></div>
		</div>
		<div class="remark">
					<div class="text">Description слова:</div>
					<div class="text1">Максимальный размер - 255 символов</div>
					<div class="name"><input name="desc" type="text" value="<?php echo "$myrow[desc]"; ?>"></div>
		</div>
		<div class="remark">
			<div class="text">Категория:</div>
			<div class="text1">Выберите категорию из выподающего списка</div>
			<div class="name">
			<select name="category">
<?php 
$result2=mysql_query("SELECT * FROM news_category WHERE id=$myrow[category]");
$myrow2=mysql_fetch_array($result2);
if($myrow2>0)
{
echo "<option value='$myrow2[id]'>$myrow2[name]</option>";
echo "<option value='0'>Без категории</option>";
}
else
{
echo "<option value='0'>Без категории</option>";
}

$result3=mysql_query("SELECT * FROM news_category WHERE id!=$myrow[category]");
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
					<div class="text">Текст новости:</div>
					<div class="text1">До 10000 символов</div>
					<div class="edit"><textarea name="text" ><?php echo "$myrow[text]"; ?></textarea></div>
				</div>
			<div class="remark">
					<div class="text">Установить связь с товарной позицией:</div>
					<div class="text1">Прикрепить обзор к товару</div>
					<div class="name" style="height:150px;">
					<select name="svias[]" size="5" style="height:150px;" multiple="multiple">
<?php 
$result4=mysql_query("SELECT * FROM catalog WHERE id IN(SELECT idi FROM news_item_s WHERE idn=$id)");
$myrow4=mysql_fetch_array($result4);
if($myrow4>0)
{
do
{
echo "<option value='$myrow4[id]' selected='selected'>$myrow4[name]</option>";
}
while($myrow4=mysql_fetch_array($result4));
echo "<option value='0' >Без категории</option>";
}
else
{
echo "<option value='0' selected='selected'>Без связи</option>";
}
$result5=mysql_query("SELECT * FROM catalog WHERE id NOT IN(SELECT idi FROM news_item_s WHERE idn=$id)");
$myrow5=mysql_fetch_array($result5);
do
{
echo "<option value='$myrow5[id]'>$myrow5[name]</option>";
}
while($myrow5=mysql_fetch_array($result5));
?>
</select>
					</div>
		</div>
		
		
</div>

<div class="update"><input name="id" type="hidden" value="<?php echo "$myrow[id]"; ?>">
<input name="submit" type="submit" value="Обновить"></div>
</form>
		<script type="text/javascript">
$('#name').live('keyup', function(){
        $.ajax({  
            type: "POST",
            url: "chpu/namenews.php",
            data: $('#name').serialize(),
            cache:false,
            success: function(html){  
                $("#chpu").html(html);  
            }  
        });  
        return false;  
    });
</script>