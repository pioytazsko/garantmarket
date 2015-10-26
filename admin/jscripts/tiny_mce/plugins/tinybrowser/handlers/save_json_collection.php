<?php
/*********************************************************************************************
 * MODx PLUGIN: Basic Manager
 * VERSION:     1.0
 * DESCRIPTION: File Manager
 * WRITTEN BY:  Kobezzza (kobezzza@mail.ru)
 * DATE:        29/09/2010
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *********************************************************************************************/

header('Cache-Control: no-cache');
header('Pragma: no-cache');
header('Content-Type: text/plain');

$manager_path = '../../../../';
require('../config.php');
require('../include/core.fn.php');

$pathType = $_POST['pathType'];
$path = $_POST['path'];
$name = trans(trim($_POST['name']));

if (!$name) die(ERROR_CREATE_JSON_COLLECTION_1);

switch ($pathType){
	case "images" : $path = "${config['base_dir']}images/${path}"; break;
	case "flash" : $path = "${config['base_dir']}flash/${path}"; break;
	case "media" : $path = "${config['base_dir']}media/${path}"; break;
	case "files" : $path = "${config['base_dir']}files/${path}"; break;
}
$string = $_POST['string'];
$string = explode('{!}', $string);

$tpl = '{"Elements": [';
	
foreach($string as $val){
	$val = explode('|', $val);
	if ($val[1]) $tpl .= '{"Src":"'.$val[0].'","Thumb":"'.$val[1].'"},';
	else $tpl .= '{"Src":"'.$val[0].'"},';
}

$tpl .= ']}';
$tpl = preg_replace("/,]/", ']', $tpl);

while (file_exists("${path}${name}.json")) $name .= rand(0, 1000);

try{
	$f = fopen("${path}${name}.json", 'w+');
	fwrite($f, $tpl);
	echo '1';
} catch (Exception $e){ die(ERROR_CREATE_JSON_COLLECTION_2); }

?>