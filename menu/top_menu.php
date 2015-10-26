<?php
//require('config.php');
//$db_connect=mysql_connect('localhost','root','');
//mysql_select_db('garantmarket');
//mysql_connect('localhost','toolbyto_serj','kayman');
//mysql_select_db('toolbyto_old');
$query="SELECT id,name,chpu,img,menu_img FROM catecory WHERE parent=0 AND publick=1 ORDER BY levl";
mysql_query('SET NAMES utf8');
$res=mysql_query($query);echo mysql_error();
$resultat=array();
while($resulr=mysql_fetch_array($res)){
$resultat []=$resulr;    
    $query_parent="";
}

//print_r($result);?>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="nav-collapse collapse">
                    <ul class="nav">
                        <li class="main_li">
                            <a class="dropdown-toggle pull-left" data-toggle="dropdown" href="/">Главная</a>
                        </li>
                                            
                        <li class="main_li">
                            <a class="dropdown-toggle pull-left menu_catalog " id='menu_catalog' data-toggle="dropdown" href="/cataloge.php"> &#9662 Каталог</a>
                            <ul class="dropdown-menu" role="menu">
                                <?php foreach($resultat as $key=>$values ){ 
                    $query_parent="SELECT id,name,chpu,specification FROM catecory WHERE parent='".$values['id']."' ORDER BY levl";
                    $res=mysql_query($query_parent);echo mysql_error();
    $result_subcategory=array();
     while($res_parent=mysql_fetch_assoc($res)){
                                $result_subcategory []=$res_parent;}
                    $n=count($result_subcategory);
//    $res_parent=mysql_fetch_array($res);print_r($res_parent);
                    echo' <li data-submenu-id="submenu-'.$values['id'].'">
                    <a href="/catalog/'.$values['chpu'].'/">'.$values['name'].'</a>';if($n==0){}else{
                    
                   echo'<span class="left_menu">></span> <div id="submenu-'.$values['id'].'" class="popover">';               
                    
                   
                    if($n<9){ echo'<div class="padding">
                                <h4>'.$values['name'].'</h4><ul><img  class="img_category"src="categoryimages/'.$values['menu_img'].'">';
                                foreach($result_subcategory as $key=>$valuess){    
                                                    echo '<li><a href="/catalog/'.$valuess['chpu'].'/">'.$valuess['name'].'</a></li>
                                                    <span>'.$valuess['specification'].'</span>';
                                                    }
                                echo  '</ul></div></div></li>';
                                ;}
                    else{ 
                        foreach($result_subcategory as $key=>$valuess){ //echo $key;
                                                if($key==0){ echo'<div class="pull-left padding row_left">
                                                            <h4>'.$values['name'].'</h4><ul><img  class="img_category"src="categoryimages/'.$values['menu_img'].'">';
                                                            };
                                                    echo'<li><a href="/catalog/'.$valuess['chpu'].'/">'.
                                                    $valuess['name'].'</a></li>
                                                    <span>'.$valuess['specification'].'</span>';
                                                if($key==8){
                                                            echo'</ul></div>
                                                            <div class="pull-right padding row_right">
                                                            <br></br>
                                                            <ul>'
                                                            ;}
                            if($key==16){
                            echo'<li><a  style="display:block"href="/catalog/'.$values['chpu'].'/"><h4 style="font-size:1em">Посмотреть еще</h4>
                                        </a></li>';break;
                                                   
                            }
                                                   
                                                        };
                                                    echo '</ul></div>
                                                            </div></li>
                                                            ';
         
     } ;
                    };
        
        
                        } ;?>




                            </ul>
                        </li>
                        
                       <li class="main_li">
                            <a class="dropdown-toggle pull-left" data-toggle="dropdown" href="news/oplata-i-dostavka/3">Доставка и оплата</a>
                        </li>
                        <li class="main_li">
                            <a class="dropdown-toggle pull-left" data-toggle="dropdown" href="/manufacturers.php">Производители</a>
                        </li>
                        <li class="main_li">
                            <a class="dropdown-toggle pull-left" data-toggle="dropdown" href="/newscat/novosti/3">Новости</a>
                        </li>
                        <li class="main_li">
                            <a class="dropdown-toggle pull-left" data-toggle="dropdown" href="/news/kontakty/9">Контакты</a>
                        </li>
                         <li class="main_li">
                            <a class="dropdown-toggle pull-left" data-toggle="dropdown" href="/faq.php">Вопрос/ответ</a>
                        </li>
                    </ul>



                </div>
            </div>
        </div>



        <script src="/js/jquery-1.9.0.min.js" type="text/javascript"></script>
        <script src="/js/jquery.menu-aim.js" type="text/javascript"></script>
        <script src="/js/bootstrap.min.js" type="text/javascript"></script>
        <script>
            var $menu = $(".dropdown-menu");

            // jQuery-menu-aim: <meaningful part of the example>
            // Hook up events to be fired on menu row activation.
            $menu.menuAim({
                activate: activateSubmenu,
                deactivate: deactivateSubmenu
            });
            // jQuery-menu-aim: </meaningful part of the example>

            // jQuery-menu-aim: the following JS is used to show and hide the submenu
            // contents. Again, this can be done in any number of ways. jQuery-menu-aim
            // doesn't care how you do this, it just fires the activate and deactivate
            // events at the right times so you know when to show and hide your submenus.
            function activateSubmenu(row) {
                var $row = $(row),
                    submenuId = $row.data("submenuId"),
                    $submenu = $("#" + submenuId),
                    height = $menu.outerHeight(),
                    width = $menu.outerWidth();

                // Show the submenu
                $submenu.css({
                    display: "block",
                    top: -1,
                    left: width - 3, // main should overlay submenu
                    height:450 // padding for main dropdown's arrow
                });

                // Keep the currently activated row's highlighted look
                $row.find("a").addClass("maintainHover");
            }

            function deactivateSubmenu(row) {
                var $row = $(row),
                    submenuId = $row.data("submenuId"),
                    $submenu = $("#" + submenuId);

                // Hide the submenu and remove the row's highlighted look
                $submenu.css("display", "none");
                $row.find("a").removeClass("maintainHover");
            }

            // Bootstrap's dropdown menus immediately close on document click.
            // Don't let this event close the menu if a submenu is being clicked.
            // This event propagation control doesn't belong in the menu-aim plugin
            // itself because the plugin is agnostic to bootstrap.
            $(".dropdown-menu li").click(function (e) {
                e.stopPropagation();
            });

            $(document).click(function () {
                // Simply hide the submenu on any click. Again, this is just a hacked
                // together menu/submenu structure to show the use of jQuery-menu-aim.
                $(".popover").css("display", "none");
                $("a.maintainHover").removeClass("maintainHover");
            });
        </script>
