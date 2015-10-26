<?php

// конфигурационные параметры

// разделитель категорий в таблице БД
define('CAT_DIV_CHAR', '+');
// каталоги для скачиваемых файлов
define('ICON_DIR', '../../shopimage/');
define('IMG_DIR', '../../shopimage/');
// параметры БД
define('DB_HOST', 'localhost');
define('DB_NAME', 'toolbyto_garant2');
define('DB_USER', 'toolbyto_garu'2);
define('DB_PASS', 'pentuh1984');
define('DB_IMPORT_TABLE', 'catalog');

setlocale(LC_ALL, "ru_RU.CP1251");

// Сохранить начало времени выполнения скрипта
$time_start = microtime(true);

session_start();
// инициализация входных параметров
if ( isset($_POST['ImportStartH']) )
{
  session_unset();
  $total_recs = 0;
  $file_cp = 0;
 // $import_file = $_POST['ImportFile'];
  $Cat = array(0 => '', 1 => '', 2 => '', 3 => '', 4 => '');
  $cat_depth = 0;
}
else
{
  $total_recs = isset($_SESSION['total_items']) ? $_SESSION['total_items'] : 0;
  $file_cp = isset($_SESSION['import_file_pos']) ? $_SESSION['import_file_pos'] : 0;
/*  if ( isset($_POST['ImportFile']) ) { $import_file = $_POST['ImportFile']; }
  elseif ( isset($_SESSION['import_file']) ) { $import_file = $_SESSION['import_file']; }
  else { die('Не выбран файл для импорта!'); }*/
  if ( isset($_SESSION['category']) ) { $Cat = unserialize($_SESSION['category']); }
  else { $Cat = array(0 => '', 1 => '', 2 => '', 3 => '', 4 => ''); }
  $cat_depth = isset($_SESSION['cat_depth']) ? $_SESSION['cat_depth'] : 0;
}


  $import_file = 'imp.xls';

//echo $import_file."<br/>\n";

// Escapes special characters in a string for use in a SQL statement.
// Prepends backslashes to the following characters: \x00, \n, \r, \, ', ", \x1a.
function escape_string($str)
{
  if ( get_magic_quotes_gpc() ) 
  { // magic_quotes_gpc is 'On' in php.ini
    if ( ini_get('magic_quotes_sybase') )
    { // magic_quotes_sybase is 'On' in php.ini
      $esc_str = str_replace("''", "'", $str);
    }
    else
    { // if magic_quotes_sybase is not 'On', just remove slashes
      $esc_str = stripslashes($str);
    }
  }
  else
  { // magic_quotes_gpc is 'Off'
    $esc_str = $str;
  }
  return mysql_real_escape_string($esc_str);
}

// Downloads a file by the specified URL link
function download_file($src_url)
{
  if ( strcasecmp($src_url, 'страница недоступна') == 0 ) { return ''; }
  if ( strpos($src_url, ' ') > 0 )
  {
    $url = str_replace(' ', '%20', $src_url);
  }
  else { $url = $src_url; }
  $dest_file = substr($url, strrpos($url, '/') + 1);
  $dest_file = str_replace('%20', '_', $dest_file);
  $dest_path = IMG_DIR . $dest_file;
  
  if ( ini_get('allow_url_fopen') == '0' ) { die('Скачивание файлов запрещено'); }
  
  if ( @copy($url, $dest_path) )
  {
    return $dest_path;
  }
  else
  {
    return '';
  }
}

