<?php include("../db.php");
$name = trim(htmlspecialchars($_POST['name']));
$vopros = trim(htmlspecialchars($_POST['vopros']));
preg_match("|[a-zA-Z]+|U", $vopros, $out);
if(count($out)>0){
 header("Location: ".$_SERVER['HTTP_REFERER']);
}
$date=date('Y-m-d');
$ednews=mysql_query ("INSERT INTO vopros (name, vopros, date) VALUES  ('$name', '$vopros', '$date') ");

$title2 = "new vopros";
$mess2="new vopros garant";
$mess2 = iconv('UTF-8', 'KOI8-R', $mess2);
mail($from, $title2, $mess2, 'From:'.$from);

if($ednews=='true')
{
$url="../index.php?idcom=if1";
header("Location: ".$url);
}
else
{
$url="../index.php?idcom=if2";
header("Location: ".$url);
}
?>