<form action="shop/newspeedzakaz.php" method="post">
<?php 
if($id_user<1)
{
?>

<div class="nameotziv">Укажите номер телефона</div>
<div class="otzivform"><input name="phone" type="text"></div>
<div class="nameotziv">Укажите e-mail</div>
<div class="otzivform"><input name="milo" type="text" id="email"></div>
<div class="nameotziv">Примечание</div>
<div class="otzivform"><input name="primechanie" type="text" id="password"></div>
<input name="id" type="hidden" value="<?php echo "$id"; ?>">
<input name="submit" type="submit" value="Оформить" class="submit" disabled>
<?php 
}
else
{
$infous=mysql_query("SELECT * FROM user WHERE id=$id_user");
$infousrez=mysql_fetch_array($infous);
?>
<div class="nameotziv">Укажите номер телефона</div>
<div class="otzivform"><input name="phone" type="text" value="<?php echo "$infousrez[phone]"; ?>"></div>
<div class="nameotziv">Укажите e-mail</div>
<div class="otzivform"><input name="milo" type="text" value="<?php echo "$infousrez[milo]"; ?>"></div>
<div class="nameotziv">Примечание</div>
<div class="otzivform"><input name="primechanie" type="text"></div>
<input name="id" type="hidden" value="<?php echo "$id"; ?>">
<input name="submit" type="submit" value="Оформить">
<?php 
}
?>
</form>