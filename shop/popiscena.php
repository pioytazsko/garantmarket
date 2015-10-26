<?php include("../db.php");
$milo = $_POST['milo'];
$iditem = $_POST['iditem'];
$ednews=mysql_query ("INSERT INTO voproscena (milo, iditem) VALUES  ('$milo', '$iditem') ");


if($ednews=='true')
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=pod1");
}
else
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=pod2");
}
?>