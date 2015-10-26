<?php
session_start();
foreach($_GET as &$value) $value = (int)$value;
foreach($_POST as &$value) $value = trim(strip_tags(htmlspecialchars($value)));
$url="index.php";
header("Location: ".$url);
$db=mysql_connect("localhost", "root", "");
mysql_select_db("garantmarket", $db);

$login=trim($_POST['login']);
$pass=trim(md5($_POST['pass']));
echo "$login $pass <br>";
$result=mysql_query('SELECT * FROM user WHERE foi="'.$login.'" and pass="'.$pass.'" ');
$myrow=mysql_fetch_array($result);

if($myrow['tip']==1)
{
$_SESSION['user'] = $myrow['id'];
}

?>