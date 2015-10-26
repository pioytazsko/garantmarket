			
<div class="pole_user">
			<div class="user">Список заказов</div>
			<div class="head">
				<div class="zak_punct1">id</div>
				<div class="zak_punct2">Статус</div>
				<div class="zak_punct3">Дата</div>
				<div class="zak_punct4">Содержание</div>
				<div class="zak_punct5">Действие</div>
			</div>	

<?php 
$per_page=20;
if (isset($_GET['page'])) {$page=($_GET['page']-1);} else {$page=0;};
$start=abs($page*$per_page);

$result=mysql_query("SELECT * FROM zakaz ORDER BY date LIMIT $start, $per_page");
$myrow=mysql_fetch_array($result);
do
{
$result2=mysql_query("SELECT * FROM statuszakaza WHERE id=$myrow[status]");
$myrow2=mysql_fetch_array($result2);
if($myrow2>0)
{
$status="$myrow2[name]";
}
else
{
$status="Не указан";
}
$text=substr($myrow['info'], 35, 50);
?>

<div class="kategory">
				<div class="zak_punct1"><a href="catalog.php?idp=10&id=<?php echo "$myrow[id]"; ?>"><?php echo "$myrow[id]<br>"; ?></a></div>
				<div class="zak_punct2"><?php echo "$status"; ?></div>
				<div class="zak_punct3"><?php echo "$myrow[date]"; ?></div>
				<div class="zak_punct4"><?php echo "$text"; ?></div>
				<div class="zak_punct5">
					
					<a href="controller/delit_zakaz.php?id=<?php echo "$myrow[id]"; ?>"><div class="stock"><img src="images/3.png"></div></a>
				</div>
				
			</div>
<?php 
}
while($myrow=mysql_fetch_array($result));
?>

<div class="button">
<?php 
//сами ссылки
$q="SELECT count(*) FROM zakaz";



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
    echo '<div class="push"><a href="'.$_SERVER['PHP_SELF'].'?idp=9&page='.$i.'">'.$i."</a></div> ";
  }
}

for($i=$page;$i<=$page2;$i++) {
  if ($i == $page) {
    echo "<div class='push'>$i</div>";
  } else {
    echo '<div class="push"><a href="'.$_SERVER['PHP_SELF'].'?idp=9&page='.$i.'">'.$i."</a></div> ";
  }
}
?>
			
			</div>
			
			
		</div>	
