<?php
$a = rand(1, 25);
$b = rand(1, 25);
$r = $a+$b;
?>
<form action="shop/newvopros.php" method="post">
<div class="nameotziv">e-mail или телефон</div>
<div class="otzivform"><input name="milo" type="text" id="email"><span></span></div>
<div class="nameotziv">Ваш вопрос</div>
<div class="otzivform"><textarea name="text" id="password"></textarea><span></span></div>
<div class="nameotziv"><?=$a?>+<?=$b?>= ?</div>
<div class="otzivform"><input name="cod" type="text"></div>
<input name="iditem" type="hidden" value="<?php echo $id; ?>">
<input name="capcha" type="hidden" value="<?php echo $r; ?>">
<input name="submit" type="submit" class="submit"></form>