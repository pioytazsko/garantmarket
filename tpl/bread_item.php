<?php require_once 'medoo.min.php';
 // Initialize
//$database = new medoo(array(
//	'database_type' => 'mysql',
//	'database_name' => 'garantmarket',
//	'server' => 'localhost',
//	'username' => 'root',
//	'password' => '',
//	'charset' => 'utf8'
//    ));
$database = new medoo(array(
	'database_type' => 'mysql',
	'database_name' => 'garantma_db',
	'server' => 'localhost',
	'username' => 'garantma_user',
	'password' => 'crKAyqBMMaEq',
	'charset' => 'utf8'
    ));

$id_parent=$database->select("catalog",array('category','name'),array(
	"id" => $id
));

// print_r($id_parent);   
$result=$database->select("catecory",'*',array(
	"id" => $id_parent[0]['category']
));
  
//print_r($result);
//// имея категорию ищем родителей этой категории, выводи ее

$ids[]=$result[0]['id'];

$parent[0]['parent']=$result[0]['parent'];
do
{
$parent=$database->select("catecory",'*',array(
	"id" => $parent[0]['parent']
));
 $ids[]=$parent[0]['id'];   

}while($parent[0]['parent']!=0);
//print_r($id);
$ids=array_reverse($ids);
//print_r($id);
echo"<span><a href='/cataloge.php' >Каталог</a></span> ";
foreach($ids as $val){
    if ($val!=''){
$result=$database->select("catecory",'*',array(
	"id" => $val));
        echo "/ <span><a href='/catalog/".$result[0]['chpu']."/' >".$result[0]['name']."</a></span> ";}
};

echo "/ <span>".$id_parent[0]['name']."</span> ";