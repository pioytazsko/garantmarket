<?php 
$menu=mysql_query("SELECT * FROM menu WHERE publick=1 and levl>10 ORDER BY levl");
$rezmenu=mysql_fetch_array($menu);
while($rezmenu=mysql_fetch_array($menu))
{
    /*
     * 3-категория новостей
     * 2-статья
     * 1-каталог
     * 4-категория статей
     *

    */

 /*
 * 1-каталог(компонент)
 * 2-скатегория товаров
 * 3-товар
 * 4-все производители(компонент)
 * 5-производитель
 * 6-Новость
 * 7-категория новостей
 * 8-все новости(компонет)

 */
$type2=$rezmenu['linkpunkta'];

if( $rezmenu['type']==1)
{
$tp=0;
$menulink="catalog_all/".$type2;
}
if( $rezmenu['type']==0)
{
$tp=0;
$menulink=$type2;
}


if($rezmenu['type']==4)
{
    $tp=0;
    $menulink="news/".$type2;
}

if($rezmenu['type']==8)
{
    $tp=0;
    $menulink=$type2;
}
if($rezmenu['type']==9)
{
    $tp=0;
    $menulink=$type2;
}

if($rezmenu['type']==2)
{
    $tp="catecory";
    $tp2="catalog";

}
    if($rezmenu['type']==3)
    {
        $tp="catalog";
        $tp2="item";

    }
    if($rezmenu['type']==5)
    {
        $tp="manufekted";
        $tp2="manufactor";

    }
    if($rezmenu['type']==6)
    {
        $tp="news";
        $tp2="news";



    }
    if( $rezmenu['type']==7)
    {
        $tp='news_category';
        $tp2="newscat";

    }


if($tp!==0)
{
$query=mysql_query("SELECT * FROM $tp WHERE id=$type2");
$newsCatChpu=mysql_fetch_array($query);
    if ($newsCatChpu['chpu']!=''){$newsChpu=$newsCatChpu['chpu'];} else {$newsChpu="noname";}

    $menulink=$tp2."/".$newsChpu."/".$newsCatChpu['id'];
//echo $newsCatChpu['id'];
}


?>
<div class="top_punct"><a href="<?php echo $menulink?>"><?php echo "$rezmenu[name]"; ?></a></div>
<div class="razdel2"><img src="image/sep2.png"></div>

<?php

}
?>


















