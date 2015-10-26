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
if (!file_exists("${config['filemanager_path']}manager/media/browser/mcpuk/languages/${config['lng']}.php")){
	$config['lng'] = $config['default_lng'];
	require("../languages/${config['lng']}.php");
}else require("../languages/${config['lng']}.php");

$actionType = $_POST['actionType'];
$pathType = $_POST['pathType'];
$path = $_POST['path'];

switch ($pathType){
	case "images" : $path = "${config['base_dir']}images/${path}"; break;
	case "flash" : $path = "${config['base_dir']}flash/${path}"; break;
	case "media" : $path = "${config['base_dir']}media/${path}"; break;
	case "files" : $path = "${config['base_dir']}files/${path}"; break;
}

$new = trim($_POST['new']);

switch ($actionType){
	case 'delete' : {
		$delType = $_POST['delType'];
		if ($delType == 'file'){
			$name = $_POST['name'];
			if (unlink($path.$name)){
				if (file_exists("${path}.thumb_${name}")) unlink("${path}.thumb_${name}");
				if (file_exists("${path}.thumb_user_${name}")) unlink("${path}.thumb_user_${name}");
				die('1');
			}else die(ERROR_DELETE_FILE);
		}else{
			if (remove_dir($path)) die('1');
			else die(ERROR_DELETE_CAT);
		}
	} break;
	case 'rename' : {
		if (!$new) $new = 0;
		else{
			$return = trans($_POST['new']);
			$new = $path.trans($_POST['new']);
			$new_thumb = $path.'.thumb_'.trans($_POST['new']);
			$new_thumb_user = $path.'.thumb_user_'.trans($_POST['new']);
		}
		$old = $path.$_POST['old'];
		$old_thumb = $path.'.thumb_'.$_POST['old'];
		$old_thumb_user = $path.'.thumb_user_'.$_POST['old'];
		
		if (!$new) die(ERROR_RENAME_1);
		else{
			if (is_file($old)){
				$ext = explode('.', $old);
				$new = $new.'.'.$ext[count($ext) - 1];
				$new_thumb = $new_thumb.'.'.$ext[count($ext) - 1];
				$new_thumb_user = $new_thumb_user.'.'.$ext[count($ext) - 1];
			}
			
			if (file_exists($new)) die(ERROR_RENAME_2);
			
			if(rename($old, $new)){
				if (file_exists($old_thumb)) rename($old_thumb, $new_thumb);
				if (file_exists($old_thumb_user)) rename($old_thumb_user, $new_thumb_user);
				die("1->${return}");
			}
			else die(ERROR_RENAME_3);
		}
	} break;
	case 'create' : {
		$name = trans(trim($_POST['name']));
		$path .= $name;
		if (!$name) die(ERROR_NEW_CAT_1);
		else if (file_exists($path)) die(ERROR_NEW_CAT_2);
		try{
			mkdir($path);
			chmod($path, 0755);
			echo '1';
		}catch (Exception $e){ die(ERROR_NEW_CAT_3); }
	}
}

?>