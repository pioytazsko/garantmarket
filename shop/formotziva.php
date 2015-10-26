<form action="shop/newotziv.php" method="post">
<div class="nameotziv">Представьтесь</div>
<div class="otzivform"><input name="name" type="text"></div>
<div class="nameotziv">e-mail</div>
<div class="otzivform"><input name="milo" type="text"></div>
<div class="nameotziv">Ваш отзыв</div>
<div class="otzivform"><textarea name="text" ></textarea></div>
<div class="nameotziv">2+2= ?</div>
<div class="otzivform"><input name="cod" type="text"></div>
<input name="iditem" type="hidden" value="<?php echo $id; ?>">
<input name="submit"class="send_query" type="submit"></form>

