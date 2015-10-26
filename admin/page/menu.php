<?php 
$idcom=$_GET['idcom'];
if($idcom==1)
{
echo "<div class='yescoment'>Выполнено успешно</div>";
}
if($idcom==2)
{
echo "<div class='nocoment'>Произошла ошибка</div>";
}
?>
<div class="plus"><a href="sitting.php?idp=6"><img src="images/add.png"></a></div>
<div class="pole_user">
			<div class="user">Пункты меню</div>
			<div class="head">
				<div class="head_punct1">Название</div>
				<div class="head_punct2">Тип</div>
				<div class="head_punct3">Действия</div>
			</div>
<?php 
$result=mysql_query("SELECT * FROM menu ORDER BY levl");
$myrow=mysql_fetch_array($result);
do
{
?>				
			<div class="kategory">
				<div class="kategory_punct1"><a href="sitting.php?idp=5&id=<?php echo "$myrow[id]"; ?>"><?php echo "$myrow[name]"; ?></a></div>
				<div class="kategory_punct2"><?php echo "$myrow[tip]"; ?></div>
				<div class="kategory_punct3">
					<a href="controller/up_publickmenu.php?id=<?php echo "$myrow[id]"; ?>"><div class="stock"><img src="images/<?php if($myrow['publick']==1) {echo "1.png";} else {echo "4.png";}?>"></div></a>
					<a href="controller/delit_menu.php?id=<?php echo "$myrow[id]"; ?>"><div class="stock"><img src="images/3.png"></div></a>
				</div>
			</div>
<?php 
}
while($myrow=mysql_fetch_array($result));
?>		
		</div>	