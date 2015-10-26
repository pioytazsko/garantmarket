<?php 
$idcom=$_GET['idcom'];
if($idcom==1)
{
echo "<div class='yescoment'>Выполнено успешно</div>";
}
if($idcom==2)
{
echo "<div class='nocoment'>При удалении пользователя произошла ошибка</div>";
}
?>
<div class="pole_user">
			<div class="user">Пользователи:</div>
			<div class="line">
				<div class="line_punct1">Id</div>
				<div class="line_punct2">E-mail</div>
				<div class="line_punct3">Телефон</div>
				<div class="line_punct4">Дата</div>
				<div class="line_punct5">Примечание</div>
				<div class="line_punct6">Удалить</div>
			</div>
<!--Шапка страницы пользователей, дальше тело цикла-->		
<?php 
$per_page=20;
if (isset($_GET['page'])) {$page=($_GET['page']-1);} else {$page=0;};
$start=abs($page*$per_page);

$result=mysql_query("SELECT * FROM user LIMIT $start, $per_page");
$myrow=mysql_fetch_array($result);
do
{
?>
	
			<a href="sitting.php?idp=3&idus=<?php echo $myrow['id']; ?>"><div class="filling">
				<div class="filling_punct1"><?php echo $myrow['id']; ?></div>
				<div class="filling_punct2"><?php echo substr($myrow['milo'], 0, 16); ?></div>
				<div class="filling_punct3"><?php echo substr($myrow['phone'], 0, 15); ?></div>
				<div class="filling_punct4"><?php echo substr($myrow['datereg'], 0, 10); ?></div>
				<div class="filling_punct5"><?php echo substr($myrow['info'], 0, 40); ?></div></a>
				<div class="filling_punct6"><a href="controller/delit_user.php?id=<?php echo $myrow['id']; ?>"><img src="images/delete.png"></a></div>
			</div>
<?php 
}
while($myrow=mysql_fetch_array($result));
?>


<!--Конец блока цикла, ниже навигация-->	
<div class="button">
<?php 
//сами ссылки
$q="SELECT count(*) FROM user";



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
    echo '<div class="push"><a href="'.$_SERVER['PHP_SELF'].'?idp=2&page='.$i.'">'.$i."</a></div> ";
  }
}

for($i=$page;$i<=$page2;$i++) {
  if ($i == $page) {
    echo "<div class='push'>$i</div>";
  } else {
    echo '<div class="push"><a href="'.$_SERVER['PHP_SELF'].'?idp=2&page='.$i.'">'.$i."</a></div> ";
  }
}
?>
			
			</div>
		</div>

