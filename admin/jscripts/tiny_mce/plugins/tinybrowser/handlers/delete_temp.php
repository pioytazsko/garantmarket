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

$directory = '../tmp/';

$dir = opendir($directory);

while(($file = readdir($dir))){
	if (is_file("${directory}/${file}")) unlink("${directory}/${file}");
	else if (is_dir("${directory}/${file}") && ($file !== '.') && ($file !== '..')) remove_dir("${directory}/${file}");
}

closedir($dir);

?>