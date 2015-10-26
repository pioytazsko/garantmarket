<?php include("../db.php");
//обробатываем изображение
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
            $newwidth = 400; //в данную переменную мы помещаем желаемую ширину файла
            $newname = $imgDir .rand(10000000000, 99999999999).($data['name']); 
			function getExtension($newname) {
   			return end(explode("/", $newname));
			}
			$image=getExtension($newname);
					
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

if ($image=='')
{
$image="no_image.png";
}

//Обробатываем файл
$imgDir = $_SERVER['DOCUMENT_ROOT'].'/file/'; // каталог для хранения изображений
            function getExtension1($newname3) {
   			return end(explode("/", $newname3));
			}
			
			if ($_FILES['file']['size']>0)
			{
			$data2 = $_FILES['file'];
			$newname3 = $imgDir .rand(1, 10000).($data2['name']); 
			$file=getExtension1($newname3);
            move_uploaded_file($_FILES['file']['tmp_name'], $newname3);
			}



//Обробатываем тектовую информацию
$iditem=$_POST['iditem'];
$name=htmlspecialchars($_POST['name']);
$price=$_POST['price'];
$linkodzor=htmlspecialchars($_POST['linkodzor']);
$linkodzortitle	=htmlspecialchars($_POST['linkodzortitle']);
$linkotziv=htmlspecialchars($_POST['linkotziv']);
$linkotzivtitle=htmlspecialchars($_POST['linkotzivtitle']);
$manufekted=$_POST['manufekted'];
$category=$_POST['category'];
$deskripshn=$_POST['deskripshn'];
$keywords=htmlspecialchars($_POST['keywords']);
$spase=trim($_POST['spase']);
$vip=trim($_POST['vip']);
$levl=trim($_POST['levl']);
$filetitle=htmlspecialchars($_POST['filetitle']);
$unit=trim($_POST['unit']);

if($iditem!='')
{
$result=mysql_query("SELECT * FROM catalog WHERE iditem=$iditem");
$myrow=mysql_fetch_array($result);
if($myrow>0)
{
$url="../catalog.php?idp=5&idcom=3";
header("Location: ".$url);
}
else
{
$rez=mysql_query ("INSERT INTO catalog (iditem, name, price, linkodzor, linkodzortitle, linkotziv, linkotzivtitle, manufekted, category, deskripshn, keywords, spase, vip, levl, filetitle, unit, image,  	filename) VALUES  ('$iditem', '$name', '$price', '$linkodzor', '$linkodzortitle', '$linkotziv', '$linkotzivtitle', '$manufekted', '$category', '$deskripshn', '$keywords', '$spase', '$vip', '$levl', '$filetitle', '$unit', '$image', '$file') ");

$posi=mysql_query("SELECT * FROM catalog ORDER BY id DESC");
$posirez=mysql_fetch_array($posi);

//Обробатываем дополнительные параметры
$doppar=mysql_query("SELECT * FROM paramskat WHERE idcat=$category ORDER BY idpar");
$dopparrez=mysql_fetch_array($doppar);
$co=0;
if($dopparrez>0)
{
do
{
$dop="dop$co";
$dopval=$_POST[''.$dop.''];

$doppar2=mysql_query("SELECT * FROM paramsitem WHERE iditem=$posirez[id] and idparams=$dopparrez[idpar]");
$dopparrez2=mysql_fetch_array($doppar2);
if($dopparrez2>0)
{
mysql_query("UPDATE paramsitem SET val='$dopval' WHERE iditem=$posirez[id] and idparams=$dopparrez[idpar]");
}
else
{
mysql_query ("INSERT INTO paramsitem (iditem, idparams, val) VALUES  ('$posirez[id]', '$dopparrez[idpar]', '$dopval') ");
}
$co++;
}
while($dopparrez=mysql_fetch_array($doppar));
}

//Конц обработки дополнительных параметров

if($rez=='true')
{
$url="../catalog.php?idp=5&idcom=1";
header("Location: ".$url);
}
else
{
$url="../catalog.php?idp=5&idcom=2";
header("Location: ".$url);
}
}
}


?>