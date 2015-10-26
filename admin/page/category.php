<div class="plus"><a href="catalog.php?idp=11"><img src="images/add.png"></a></div>
<?php 
$idcom=$_GET['idcom'];
if($idcom==1)
{
echo "<div class='yescoment'>Выполнено успешно</div>";
}
if($idcom==2)
{
echo "<div class='nocoment'>Невозможно удалить категорию. Категория содржит вложенные категории или привязана к товарам</div>";
}
?>
		<div class="pole_user">
			<div class="user">Список категорий</div>
			<div class="head">
				<div class="head_punct1">Название</div>
				<div class="head_punct2">Уровень</div>
				<div class="head_punct3">Действия</div>
			</div>

<?php 
$per_page=10;
if (isset($_GET['page'])) {$page=($_GET['page']-1);} else {$page=0;};
$start=abs($page*$per_page);

$result=mysql_query("SELECT * FROM catecory WHERE parent=0 ORDER BY levl LIMIT $start, $per_page");
$myrow=mysql_fetch_array($result);
if($myrow>0)
{
do
{
?>
<!--Первый уровень-->
			<div class="kategory">
				<div class="kategory_punct1"><a href="catalog.php?idp=2&idc=<?php echo "$myrow[id]"; ?>"><?php echo "$myrow[name]"; ?></a></div>
				<div class="kategory_punct2">
					<a href="controller/uplevlcat.php?up=<?php echo "$myrow[id]"; ?>"><div class="up"><img src="images/5.png"></div></a>
					<div class="valuation"><form action="controller/uplevlcat.php" method="post"><input name="levl" type="text" value="<?php echo "$myrow[levl]"; ?>"></div>
					<a href="controller/uplevlcat.php?dw=<?php echo "$myrow[id]"; ?>"><div class="down"><img src="images/6.png"</div></div></a>
					<div class="save"><input name="id" type="hidden" value="<?php echo "$myrow[id]"; ?>"><input name="submit" type="submit" id="save" value=" "></form></div>
				</div>
				<div class="kategory_punct3">
					<a href="controller/up_publickcat.php?id=<?php echo "$myrow[id]"; ?>"><div class="stock"><img src="images/<?php if($myrow['publick']==1) {echo "1.png";} else {echo "4.png";}?>"></div></a>
					<a href="controller/delit_category.php?id=<?php echo "$myrow[id]"; ?>"><div class="stock"><img src="images/3.png"></div></a>
				</div>
			</div>



<?php 
$result2=mysql_query("SELECT * FROM catecory WHERE parent=$myrow[id] ORDER BY levl");
$myrow2=mysql_fetch_array($result2);
if($myrow2>0)
{
do
{
?>
<!--Второй уровень-->
			<div class="kategory">
				<div class="kategory_punct1"><a href="catalog.php?idp=2&idc=<?php echo "$myrow2[id]"; ?>">--|<?php echo "$myrow2[name]"; ?></a></div>
				<div class="kategory_punct2">
					<a href="controller/uplevlcat.php?up=<?php echo "$myrow2[id]"; ?>"><div class="up"><img src="images/5.png"></div></a>
					<div class="valuation"><form action="controller/uplevlcat.php" method="post"><input name="levl" type="text" value="<?php echo "$myrow2[levl]"; ?>"></div>
					<a href="controller/uplevlcat.php?dw=<?php echo "$myrow2[id]"; ?>"><div class="down"><img src="images/6.png"</div></div></a>
					<div class="save"><input name="id" type="hidden" value="<?php echo "$myrow2[id]"; ?>"><input name="submit" type="submit" id="save" value=" "></form></div>
				</div>
				<div class="kategory_punct3">
					<a href="controller/up_publickcat.php?id=<?php echo "$myrow2[id]"; ?>"><div class="stock"><img src="images/<?php if($myrow2['publick']==1) {echo "1.png";} else {echo "4.png";}?>"></div></a>
					<a href="controller/delit_category.php?id=<?php echo "$myrow2[id]"; ?>"><div class="stock"><img src="images/3.png"></div></a>
				</div>
			</div>



<?php 
$result3=mysql_query("SELECT * FROM catecory WHERE parent=$myrow2[id] ORDER BY levl ");
$myrow3=mysql_fetch_array($result3);
if($myrow3>0)
{
do
{
?>
<!--Третий уровень-->
<div class="kategory">
				<div class="kategory_punct1"><a href="catalog.php?idp=2&idc=<?php echo "$myrow3[id]"; ?>">--|--|<?php echo "$myrow3[name]"; ?></a></div>
				<div class="kategory_punct2">
					<a href="controller/uplevlcat.php?up=<?php echo "$myrow3[id]"; ?>"><div class="up"><img src="images/5.png"></div></a>
					<div class="valuation"><form action="controller/uplevlcat.php" method="post"><input name="levl" type="text" value="<?php echo "$myrow3[levl]"; ?>"></div>
					<a href="controller/uplevlcat.php?dw=<?php echo "$myrow3[id]"; ?>"><div class="down"><img src="images/6.png"</div></div></a>
					<div class="save"><input name="id" type="hidden" value="<?php echo "$myrow3[id]"; ?>"><input name="submit" type="submit" id="save" value=" "></form></div>
				</div>
				<div class="kategory_punct3">
					<a href="controller/up_publickcat.php?id=<?php echo "$myrow3[id]"; ?>"><div class="stock"><img src="images/<?php if($myrow3['publick']==1) {echo "1.png";} else {echo "4.png";}?>"></div></a>
					<a href="controller/delit_category.php?id=<?php echo "$myrow3[id]"; ?>"><div class="stock"><img src="images/3.png"></div></a>
				</div>
			</div>
	


<?php 
}
while($myrow3=mysql_fetch_array($result3));
}
}
while($myrow2=mysql_fetch_array($result2));
}
}
while($myrow=mysql_fetch_array($result));
}
else
{
echo "Нет категорий";
}
?>

<div class="button">
<?php 
//сами ссылки
$q="SELECT count(*) FROM catecory WHERE parent=0";



$res=mysql_query($q);
$row=mysql_fetch_row($res);
$total_rows=$row[0];
$num_pages=ceil($total_rows/$per_page);
$page=$_GET['page'];
if($page<1)
{
$page=1;
}
$page2=$page+6;
$page3=$page-6;
if($page3<1)
{
$page3=1;
}

if($page2>$num_pages)
{
$page2=$num_pages;
}

for($i=$page3;$i<$page;$i++) {
  if ($i == $page) {
    echo "<div class='push'>$i</div>";
  } else {
    echo '<div class="push"><a href="'.$_SERVER['PHP_SELF'].'?idp=1&page='.$i.'">'.$i."</a></div> ";
  }
}

for($i=$page;$i<=$page2;$i++) {
  if ($i == $page) {
    echo "<div class='push'>$i</div>";
  } else {
    echo '<div class="push"><a href="'.$_SERVER['PHP_SELF'].'?idp=1&page='.$i.'">'.$i."</a></div> ";
  }
}
?>
			
			</div>
	</div>
