<?php
define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);

require_once('_keybord_lang.php');
include_once(__ROOT__.'/location/read_location.php');
//require_once('LangCorrect.php');
//$corrector = new Text_LangCorrect();
if (!$DB)
    include($DOCUMENT_ROOT . "_config.php");
include($DOCUMENT_ROOT . "_mysql.php");

class Lingua_Stem_Ru {

    var $VERSION = "0.02";
    var $Stem_Caching = 0;
    var $Stem_Cache = array();
    var $VOWEL = '/аеиоуыэюя/';
    var $PERFECTIVEGROUND = '/((ив|ивши|ившись|ыв|ывши|ывшись)|((?<=[ая])(в|вши|вшись)))$/';
    var $REFLEXIVE = '/(с[яь])$/';
    var $ADJECTIVE = '/(ее|ие|ые|ое|ими|ыми|ей|ий|ый|ой|ем|им|ым|ом|его|ого|еых|ую|юю|ая|яя|ою|ею)$/';
    var $PARTICIPLE = '/((ивш|ывш|ующ)|((?<=[ая])(ем|нн|вш|ющ|щ)))$/';
    var $VERB = '/((ила|ыла|ена|ейте|уйте|ите|или|ыли|ей|уй|ил|ыл|им|ым|ены|ить|ыть|ишь|ую|ю)|((?<=[ая])(ла|на|ете|йте|ли|й|л|ем|н|ло|но|ет|ют|ны|ть|ешь|нно)))$/';
    var $NOUN = '/(а|ев|ов|ие|ье|е|иями|ями|ами|еи|ии|и|ией|ей|ой|ий|й|и|ы|ь|ию|ью|ю|ия|ья|я)$/';
    var $RVRE = '/^(.*?[аеиоуыэюя])(.*)$/';
    var $DERIVATIONAL = '/[^аеиоуыэюя][аеиоуыэюя]+[^аеиоуыэюя]+[аеиоуыэюя].*(?<=о)сть?$/';

    function s(&$s, $re, $to) {
        $orig = $s;
        $s = preg_replace($re, $to, $s);
        return $orig !== $s;
    }

    function m($s, $re) {
        return preg_match($re, $s);
    }

    function stem_word($word) {
        $word = strtolower($word);
        $word = strtr($word, 'ё', 'е'); // замена Є на е, что бы учитывалась как одна и та же буква
        # Check against cache of stemmed words
        if ($this->Stem_Caching && isset($this->Stem_Cache[$word])) {
            return $this->Stem_Cache[$word];
        }
        $stem = $word;
        do {
            if (!preg_match($this->RVRE, $word, $p))
                break;
            $start = $p[1];
            $RV = $p[2];
            if (!$RV)
                break;

            # Step 1
            if (!$this->s($RV, $this->PERFECTIVEGROUND, '')) {
                $this->s($RV, $this->REFLEXIVE, '');

                if ($this->s($RV, $this->ADJECTIVE, '')) {
                    $this->s($RV, $this->PARTICIPLE, '');
                } else {
                    if (!$this->s($RV, $this->VERB, ''))
                        $this->s($RV, $this->NOUN, '');
                }
            }

            # Step 2
            $this->s($RV, '/и$/', '');

            # Step 3
            if ($this->m($RV, $this->DERIVATIONAL))
                $this->s($RV, '/ость?$/', '');

            # Step 4
            if (!$this->s($RV, '/ь$/', '')) {
                $this->s($RV, '/ейше?/', '');
                $this->s($RV, '/нн$/', 'н');
            }

            $stem = $start . $RV;
        } while (false);
        if ($this->Stem_Caching)
            $this->Stem_Cache[$word] = $stem;
        return $stem;
    }

    function stem_caching($parm_ref) {
        $caching_level = @$parm_ref['-level'];
        if ($caching_level) {
            if (!$this->m($caching_level, '/^[012]$/')) {
                die(__CLASS__ . "::stem_caching() - Legal values are '0','1' or '2'. '$caching_level' is not a legal value");
            }
            $this->Stem_Caching = $caching_level;
        }
        return $this->Stem_Caching;
    }

    function clear_stem_cache() {
        $this->Stem_Cache = array();
    }

}

