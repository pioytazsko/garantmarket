<?php 
$userone3=mysql_query("SELECT * FROM moduls WHERE pos=3 and publick=1");
$useronerez3=mysql_fetch_array($userone3);
if($useronerez3>0)
{
do
{
?>
<div class="header_small"><?php echo "$useronerez3[name]"; ?></div>
<div class="left_text"><?php echo "$useronerez3[info]"; ?></div>
<?php 
}
while($useronerez3=mysql_fetch_array($userone3));
}
?>