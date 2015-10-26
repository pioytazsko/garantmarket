<?php 
include("../db.php");

function translitURL($str) 
{
    $tr = array(
        "А"=>"a","Б"=>"b","В"=>"v","Г"=>"g",
        "Д"=>"d","Е"=>"e","Ё"=>"yo","Ж"=>"zh","З"=>"z","И"=>"i",
        "Й"=>"j","К"=>"k","Л"=>"l","М"=>"m","Н"=>"n",
        "О"=>"o","П"=>"p","Р"=>"r","С"=>"s","Т"=>"t",
        "У"=>"u","Ф"=>"f","Х"=>"x","Ц"=>"c","Ч"=>"ch",
        "Ш"=>"sh","Щ"=>"shh","Ъ"=>"j","Ы"=>"y","Ь"=>"",
        "Э"=>"e","Ю"=>"yu","Я"=>"ya","а"=>"a","б"=>"b",
        "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ё"=>"yo","ж"=>"zh",
        "з"=>"z","и"=>"i","й"=>"j","к"=>"k","л"=>"l",
        "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
        "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"x",
        "ц"=>"c","ч"=>"ch","ш"=>"sh","щ"=>"shh","ъ"=>"j",
        "ы"=>"y","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya", 
        " "=> "-", "."=> "", "І"=> "i",
        "і"=> "i", "&#1186;"=> "n", "&#1187;"=> "n", 
        "&#1198;"=> "u", "&#1199;"=> "u", "&#1178;"=> "q", 
        "&#1179;"=> "q", "&#1200;"=> "u",
        "&#1201;"=> "u", "&#1170;"=> "g", "&#1171;"=> "g", 
        "&#1256;"=> "o", "&#1257;"=> "o", "&#1240;"=> "a", 
        "&#1241;"=> "a"                             
    );
    // Убираю тире, дефисы внутри строки
    $urlstr = str_replace('–'," ",$str);
    $urlstr = str_replace('-'," ",$urlstr); 
    $urlstr = str_replace('—'," ",$urlstr);

    // Убираю лишние пробелы внутри строки
    $urlstr=preg_replace('/\s+/',' ',$urlstr);
     if (preg_match('/[^A-Za-z0-9_\-]/', $urlstr)) {
        $urlstr = strtr($urlstr,$tr);
        $urlstr = preg_replace('/[^A-Za-z0-9_\-]/', '', $urlstr);
        $urlstr = strtolower($urlstr);
        return $urlstr;
    } else {
        return strtolower($str);
    }
}

$chpu=$_POST['name'];
$chpu=translitURL($chpu);

$result=mysql_query('SELECT * FROM catalog WHERE chpu="'.$chpu.'"');
$myrow=mysql_fetch_array($result);
if($myrow>0)
{
$unic=1;
do {
$chpu=$chpu.$unic;
$pralias=mysql_query('SELECT * FROM catalog WHERE chpu="'.$chpu.'"');
$praliass=mysql_fetch_array($pralias);
$unic++;
}
while($praliass>0);
}

?>

<div class="text">Псевдоним:</div>
<div class="text1">Цифры, латинские буквы</div>
<div class="name"><input name="chpu" type="text" value="<?php echo "$chpu"; ?>"></div>