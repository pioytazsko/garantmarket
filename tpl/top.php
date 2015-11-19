
	<div class="top">
		<div class="menu_top">
			<?php include("menu/top_menu2.php"); ?>
		</div>
		<div class="search">
			
		<form action="/search.php" style=" margin:0px; padding:0px" method="post" id="search-from">
                    
                        <div class="live-search-wrap">
                            <div class="live-search-filed">
                                <input type="text" class="search-field" id="search-keyword" name="keyword" placeholder="Введите текст" autocomplete="off">
                                <a class="empty-search" id="empty-search"></a>
                                <input class="search-button" id="search_button" type="submit" value="Найти">
                            </div>
                            <div class="live-search-result" id="search-block">
                            </div>
                        </div>
                   
                    </form>
		</div>
	</div>
	
	
	<div class="head">
		<div class="head_top">
			<a href="index.php"><div style="height:85px;width:220px;float:left"></div></a>
			<div class="razdel"><img src="image/sep.png" alt="image"></div>
			<div class="head_text"><div class="top1"><?php include("moduls/user1.php");?></div></div>
			<div class="razdel"><img src="image/sep.png" alt="image"></div>
			<div  id="telephone" class="head_text"><?php include("moduls/user2.php");?></div>
		</div>
        
		<?php include("menu/top_menu.php"); ?>
	</div>
<div class="fixed_menu">

<div class="phones_menu">Наши телефоны:</div>
<div class="catalog_menu">
    <b>8 (029) 633 63 66</b>
    <br>
    <b>8 (029) 500 45 33</b>

    </div>



</div>