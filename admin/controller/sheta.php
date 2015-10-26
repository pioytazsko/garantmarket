<div class="lineWithClientNameLCRM"></div>
    <div class="lineWithClientNameMCRM">
    	<div class="whiteTextUsrCRM">Счета</div>
    </div>
    <div class="lineWithClientNameRCRM"></div>
    <div class="lGrayAddUserLCRM"></div>
    <div class="lGrayAddUserMCRM">
		<div class="firColTopCRM">Счет для клиента</div>
        <div class="firTwoColTopCRM">Выставил</div>
        <div class="secColTopCRM">Статус</div>
        <div class="thiColTopCRM">Дата</div>
        <div class="fouColTopCRM">Сумма счета</div>
        <div class="fifColTopCRM">Прибыль</div>
    </div>
    <div class="lGrayAddUserRCRM"></div>
    <div class="bgColorForCRM">
	<?php 
	$per_page=30;
	if (isset($_GET['page'])) {$page=($_GET['page']-1);} else {$page=0;};
	$start=abs($page*$per_page);
	
	$typeuser=mysql_query("SELECT * FROM user WHERE id=$userid ");
	$typeuserrez=mysql_fetch_array($typeuser);
	if($typeuserrez['type']==1)
	{
	$result=mysql_query("SELECT * FROM scheta ORDER BY id DESC LIMIT $start, $per_page ");
	}
	else
	{
	$result=mysql_query("SELECT * FROM scheta WHERE vendor=$userid ORDER BY id DESC LIMIT $start, $per_page ");
	}
	$myrow=mysql_fetch_array($result);
	
	
	if($myrow>0)
	{
	
	
	$i=1;
	
	do{
	
	$result2=mysql_query("SELECT * FROM firm WHERE id=$myrow[firm] ");
	$myrow2=mysql_fetch_array($result2);
	
	$result3=mysql_query("SELECT * FROM user WHERE id=$myrow[vendor] ");
	$myrow3=mysql_fetch_array($result3);
	
	$result4=mysql_query("SELECT * FROM statusschet WHERE id=$myrow[status] ");
	$myrow4=mysql_fetch_array($result4);
	
	$result5=mysql_query("SELECT * FROM statusschet WHERE id!=$myrow[status] ");
	$myrow5=mysql_fetch_array($result5);
	
	if($i%2==0)
	{
	include("strokasch1.php");
	}
	else
	{
	include("strokasch2.php");
	}
	
	$i++;
	
	}
	 while ($myrow=mysql_fetch_array($result));
	 }
	 else
	 {
	 echo "В БД нет щетов";
	 }
	 ?>   
	 
	 
		<div class="tenPxBlockCRM"></div>
        <div class="lineWithNumPageCRM">
		<?php 
//сами ссылки
if($typeuserrez['type']==1)
	{
	$q="SELECT count(*) FROM scheta";
	}
	else
	{
	$q="SELECT count(*) FROM scheta WHERE vendor=$userid";
	}


$res=mysql_query($q);
$row=mysql_fetch_row($res);
$total_rows=$row[0];
$num_pages=ceil($total_rows/$per_page);
$page=$_GET['page'];
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
    echo "<div class='blockWithNumberPageCRM'>$i</div>";
  } else {
    echo '<div class="blockWithNumberPageCRM"><a href="'.$_SERVER['PHP_SELF'].'?idp=6&page='.$i.'">'.$i."</a></div> ";
  }
}

for($i=$page;$i<=$page2;$i++) {
  if ($i == $page) {
    echo "<div class='blockWithNumberPageCRM'>$i</div>";
  } else {
    echo '<div class="blockWithNumberPageCRM"><a href="'.$_SERVER['PHP_SELF'].'?idp=6&page='.$i.'">'.$i."</a></div> ";
  }
}
?>
        </div>
       
    </div>