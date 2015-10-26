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

$resizeThumb = sprintf("%d", trim($_POST['resizeThumb']));
$widthThumb = sprintf("%d", trim($_POST['widthThumb']));
$heightThumb = sprintf("%d", trim($_POST['heightThumb']));
$resizeImg = sprintf("%d", trim($_POST['resizeImg']));
$widthImg = sprintf("%d", trim($_POST['widthImg']));
$heightImg = sprintf("%d", trim($_POST['heightImg']));
$rewriteName = sprintf("%d", trim($_POST['rewriteName']));
$rewriteWidth = sprintf("%d", trim($_POST['rewriteWidth']));
$systemThumb = sprintf("%d", trim($_POST['systemThumb']));


if ($widthThumb == '0' || $heightThumb == '0'){
	$widthThumb = 200;
	$heightThumb = 200;
}

if ($widthImg == '0' || $heightImg == '0'){
	$widthImg = 600;
	$heightImg = 600;
}

$f = fopen('../user_config_manager.php', 'w+');
fwrite($f, '<?php $config[\'resizeThumb\']='.$resizeThumb.'; $config[\'widthThumb\']='.$widthThumb.'; $config[\'heightThumb\']='.$heightThumb.'; $config[\'resizeImg\']='.$resizeImg.'; $config[\'widthImg\']='.$widthImg.'; $config[\'heightImg\']='.$heightImg.'; $config[\'rewriteName\']='.$rewriteName.'; $config[\'rewriteWidth\']='.$rewriteWidth.'; $config[\'systemThumb\']='.$systemThumb.'; ?>');

?>