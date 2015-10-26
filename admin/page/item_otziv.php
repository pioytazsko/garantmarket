<?php 
$id=$_GET['id'];
$result=mysql_query("SELECT * FROM otzivi WHERE id=$id");
$myrow=mysql_fetch_array($result);

$result2=mysql_query("SELECT * FROM catalog WHERE id=$myrow[iditem]");
$myrow2=mysql_fetch_array($result2);
?>
<strong>Разместил</strong><br>
<?php echo "$myrow[name]"; ?><br>
<strong>К товару</strong><br>
<?php echo "$myrow2[name]"; ?><br>
<strong>Сожержание отзыва</strong><br>
<?php echo "$myrow[text]"; ?><br>
<strong>Дата добавления</strong><br>
<?php echo "$myrow[date]"; ?><br>