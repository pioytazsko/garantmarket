<form action="controller/new_menu.php" method="post">
Название<br>
<input name="name" type="text" ><br>
Уровень<br>
<input name="levl" type="text" ><br><br>
Выберите тип<br><br>

<a href="sitting.php?idp=6&tip=catnews">Категория новостей</a><br>
<a href="sitting.php?idp=6&tip=itemnews">Статья</a><br>
<a href="sitting.php?idp=6&tip=catalog">Каталог товаров</a><br>
<a href="sitting.php?idp=6&tip=catshop">Категория товаров</a><br>
<a href="sitting.php?idp=6&tip=man">Производители</a><br>
<a href="sitting.php?idp=6&tip=gl">Главная страница</a><br><br>

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
?>
<br>
<input name="submit" type="submit" value="Добавить">

</form>