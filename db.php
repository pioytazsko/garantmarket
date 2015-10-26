<?php
session_start();
$db=mysql_connect("localhost", "root", "");
mysql_select_db("garantmarket", $db);
mysql_query("SET CHARACTER SET 'utf8'");
foreach($_GET as &$value) $value = trim(strip_tags(htmlspecialchars($value)));
foreach($_POST as &$value) $value = trim(strip_tags(htmlspecialchars($value)));
//Проверка на существование страниц
	$redic=0;
	
	if($_GET['id_cat']!='')//категория товаров
	{
		$id=$_GET['id_cat'];
		$err=mysql_query("SELECT count(id) AS er_rez FROM catecory WHERE chpu='$id'");
		$errrez=mysql_fetch_array($err);
		$redic=2;
	}
	
	if($_GET['id']!='')//товар
	{
		$id=$_GET['id'];
		$err=mysql_query("SELECT count(id) AS er_rez FROM catalog WHERE chpu='$id'");
		$errrez=mysql_fetch_array($err);
		$redic=1;
	}
	
	if($_GET['idn']!='')//новость
	{
		$id=$_GET['idn'];
		$err=mysql_query("SELECT count(id) AS er_rez FROM news WHERE id='$id'");
		$errrez=mysql_fetch_array($err);
		$redic=3;
	}
	
	if($_GET['idcat']!='')//категория новостей
	{
		$id=$_GET['idcat'];
		$err=mysql_query("SELECT count(id) AS er_rez FROM news_category WHERE id='$id'");
		$errrez=mysql_fetch_array($err);
		$redic=4;
	}
	
	if($_GET['idman']!='')//категория новостей
	{
		$id=$_GET['idman'];
		$err=mysql_query("SELECT count(id) AS er_rez FROM manufekted WHERE id='$id'");
		$errrez=mysql_fetch_array($err);
		$redic=5;
	}
	
	if($redic>0)
	{
			if($errrez['er_rez']<1)
			{
				header('Location: http://garantmarket.by/err404.html');
			}
	}		
//Проверка на существование страниц конец

$sit=mysql_query("SELECT * FROM sitting");
$sitrez=mysql_fetch_array($sit);
$curs=$sitrez['curs'];
$val1=$sitrez['oneval'];
$val2=$sitrez['towval'];
$from = $sitrez['milo'];
$namesite = $sitrez['namesite'];
$id_user = $_SESSION['id_user'];
$id_user2 = $_SESSION['id_user2'];
if($id_user2<1)
{
$id_user2 = rand(1000000, 9999999);
$_SESSION['id_user2']=$id_user2;
}
?>