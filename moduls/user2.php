<?php 
$userone2=mysql_query("SELECT * FROM moduls WHERE pos=2 and publick=1");
$useronerez2=mysql_fetch_array($userone2);
echo "$useronerez2[info]";
?>