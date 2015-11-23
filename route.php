<?php 
define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
require_once(__ROOT__.'/medoo.min.php');
require_once(__ROOT__.'/config.php');
$database = new medoo(array(
	       // required
            'database_type' => $config_db['database_type'],
            'database_name'=> $config_db['database_name'],
            'server_name' => $config_db['server_name'],
            'username' => $config_db['username'],
            'password' => $config_db['password'],
            'charset'=>$config_db['charset']
        ));

$indicesServer = array(
'QUERY_STRING'
) ;
//
//echo '<table cellpadding="10">' ;
//foreach ($indicesServer as $arg) {
//    if (isset($_SERVER[$arg])) {
//        echo '<tr><td>'.$arg.'</td><td>' . $_SERVER[$arg] . '</td></tr>' ;
//    }
//    else {
//        echo '<tr><td>'.$arg.'</td><td>-</td></tr>' ;
//    }
//}
//echo '</table>' ; 
$idman=$_GET['idman'];//производители
$id_cat=$_GET['id_cat'];//категории товаров
$idcat=$_GET['idcat'];//категории новости
$id=$_GET['id'];//товыры
$idn=$_GET['idn'];
 if($_SERVER['QUERY_STRING']===''){
     
     
// $title=$sitrez['title'];
//$keywords=$sitrez['keywords'];
//$kewdesk=substr(strip_tags($sitrez['desc']), 0, 400);
     $datas = $database->select("seo", array(
	"catalog_key",
	"catalog_desc","catalog_title"
),array(
	"id" => "1"
));
   $title=$datas[0]['catalog_title'] ; 
   $keywords=$datas[0]['catalog_key'] ; 
   $kewdesk=$datas[0]['catalog_desc'] ; 
     
 
 }elseif($id!=null){
 $datas = $database->select("catalog", array(
	"keywords",
	"description","title"
),array(
	"chpu" => $id
));
    $kewdesk=$datas[0]['description'];
    $keywords=$datas[0]['keywords'];
    $title=$datas[0]['title']; 
     
 }elseif($id_cat!=null){
 $datas = $database->select("catecory", array(
	"keywords",
	"description","title"
),array(
	"chpu" => $id_cat
));
     $kewdesk=$datas[0]['description'];
     $keywords=$datas[0]['keywords'];
     $title=$datas[0]['title'];
 
 }else{
 $title=$sitrez['title'];
$keywords=$sitrez['keywords'];
$kewdesk=substr(strip_tags($sitrez['desc']), 0, 400);
 }


