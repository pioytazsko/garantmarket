<?php 
$userone4=mysql_query("SELECT * FROM moduls WHERE pos=4 and publick=1");
$useronerez4=mysql_fetch_array($userone4);
?>
<div class="podval_left">
			<div class="header_large"><?php echo "$useronerez4[name]"; ?></div>
			<div class="podval_text"><?php echo "$useronerez4[info]"; ?> </div>
		</div>
