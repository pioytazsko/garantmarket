<?php include("db.php");?>
<?php include("title.php");require_once ("location/read_location.php"); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html lang="ru">
<head>
<title><?php echo $title; ?></title> 
<base href="http://<?=$_SERVER['HTTP_HOST'];?>">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="<?php echo $keywords; ?>" />
<meta name="description" content="<?php echo $kewdesk; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="content-style-type" content="text/css">
<meta http-equiv="content-language" content="ru" />
<link rel="canonical" href="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']  ?>" />
<link rel="stylesheet" type="text/css" href="/css/bootstrap.css" >
<link rel="stylesheet" type="text/css" href="/css/style.css">
<link rel="stylesheet" type="text/css" href="/css/lightbox.css">
<link rel="stylesheet" type="text/css" href="/css/news_style.css">
<link rel="stylesheet" type="text/css" href="/css/style_shop.css">
<link rel="stylesheet" type="text/css" href="/css/craftyslide.css">
<link rel="stylesheet" type="text/css" href="/css/ui.totop.css">
<link rel="stylesheet" type="text/css" href="/css/all.css">
<link rel="stylesheet" type="text/css" href="/css/menu.css" > 
</head>
<body>
      <!-- Google Code for garantmarket.by -->
<!-- Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. For instructions on adding this tag and more information on the above requirements, read the setup guide: google.com/ads/remarketingsetup -->

<?php require_once ("tpl/top_slider.php"); ?>
<?php
$idcom=$_GET['idcom'];
if($idcom!='')
{
?>
<div id="comentblock">
<?php 

if($idcom=="z1")
{
echo "Ваш заказ принят.";
}

if($idcom=="z2")
{
echo "При оформлении заказа произошла ошибка.";
}

if($idcom=="o1")
{
echo "Благодарим вас за отзыв. После рассмотрения модератром он будет опубликован";
}

if($idcom=="o2")
{
echo "При добавлении отзыва произошла ошибка.";
}

if($idcom=="v1")
{
echo "Вопрос принят";
}

if($idcom=="v2")
{
echo "При отправке вопроса произошла ошибка";
}

if($id_user>0)
{
$lk="zakaz.php";
}
else
{
$lk="zakaz2.php";
}

if($idcom=="ad1")
{
echo "Добавлен в корзину <br> <a href='$lk'>Перейти в корзину?</a>";
}

if($idcom=="ad2")
{
echo "Вы не авторизованы";
}

if($idcom=="iz1")
{
echo "Ваш заказ принят";
}

if($idcom=="iz2")
{
echo "При оформлении заказа произошла ошибка";
}

if($idcom=="pod1")
{
echo "Выполнено успешно";
}

if($idcom=="pod2")
{
echo "Произошла ошибка";
}

if($idcom=="if1")
{
echo "Ваш вопрос принят. Мы ответим на него в ближайшее время";
}

if($idcom=="if2")
{
echo "При добавлении вопроса произошла ошибка";
}
?>
</div>
<?php }?>
<div id="content">