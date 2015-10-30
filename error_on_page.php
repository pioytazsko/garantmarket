
<?php
$comment=$_POST['comment'];
$text=$_POST['txt'];
$href=$_POST['href'];
$browser=$_POST['browser'];
$message ='Пользователь выявил на сайте garantmarket.by  следующую ошибку:'."\r\n".'"'.$comment.'-'.wordwrap($text, 70, "\r\n")."\r\n".'"на странице '.$href.".\r\n Пользователь использует: ".$browser;
$mail=array('stankograd2015@gmail.com');
foreach($mail as $value){
    if(mail($value, 'Ошибка: '.$comment, $message))
{
    echo 'ok'.$message;
} 
else 
{
    echo 'No send mail';
};
}
