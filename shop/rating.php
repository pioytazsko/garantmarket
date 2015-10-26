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
$result=$database->select("catalog",'rating',array(
	"id" => $id
));
//print_r($result);

 $rating='';
            for($i=$result[0];$i>0;$i--){
                $rating='<span class="rate_active"></span>'.$rating;};
            for($i=5-$result[0];$i>0;$i--){
                $rating=$rating.'<span class="rate_inactive"></span>';};
echo $rating;