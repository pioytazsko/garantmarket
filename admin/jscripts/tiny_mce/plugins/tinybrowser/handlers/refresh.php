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
if (!file_exists("${config['filemanager_path']}manager/media/browser/mcpuk/languages/${config['lng']}.php")){
	$config['lng'] = $config['default_lng'];
	require("../languages/${config['lng']}.php");
}else require("../languages/${config['lng']}.php");
require('../include/core.fn.php');
require('../user_config.php');

$type = $_POST['type'];
$dir = $_POST['dir'];

switch ($type){
	case "images" : $dir = "${config['base_dir']}images/${dir}"; break;
	case "flash" : $dir = "${config['base_dir']}flash/${dir}"; break;
	case "media" : $dir = "${config['base_dir']}media/${dir}"; break;
	case "files" : $dir = "${config['base_dir']}files/${dir}"; break;
}

if (file_exists("${path}user_config_manager.php")) require("${path}user_config_manager.php");
else require('../user_config_manager.php');

$dir_str = $dir;
$dir = opendir($dir);
chdir($dir_str);
	
while ($read = readdir($dir)){
	if (is_file($read) && strpos($read, '.') !== 0 && format($read, 1, '.jpg.jpeg.png.gif')){
			$tmp_thumb = explode('.', $read);
			$thumb = '';
			$cnt = count($tmp_thumb) - 1;
			for ($i = 0; $i < $cnt; $i++){ $thumb .= $tmp_thumb[$i]; }
			if (!resize_img($dir_str, $read, $thumb, $config)) die(ERROR_REFRESH);
	}
}

closedir($dir);
die('1');

?>