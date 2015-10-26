<?php include("../db.php");

//Обробатываем тектовую информацию
$milo=htmlspecialchars($_POST['milo']);
$text=htmlspecialchars($_POST['text']);
preg_match("|[a-zA-Z]+|U", $text, $out);
if(count($out)>0){
 header("Location: ".$_SERVER['HTTP_REFERER']);
}
$iditem=$_POST['iditem'];
$cod=$_POST['cod'];


if($cod==4)
{
$result=mysql_query("SELECT * FROM catalog WHERE id=$iditem");
$myrow=mysql_fetch_array($result);

$info=" Товар с id - $myrow[id] Название: $myrow[name] - $myrow[price] Содержание вопроса:";
$info=$info.$text;
$info.=" Контактные данные: $milo";
$mess = $info;

$as=$_SERVER['HTTP_HOST'];
$title="Вопрос по товару -$as";
$message = "$mess";
$email = "$from";
$subject = "$title";
$headers  = "From: $as <$from>\r\n";
$headers .= "Reply-To: $from\r\n";
$headers .= "Return-Path: $from\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/plain; charset=UTF-8\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();
mail($email, $subject, $message, $headers);
}

if($myrow>0)
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=v1");
}
else
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=v2");
}
?>