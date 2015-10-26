<?php 
include("db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html xmlns="http://www.w3.org/1999/xhtml">
 
	<head><link rel="stylesheet" type="text/css" href="css/css.css">
	<head><link rel="stylesheet" type="text/css" href="css/export.css">
    <title>Вход в административную панель</title>
	
    <script type="text/javascript" src="http://bitby.net/wp-demo/files/jquery.js"></script>
<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
 tinyMCE.init({
 relative_urls : false,
 convert_urls : false,
 // General options
 mode : "textareas",
 theme : "advanced",
 skin : "o2k7",
 plugins : "images,advimage,preview",

 theme_advanced_buttons1 : "bold,italic,underline,formatselect,|,undo,redo,|,link,|,"+
 "image,images,|,forecolor,|,code,|,preview,",
 theme_advanced_buttons2 : "justifyleft,justifycenter,justifyright,justifyfull,pasteword,pastetext,fontselect, fontsizeselect, strikethrough,bullist, numlist,",
 theme_advanced_toolbar_location : "top",
 theme_advanced_toolbar_align : "left",
 theme_advanced_statusbar_location : "bottom",
 theme_advanced_resizing : true,
 

 // Example word content CSS (should be your site CSS) this one removes paragraph margins
 content_css : "css/word.css",

 // Drop lists for link/image/media/template dialogs
 template_external_list_url : "lists/template_list.js",
 external_link_list_url : "lists/link_list.js",
 external_image_list_url : "lists/image_list.js",
 media_external_list_url : "lists/media_list.js",

 
 });
 </script>
	</head>
	<body>