<?php include("../db.php");

$phone = trim(htmlspecialchars($_POST['phone']));
$milo = trim(htmlspecialchars($_POST['milo']));
$fio = trim(htmlspecialchars($_POST['fio']));
$primechanie = $_POST['primechanie'];
$info = $_POST['info'];
$pricerez = $_POST['pricerez'];
$iduser = $_POST['iduser'];
$date=date('Y-m-d H:i:s');



mysql_query("UPDATE user SET milo='$milo', phone='$phone', foi='$fio' WHERE id=$iduser ");


$info="Содержание заказа: $info на итоговую сумму $pricerez";

$ednews=mysql_query ("INSERT INTO zakaz (iduser, info, primechanie, date) VALUES  ('$iduser', '$info', '$primechanie', '$date') ");

//Отправляем сообщения о подтверждении.

$as=$_SERVER['HTTP_HOST'];
$message = "Ваш заказ принят. Мы свяжемся с вами в ближайшее время.";
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
$message = "Поступил новый заказ с тайта $as. Просмотреть информацию о заказе вы можете в личном кабинете. $info. Контактные данные: $phone  $milo $fio. Примечание к заказу:$primechanie ";
$email = "$from";
$subject = "Информация с сайта $as";
$headers  = "From: $as <$from>\r\n";
$headers .= "Reply-To: $from\r\n";
$headers .= "Return-Path: $from\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/plain; charset=UTF-8\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();
mail($email, $subject, $message, $headers);

mysql_query("DELETE FROM logzakaz WHERE iduser=$iduser", $db);

if($ednews=='true')
{
$url="../index.php?idcom=iz1";
header("Location: ".$url);
}
else
{
$url="../index.php?idcom=iz2";
header("Location: ".$url);
}
?>