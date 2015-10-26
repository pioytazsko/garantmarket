<div class="center">

<div class="titlezak">Название товара</div><div class="collitem">Колличество</div><div class="priceitem3">Всего</div>
<?php 
$result=mysql_query("SELECT * FROM logzakaz WHERE iduser=$id_user");
$myrow=mysql_fetch_array($result);
do
{
$result2=mysql_query("SELECT * FROM catalog WHERE id=$myrow[iditem]");
$myrow2=mysql_fetch_array($result2);
$price = $myrow2['price']*$myrow['coll'];
$pricerez=$price+$pricerez;
$info="$myrow2[name] колличество($myrow[coll]) - $price | ";
$rezinfo = $rezinfo.$info;
?>

<div class="titlezak2"><?php echo "$myrow2[name]"; ?></div><div class="collitem2"><?php echo "$myrow[coll]"; ?></div><div class="priceitem2"><?php echo "$price $val1"; ?></div>

<?php 
}
while($myrow=mysql_fetch_array($result))
?>
<div class="itogo"><strong>Итого:</strong><?php echo "$pricerez $val1"; ?></div>
<div class="formzakus">
<?php 
$infous=mysql_query("SELECT * FROM user WHERE id=$id_user");
$infousrez=mysql_fetch_array($infous);
?>
<form action="shop/newzakaz.php" method="post"><div class="nameotziv">Укажите номер телефона</div>
<div class="otzivform"><input name="phone" type="text" value="<?php echo "$infousrez[phone]"; ?>"></div>
<div class="nameotziv">Укажите e-mail</div>
<div class="otzivform"><input name="milo" type="text" value="<?php echo "$infousrez[milo]"; ?>"></div>
<div class="nameotziv">Представьтесь</div>
<div class="otzivform"><input name="fio" type="text" value="<?php echo "$infousrez[foi]"; ?>"></div>
<div class="nameotziv">Примечание</div>
<div class="otzivform"><textarea name="primechanie"></textarea></div>
<input name="info" type="hidden" value="<?php echo "$rezinfo"; ?>">
<input name="pricerez" type="hidden" value="<?php echo "$pricerez"; ?>">
<input name="iduser" type="hidden" value="<?php echo "$id_user"; ?>">
<input name="submit" type="submit" value="Оформить"></form>
</div>

</div>