<?php 
$userone=mysql_query("SELECT * FROM moduls WHERE pos=1 and publick=1");
$useronerez=mysql_fetch_array($userone);
echo "$useronerez[info]";
?>