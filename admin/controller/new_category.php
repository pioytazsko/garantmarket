<?php include("../db.php");
//обробатываем изображение

$imgDir = $_SERVER['DOCUMENT_ROOT'].'/categoryimages/'; // каталог для хранения изображений
          
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

$img_menu = $_SERVER['DOCUMENT_ROOT'].'/categoryimages/'; // каталог для хранения изображений
            
			
			if ($_FILES['menu']['size']>0)
			{
			$data2 = $_FILES['menu'];
			$newname2 = $img_menu .rand(1, 10000).($data2['name']); 
			$menu_image=getExtension1($newname2);
            move_uploaded_file($_FILES['menu']['tmp_name'], $newname2);
			}


//Обробатываем тектовую информацию
$name=htmlspecialchars($_POST['name']);
$deskripshn=$_POST['deskripshn'];
$keywords=htmlspecialchars($_POST['keywords']);
$levl=$_POST['levl'];
$parent=$_POST['parent'];
$specification=$_POST['specification'];
if($image=='')
{
$image="no_image.png";
}

mysql_query ("INSERT INTO catecory (name, deskripshn, keywords, levl, parent, img,specification,menu_img) VALUES  ('$name', '$deskripshn', '$keywords', '$levl', '$parent', '$image','$specification','$menu_image') ");
$url="../catalog.php?idp=1&idcom=1";
header("Location: ".$url);
?>