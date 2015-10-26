<?php include("../db.php");
$id=$_POST['id'];
$name=$_POST['name'];
$levl=$_POST['levl'];
$tip=$_POST['tip'];
$linkpunkta=$_POST['linkpunkta'];
$razv1 = $_POST['razv'];
if ($razv1!=1)
{
    $razv=0;
}
else
{
    $razv=$linkpunkta;
}
if($tip=="catnews")
{
$tip2="Категория статей";
$linkpunkta2=$linkpunkta;
$type=7;
}

if($tip=="catshop")
{
$tip2=="Категория каталога";
$linkpunkta2=$linkpunkta;
$type=2;
}

if($tip=="itemnews")
{
$tip2="Статья";
$linkpunkta2=$linkpunkta;
$type=6;
}

if($tip=="catalog")
{
$tip2="Каталог";
$linkpunkta2="1";
$type=1;
}

if($tip=="gl")
{
$tip2="Главная страница";
$linkpunkta2="index.php";
}

if($tip=="man")
{
$tip2="Производители";
$linkpunkta2="manufactor/";
$type=4;
}

if($tip=="recept")
{
$tip2="Рецепты";
$linkpunkta2="recept.php";
}

if($tip=="golosari")
{
$tip2="Голосарий";
$linkpunkta2="golosari.php";
}

if($tip=="newssite")
{
$tip2="Новости сайта";
$linkpunkta2="news/";
}

if($tip=="infosite")
{
$tip2="Информация";
$linkpunkta2="infosite.php";
}

$ednews=mysql_query("UPDATE menu SET name='$name', levl='$levl', tip='$tip2', linkpunkta='$linkpunkta2', razv='$razv', type='$type' WHERE id=$id ", $db);
if($ednews=='true')
{
$url="../menu.php?idp=4&idcom=1";
header("Location: ".$url);
}
else
{
$url="../menu.php?idp=4&idcom=2";
header("Location: ".$url);
}
?>