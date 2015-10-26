<?php
$result44=mysql_query("SELECT * FROM catecory WHERE id=$myrow[parent]");
$myrow44=mysql_fetch_array($result44);
if($myrow44>0)
{
echo "<option value='$myrow44[id]'>$myrow44[name]</option>";
}

$result111=mysql_query("SELECT * FROM catecory WHERE parent=0 ORDER BY name");
$myrow111=mysql_fetch_array($result111);
echo "<option value='0'>Нет родителя</option>";
do
{
if($myrow111>0)
{
echo "<option value='$myrow111[id]'>$myrow111[name]</option>";
}
$result2=mysql_query("SELECT * FROM catecory WHERE parent=$myrow111[id] ORDER BY name");
$myrow2=mysql_fetch_array($result2);
do
{
if($myrow2>0)
{
echo "<option value='$myrow2[id]'>&nbsp;&nbsp;$myrow2[name]</option>";
$result3=mysql_query("SELECT * FROM catecory WHERE parent=$myrow2[id] ORDER BY name");
$myrow3=mysql_fetch_array($result3);
}
do
{
if($myrow3>0)
{
echo "<option value='$myrow3[id]' disabled='disabled'>&nbsp;&nbsp;&nbsp;&nbsp;$myrow3[name]</option>";
}
}
while($myrow3=mysql_fetch_array($result3));
}
while($myrow2=mysql_fetch_array($result2));
}
while($myrow111=mysql_fetch_array($result111))
?>