<?php include("../db.php");
$milo=$_POST['milo'];
$phone=$_POST['phone'];
$foi=$_POST['foi'];
$info=$_POST['info'];
$tip=$_POST['tip'];
if($_POST['pass']!='')
{
$pass=md5($_POST['pass']);
}
else
{
$pass="";
}

$id=$_POST['id'];


$ednews=mysql_query("UPDATE user SET milo='$milo', phone='$phone', foi='$foi', info='$info', pass='$pass', tip='$tip' WHERE id=$id ", $db);

if($ednews=='true')
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=1");
}
else
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=2");
}

?>