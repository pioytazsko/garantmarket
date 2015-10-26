<?php require_once 'medoo.min.php';
require('/config.php');
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
$result=$database->select("catecory",'*',array(
	"chpu[~]" => $id_cat2
));
// имея категорию ищем родителей этой категории, выводи ее

$id[]=$result[0]['id'];

$parent[0]['parent']=$result[0]['parent'];
do
{
$parent=$database->select("catecory",'*',array(
	"id" => $parent[0]['parent']
));
 $id[]=$parent[0]['id'];   

}while($parent[0]['parent']!=0);
//print_r($id);
$id=array_reverse($id);
//print_r($id);
echo"<span><a href='/cataloge.php' >Каталог</a></span> ";
foreach($id as $val){
    if ($val!=''){
$result=$database->select("catecory",'*',array(
	"id" => $val));
        echo "/ <span><a href='/catalog/".$result[0]['chpu']."/' >".$result[0]['name']."</a></span> ";}
};