function xml_data_processing($prc_data)
{
  global $Cat, $cat_depth, $cnt_recs;
  $xml = xml_parser_create();
  xml_parser_set_option($xml, XML_OPTION_CASE_FOLDING, 0);
  xml_parser_set_option($xml, XML_OPTION_SKIP_WHITE, 1);
  $values = array();
  $index = array();
  if ( xml_parse_into_struct($xml, iconv('WINDOWS-1251', 'UTF-8', $prc_data), $values, $index) !== 0 )
  { // process obtained array data
    $cnt = count($values);
    if ( $cnt == 5 )
	{ // 5 elements in obtained array - check if it's a category
	  if ( $values[1]['attributes']['ss:MergeAcross'] == 9 )
	  {
	    $p = stripos($values[1]['attributes']['ss:StyleID'], 'section_title_');
	    if ( $p !== FALSE )
		{
		  $n = substr($values[1]['attributes']['ss:StyleID'], $p+14);
		  if ( $n >= $cat_depth ) { $cat_depth = $n; }
		  else 
		  {
		    $Cat[$cat_depth] = '';
		    $cat_depth = $n;
		  }
		  $Cat[$n] = iconv('UTF-8', 'WINDOWS-1251', $values[2]['value']);
		}
	  }
    }
	if ( $cnt == 32 )
	{ // 32 elements in obtained array - it should be a data record (except it's a table header)
	  if ( $values[1]['attributes']['ss:StyleID'] != 'field_title' )
	  { 
	    // get data from the array - with conversion to a proper charset
	    $short_title = iconv('UTF-8', 'WINDOWS-1251', $values[2]['value']);
		$long_title  = isset($values[5]['value']) ? iconv('UTF-8', 'WINDOWS-1251', $values[5]['value']) : '';
		$short_desc  = isset($values[8]['value']) ? iconv('UTF-8', 'WINDOWS-1251', $values[8]['value']) : '';
		$long_desc   = isset($values[11]['value']) ? iconv('UTF-8', 'WINDOWS-1251', $values[11]['value']): '';
		$price       = iconv('UTF-8', 'WINDOWS-1251', $values[14]['value']);
		$icon_path   = iconv('UTF-8', 'WINDOWS-1251', $values[17]['value']);
		// download icon
		$icon_path   = download_file($icon_path);
		$img_path    = iconv('UTF-8', 'WINDOWS-1251', $values[20]['value']);
		// download image
		$img_path   = download_file($img_path);
		//$page_path   = iconv('UTF-8', 'WINDOWS-1251', $values[23]['value']);
		$item_code   = iconv('UTF-8', 'WINDOWS-1251', $values[26]['value']);
		$item_status = iconv('UTF-8', 'WINDOWS-1251', $values[29]['value']);
		// combine categories
		$category = '';
		for ( $i = 0; $i < count($Cat); $i++ ) 
		{ 
		  if ( $Cat[$i] != '' ) { $category .= $Cat[$i].CAT_DIV_CHAR; }
		}
		$category = ($category != '') ? substr($category, 0, strlen($category)-1) : '';
		// prepare MySQL statement
		$sql_cmd = 'INSERT INTO '.DB_IMPORT_TABLE.'(id, category, short_title, long_title, short_desc, long_desc, price, icon_path, img_path, page_path, item_code, item_status) '.
		           'VALUES (NULL, "'.escape_string($category).'", "'.escape_string($short_title).'", "'.escape_string($long_title).'", "'.
				           escape_string($short_desc).'", "'.escape_string($long_desc).'", '.$price.', "'.escape_string($icon_path).'", "'.
						   escape_string($img_path).'", "", "'.escape_string($item_code).'", "'.escape_string($item_status).'")';
	    $res_ins = mysql_query($sql_cmd);
		if ( $res_ins )
		{
		  $cnt_recs++; 
		}
		else
		{ 
		  echo 'Ошибка при добавлении записи в таблицу базы данных!';
          echo "<pre>\n";
		  echo "SQL-оператор:<br />\n";
          echo $sql_cmd;
          echo "</pre><hr/>\n";
		  exit;
		}
	  }
	}
  }
  else
  {
    echo '<div color="red">XML error: code - '.xml_get_error_code($xml).', msg - '.xml_error_string(xml_get_error_code($xml))."</div>\n";
    echo "<br />Дамп сбойных данных:<br /><pre>\n";
    echo var_dump($prc_data);
    echo "</pre>\n";
  }
  xml_parser_free($xml);
} // end of xml_data_processing


/***************************** Main code *****************************/

// Завершить скрипт, если нажата кнопка "Отмена"
if ( isset($_POST['ActionCancel']) )
{
  header('Location: import_end.html');
  exit;
}

// Подключиться к БД MySQL
$db_link = mysql_connect(DB_HOST, DB_USER, DB_PASS);
if ( !$db_link ) { die('Не удалось подключиться к базе данных MySQL'); }
mysql_select_db(DB_NAME);
mysql_query('SET CHARACTER SET cp1251');
// очистить таблицу импорта, если мы начинаем импорт нового файла
if ( isset($_POST['ImportStartH']) )
{
  mysql_query('TRUNCATE TABLE '.DB_IMPORT_TABLE);
}

$start = 0; $end = 0;
$buffer = '';
$cnt_recs = 0;
$time = 0;
$fp = fopen($import_file, 'r');
fseek($fp, $file_cp);
while ( $data = fgets($fp) )
{
  $data = trim($data);
  $buffer .= $data;
  do 
  {
    $start = strpos($buffer, '<Row');
    if ( $start === FALSE )
	{ 
	  $buffer = '';
	  $start = 0;
	  continue 2;
	}
    $end = strpos($buffer, '</Row>');
    if (!$end) 
	{ // прочитать еще одну строку из файла
	  continue 2;
	}
    $prc_buffer = substr($buffer, $start, $end+6);
	if ( strlen($prc_buffer) > 0)
	{
      xml_data_processing($prc_buffer);
      $time_end = microtime(true);
      $time = $time_end - $time_start;
      if ( $time > ini_get('max_execution_time') - 2 )
      { // остановить выполнение скрипта, т.к. достигнут лимит времени выполнения
		$buffer = substr($buffer, $end+6);
        break 2;
      }
	}
    $buffer = substr($buffer, $end+6);
  } while ($buffer !== '');
}

if ( $buffer !== '')
{ // если буфер не пуст, надо вернуть файловый указатель назад на длину буфера
  $new_cp = ftell($fp) - strlen($buffer);
  do {
    fseek($fp, $new_cp);
    $data = fread($fp, 4);
	$new_cp = $new_cp-1;
  } while ( $data !== '<Row');
  fseek($fp, $new_cp+1);
}

$total_recs += $cnt_recs;
// сохранить параметры для следующего запуска процедуры импорта
$_SESSION['import_file'] = $import_file;   // полное имя файла
$_SESSION['import_file_pos'] = ftell($fp); // текущая позиция в файле
$_SESSION['sess_items'] = $cnt_recs;       // количество импортированных позиций за сеанс
$_SESSION['total_items'] = $total_recs;    // общее количество импортированных позиций
$_SESSION['category'] = serialize($Cat);
$_SESSION['cat_depth'] = $cat_depth;
$_SESSION['exec_time'] = $time;            // время выполнения

if ( feof($fp) ) { $_SESSION['import_end'] = 1; }

fclose($fp);
mysql_close($db_link);

header('Location: import_next.php');

?>
