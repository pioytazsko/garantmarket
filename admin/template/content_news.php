	<div id='content'>
		<div class='welcome'>Управление новостями</div>
<?php 
$idp = $_GET['idp'];

if($idp==1)
{
include("page/news_category.php");
}

if($idp==2)
{
include("page/edit_news_category.php");
}

if($idp==3)
{
include("page/news.php");
}

if($idp==4)
{
include("page/edit_news.php");
}

if($idp==5)
{
include("page/new_news.php");
}

if($idp==6)
{
include("page/new_news_category.php");
}

?>
	</div>
	
	<script>
  $(function(){
	$(".welcome").animate({opacity:'show', right: '+=50'}, 700);
  });
</script>