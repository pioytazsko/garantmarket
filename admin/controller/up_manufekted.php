<?php include("../db.php");
//обробатываем изображение
$id=$_POST['id'];
$result=mysql_query("SELECT * FROM manufekted WHERE id=$id ");
$myrow=mysql_fetch_array($result);

$imgDir = $_SERVER['DOCUMENT_ROOT'].'/manufected/'; // каталог для хранения изображений
           function getExtension1($newname) {
   			return end(explode("/", $newname));
			}
						
			if ($_FILES['image']['size']>0)
			{
			$data2 = $_FILES['image'];
			$newname2 = $imgDir .rand(1, 10000).($data2['name']); 
			$image=getExtension1($newname2);
            move_uploaded_file($_FILES['image']['tmp_name'], $newname2);
			}
			else
			{
			$image=$myrow['image'];
			}




//Обробатываем тектовую информацию
$name=htmlspecialchars($_POST['name']);
$deskripshn=$_POST['deskripshn'];
$keywords=htmlspecialchars($_POST['keywords']);
$kursman=htmlspecialchars($_POST['kursman']);
$chpu = $_POST['chpu'];

$ednews=mysql_query("UPDATE manufekted SET name='$name', kursman='$kursman', deskripshn='$deskripshn', keywords='$keywords', image='$image', chpu='$chpu' WHERE id=$id ", $db);
if($ednews=='true')
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=1");
}
else
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=2");
}
?>