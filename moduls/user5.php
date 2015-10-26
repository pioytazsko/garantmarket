<?php 
$userone5=mysql_query("SELECT * FROM moduls WHERE pos=5 and publick=1");
$useronerez5=mysql_fetch_array($userone5);
?>
<div class="podval_right">
			<div class="header_small"><?php echo "$useronerez5[name]"; ?></div>
			<div class="podval_text"><?php echo "$useronerez5[info]"; ?></div>
</div>	

