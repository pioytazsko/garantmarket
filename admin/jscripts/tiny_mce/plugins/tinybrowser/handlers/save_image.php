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

$manager_path = '../../../../';
require('../config.php');
require('../include/core.fn.php');

$image = $_GET['image'];
$type = strtolower($_GET['type']);
$state = $_GET['state'];
$filename = trans($_GET['title']);
$pathType = $_GET['pathType'];
$oldName = $_GET['oldName'];
$path = $_GET['path'];

switch ($pathType){
	case "images" : $path = "${config['base_dir']}images/${path}"; break;
	case "flash" : $path = "${config['base_dir']}flash/${path}"; break;
	case "media" : $path = "${config['base_dir']}media/${path}"; break;
	case "files" : $path = "${config['base_dir']}files/${path}"; break;
}

if (file_exists("${path}user_config_manager.php")) require("${path}user_config_manager.php");
else require('../user_config_manager.php');

if(format($type, 1)){
	$i = 0;
	$filename_tmp = $filename;

	if ($oldName != "${filename}.${type}")
		while (file_exists("${path}${filename}.${type}")){ 
			$i++;
			$filename = "${filename_tmp}_copy${i}";
		}
	
	$save_path = "${path}${filename}.${type}";
	if(copy($image, $save_path)){
		if (filesize($save_path) > $config['size']){
			$die = '
			<script type="text/javascript">
				with(window.top){
					popupMenu({title: lng.ERROR, main: \'<p class="center">\' + lng.SAVE_FILE_ERROR_3 + "</p>"});
				}
				if(parent){
					parent.pixlr.overlay.hide();
				}
			</script>
			 ';
			 die($die);
		}
		resize_img("${folder}${path}", "${filename}.${type}", $filename, $config);
		echo '
		<script type="text/javascript">
			with(window.top){
				getDir(realPath);
				setView();
			}
			if(parent) parent.pixlr.overlay.hide();
		</script>
		 ';
	}else{
		echo '
		<script type="text/javascript">
			with(window.top){
				popupMenu({title: lng.ERROR, main: \'<p class="center">\' + lng.SAVE_FILE_ERROR_2 + "</p>"});
			}
			if(parent){
				parent.pixlr.overlay.hide();
			}
		</script>
		';
	}
}else{
	echo '
		<script type="text/javascript">
			with(window.top){
				popupMenu({title: lng.ERROR, main: \'<p class="center">\' + lng.SAVE_FILE_ERROR_1 + "</p>"});
			}
			if(parent){
				parent.pixlr.overlay.hide();
			}
		</script>
	';
}

?>