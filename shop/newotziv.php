<?php include("../db.php");
define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
require_once(__ROOT__.'/medoo.min.php');
require_once(__ROOT__.'/config.php');
require(__ROOT__.'/send_email.php');

$database = new medoo(array(
	       // required
            'database_type' => $config_db['database_type'],
            'database_name'=> $config_db['database_name'],
            'server_name' => $config_db['server_name'],
            'username' => $config_db['username'],
            'password' => $config_db['password'],
            'charset'=>$config_db['charset']
        ));



//Обробатываем тектовую информацию
$name=htmlspecialchars($_POST['name']);
$milo=htmlspecialchars($_POST['milo']);
$text=htmlspecialchars($_POST['text']);
preg_match("|[a-zA-Z]+|U", $text, $out);
if(count($out)>0){
 header("Location: ".$_SERVER['HTTP_REFERER']);
}
$iditem=$_POST['iditem'];
$cod=$_POST['cod'];
$date=date("Y-m-d H:i:s");

if($cod==4)
{
$ednews=mysql_query ("INSERT INTO otzivi (name, text, milo, iditem, date) VALUES  ('$name', '$text', '$milo', '$iditem', '$date') ");
}


//отправка на почту 

$datas = $database->select("catalog",array(
	"name"), array("id"=>$iditem));

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";  
$subject="Отзыв на товар";
$message="Получен отзыв на товар :<b>".$datas[0]['name']."</b><br>Содержание:".$text."\r\n<br> Дата:".$date."\r\n <br>e-mail: ".$milo;
//$send_email=array("serg@10.by");    
    foreach ($send_email as $val){ 
if(mail ( $val,  $subject ,  $message,$headers )){echo 'ok';}else {echo error;}
    }





if($ednews=='true')
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=o1");
}
else
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=o2");
}















?>