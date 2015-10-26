<?php include("db.php");?>
<?php include("title.php") ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<base href="http://<?=$_SERVER['HTTP_HOST'];?>">
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>-->

    <script src="js/jquery-1.9.0.js"></script>
    <script src="js/myskripts.js"></script>
<script src="js/myskripts3.js"></script>
<script src="js/craftyslide.js"></script>
<script src="js/lightbox.js"></script>
<script type="text/javascript" src="js/jquery.devrama.slider.js"></script>

<script type="text/javascript" charset="utf-8" src="/buyme/js/buyme.js"></script>
    
<script type="text/javascript" charset="utf-8" src="/js/autocomplete.js"></script>

<link rel="stylesheet" type="text/css" href="/css/style.css">
<link rel="stylesheet" type="text/css" href="/css/lightbox.css">
<link rel="stylesheet" type="text/css" href="/css/news_style.css">
<link rel="stylesheet" type="text/css" href="/css/style_shop.css">
<link rel="stylesheet" type="text/css" href="/css/craftyslide.css">
<link rel="stylesheet" type="text/css" href="/css/ui.totop.css">
<link rel="stylesheet" type="text/css" href="/css/all.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="keywords" content="<?php echo $keywords; ?>" />
<meta name="description" content="<?php echo $kewdesk; ?>" />
<title><?php echo $title; ?></title> 
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-39713687-1']);
_gaq.push(['_addOrganic', 'images.yandex.ru','q',true]);
_gaq.push(['_addOrganic', 'blogsearch.google.ru','q',true]);
_gaq.push(['_addOrganic', 'blogs.yandex.ru','text', true]);
_gaq.push(['_addOrganic', 'go.mail.ru','q']);
_gaq.push(['_addOrganic', 'nova.rambler.ru','query']);
_gaq.push(['_addOrganic', 'nigma.ru','s']);
_gaq.push(['_addOrganic', 'webalta.ru','q']);
_gaq.push(['_addOrganic', 'aport.ru','r']);
_gaq.push(['_addOrganic', 'poisk.ru','text']);
_gaq.push(['_addOrganic', 'km.ru','sq']);
_gaq.push(['_addOrganic', 'liveinternet.ru','ask']);
_gaq.push(['_addOrganic', 'quintura.ru','request']);
_gaq.push(['_addOrganic', 'search.qip.ru','query']);
_gaq.push(['_addOrganic', 'gde.ru','keywords']);
_gaq.push(['_addOrganic', 'gogo.ru','q']);
_gaq.push(['_addOrganic', 'ru.yahoo.com','p']);
_gaq.push(['_addOrganic', 'market.yandex.ru','text', true]);
_gaq.push(['_addOrganic', 'price.ru','pnam']);
_gaq.push(['_addOrganic', 'tyndex.ru','pnam']);
_gaq.push(['_addOrganic', 'torg.mail.ru','q']);
_gaq.push(['_addOrganic', 'tiu.ru','query']);
_gaq.push(['_addOrganic', 'tech2u.ru','text']);
_gaq.push(['_addOrganic', 'goods.marketgid.com','query']);
_gaq.push(['_addOrganic', 'poisk.ngs.ru','q']);
_gaq.push(['_addOrganic', 'akavita.by','z']);
_gaq.push(['_addOrganic', 'tut.by','query']);
_gaq.push(['_addOrganic', 'all.by','query']);
_gaq.push(['_addOrganic', 'meta.ua','q']);
_gaq.push(['_addOrganic', 'bigmir.net','q']);
_gaq.push(['_addOrganic', 'i.ua','q']);
_gaq.push(['_addOrganic', 'online.ua','q']);
_gaq.push(['_addOrganic', 'a.ua','s']);
_gaq.push(['_addOrganic', 'ukr.net','search_query']);
_gaq.push(['_addOrganic', 'search.com.ua','q']);
_gaq.push(['_addOrganic', 'search.ua','query']);
_gaq.push(['_addOrganic', 'search.ukr.net','search_query']);
_gaq.push(['_addOrganic', 'sm.aport.ru','r']);
_gaq.push(['_setSampleRate', '80']);
_gaq.push(['_setCampTermKey', 'term']);
  _gaq.push(['_trackPageview']);
setTimeout('if (window._gaq != undefined) _gaq.push([\'_trackEvent\', \'NoBounce\', \'Over 60 seconds\'])',60000);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</head>
<body>
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