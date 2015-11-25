<div id='content'>
		<div class='welcome'>Управление каталогом</div>
<?php 
$idp = $_GET['idp'];

if($idp==1)
{
include("page/category.php");
}

if($idp==2)
{
include("page/edit_category.php");
}

if($idp==3)
{
include("page/manufekted.php");
}

if($idp==4)
{
include("page/edit_manufekted.php");
}

if($idp==5)
{
include("page/items.php");
}

if($idp==6)
{
include("page/edit_items.php");
}

if($idp==7)
{
include("page/status_zakaza.php");
}

if($idp==8)
{
include("page/edit_status_zakaza.php");
}

if($idp==9)
{
include("page/zakazi.php");
}

if($idp==10)
{
include("page/page_zakazi.php");
}

if($idp==11)
{
include("page/new_category.php");
}

if($idp==12)
{
include("page/new_item.php");
}

if($idp==13)
{
include("page/new_manufekted.php");
}

if($idp==14)
{
include("page/new_status_zakaza.php");
}

if($idp==15)
{
include("page/add_image_item.php");
}

if($idp==16)
{
include("page/import.php");
}

if($idp==17)
{
include("page/otzivi.php");
}

if($idp==18)
{
include("page/item_otziv.php");
}

if($idp==19)
{
include("page/params.php");
}

if($idp==20)
{
include("page/edit_params.php");
}

if($idp==21)
{
include("page/new_params.php");
}

if($idp==22)
{
include("page/copy_item.php");
}

if($idp==23)
{
include("page/vopros.php");
}

if($idp==24)
{
include("page/editvopros.php");
}
if($idp==25)
{
include("page/import_items.php");
}
if($idp==26)
{
include("page/export_exel.php");
}
if($idp==27)
{
include("page/location.php");
}
?>
</div>
	
	<script>
  $(function(){
	$(".welcome").animate({opacity:'show', right: '+=50'}, 700);
  });
</script>