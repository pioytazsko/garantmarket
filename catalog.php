<?php
require_once ("tpl/header.php");
require_once ("tpl/top.php");

if($_GET['id']!='')
{
    require_once ("tpl/item.php");
}
else {
    require_once ("tpl/center_catalog.php");

}
require_once ("tpl/bottom.php");
?>
