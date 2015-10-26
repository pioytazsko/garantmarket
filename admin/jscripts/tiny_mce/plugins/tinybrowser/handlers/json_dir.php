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
header('Content-Type: application/json');

$manager_path = '../../../../';
require('../config.php');
require('../include/core.fn.php');

$type = $_POST['type'];
$dir = $_POST['dir'];

switch ($type){
	case "images" : $dir = "${config['base_dir']}images/${dir}"; break;
	case "flash" : $dir = "${config['base_dir']}flash/${dir}"; break;
	case "media" : $dir = "${config['base_dir']}media/${dir}"; break;
	case "files" : $dir = "${config['base_dir']}files/${dir}"; break;
}

if (file_exists("${dir}user_config.php")) require("${dir}user_config.php");
else require('../user_config.php');

if (file_exists("${dir}user_config_manager.php")) require("${dir}user_config_manager.php");
else require('../user_config_manager.php');

$dir_str = $dir;
$dir = opendir($dir);
chdir($dir_str);

$rand = rand(0, 100);

$tpl = '{"Dir": [';
	
while ($read = readdir($dir)){
	if (is_dir($read) == 1 && $read != '.' && $read != '..') $tpl .= '{"Name":"'.$read.'","Type":"Cat","Format":"1","Filesize":"0"},';
	else if (strpos($read, '.') !== 0){
		$name = explode('.', $read);
		$r_name = '';
		$cnt = count($name) - 1;
		for ($i = 0; $i < $cnt; $i++){ $r_name .= $name[$i]; }
		if (format($read, 1, '.jpeg.jpg.png.gif')){
			if (!file_exists("${dir_str}.thumb_${r_name}.".format($read))) resize_img($dir_str, $read, $r_name, $config);
			if (!file_exists("${dir_str}.thumb_user_${read}")) $thumb = 'None'; else $thumb = 'Exists';
			$tpl .= '{"Name":"'.$r_name.'","Type":"Img","Thumb":"'.$thumb.'","Format":"'.format($read).'","Filesize":"'.filesize($read).'"},';
		}
		else $tpl .= '{"Name":"'.$r_name.'","Type": "File","Format":"'.format($read).'","Filesize":"'.filesize($read).'"},';
	}
}

closedir($dir);

$tpl .= '], "SortType": "'.$config['sortType'].'", "View": "'.$config['view'].'", "ResizeThumb": "'.$config['resizeThumb'].'"}';
$tpl = preg_replace("/,]/", ']', $tpl);
echo $tpl;

?>