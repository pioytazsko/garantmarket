<?php 
$id=$_GET['id'];
$result=mysql_query("SELECT * FROM menu WHERE id=$id");
$myrow=mysql_fetch_array($result);
?>
<form action="controller/up_menu.php" method="post">
Название<br>
<input name="name" type="text" value="<?php echo "$myrow[name]"; ?>"><br>
Уровень<br>
<input name="levl" type="text" value="<?php echo "$myrow[levl]"; ?>"><br><br>
Выберите тип<br><br>

<a href="sitting.php?idp=5&tip=catnews&id=<?php echo $id; ?>">Категория новостей</a><br>
<a href="sitting.php?idp=5&tip=itemnews&id=<?php echo $id; ?>">Статья</a><br>
<a href="sitting.php?idp=5&tip=catalog&id=<?php echo $id; ?>">Каталог товаров</a><br>
<a href="sitting.php?idp=5&tip=catshop&id=<?php echo $id; ?>">Категория товаров</a><br>
<a href="sitting.php?idp=5&tip=man&id=<?php echo $id; ?>">Производители</a><br>
<a href="sitting.php?idp=5&tip=gl&id=<?php echo $id; ?>">Главная страница</a><br><br>
<a href="sitting.php?idp=5&tip=faq&id=<?php echo $id; ?>">Вопрос/ответ</a><br><br>

<?php 
$tip=$_GET['tip'];
if($tip=="catnews")
{
include("menu/catnews.php");
}

if($tip=="catshop")
{
include("menu/catshop.php");
}

if($tip=="itemnews")
{
include("menu/itemnews.php");
}

if($tip=="catalog")
{
include("menu/catalog.php");
}

if($tip=="man")
{
include("menu/man.php");
}

if($tip=="gl")
{
include("menu/index_page.php");
}

if($tip=="faq")
{
include("menu/faq.php");
}
?>
<br>
<input name="id" type="hidden" value="<?php echo $id; ?>">
<input name="submit" type="submit" value="Обновить">

</form>