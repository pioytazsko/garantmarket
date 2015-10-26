<?php 
include("db.php");

$iditem = $_GET['iditem'];
$coll=1;
if($id_user<1)
{
$id_user=$id_user2;
}
if($id_user>0)
{
$result=mysql_query("SELECT * FROM logzakaz WHERE iditem=$iditem and iduser=$id_user ");
$myrow=mysql_fetch_array($result);
if($myrow>0)
{
$coll=$myrow['coll']+1;
mysql_query("UPDATE logzakaz SET coll='$coll' WHERE iditem=$iditem and iduser=$id_user ", $db);
}
else
{
mysql_query ("INSERT INTO logzakaz (iditem, iduser, coll) VALUES  ('$iditem', '$id_user', '$coll') ");
}
}
$vozrat=end(explode('/', $_SERVER['HTTP_REFERER']));
if($id_user>0)
{
$url="&idcom=ad1";
if("$vozrat"=="index.php" or "$vozrat"=='')
{
$url="?idcom=ad1";
}
header("Location: ".$_SERVER['HTTP_REFERER'].$url);
}
else
{
$url="&idcom=ad2";
if("$vozrat"=="index.php" or "$vozrat"=='')
{
$url="?idcom=ad2";
}
header("Location: ".$_SERVER['HTTP_REFERER'].$url);
}
?>