<div id='content'>
<div class='welcome'>Общие настройки сайта</div>
<?php 
$idp = $_GET['idp'];

if($idp==1)
{
include("page/all_sitting.php");
}

if($idp==2)
{
include("page/user.php");
}

if($idp==3)
{
include("page/edit_user.php");
}

if($idp==4)
{
include("page/menu.php");
}

if($idp==5)
{
include("page/edit_menu.php");
}

if($idp==6)
{
include("page/new_menu.php");
}

if($idp==7)
{
include("page/tipuser.php");
}

if($idp==8)
{
include("page/edit_tipuser.php");
}

if($idp==9)
{
include("page/new_user.php");
}

if($idp==10)
{
include("page/mail.php");
}

if($idp==11)
{
include("page/moduls.php");
}

if($idp==12)
{
include("page/edit_mod.php");
}

if($idp==13)
{
include("page/new_mod.php");
}
if($idp==66)
{
include("page/seo_sitting.php");
}
?>


		
</div>
	
	<script>
  $(function(){
	$(".welcome").animate({opacity:'show', right: '+=50'}, 700);
  });
</script>