$arraySpecialChars = array('/', ']', '[', '-', '\\', '+', '\'', '&quot;');
header("Content-type: text/html; charset=utf-8");
$search = $_REQUEST['search'];
$search= mb_strtolower($search,"UTF-8");
$search=preg_replace('(-)',' ',$search);
$search = addslashes($search);
$search = htmlspecialchars($search);
$search = stripslashes($search);
$search = switcher($search);


foreach ($arraySpecialChars as $item) {
    $search = str_replace($item, '', $search);
}
$search = preg_replace('/ {2,}/', ' ', $search);
$search = trim($search);
$searchKeywordArray = explode(' ', $search);
if (count($searchKeywordArray) <= 1) {
//     $searchKeywordArray = iconv('windows-1251','utf-8',  $searchKeywordArray);
    preg_match_all('/([A-Za-А-Яа-я]{1,})|([0-9]{1,})/u', $search, $searchKeywordArray);
    $searchKeywordArray = $searchKeywordArray[0];
}

$usdCurs = 0;
$sqlCurrency = "SELECT f1 FROM " . $module_name . " WHERE id=107";
//$usdCurs = mysql_result($Q->query($DB, $sqlCurrency), 0, 0);
$usdCurs = (float) $usdCurs;


$sqlQuery = 'FROM ' . $module_name . ' WHERE ';
$sqlQueryPrefix = 'id<> 74';
$sqlQueryTerm1 = '';
$sqlQueryTerm2 = '';
$writeTerm2 = false;
foreach ($searchKeywordArray as $key => $value) {
    if (!empty($value)) {
        if ($value == '###') {
            $writeTerm2 = true;
        } else {

            if ($writeTerm2) {
                if ($sqlQueryTerm2 != '')
                    $sqlQueryTerm2.=' AND ';
//                print_r($searchKeywordArray);
                $sqlQueryTerm2.= 'name LIKE \'%' . $searchKeywordArray[$key] . '%\'';
            } else {    
//                print_r($searchKeywordArray);
                if ($sqlQueryTerm1 != '')
                    $sqlQueryTerm1.=' AND ';
                $sqlQueryTerm1.= 'name LIKE \'%' . $searchKeywordArray[$key] . '%\'';
            }
        }
    }
}
$sqlQuery = $sqlQueryPrefix . ' AND ';
if ($writeTerm2) {
    $sqlQuery.='((' . $sqlQueryTerm1 . ') OR (' . $sqlQueryTerm2 . '))';
} else {
    $sqlQuery.=$sqlQueryTerm1;
}
$sqlQueryNum=$sqlQuery;
$sqlQuery = 'FROM ' . $module_name . ' WHERE ' . $sqlQuery;
$sqlQueryNum = 'FROM ' . $module_name . ' WHERE ' . $sqlQueryNum;
$sqlCount = 'SELECT price ' . $sqlQuery;
//считаем количество продуктов 
//$countProduct = mysql_result($Q->query($DB, $sqlCount), 0, 0);
$sqlQuery = 'SELECT * ' . $sqlQuery . ' ORDER BY levl DESC LIMIT 0,5';
$sqlQueryNum = 'SELECT * ' . $sqlQueryNum . ' ORDER BY levl';
$categotyList = array();

