<?php $text="здравствуйте дорогой коля";
$word="здр";
    $text=preg_replace("/".$word."/","<b>".$word."</b>",$text); 
echo $text;