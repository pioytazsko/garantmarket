<?php include("../db.php");
//обробатываем изображение
$imgDir = $_SERVER['DOCUMENT_ROOT'].'/manufected/'; // каталог для хранения изображений
           function getExtension1($newname) {
   			return end(explode("/", $newname));
			}
			if($_FILES['icon']['size']>0)
			{
			$data = $_FILES['icon'];
    		$newname = $imgDir .rand(1, 10000).($data['name']); 
			$icon=getExtension1($newname);
            move_uploaded_file($_FILES['icon']['tmp_name'], $newname);
			}
			if ($_FILES['image']['size']>0)
			{
			$data2 = $_FILES['image'];
			$newname2 = $imgDir .rand(1, 10000).($data2['name']); 
			$image=getExtension1($newname2);
            move_uploaded_file($_FILES['image']['tmp_name'], $newname2);
			}





//Обробатываем тектовую информацию
$name=htmlspecialchars($_POST['name']);
$deskripshn=$_POST['deskripshn'];
$keywords=htmlspecialchars($_POST['keywords']);

if($image=='')
{
$image="no_image.png";
}


mysql_query ("INSERT INTO manufekted (name, deskripshn, keywords, image) VALUES  ('$name', '$deskripshn', '$keywords', '$image') ");
$url="../catalog.php?idp=3&idcom=1";
header("Location: ".$url);
?>