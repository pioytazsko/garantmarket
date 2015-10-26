<?php
session_start();
$db=mysql_connect("localhost", "root", "");
mysql_select_db("garantmarket", $db);
mysql_query("SET CHARACTER SET 'utf8'");
if($_SESSION['user']<1)
{
exit("no dostup");
}
?>