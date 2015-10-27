<?php $host='localhost';
$user='root';
$pasword='';
$database='garantmarket';
 $config_db=array(
      'database_type' => 'mysql',
    'database_name'=> 'garantmarket',
	'server_name' => 'localhost',
	'username' => 'root',
	'password' => '',
    'charset'=>'utf8');


// $config_db=array(
//      'database_type' => 'mysql',
//    'database_name'=> 'garantma_db',
//	'server_name' => 'localhost',
//	'username' => 'garantma_user',
//	'password' => 'crKAyqBMMaEq',
//    'charset'=>'utf8');



//example
//require('/medoo.min.php');
//require('/config.php');

//$database = new medoo(array(
//	       // required
//            'database_type' => $config['database_type'],
//            'database_name'=> $config['database_name'],
//            'server_name' => $config['server_name'],
//            'username' => $config['username'],
//            'password' => $config['password'],
//            'charset'=>$config['charset'],
// 
//            // optional
//            'port' => 3306,
//            // driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
//            'option' => array(
//                PDO::ATTR_CASE => PDO::CASE_NATURAL
//                )
//        ));
