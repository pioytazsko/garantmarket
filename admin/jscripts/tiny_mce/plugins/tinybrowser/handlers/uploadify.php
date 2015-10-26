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
header('Content-Type: text/html');

$file = $_POST['file'];
$pathType = $_POST['pathType'];
$path = $_POST['path'];

if (file_exists("../tmp/${file}.php")){
	require("../tmp/${file}.php");
	require('../include/core.fn.php');
	if (!file_exists("${config['filemanager_path']}manager/media/browser/mcpuk/languages/${config['lng']}.php")){
		$config['lng'] = $config['default_lng'];
		require("../languages/${config['lng']}.php");
	}else require("../languages/${config['lng']}.php");

	switch ($pathType){
		case "images" : $path = "${config['base_dir']}images/${path}"; break;
		case "flash" : $path = "${config['base_dir']}flash/${path}"; break;
		case "media" : $path = "${config['base_dir']}media/${path}"; break;
		case "files" : $path = "${config['base_dir']}files/${path}"; break;
	}
	
	if (file_exists("${path}user_config_manager.php")) require("${path}user_config_manager.php");
	else require('../user_config_manager.php');
	
	$tempFile = $_FILES['Filedata']['tmp_name'];	
	$filename = strtolower(trans($_FILES['Filedata']['name']));
	$format = format($filename);
	
	if(format($filename, 1)){
		$tmp_thumb = explode('.', $filename);
		$thumb = '';
		$cnt = count($tmp_thumb) - 1;
		for ($i = 0; $i < $cnt; $i++){ $thumb .= $tmp_thumb[$i]; }
		
		$tmp_thumb = $thumb;
		$i = 0;
		
		while (file_exists("${path}${thumb}.${format}")){ 
			$i++;
			$thumb = "${tmp_thumb}_copy${i}";
		}
		
		$filename = "${thumb}.${format}";
		$targetFile =  "${path}${filename}";
		
		if ($_FILES['Filedata']['size'] > $config['size']) die(ERROR_SAVE_FILE_3);
		if (!move_uploaded_file($tempFile, $targetFile)) die(ERROR_SAVE_FILE_2);
		if(format($filename, 1, '.jpg.jpeg.gif.png')){
			resize_img($path, $filename, $thumb, $config);
			die('1');
		}
		die('1');
	}else die(ERROR_SAVE_FILE_1);
	
}else die('PERMISSION DENIED');

?>