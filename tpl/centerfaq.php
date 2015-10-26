<div class="center">
<?php 
$result=mysql_query("SELECT * FROM vopros WHERE publick=1 ORDER BY id DESC");
$myrow=mysql_fetch_array($result);
if($myrow>0)
{
do
{
?>
<div class="namevop"><?php echo "$myrow[name] "; ?><?php echo "$myrow[date]"; ?></div>
<div class="textvop"><?php echo "$myrow[vopros]"; ?></div>
<div class="textotv"><strong>Ответ</strong><br><?php echo "$myrow[otvet]"; ?></div>
<?php 
}
while($myrow=mysql_fetch_array($result));
}
?>
<div class="formvop">
Представьтесь:<br>
<form action="shop/newvopros2.php" method="post"><input name="name" type="text"><br>
Ваш вопрос:<br>
<textarea name="vopros" cols="40" rows="10"></textarea><br>
<input name="submit" type="submit" value="Отправить"></form>
</div>
</div>