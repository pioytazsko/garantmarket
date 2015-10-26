<div class="center">

<?php 
$man=mysql_query("SELECT * FROM manufekted WHERE publick=1");
$manrez=mysql_fetch_array($man);
do
{
$string = strip_tags($manrez['deskripshn']);
$desc = implode(array_slice(explode('<br>',wordwrap($string,500,'<br>',false)),0,1));
if($desc!=$string)
{
$desc=$desc." ...";
}
?>
<div class="blok_man"><a href="manufactors/<?php if($manrez['chpu']!='') echo $manrez['chpu']; else echo "manufactor"; ?><?php echo "/"."$manrez[id]"; ?>">
<div class="titleman"><?php echo "$manrez[name]"; ?></div>
<div class="imgman"><img src="manufected/<?php echo "$manrez[image]"; ?>" title="<?php echo "$manrez[name]"; ?>" alt="<?php echo "$manrez[name]"; ?>"/></div></a>
<div class="deskman"><?php echo "$desc"; ?></div>
<div style="clear:both"></div>
</div>
<?php 
}
while($manrez=mysql_fetch_array($man));
?>

</div>