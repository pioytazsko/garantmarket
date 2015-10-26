<?php include("../db.php");
//обробатываем изображение
$id=$_POST['id'];
$result=mysql_query("SELECT * FROM catecory WHERE id=$id ");
$myrow=mysql_fetch_array($result);
$newim=$myrow['img'];
$new_men_im=$myrow['menu_img'];
if($_FILES['image']['size']!='')
{
if ($newim!="no_image.png")
{
unlink('../categoryimages/'.$newim);
}
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
}
else
{
$image=$myrow['img'];
}


if($_FILES['menu']['size']!='')
{
if ($new_men_im!="no_image.png")
{
//unlink('../categoryimages/'.$new_men_im);
}
$imgDir = $_SERVER['DOCUMENT_ROOT'].'/categoryimages/'; // каталог для хранения изображений
             function getExtension1($newname2) {
   			return end(explode("/", $newname2));
			}
			
			if ($_FILES['menu']['size']>0)
			{
			$data2 = $_FILES['menu'];
			$newname2 = $imgDir .rand(1, 10000).($data2['name']); 
			$new_men_im=getExtension1($newname2);
            move_uploaded_file($_FILES['menu']['tmp_name'], $newname2);
			}
}
else
{
$new_men_im=$myrow['img'];
}

//Обробатываем тектовую информацию
$name=htmlspecialchars($_POST['name']);
$deskripshn=$_POST['deskripshn'];
$keywords=htmlspecialchars($_POST['keywords']);
$levl=$_POST['levl'];
$parent=$_POST['parent'];
$chpu=$_POST['chpu'];
$title= $_POST['title'];
$h1 = $_POST['h1'];
$specification=$_POST['specification'];
$nameLink = $_POST['nameLink'];
$description = $_POST['description'];
$ednews=mysql_query("UPDATE catecory SET name='$name', deskripshn='$deskripshn', keywords='$keywords', levl='$levl', parent='$parent', img='$image',
 chpu='$chpu', title='$title', h1='$h1', nameLink='$nameLink', description='$description',specification='$specification',menu_img='$new_men_im' WHERE id=$id ", $db);
if($ednews=='true')
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=1");
}
else
{
header("Location: ".$_SERVER['HTTP_REFERER']."&idcom=2");
}
?>