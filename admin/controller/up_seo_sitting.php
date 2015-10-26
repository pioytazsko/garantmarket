<?php include("../db.php");
$catalog_title = $_POST['catalog_title'];
$catalog_desc = $_POST['catalog_desc'];
$catalog_key = $_POST['catalog_key'];
$man_title = $_POST['man_title'];
$man_desc = $_POST['man_desc'];
$man_key = $_POST['man_key'];
$faq_title = $_POST['faq_title'];
$faq_desc = $_POST['faq_desc'];
$faq_key = $_POST['faq_key'];



$ednews=mysql_query("UPDATE seo SET catalog_title = '$catalog_title', catalog_desc = '$catalog_desc', catalog_key = '$catalog_key', man_title = '$man_title', man_desc = '$man_desc',
man_key = '$man_key', faq_title = '$faq_title', faq_desc = '$faq_desc', faq_key = '$faq_key' ", $db);
if($ednews=='true')
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=1");
}
else
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=2");
}
?>