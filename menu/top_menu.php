<?php
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
                            <a class="dropdown-toggle pull-left menu_catalog " id='menu_catalog' data-toggle="dropdown" href="/cataloge.php"> &#9662; Каталог</a>
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
                                <h4>'.$values['name'].'</h4><img  class="img_category" src="categoryimages/'.$values['menu_img'].' " alt=""><ul>';
                                foreach($result_subcategory as $key=>$valuess){    
                                                    echo '<li><a href="/catalog/'.$valuess['chpu'].'/">'.$valuess['name'].'</a><span>'.$valuess['specification'].'</span></li>';
                                                    }
                                echo  '</ul></div></div></li>';
                                ;}
                    else{ 
                        foreach($result_subcategory as $key=>$valuess){ //echo $key;
                                                if($key==0){ echo'<div class="pull-left padding row_left">
                                                            <h4>'.$values['name'].'</h4><img  class="img_category"  src="categoryimages/'.$values['menu_img'].'" alt=""><ul>';
                                                            };
                                                    echo'<li><a href="/catalog/'.$valuess['chpu'].'/">'.
                                                    $valuess['name'].'</a><span>'.$valuess['specification'].'</span></li>';
                                                if($key==8){
                                                            echo'</ul></div>
                                                            <div class="pull-right padding row_right">
                                                            <br>
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
<!--
                        <li class="main_li">
                            <a class="dropdown-toggle pull-left" data-toggle="dropdown" href="/newscat/novosti/3">Новости</a>
                        </li>
-->
                        <li class="main_li">
                            <a class="dropdown-toggle pull-left" data-toggle="dropdown" href="/news/kontakty/9">Контакты</a>
                        </li>
                         <li class="main_li">
                            <a class="dropdown-toggle pull-left" data-toggle="dropdown" href="/faq.php">Вопрос/ответ</a>
                        </li>
                        <li class="main_li basket">
                          <a class="basket" data-toggle="dropdown" href="/faq.php"><div class='basket_image'><img src="/icon/basket.png" alt=""><span class="
number_of_goods">0</span></div> Корзина</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>