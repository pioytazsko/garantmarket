<?php include("../db.php");
$namesite=$_POST['namesite'];
$opisanie=$_POST['opisanie'];
$keywords=$_POST['keywords'];
$oneval=$_POST['oneval'];
$towval=$_POST['towval'];
$curs=$_POST['curs'];
$milo=$_POST['milo'];
$companiname=$_POST['companiname'];
$phone=$_POST['phone'];
$infoshet=$_POST['infoshet'];
$nds=$_POST['nds'];
$primechanie=$_POST['primechanie'];
$title = $_POST['title'];
$desc = $_POST['desc'];


$ednews=mysql_query("UPDATE sitting SET namesite='$namesite', opisanie='$opisanie', keywords='$keywords', oneval='$oneval', towval='$towval', curs='$curs', milo='$milo', companiname='$companiname', phone='$phone', infoshet='$infoshet', nds='$nds', primechanie='$primechanie', `title`='$title', `desc`='$desc'  WHERE `id`=1 ", $db);
if($ednews=='true')
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=1");
}
else
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=2");
}
?>