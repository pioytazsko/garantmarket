<?php 
$id=$_GET['id'];
$result=mysql_query("SELECT * FROM news_category WHERE id=$id");
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
<form action="controller/up_category_news.php" method="post">

<div class="new_cait">
			<div class="left">
				<div class="remark">
					<div class="text">Название категории:</div>
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
					<div class="text">Description:</div>
					<div class="text1">Максимальный размер - 255 символов</div>
					<div class="name"><input name="desc" type="text" value="<?php echo "$myrow[desc]"; ?>"></div>
		</div>
		</div>
			<div class="right">
				<div class="remark">
					<div class="text">Описание категории:</div>
					<div class="text1">До 10000 символов</div>
					<div class="edit"><textarea name="text" cols="" rows=""><?php echo "$myrow[text]"; ?></textarea></div>
				</div>
			
</div>

<div class="update"><input name="id" type="hidden" value="<?php echo "$myrow[id]"; ?>">
<input name="submit" type="submit" value="Обновить"></div>
</form>
<script type="text/javascript">
$('#name').live('keyup', function(){
        $.ajax({  
            type: "POST",
            url: "chpu/namecatnews.php",
            data: $('#name').serialize(),
            cache:false,
            success: function(html){  
                $("#chpu").html(html);  
            }  
        });  
        return false;  
    });
</script>