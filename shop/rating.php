 <?php 
require_once('/medoo.min.php');
require_once('/config.php');

$database = new medoo(array(
	       // required
            'database_type' => $config_db['database_type'],
            'database_name'=> $config_db['database_name'],
            'server_name' => $config_db['server_name'],
            'username' => $config_db['username'],
            'password' => $config_db['password'],
            'charset'=>$config_db['charset']
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