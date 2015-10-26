<?php 
$title="$sitrez[title]";
$keywords="$sitrez[keywords]";
$kewdesk=substr(strip_tags($sitrez['desc']), 0, 400);

$idman=$_GET['idman'];//производители
$id_cat=$_GET['id_cat'];//категории товаров
$idcat=$_GET['idcat'];//категории новости
$id=$_GET['id'];//товыры
$idn=$_GET['idn'];//новости

if($idman>0)
{
$metad=mysql_query("SELECT * FROM manufekted WHERE id=$idman");
$metadrez=mysql_fetch_array($metad);
if($metadrez==FALSE){
 $flag++;
}
$title="$metadrez[name]";
$keywords="$metadrez[keywords]";
$kewdesk=substr(strip_tags($metadrez['deskripshn']), 0, 400);
}

if($id_cat>0)
{
$metad=mysql_query("SELECT * FROM catecory WHERE id=$id_cat");
$metadrez=mysql_fetch_array($metad);
if($metadrez==FALSE){
 $flag++;
}
$title="$metadrez[title]";
$keywords="$metadrez[keywords]";
$kewdesk=substr(strip_tags($metadrez['description']), 0, 400);
}

if($idcat>0)
{
$metad=mysql_query("SELECT * FROM news_category WHERE id=$idcat");
$metadrez=mysql_fetch_array($metad);
if($metadrez==FALSE){
 $flag++;
}
$title="$metadrez[name]";
$keywords="$metadrez[keywords]";
$kewdesk=substr(strip_tags($metadrez['desc']), 0, 400);
}

if($id>0)
{
$metad=mysql_query("SELECT * FROM catalog WHERE id=$id");
$metadrez=mysql_fetch_array($metad);
if($metadrez==FALSE){
 $flag++;
}
$title="$metadrez[title]";
$keywords="$metadrez[keywords]";
$kewdesk=substr(strip_tags($metadrez['description']), 0, 400);
}

if($idn>0)
{
$metad=mysql_query("SELECT * FROM news WHERE id=$idn");
$metadrez=mysql_fetch_array($metad);
if($metadrez==FALSE){
 $flag++;
}
$title="$metadrez[name]";
$keywords="$metadrez[keywords]";
$kewdesk=substr(strip_tags($metadrez['desc']), 0, 400);
}

if($idman>0 and $idcat>0)
{
$metad=mysql_query("SELECT * FROM manufekted WHERE id=$idman");
$metadrez=mysql_fetch_array($metad);
if($metadrez==FALSE){
 $flag++;
}
$title="$metadrez[name]";
$keywords="$metadrez[keywords]";
$kewdesk=substr(strip_tags($metadrez['deskripshn']), 0, 400);
}
if($_SERVER['SCRIPT_NAME']=='/manufacturers.php'){
	$metad=mysql_query("SELECT `man_title`, `man_desc`, `man_key` FROM `seo` WHERE `id`=1");
	$metadrez=mysql_fetch_array($metad);
	if($metadrez==FALSE){
	 $flag++;
	}
	$title="$metadrez[man_title]";
	$keywords="$metadrez[man_key]";
	$kewdesk=substr(strip_tags($metadrez['man_desc']), 0, 400);
}
if($_SERVER['SCRIPT_NAME']=='/faq.php'){
	$metad=mysql_query("SELECT `faq_title`, `faq_desc`, `faq_key` FROM `seo` WHERE `id`=1");
	$metadrez=mysql_fetch_array($metad);
	if($metadrez==FALSE){
	 $flag++;
	}
	$title="$metadrez[faq_title]";
	$keywords="$metadrez[faq_key]";
	$kewdesk=substr(strip_tags($metadrez['faq_desc']), 0, 400);
}
if($_SERVER['SCRIPT_NAME']=='/catalog.php'){
	if($id!=''){
        
		$metad=mysql_query("SELECT `description`, `keywords`, `title`  FROM `catalog` WHERE `chpu`='".$id."'");
		$metadrez=mysql_fetch_array($metad);
		if($metadrez==FALSE){
		 $flag++;
		}
		$title="$metadrez[title]";
		$keywords="$metadrez[keywords]";
		$kewdesk=substr(strip_tags($metadrez['description']), 0, 400);
	}else{
		$metad=mysql_query("SELECT `catalog_title`, `catalog_desc`, `catalog_key` FROM `seo` WHERE `id`=1");
		$metadrez=mysql_fetch_array($metad);
		if($metadrez==FALSE){
		 $flag++;
		}
		$title="$metadrez[catalog_title]";
		$keywords="$metadrez[catalog_key]";
		$kewdesk=substr(strip_tags($metadrez['catalog_desc']), 0, 400);
	}
}


?>