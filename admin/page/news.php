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
<div class="plus"><a href="news.php?idp=5"><img src="images/add.png"></a></div>
		<div class="pole_user">
			<div class="user">Список категорий</div>
			<div class="head">
				<div class="head_punct1">Название</div>
				<div class="head_punct2">Категория</div>
				<div class="head_punct3">Действия</div>
			</div>	

<?php 
$per_page=20;
if (isset($_GET['page'])) {$page=($_GET['page']-1);} else {$page=0;};
$start=abs($page*$per_page);

$result=mysql_query("SELECT * FROM news LIMIT $start, $per_page");
$myrow=mysql_fetch_array($result);
do
{
$result2=mysql_query("SELECT * FROM news_category WHERE id=$myrow[category]");
$myrow2=mysql_fetch_array($result2);
?>
<div class="kategory">
				<div class="kategory_punct1"><a href="news.php?idp=4&id=<?php echo "$myrow[id]"; ?>"><?php echo "$myrow[name]"; ?></a></div>
				<div class="kategory_punct2"><?php if($myrow2>0){echo "$myrow2[name]";} else {echo "Без категории";} ?></div>
				<div class="kategory_punct3">
					<a href="controller/up_publicknews.php?id=<?php echo "$myrow[id]"; ?>"><div class="stock"><img src="images/<?php if($myrow['publick']==1) {echo "1.png";} else {echo "4.png";}?>"></div></a>
					<a href="controller/delit_news.php?id=<?php echo "$myrow[id]"; ?>"><div class="stock"><img src="images/3.png"></div></a>
				</div>
			</div>


<?php 
}
while($myrow=mysql_fetch_array($result));
?>
<div class="button">
<?php 
//сами ссылки
$q="SELECT count(*) FROM news";



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
    echo '<div class="push"><a href="'.$_SERVER['PHP_SELF'].'?idp=3&page='.$i.'">'.$i."</a></div> ";
  }
}

for($i=$page;$i<=$page2;$i++) {
  if ($i == $page) {
    echo "<div class='push'>$i</div>";
  } else {
    echo '<div class="push"><a href="'.$_SERVER['PHP_SELF'].'?idp=3&page='.$i.'">'.$i."</a></div> ";
  }
}
?>
			
	</div>
</div>