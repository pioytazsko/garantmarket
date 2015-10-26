<?php 
require_once('/medoo.min.php');
require_once('/config.php');
require_once('/Classes/PHPExcel.php');
// Подключаем класс для вывода данных в формате excel
require_once('/Classes/PHPExcel/Writer/Excel5.php');
echo "OK! I AM WORKED!!!";
$xls = new PHPExcel();
//установка шрифта 
$xls->getDefaultStyle()->getFont()->setName('Arial');
$xls->getDefaultStyle()->getFont()->setSize(8);
//подключение бд
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
//делаем новый лист
$xls->setActiveSheetIndex(0);
$sheet = $xls->getActiveSheet();
//на листе устанавливаем 
// Выравнивание текста

$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(70);
$sheet->getColumnDimension('C')->setWidth(40);
$sheet->getColumnDimension('D')->setWidth(10);
$sheet->getColumnDimension('E')->setWidth(10);
$datas = $database->select("catalog",array("[>]manufekted" => array("manufekted" => "id"),"[>]catecory" => array("category" => "id")),array(
	"catalog.id",
	"catalog.name(catalog_name)",
    "manufekted.name(manufekted_name)",
    "catalog.price",
    "catalog.category",
    "catecory.name(category_name)",
    "catalog.chpu(catal_chpu)",
    'catecory.chpu(categ_chpu)'
   
),array("ORDER" => "catalog.category"));
$j=2;
//выводим таблицу с вставкой категорий строками
$category=$database->select("catecory",array("name","parent","id"),array("ORDER" => "id"));
//print_r($category);

class Items {
public $levl;
public $items;
public $name_category;
public $adress;
public $id_category;
public $parent;
public $children;
public function __construct($item,$arr)   
{
    $this->name_category=$item['name'];
    $this->parent=$item['parent'];
    $this->id_category=$item['id'];
    foreach ($arr as $val)
    {
        if($val['category_name']==$this->name_category)
        {
        $this->items[]=$val;
        }
    }
    
}


}
$res=array();
foreach ($category as $val)
{
   $res[]= new Items($val,$datas);
// $categ=new Items($category[0],$datas);

};


// необходимо расставить левелы для объектов ...
class Arr_levl
{
public $levl0=array();
public $levl1=array();
public $levl2=array();
public $levl3=array();    
};

$levls=new Arr_levl();
//заполненние уровней для категорий 

foreach($res as &$val)
{
    if($val->parent==0)
    {
     $val->levl=0;
        $levls->levl0[]=$val->id_category;
    }
}


foreach($res as &$val)
{
    foreach($levls->levl0 as $value)
    {
        if($val->parent==$value)
        {
           $levls->levl1[]=$val->id_category;
            $val->levl=1;
        }
    }

}

foreach($res as &$val)
{
    foreach($levls->levl1 as $value)
    {
        if($val->parent==$value)
        {
           $levls->levl2[]=$val->id_category;
            $val->levl=2;
        }
    }

}
foreach($res as &$val)
{
    foreach($levls->levl2 as $value)
    {
        if($val->parent==$value)
        {
           $levls->levl3[]=$val->id_category;
            $val->levl=3;
        }
    }

}
//выводим значения в таблицу

//сортировка 
$sort=$res;
function sorting($arr,$abc,$parent,$parent_adress=null)
{$i=0; 
  foreach ($arr as &$val)
  {
    
  if ($parent===$val->parent)
    {
      
    $val->adress=$parent_adress.$abc[$i];$i++;
      sorting($arr,$abc,$val->id_category,$val->adress);
    }
  }
}

$abc=array('a','b','c','d','e','f','g','h','j','i','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
sorting($res,$abc,'0');
$result=array();
foreach ($res as $val)
{
$result[$val->adress]=$val;
}
ksort($result,SORT_STRING);

$res=$result;


$j=5;//перенос от начала документа по строкам


$sheet->setCellValue("A1", 'GARANTMARKET.BY');
$sheet->getStyle('A1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('A1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->getStyle('A1')->getFont()->setSize(18);
// Объединяем ячейки
$sheet->mergeCells('A1:E1');


foreach($res as $val)
{   ++$j;
  
    $sheet->mergeCells('A'.($j).':E'.($j));
    $sheet->getStyle('A'.($j))->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
    $sheet->getStyle('A'.($j))->getFill()->getStartColor()->setRGB('f2c9a6');
 $sheet->getStyle('A'.($j).':E'.($j))->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyle('A'.($j).':E'.($j))->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyle('A'.($j).':E'.($j))->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyle('A'.($j).':E'.($j))->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


    $sheet->getRowDimension($j)->setOutlineLevel($val->levl);   
    $sheet->setCellValueByColumnAndRow( 0 , $j,$val->name_category);
   
//   
    for($i=0;$i<count($val->items);++$i)
        {
        ++$j;
//        $sheet->getRowDimension($j)->setOutlineLevel($val->name_category);
        $sheet->setCellValueByColumnAndRow( 0 , $j,$val->items[$i]['id'] );
        $sheet->setCellValueByColumnAndRow( 1 , $j,$val->items[$i]['catalog_name']);
        $sheet->setCellValueByColumnAndRow( 2 , $j,$val->items[$i]['manufekted_name'] );
        $sheet->setCellValueByColumnAndRow( 3 ,$j,$val->items[$i]['price']);
        $sheet->setCellValueByColumnAndRow( 4 , $j, "Перейти");
        $sheet->getStyle('E'.($j))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
 $sheet->getStyle('E'.($j))->getFont()->getColor()->setRGB('081bf8');
 $sheet->getStyle('E'.($j))->getFont()->getColor()->setRGB('081bf8');
        $sheet->getRowDimension($j)->setOutlineLevel($val->levl+1);
// $sheet->getRowDimension($j)->setOutlineLevel(3);
//
$sheet->getCell('E'.($j))->getHyperlink()->setUrl( 'http://garantmarket.by/catalog/'.$val->items[$i]['categ_chpu'].'/'.$val->items[$i]['catal_chpu']);
    }
}
//echo $j;

//шапка таблицы 
$sheet->setCellValue("A5", 'ID');
$sheet->getStyle('A5')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('A5')->getFill()->getStartColor()->setRGB('f2b078');
$sheet->setCellValue("B5", 'Название товара');
$sheet->getStyle('B5')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('B5')->getFill()->getStartColor()->setRGB('f2b078');
$sheet->setCellValue("C5", 'Производитель');
$sheet->getStyle('C5')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('C5')->getFill()->getStartColor()->setRGB('f2b078');
$sheet->setCellValue("D5", 'Цена');
$sheet->getStyle('D5')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('D5')->getFill()->getStartColor()->setRGB('f2b078');

$sheet->setCellValue("E5", 'Ссылка');
$sheet->getStyle('E5')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('E5')->getFill()->getStartColor()->setRGB('f2b078');

//сохраняем в файл
$sheet->setAutoFilter('A5:E5');
$sheet->setShowSummaryBelow(false);
$objWriter = new PHPExcel_Writer_Excel5($xls);
$name='price-garant'.date('d.m.y').'.xls';
//$name='test.xls';
 $objWriter->save($name);

