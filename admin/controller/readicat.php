<?php
include ("../db.php");
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Untitled Document</title>
</head>
<body>
<?php
function getExtension1($cat) {
    return end(explode("+", $cat));
}
$result=mysql_query("SELECT category, id FROM goods", $db);
$myrow=mysql_fetch_array($result);
do{
$d=getExtension1($myrow['category']);
$cat=mysql_query("SELECT * FROM catecory WHERE name='$d'", $db);
$myrow2=mysql_fetch_array($cat);
$v=$myrow2['id'];
$c=$myrow['id'];
$up=mysql_query("UPDATE goods SET category='$v' WHERE id=$c", $db);
}
while($myrow=mysql_fetch_array($result));
?>

</body>
</html>
