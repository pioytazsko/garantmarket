<?php include("../db.php");
//обробатываем изображение

$id=$_POST['id'];
$result=mysql_query("SELECT * FROM params WHERE id=$id ");
$myrow=mysql_fetch_array($result);
$newim=$myrow['image'];

if($_FILES['image']['size']!='')
{
if ($newim!="no_image.png")
{
unlink('../icon/'.$newim);
}
$imgDir = $_SERVER['DOCUMENT_ROOT'].'/icon/'; // каталог для хранения изображений
            function getExtension1($newname2) {
   			return end(explode("/", $newname2));
			}
			
			if ($_FILES['image']['size']>0)
			{
			$data2 = $_FILES['image'];
			$newname2 = $imgDir .rand(1, 10000).($data2['name']); 
			$image=getExtension1($newname2);
            move_uploaded_file($_FILES['image']['tmp_name'], $newname2);
			}
}
else
{
$image=$myrow['image'];
}






//Обробатываем тектовую информацию
$name=htmlspecialchars($_POST['name']);
$idcat=$_POST['idcat'];


$ednews=mysql_query("UPDATE params SET name='$name', image='$image' WHERE id=$id ", $db);

if($idcat>0)
{
$ednews2=mysql_query("INSERT INTO paramskat (idcat, idpar) VALUES  ('$idcat', '$id') ");
}

if($ednews=='true')
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=1");
}
else
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=2");
}
?>