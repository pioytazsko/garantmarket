<?php
require('config.php');
mysql_connect($host,$user,$password);
mysql_select_db($database);
//mysql_connect('localhost','toolbyto_serj','kayman');
//mysql_select_db('toolbyto_old');
$query="SELECT id,name,chpu,img FROM catecory WHERE parent=0";
mysql_query('SET NAMES utf8');
$res=mysql_query($query);echo mysql_error();
$result=array();
while($resulr=mysql_fetch_array($res)){
$result []=$resulr;    
    $query_parent="";
}

//print_r($result);?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>GarantMarket</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="www.jakbyco.com">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>

        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="nav-collapse collapse">
                    <ul class="nav">
                        <li class="main_li">
                            <a class="dropdown-toggle pull-left" data-toggle="dropdown" href="#">Главная</a>
                        </li>
                        <li class="main_li">
                            <a class="dropdown-toggle pull-left" data-toggle="dropdown" href="#">Контакты</a>
                        </li>
                        
                        <li class="main_li">
                            <a class="dropdown-toggle pull-left" data-toggle="dropdown" href="#">Доставка</a>
                        </li>
                        <li class="main_li">
                            <a class="dropdown-toggle pull-left" data-toggle="dropdown" href="#">Производители</a>
                        </li>
                        <li class="main_li">
                            <a class="dropdown-toggle pull-left" data-toggle="dropdown" href="#">Новости</a>
                        </li>
                        <li class="main_li">
                            <a class="dropdown-toggle pull-left" data-toggle="dropdown" href="#">Каталог</a>
                            <ul class="dropdown-menu" role="menu">
                                <?php foreach($result as $key=>$value ){ 
                    $query_parent="SELECT id,name,chpu FROM catecory WHERE parent=".$value['id'];
                    $res=mysql_query($query_parent);echo mysql_error();
    $result_subcategory=array();
     while($res_parent=mysql_fetch_assoc($res)){
                                $result_subcategory []=$res_parent;}
                    $n=count($result_subcategory);
//    $res_parent=mysql_fetch_array($res);print_r($res_parent);
                    echo' <li data-submenu-id="submenu-'.$value['id'].'">
                    <a href="/catalog/'.$value['chpu'].'">'.$value['name'].'</a>';if($n==0){}else{
                    
                   echo' <div id="submenu-'.$value['id'].'" class="popover">';               
                    
                   
                    if($n<9){ echo'<div class="padding">
                                <h4>'.$value['name'].'</h4><ul>';
                                foreach($result_subcategory as $key=>$values){    
                                                    echo '<li><a href="/catalog/'.$values['chpu'].'">'.$values['name'].'</a></li>
                                                    <span>'.$values['name'].'</span>';
                                                    }
                                echo  '</ul></div><div class="img_category" ><img src="categoryimages/'.$value['img'].'"  alt="picture"></div></div></li>';
                                ;}
                    else{ 
                        foreach($result_subcategory as $key=>$values){ //echo $key;
                                                if($key==0){ echo'<div class="pull-left padding row_left">
                                                            <h4>'.$value['name'].'</h4><ul>';
                                                            };
                                                    echo'<li><a href="/catalog/'.$values['chpu'].'">'.
                                                    $values['name'].'</a></li>
                                                    <span>'.$values['name'].'</span>';
                                                if($key==8){
                                                            echo'</ul></div>
                                                            <div class="pull-right padding row_right">
                                                            <h4>'.$value['name'].'</h4>
                                                            <ul>'
                                                            ;}
                                                   
                                                        };
                                                    echo '</ul></div><div class="img_category" ><img src="categoryimages/'.$value['img'].'"  alt="picture"></div>
                                                            </div></li>
                                                            ';
         
     } ;
                    };
        
        
                        } ;?>




                            </ul>
                        </li>
                        
                    </ul>



                </div>
            </div>
        </div>



        <script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="js/jquery.menu-aim.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
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
                    height: height - 4 // padding for main dropdown's arrow
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
    </body>

    </html>