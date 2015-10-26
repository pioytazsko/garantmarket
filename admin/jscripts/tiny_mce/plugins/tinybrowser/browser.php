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

$manager_path = '../../../';
require('config.php');
require('user_config_manager.php');
function check_select($var, $val){
	return $var = $var === $val ? 'selected="selected"' : '';
}
$userid = $modx -> getLoginUserID();
$main_admin = explode('|', $config['main_admin']);
function checker($main_admin, $userid){
	foreach($main_admin as $val){
		if ($val === $userid || $val == '*') return 1;
	}
	return 0;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $config['charset']; ?>" />
	<title>
	<?php
		if (!file_exists("${config['filemanager_path']}manager/media/browser/mcpuk/languages/${config['lng']}.php")){
			$config['lng'] = $config['default_lng'];
			require("languages/${config['lng']}.php");
		}else require("languages/${config['lng']}.php");
		require('include/core.fn.php');
		$type = $_GET['type'];
		echo TITLE;
	?>
	</title>
	<script type="text/javascript">
		var type = "<?php echo $type; ?>";
		var language = "<?php echo $config['lng']; ?>";
		var tv = "<?php echo $_GET['tv']; ?>";
		tv = tv == "true" ? tv : null;
		var rewriteName = "<?php echo $config['rewriteName']; ?>";
		var rewriteWidth = "<?php echo $config['rewriteWidth']; ?>";
	</script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
	<script src="languages/<?php echo $config['lng']; ?>.js" type="text/javascript"></script>
	<script src="js/plugins/jquery.uploadify.js" type="text/javascript"></script>
	<script src="js/plugins/pixlr.js" type="text/javascript"></script>
	<script src="js/plugins/jquery.cookie.js" type="text/javascript"></script>
	<script src="js/plugins/swfobject.js" type="text/javascript"></script>
	<script src="js/plugins/tiny_mce_popup.js" type="text/javascript"></script>
	<script src="js/plugins/tinymce.modxfb.js" type="text/javascript"></script>
	<script src="js/core/core.fn.js" type="text/javascript"></script>
	<script src="js/core/core.tpl.js" type="text/javascript"></script>
	<script src="js/media.js" type="text/javascript"></script>
	<link href="styles/style.css" rel="stylesheet" type="text/css" />
	<link href="languages/<?php echo $config['lng']; ?>.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="MainBar">
		<div id="Search" class="path">
			<input name="Search" type="text" value="<?php echo SEARCH_VALUE; ?>" title="<?php echo SEARCH_TITLE; ?>" />
			<img src="images/search.png" width="13" height="13" alt="" />
		</div>
		<div id="Path" class="path">
			<div id="Refresh" class="path">
				<a href="javascript:;" rel="go->refresh" title="<?php echo REFRESH_TITLE; ?>"></a>
			</div>
			<div class="PathText">
				<img src="images/cat.png" width="13" height="16" alt="" />
				<span id="PathText"></span>
			</div>
		</div>
	</div>
	<div id="HeadBar">
		<ul>
			<li>
				<a href="javascript:;" id="Order" rel="set->order" title="<?php echo ORDER_TITLE; ?>"></a>
				<ul class="menu">
					<li><a href="javascript:;" rel="set->order->name"><?php echo ORDER_NAME; ?></a></li>
					<li><a href="javascript:;" rel="set->order->size"><?php echo ORDER_SIZE; ?></a></li>
					<li><a href="javascript:;" rel="set->order->format"><?php echo ORDER_FORMAT; ?></a></li>
				</ul>
			</li>
			<li>
				<a href="javascript:;" id="Views" rel="set->view" title="<?php echo VIEWS_TITLE; ?>"></a>
				<ul class="menu">
					<li><a href="javascript:;" rel="set->view->table"><?php echo VIEWS_TABLE; ?></a></li>
					<li><a href="javascript:;" rel="set->view->plate"><?php echo VIEWS_PLATE; ?></a></li>
					<li><a href="javascript:;" rel="set->view->list"><?php echo VIEWS_LIST; ?></a></li>
				</ul>
			</li>
			<li>
				<a href="javascript:;" id="Create" rel="set->create" title="<?php echo CREATE_TITLE; ?>"></a>
				<ul class="menu">
					<li><a href="javascript:;" rel="create->newImage"><?php echo CREATE_IMG; ?></a></li>
					<li><a href="javascript:;" rel="create->newFolder"><?php echo CREATE_FOLDER; ?></a></li>
					<li><a href="javascript:;" rel="create->jsonCollection"><?php echo CREATE_JSON_COLLECTION; ?></a></li>
				</ul>
			</li>
			<li>
				<a href="javascript:;" id="Upload" rel="upload" title="<?php echo DOWNLOAD_TITLE; ?>"></a>
			</li>
		</ul>
	</div>
	<div id="LeftBar">
		<?php echo checker($main_admin, $userid) ? '<div class="root"><a href="javascript:;" rel="show->pref" id="WindowType">'.MANAGER_PREF.'</a></div>' : '' ?>
		<div class="root"><?php echo ROOT_FOLDER; ?></div>
		<ul id="Root">
			<li><a href="javascript:;" rel="set->root->images"><?php echo IMAGES; ?></a></li>
			<li><a href="javascript:;" rel="set->root->media"><?php echo MEDIA; ?></a></li>
			<li><a href="javascript:;" rel="set->root->flash"><?php echo FLASH; ?></a></li>
			<li><a href="javascript:;" rel="set->root->files"><?php echo FILES; ?></a></li>
		</ul>
		<div class="root"><?php echo THIS_ROOT; ?></div>
		<div id="Cat"></div>
	</div>
	<div id="MainContent"></div>
	<div id="Pref">
		<table class="pref">
			<tr><th colspan="2"><?php echo MANAGER_IMG; ?></th></tr>
			<tr>
				<td><?php echo CREATE_THUMB; ?></td>
				<td>
					<select id="ResizeThumb">
						<option value="1" <?php echo check_select($config['resizeThumb'], 1); ?>><?php echo YEAS; ?></option>
						<option value="0" <?php echo check_select($config['resizeThumb'], 0); ?>><?php echo NO; ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td><?php echo WH_THUMB; ?></td>
				<td><input id="WidthThumb" type="text" value="<?php echo $config['widthThumb']; ?>" class="two" /> :: <input id="HeightThumb" type="text" value="<?php echo $config['heightThumb']; ?>" class="two" /></td>
			</tr>
			<tr>
				<td><?php echo RESIZE_IMG; ?></td>
				<td>
					<select id="ResizeImg">
						<option value="1" <?php echo check_select($config['resizeImg'], 1); ?>><?php echo YEAS; ?></option>
						<option value="0" <?php echo check_select($config['resizeImg'], 0); ?>><?php echo NO; ?></option>
					</select>
				</td>
			</tr>
				<tr>
				<td><?php echo WH_IMG; ?></td>
				<td><input id="WidthImg" type="text" value="<?php echo $config['widthImg']; ?>" class="two" /> :: <input id="HeightImg" type="text" value="<?php echo $config['heightImg']; ?>" class="two" /></td>
			</tr>
			<tr><th colspan="2"><?php echo MANAGER_OTHER; ?></th></tr>
			<tr>
				<td><?php echo REWRITE_NAME; ?></td>
				<td>
					<select id="RewriteName">
						<option value="1" <?php echo check_select($config['rewriteName'], 1); ?>><?php echo YEAS; ?></option>
						<option value="0" <?php echo check_select($config['rewriteName'], 0); ?>><?php echo NO; ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td><?php echo REWRITE_WIDTH; ?></td>
				<td><input id="RewriteWidth" type="text" value="<?php echo $config['rewriteWidth']; ?>" /></td>
			</tr>
			<tr>
				<td><?php echo SYSTEM_THUMB; ?></td>
				<td>
					<select id="SystemThumb">
						<option value="1" <?php echo check_select($config['systemThumb'], 1); ?>><?php echo YEAS; ?></option>
						<option value="0" <?php echo check_select($config['systemThumb'], 0); ?>><?php echo NO; ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2"><input type="button" id="SavePref" value="<?php echo SAVE_PREF; ?>" /></td>
			</tr>
		</table>
	</div>
</body>
</html>
