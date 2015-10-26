<?php
include ("../db.php");

$result2=mysql_query("SELECT * FROM sitting");
$myrow2=mysql_fetch_array($result2);
$from=$myrow2['milo'];

$title=$_POST['title'];
$mess=$_POST['mess'];
$tip=$_POST['tip'];
if($tip>0)
{
$result=mysql_query("SELECT * FROM user WHERE tip=$tip");
$myrow=mysql_fetch_array($result);
}
else
{
$result=mysql_query("SELECT * FROM user");
$myrow=mysql_fetch_array($result);
}

do
{
$to=$myrow['milo'];
if($to!='')
{
mail($to, $title, $mess, 'From:'.$from);
}
}
while($myrow=mysql_fetch_array($result));


header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=1");

?>