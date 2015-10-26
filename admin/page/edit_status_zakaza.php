<?php 
$id=$_GET['id'];
$result=mysql_query("SELECT * FROM statuszakaza WHERE id=$id");
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
Название статуса<br>
<form action="controller/up_statuszakaza.php" method="post">
<input name="name" type="text" value="<?php echo "$myrow[name]"; ?>">
<input name="id" type="hidden" value="<?php echo $id; ?>">
<input name="submit" type="submit" value="Обновить"></form>