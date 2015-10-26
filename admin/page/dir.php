<div class="files" >
<?php
// Обратите внимание, что оператор !== не существовал до версии 4.0.0-RC2

if ($handle = opendir('./temp')) {
       echo "Файлы:\n";
$list=array();
    while (false !== ($file = readdir($handle))) { 
        if (($file<>'.') and ($file<>'..')){
//            echo "<a target=\"_blank\" download=\"\" href='./temp/$file'><div class='fileblock'><div class='filename'>$file</div><div class='date'>".date("d F Y H:i:s.",filectime('./temp/'.$file))."</div></div></a>";
            $ctime=filectime('./temp/'.$file);
            $list[$ctime]=$file;
        }
    }

    

    closedir($handle); 
  krsort($list);
//    arsort($list);
    foreach($list as $file ){
     echo "<div class='fileblock'><input class='select_file' id='select' value='".$file."' type=\"checkbox\"><a target=\"_blank\" download=\"\" href='./temp/$file'><div class='filename'>$file</div></div></a>";
    
    }
    
}
?> </div>
    

    <div class="delete_button"><a href=""id="reload"><button>Обновить</button></a><button id="delete_select">Удалить выбранное</button> <button id="unselect">Снять выделение</button><button id="delete_all">Выделить всё</button></div>
  

 <script src="./jscripts/deletefile.js"></script>   
</body>
</html> 