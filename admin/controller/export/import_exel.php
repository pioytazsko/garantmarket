<?php 
print_r($_FILES['import']);
$filename="import/".$_FILES['importfile']['name'];
//print_r($_FILES['import']);
//echo $filename;
copy($_FILES['importfile']['tmp_name'],$filename);
require_once('/medoo.min.php');
require_once('/config.php');
require_once('Classes/PHPExcel.php');
// Подключаем класс для вывода данных в формате excel
require_once('Classes/PHPExcel/Writer/Excel5.php');
$database = new medoo(array(
	       // required
            'database_type' => $config['database_type'],
            'database_name'=> $config['database_name'],
            'server_name' => $config['server_name'],
            'username' => $config['username'],
            'password' => $config['password'],
            'charset'=>$config['charset'],
 
            // optional
            'port' => 3306,
            // driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
            'option' => array(
                PDO::ATTR_CASE => PDO::CASE_NATURAL
                )
        ));
require_once 'Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load($filename);
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    $worksheetTitle     = $worksheet->getTitle();
    $highestRow         = $worksheet->getHighestRow(); // e.g. 10
    $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $nrColumns = ord($highestColumn) - 64;
//    echo "<br>The worksheet ".$worksheetTitle." has ";
//    echo $nrColumns . ' columns (A-' . $highestColumn . ') ';
//    echo ' and ' . $highestRow . ' row.';
//    echo '<br>Data: <table border="1"><tr>';
    for ($row = 1; $row <= $highestRow; ++ $row) {
//        echo '<tr>';
//        for ($col = 0; $col < $highestColumnIndex; ++ $col) {
//            $cell = $worksheet->getCellByColumnAndRow($col, $row);
//            $val = $cell->getValue();
//            $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
//            echo '<td>' . $val . '<br>(Typ ' . $dataType . ')</td>';
//        }
//        echo '</tr>';
        
         // отправка данных в бд
      $id= $worksheet->getCellByColumnAndRow(0, $row)->getValue();
      $dataType = PHPExcel_Cell_DataType::dataTypeForValue($id);       
        if($dataType=='n'){
        $name=$worksheet->getCellByColumnAndRow(1, $row)->getValue();
        $manufected=$worksheet->getCellByColumnAndRow(2, $row)->getValue();
        $price=$worksheet->getCellByColumnAndRow(3, $row)->getValue();
        $title=$worksheet->getCellByColumnAndRow(4, $row)->getValue();
//            echo $dataType.$price;
                $database->update("catalog",array(
    	"name" => $name,     
    	// All age plus one
    	"price" => $price ,
    	"title" => $title 
    ),array(
    	"id" => $id
    ));
        }
//        $database
    };
};
header('Location:http://garantmarket.by/admin/catalog.php?idp=26');