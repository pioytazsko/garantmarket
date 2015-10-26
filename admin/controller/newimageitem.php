<?php
include("../db.php");

function resize($photo_src, $width, $name){
$parametr = getimagesize($photo_src);
list($width_orig, $height_orig) = getimagesize($photo_src);
$ratio_orig = $width_orig/$height_orig;
$new_width = $width;
$new_height = $width / $ratio_orig;
$newpic = imagecreatetruecolor($new_width, $new_height);
switch ( $parametr[2] ) {
 case 1: $image = imagecreatefromgif($photo_src);
 break;
 case 2: $image = imagecreatefromjpeg($photo_src);
 break;
 case 3: $image = imagecreatefrompng($photo_src);
 break;
}
imagecopyresampled($newpic, $image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
imagejpeg($newpic, $name, 100);
return true;
 }


$messages = array();
$imgDir = $_SERVER['DOCUMENT_ROOT'].'/shopimage/'; // каталог для хранения изображений
@mkdir($imgDir, 0777); // создаем каталог, если его еще нет
if (isset($_POST['submit'])) {
    $data = $_FILES['image'];
    $tmp = $data['tmp_name'];  //это просто для удобства
    if (@file_exists($tmp)) {  //итак, если файл на месте, то
        $info = @getimagesize($_FILES['image']['tmp_name']); //берем информацию о файле
        if (preg_match('{image/(.*)}is', $info['mime'], $p)) {  //убеждаемся что файл есть ни что иное как изображение
            $newwidth = 700; //в данную переменную мы помещаем желаемую ширину файла
            $newname = $imgDir .rand(10000000000, 99999999999).($data['name']); 
			function getExtension1($newname) {
   			return end(explode("/", $newname));
			}
			$image=getExtension1($newname);
					
			//имя файла оставляем прежним
            //осторожно! если файл с таким именем существует, то он будет перезаписан загружаемым
            if ($info[0] < $newwidth){ // если ширина загужаемого изображения
              //меньше заданной в переменной, просто сохраняем файл
              if (move_uploaded_file($_FILES['image']['tmp_name'], $newname)) {
              $messages[] = "Файл успешно загружен. ";
            }
            else {
              $messages[] = "Ошибка загрузки файла!";
            }
            }
            else {
              // а если больше, то ресайзим
              // функцию ресайза мы напишем дальше
              if(resize($tmp, $newwidth, $newname)){
                $messages[] = "Рисунок был успешно загружен и преобразован";
              }
              else {
                $messages[] = "Произошла ошибка при загрузке файла";
              }
            }
        }
        else {
            $messages[] = "Ошибка! Попытка загрузить файл недопустимого формата.";
        }
    }
    else {
        $messages[] = "Файл не был загружен.";
    }
}

$iditem=$_POST['iditem'];
mysql_query ("INSERT INTO galeriitem (iditem, image) VALUES  ('$iditem', '$image') ");
header("Location: ".$_SERVER['HTTP_REFERER']);
?>