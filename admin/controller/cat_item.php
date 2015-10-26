<?php 
$result46=mysql_query("SELECT * FROM catecory WHERE id=$myrow[category]");
$myrow46=mysql_fetch_array($result46);
if($myrow46>0)
{
echo "<option value='$myrow46[id]'>$myrow46[name]</option>";
}

$result45=mysql_query("SELECT * FROM catecory WHERE parent=0 ORDER BY name");
$myrow45=mysql_fetch_array($result45);
echo "<option value='0'>Нет родителя</option>";
do
{
if($myrow45>0)
{
echo "<option value='$myrow45[id]'>$myrow45[name]</option>";
}
$result22=mysql_query("SELECT * FROM catecory WHERE parent=$myrow45[id] ORDER BY name");
$myrow22=mysql_fetch_array($result22);
do
{
if($myrow22>0)
{
echo "<option value='$myrow22[id]'>&nbsp;&nbsp;$myrow22[name]</option>";
$result33=mysql_query("SELECT * FROM catecory WHERE parent=$myrow22[id] ORDER BY name");
$myrow33=mysql_fetch_array($result33);
}
do
{
if($myrow33>0)
{
echo "<option value='$myrow33[id]'>&nbsp;&nbsp;&nbsp;&nbsp;$myrow33[name]</option>";
}
}
while($myrow33=mysql_fetch_array($result33));
}
while($myrow22=mysql_fetch_array($result22));
}
while($myrow45=mysql_fetch_array($result45))
?>