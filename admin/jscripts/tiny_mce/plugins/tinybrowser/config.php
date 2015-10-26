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
 
require("${manager_path}includes/protect.inc.php");

// load configuration file
// initialize the variables prior to grabbing the config file
$database_type = '';
$database_server = '';
$database_user = '';
$database_password = '';
$dbase = '';
$table_prefix = '';
$base_url = '';
$base_path = '';
require("${manager_path}includes/config.inc.php");

/** 
 * Security check user MUST be logged into manager 
 * before being able to run this script
 */
startCMSSession(); 
if(!isset($_SESSION['mgrValidated']))
	if(!isset($_SESSION['webValidated'])) die('</title></head><body><strong>PERMISSION DENIED</strong><p>Please use the MODx Content Manager instead of accessing this file directly.</p></body></html>');
	
// connect to the database
if(!$modxDBConn = mysql_connect($database_server, $database_user, $database_password)) die('</title></head><body>Failed to create the database connection!</body></html>');
else{
	mysql_select_db($dbase);
    mysql_query("{$database_connection_method} {$database_connection_charset}");
}

// Override system settings with user settings
define('IN_MANAGER_MODE', 'true'); // set this so that user_settings will trust us.
require("${manager_path}includes/settings.inc.php");
require("${manager_path}includes/user_settings.inc.php");

if($settings['use_browser'] != 1) die('</title></head><body><strong>PERMISSION DENIED</strong><p>You do not have permission to access this file!</p></body></html>');

if(!isset($_SESSION['mgrValidated']))
	if($_SESSION['webValidated'] && $settings['rb_webuser'] != 1 ) die('</title></head><body><strong>PERMISSION DENIED</strong><p>You do not have permission to access this file!</p></body></html>');
	
$_api_path = '../../..';

require("${manager_path}includes/config.inc.php");
require("${manager_path}includes/document.parser.class.inc.php");

$modx = new DocumentParser();

$config['main_admin'] = 1;
$config['lng'] = $manager_language;
$config['default_lng'] = 'english';
$config['format'] = "${upload_files},${upload_images},${upload_media},${upload_flash}";
$config['size'] = $upload_maxsize;
$config['base_dir'] = $rb_base_dir;
$config['url'] = preg_replace("/manager.*/i", $rb_base_url, 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);
$config['filemanager_path'] = $filemanager_path;
$config['charset'] = $modx_charset;

?>