<?php include("../db.php");
include('image_compress.php');
//обробатываем изображение
$id=$_POST['id'];

$item=mysql_query("SELECT * FROM catalog WHERE id=$id", $db);
$items=mysql_fetch_array($item);
$value=explode('/', $items['image']);
$newim=end($value);

$newfile=$items['filename'];
$image=$newim;
if($_FILES['image']['size']!='')
{
if ($newim!="no_image.png")
{
unlink('../../shopimage/'.$newim);
}

function resize($photo_src, $width, $name){
$parametr = getimagesize($photo_src);
list($width_orig, $height_orig) = getimagesize($photo_src);
$ratio_orig = $width_orig/$height_orig;
$new_width = $width;
$new_height = $width / $ratio_orig;
$newpic = imagecreatetruecolor($new_width, $new_height);
$col2=imagecolorallocate($newpic,255,255,255);
imagefilledrectangle($newpic,0,0,$new_width,$new_width,$col2);
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
            $newname = $imgDir .rand(10000000, 99999999).($data['name']); 
			function getExtension1($newname) {
                $value=explode("/", $newname);
                
   			return end($value);
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
}


if($image=='')
{
$image="no_image.png";
}
//Обробатываем файл

if($_FILES['file']['size']!='')
{
if ($newfile!='')
{
unlink('../file/'.$newim);
}
$imgDir = $_SERVER['DOCUMENT_ROOT'].'/file/'; // каталог для хранения изображений
            function getExtension1($newname2) {
                $value=explode("/", $newname2);
   			return end($value);
			}
			
			if ($_FILES['file']['size']>0)
			{
			$data10 = $_FILES['file'];
			$newname10 = $imgDir .rand(1, 10000).($data10['name']); 
			$newfile=getExtension1($newname10);
            move_uploaded_file($_FILES['file']['tmp_name'], $newname10);
			}
}
else
{
$newfile=$items['filename'];
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
$chpu=$_POST['chpu'];
$h1=$_POST['h1'];
$title=$_POST['title'];
$description=$_POST['description'];
$share = $_POST['share'];
$result22=mysql_query("SELECT * FROM catalog WHERE id=$id");
$myrow22=mysql_fetch_array($result22);
if($myrow22['price']!=$price)
{

$result33=mysql_query("SELECT * FROM voproscena WHERE iditem=$id");
$myrow33=mysql_fetch_array($result33);
do
{
$title="Изменение цены на товар";
$mess="Цена на товар $myrow22[name] изменилась. Новая цена - $price. Если вы больше не желаете получать данное сообщение перейдите по ссылке droppodpis.php?id=$myrow33[id]";
$mess = iconv('UTF-8', 'KOI8-R', $mess);
$to=$myrow33['milo'];
mail($to, $title, $mess, 'From:'.$from);
}
while($myrow33=mysql_fetch_array($result33));
}

if($myrow22['category']!=$category)
{
mysql_query("DELETE FROM paramsitem WHERE iditem=$id", $db);
}
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

$doppar2=mysql_query("SELECT * FROM paramsitem WHERE iditem=$id and idparams=$dopparrez[idpar]");
$dopparrez2=mysql_fetch_array($doppar2);
if($dopparrez2>0)
{
mysql_query("UPDATE paramsitem SET val='$dopval' WHERE iditem=$id and idparams=$dopparrez[idpar]");
}
else
{
mysql_query ("INSERT INTO paramsitem (iditem, idparams, val) VALUES  ('$id', '$dopparrez[idpar]', '$dopval') ");
}
$co++;
}
while($dopparrez=mysql_fetch_array($doppar));
}

//Конц обработки дополнительных параметров


if($iditem!='')
{
$result=mysql_query("SELECT * FROM catalog WHERE iditem=$iditem AND id!=$id");
$myrow=mysql_fetch_array($result);
if($myrow<1)
{$com=new Compressor($image);
$ednews=mysql_query("UPDATE catalog SET name='$name', price='$price', linkodzor='$linkodzor', linkodzortitle='$linkodzortitle', linkotziv='$linkotziv', 
linkotzivtitle='$linkotzivtitle', manufekted='$manufekted', category='$category',deskripshn ='$deskripshn', keywords='$keywords', image='$image', spase='$spase', 
vip='$vip', levl='$levl', filetitle='$filetitle', unit='$unit', iditem='$iditem', filename='$newfile', chpu='$chpu', h1='$h1', title='$title', description='$description',share=$share 
WHERE id=$id ", $db);
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=1");
}
else
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=2");
}
}



?>