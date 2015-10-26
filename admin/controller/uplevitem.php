<?php
include("../db.php"); 
header("Location: ".$_SERVER['HTTP_REFERER']);

$up=$_GET['up'];
$dw=$_GET['dw'];
$price=$_POST['price'];
$name=$_POST['name'];

if($up>0)
{
$id=$up;
}
else
{
if($dw>0)
{
$id=$dw;
}
}


$result=mysql_query("SELECT * FROM catalog WHERE id=$id");
$myrow=mysql_fetch_array($result);
$i=0;

if($up>0)
{
if($myrow['levl']!=0)
{
$i=$myrow['levl']-1;
$edlevl=mysql_query("UPDATE catalog SET levl='$i' WHERE id=$id", $db);
}
}

if($dw>0)
{
$i=$myrow['levl']+1;
$edlevl=mysql_query("UPDATE catalog SET levl='$i' WHERE id=$id", $db);
}

$levl=$_POST['levl'];
$id=$_POST['id'];
if($_POST['id']>0)
{
$edlevl=mysql_query("UPDATE catalog SET levl='$levl' WHERE id=$id", $db);
}

$edlevl=mysql_query("UPDATE catalog SET name='$name', price='$price' WHERE id=$id", $db);

?>