<div class="left">
			<div class="header_small">Разделы каталога</div>
			<ul>
				<?php include("shop/category.php"); ?>
			</ul>
			<?php include("moduls/user3.php"); ?>
			<div class="header_small">Новости</div>
			<div class="left_text b11">
			<?php
				$news_sql = mysql_query('SELECT id,name,text,chpu FROM `news` ORDER BY id DESC LIMIT 5');
				while($res_news = mysql_fetch_array($news_sql)){
				$string = strip_tags($res_news[text]);
				$desc = implode(array_slice(explode('<br>',wordwrap($string,210,'<br>',false)),0,1));
			?>
				<p><a href="news/<?php if($res_news[chpu]){ echo $res_news[chpu]; }else{ echo "news";} ?>/<?=$res_news[id]?>"><?=$res_news[name]?></a></p>
				<br/>
			<?php
			}
			?>
			</div>
</div>