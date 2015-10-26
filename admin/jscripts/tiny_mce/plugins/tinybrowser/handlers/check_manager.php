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
require('../user_config_manager.php');
require('../include/core.fn.php');

$textname = rand(0, 1000);

$f = fopen("../tmp/${textname}.php", 'w+');
fwrite($f, '<?php $config[\'lng\']=\''.$config['lng'].'\'; $config[\'lng\']=\''.$config['default_lng'].'\'; $config[\'format\']=\''.$config['format'].'\'; $config[\'size\']='.$config['size'].'; $config[\'base_dir\']=\''.$config['base_dir'].'\'; $config[\'filemanager_path\']=\''.$config['filemanager_path'].'\'; ?>');

echo $textname;

?>