<div class="center">
				<?php 
$idcat=$_GET['idcat'];
$per_page=20;

if (isset($_GET['page'])) {$page=($_GET['page']-1);} else {$page=0;};
$start=abs($page*$per_page);

if($idcat>0)
{
$news=mysql_query("SELECT * FROM news WHERE category=$idcat and publick=1 ORDER BY id DESC LIMIT $start, $per_page");
$newsrez=mysql_fetch_array($news);
}

else
{
$news=mysql_query("SELECT * FROM news WHERE publick=1 ORDER BY id DESC LIMIT $start, $per_page");
$newsrez=mysql_fetch_array($news);
}


do
{
$catnews=mysql_query("SELECT * FROM news_category WHERE id=$newsrez[category]");
$catnewsrez=mysql_fetch_array($catnews);
if ($catnewsrez['chpu']!='') {$newschpu=$catnewsrez['chpu'];} else { $newschpu="news";}
$text=$newsrez['text'];
$string = strip_tags($text);
$desc = implode(array_slice(explode('<br>',wordwrap($string,1000,'<br>',false)),0,1));
if($desc!=$string)
{
$desc=$desc." ...";
}
?>


	<div class="n_news">
		<div class="n_news_top"><div class="n_telephone"><?php echo "$newsrez[name]"; ?></div></div>
		<div class="n_header">
			<div class="n_header_blok">
				<div class="n_window"><img src="image/kalk.png" / alt="image/kalk.png"></div>
				<div class="n_header_date"><?php echo "$newsrez[date]"; ?></div>
			</div>
			<div class="n_header_blok">
				<div class="n_window"><img src="image/fail.png" / alt="image/fail.png"></div>
				<div class="n_header_date"><a href="<?php echo "newscat/$newschpu/$idcat"; ?>"><?php echo "$catnewsrez[name]"; ?></a></div>
			</div>
			
		</div>
		
		<div class="n_news_bottom">
			
			<div class="n_right_news">
				<div class="n_news_text"><?php echo "$desc"; ?></div>
			</div>
			<div class="n_all"><a href="news/<?php  if ($newsrez['chpu']!='') echo $newsrez['chpu']; else echo "news"; ?><?php echo "/"."$newsrez[id]"; ?>">Подробнее</a></div>
		</div>
		<div style="clear:both"></div>
	</div>



<?php
}
while($newsrez=mysql_fetch_array($news));
 ?>
 
 <div class="button">
<?php 
//сами ссылки

if($idcat>0)
{
$q="SELECT count(*) FROM news WHERE category=$idcat and publick=1";
}
else
{
$q="SELECT count(*) FROM news WHERE publick=1";
}




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
  if($idcat>0)
  {
    echo '<div class="push"><a href="'.$_SERVER['PHP_SELF'].'?idcat='.$idcat.'&page='.$i.'">'.$i."</a></div> ";
	}
	else
	{
	 echo '<div class="push"><a href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">'.$i."</a></div> ";
	}
  }
}

for($i=$page;$i<=$page2;$i++) {
  if ($i == $page) {
    echo "<div class='push'>$i</div>";
  } else {
  if($idcat>0)
  {
    echo '<div class="push"><a href="'.$_SERVER['PHP_SELF'].'?idcat='.$idcat.'&page='.$i.'">'.$i."</a></div> ";
	}
	else
	{
	echo '<div class="push"><a href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">'.$i."</a></div> ";
	}
  }
}

?>
</div>	

</div>