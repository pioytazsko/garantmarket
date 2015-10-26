<?php include("../db.php");
$id=$_POST['id'];
$name=$_POST['name'];
$levl=$_POST['levl'];
$tip=$_POST['tip'];
$linkpunkta=$_POST['linkpunkta'];//в этой переменно у нас id выбраного материала, категории товаров
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
$tip2="Категория новостей";
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
$type=9;
}

if($tip=="man")
{
$tip2="Производители";
$linkpunkta2="manufacturers.php";
$type=5;

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
$linkpunkta2="newssite.php";
$type=8;
}

$ednews=mysql_query("INSERT INTO menu (name, tip, linkpunkta, levl, razv, type) VALUES  ('$name', '$tip2', '$linkpunkta2', '$levl', '$razv','$type') ");
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