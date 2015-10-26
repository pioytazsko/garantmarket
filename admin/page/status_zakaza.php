<div class="plus"><a href="catalog.php?idp=14"><img src="images/add.png"></a></div>
<?php 
$idcom=$_GET['idcom'];
if($idcom==1)
{
echo "<div class='yescoment'>Выполнено успешно</div>";
}
if($idcom==2)
{
echo "<div class='nocoment'>Произошла ошибка. Невозможно удалить статус, так как он используется</div>";
}
?>
		<div class="pole_user">
			<div class="user">Статусы заказов</div>
			<div class="head">
				<div class="header_punct1">Название</div>
				<div class="header_punct3">Действия</div>
			</div>
<?php 
$result=mysql_query("SELECT * FROM statuszakaza");
$myrow=mysql_fetch_array($result);
do
{
?>			
			<div class="kategory">
				<div class="manufacturer_punct1"><a href="catalog.php?idp=8&id=<?php echo "$myrow[id]"; ?>"><?php echo "$myrow[name]";?></a></div>
				<div class="manufacturer_punct3">
					<a href="controller/up_publicksz.php?id=<?php echo "$myrow[id]"; ?>"><div class="stock"><img src="images/<?php if($myrow['publick']==1) {echo "1.png";} else {echo "4.png";}?>"></div></a>
					<a href="controller/delit_statuszakaza.php?id=<?php echo "$myrow[id]"; ?>"><div class="stock"><img src="images/3.png"></div></a>
				</div>
			</div>
<?php 
}
while($myrow=mysql_fetch_array($result));

?>			
			</div>