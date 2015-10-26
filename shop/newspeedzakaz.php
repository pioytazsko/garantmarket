<?php include("../db.php");

$id=$_POST['id'];
$phone=htmlspecialchars($_POST['phone']);
$milo=htmlspecialchars($_POST['milo']);
$milo=trim($milo);
$phone=trim($phone);
$primechanie=htmlspecialchars($_POST['primechanie']);
$date=date('Y-m-d H:i:s');


$result=mysql_query("SELECT * FROM catalog WHERE id=$id");
$myrow=mysql_fetch_array($result);

$info=" Заказали товар с id - $myrow[id] Название: $myrow[name] - $myrow[price]";

$result2=mysql_query('SELECT * FROM user WHERE milo="'.$milo.'" or phone="'.$phone.'"');
$myrow2=mysql_fetch_array($result2);
if($myrow2<1)
{
//если пользователь впервые на сайте создаем его
mysql_query ("INSERT INTO user (milo, phone, datereg) VALUES  ('$milo', '$phone', '$date') ");
//получаем id нового пользователя
$result3=mysql_query("SELECT * FROM user ORDER BY id DESC");
$myrow3=mysql_fetch_array($result3);
$iduser=$myrow3['id'];
}
else
{
$iduser=$myrow2['id'];
}

$ednews=mysql_query ("INSERT INTO zakaz (iduser, info, date, primechanie) VALUES  ('$iduser', '$info', '$date', '$primechanie') ");

if($ednews=='true')
{
$url="../index.php?idcom=z1";
header("Location: ".$url);
}
else
{
$url="../index.php?idcom=z2";
header("Location: ".$url);
}

//Отправляем сообщения о подтверждении.

$as=$_SERVER['HTTP_HOST'];
$message = "Ваш заказ принят. Просмотреть информацию о заказе вы можете в личном кабинете.";
$email = "$milo";
$subject = "Информация с сайта $as";
$headers  = "From: $as <$from>\r\n";
$headers .= "Reply-To: $from\r\n";
$headers .= "Return-Path: $from\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/plain; charset=UTF-8\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();
mail($email, $subject, $message, $headers);

$as=$_SERVER['HTTP_HOST'];
$message = "Поступил новый заказ с тайта $as. Просмотреть информацию о заказе вы можете в личном кабинете. $info. Контактные данные: $phone  $milo . Примечание к заказу:$primechanie ";
$email = "$from";
$subject = "Информация с сайта $as";
$headers  = "From: $as <$from>\r\n";
$headers .= "Reply-To: $from\r\n";
$headers .= "Return-Path: $from\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/plain; charset=UTF-8\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();
mail($email, $subject, $message, $headers);



?>