if ($sqlQuery != '') {
   
    // поиск категорий 
   $search_category=$search;
    $search1=preg_split('/###/',$search_category); 
            if (count($search1)>1){$search_category=$search1[1];};
            $search_category=ltrim($search_category);
  
    
    $sql_category="SELECT chpu,name FROM catecory WHERE name LIKE '%".$search_category."%' ORDER BY levl DESC LIMIT 0,5";
    if(!$res=mysql_query($sql_category)){echo "ERROR ".mysql_errno()." ".mysql_error()."\n";};
    $resu=mysql_fetch_array($res);
//    print_r($resu);
    
    $sql_utf="SET NAMES utf8";
    $Q->query($DB,$sql_utf);
    $result_cat = $Q->query($DB, $sql_category);
   
  $result_num=$Q->query($DB,$sqlQueryNum);
    $result_num=mysql_num_rows($result_num)-1;
    

    // поиск товаров
    $resultQuery = $Q->query($DB, $sqlQuery);
   
    if (mysql_num_rows($resultQuery) != 0) { 
        echo "<div style='background-color:white'>";
        //  выведем результат поиска с ссылкой и картинкой
        while ($sqlItem = mysql_fetch_array($resultQuery)) {
            $query="SELECT chpu,name FROM catecory WHERE id=".$sqlItem['category'];
            $result=$Q->query($DB,$query);
            $result=mysql_fetch_array($result);
//         print_r($result);
            // сделаем коректировку цены
            //локали для цен читаем 
            $loc=mysql_query('SELECT local_price FROM catalog WHERE id='.$sqlItem['id']);
            $loc=mysql_fetch_row($loc);
//    print_r($loc);
            if($loc[0]==1){
                $sqlItem['price']=$sqlItem['price']-$sqlItem['price']*$datas[0]['discount']/100;
            }
            $price=number_format($sqlItem['price'],0,',',' ');
                         echo '<div id="block" style=""><div style="vertical-align:middle;float:left;clear:left;margin-top:10px;margin-left:10px">
                                    <a href="/catalog/'.$result['chpu'].'/'.$sqlItem['chpu'].'">
                                       <div id="parent" style="border:solid 1px grey; width:60px;height:60px;margin:auto 10px;display:flex;justify-content:center;align-items:center" >
                                            <img class="search_image" style="display:inline-block;vertical-align:middle;width:60px;max-height:60px;" src="/shopimage/'.$sqlItem['image'].'" alt="IMAGE">
                                       </div>
                                    </a>
                                </div>';
       //
            $text=$sqlItem['name'];
            $search1=preg_split('/###/',$search); 
            if (count($search1)>1){$search=$search1[1];};
            $search=ltrim($search);
       
            
                         $text=preg_replace("#($search)#iu","<span id='data' style='background-color: rgb(190, 190, 190);'>".$search."</span>",$text); 
     $rating='';
            for($i=$sqlItem['rating'];$i>0;$i--){
                $rating='<span class="rate_active"></span>'.$rating;};
            for($i=5-$sqlItem['rating'];$i>0;$i--){
                $rating=$rating.'<span class="rate_inactive"></span>';};
                
            
         
                        echo '<div style="text-decoration:none;float:left;margin-top:10px;width:500px;text-align:left;">';
                        echo    '<a style="margin:0 15px;color:#000000;text-decoration:none;" href="/catalog/'.$result['chpu'].'/'.$sqlItem['chpu'].'">
                                        <span style="font-size:14px;">'.$text.'</span>
                                 </a>';
                        echo'    <div style="margin:0 15px;display:block;">
                                    <a style=" text-decoration:none;" href="/catalog/'.$result['chpu'].'/'.$sqlItem['chpu'].'">
                                        <span style="font-size:12px">Цена:'.$price.' бел.руб.</span><div style="float:right;margin-top:5px;">'.$rating.'</div>
                                        <div align="center" style="width:80px;border: solid 1px #c9c9c9; border-radius: 8px;padding:5px; margin-top:3px; background-color:#08ac1b;color:#ffffff;font-size:12px;"><strong>КУПИТЬ</strong>
                                        </div>
                                    </a>
                                 </div>';
                          echo'</div></div>';
            
            
//    
        }  
        
        if($result_num>5){ echo '<div id="show_all" style="float:right;width:100%;text-align:right;padding:10px 20px;font-size:13px;"><a>Всего '.$result_num.'.Показать все</a></div>';}
       
       
       
        // вывод категорий
         
        while( $result_category=mysql_fetch_array($result_cat)){
            $text=$result_category['name'];
            $text=preg_replace("#($search)#iu","<span style='background-color: rgb(190, 190, 190);'>".$search."</span>",$text);
           echo '<div style=" text-decoration:none;font-size:18px;text-align:right;float:left;clear:left"><div style="margin: 10px 15px;color:#6c6c6c">
           <a style="color:#6c6c6c;font-size:13px" href="/catalog/'.$result_category['chpu'].'/"><p><strong>'.$text.'</strong><p></a></div></div>';
        
        
            echo '</div>';}
       
        
        // перечисление категорий в результате запроса
        
        
    } else {
      echo "<b>Нет результатов</b>";
    }
}
?>