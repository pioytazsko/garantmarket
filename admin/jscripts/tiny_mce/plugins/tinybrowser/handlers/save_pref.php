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

$sortType = $_POST['sortType'];
$view = $_POST['view'];

$f = fopen('../user_config.php', 'w+');
fwrite($f, '<?php $config[\'sortType\']=\''.$sortType.'\'; $config[\'view\']=\''.$view.'\'; ?>');

?>