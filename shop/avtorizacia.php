<?php include("../db.php");

$milo=htmlspecialchars($_POST['milo']);
$milo=trim($_POST['milo']);
$phone=htmlspecialchars($_POST['phone']);
$phone=trim($_POST['phone']);
$date=date('Y-m-d H:i:s');

if($milo=='')
{
$result2=mysql_query('SELECT * FROM user WHERE phone="'.$phone.'"');
$myrow2=mysql_fetch_array($result2);
}
else
{
$result2=mysql_query('SELECT * FROM user WHERE milo="'.$milo.'" or phone="'.$phone.'"');
$myrow2=mysql_fetch_array($result2);
}



if($myrow2<1)
{
if($phone!='' or $milo!='')
{
//если пользователь впервые на сайте создаем его
mysql_query ("INSERT INTO user (milo, phone, datereg) VALUES  ('$milo', '$phone', '$date') ");
//получаем id нового пользователя
$result3=mysql_query("SELECT * FROM user ORDER BY id DESC");
$myrow3=mysql_fetch_array($result3);
$_SESSION['id_user'] = $myrow3['id'];
}
}
else
{
$_SESSION['id_user'] = $myrow2['id'];
}
$iduser=$_SESSION['id_user'];

mysql_query("UPDATE logzakaz SET iduser='$iduser' WHERE iduser=$id_user2 ", $db);

header("Location: ".$_SERVER['HTTP_REFERER']);

?>