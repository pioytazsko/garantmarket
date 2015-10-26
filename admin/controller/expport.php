<?php function export_csv($file_name){  	
  $query = "SELECT * FROM catalog";
  mysql_query ("set_client='utf8'");
mysql_query ("set character_set_results='utf8'");
mysql_query ("set collation_connection='utf8_general_ci'");
mysql_query ("SET NAMES utf8");
    
    $kar = mysql_query($query);
    $search=array(';','&quot','/r/n');
    
  if(!$kar) exit("Ошибка ".mysql_error());
  if(mysql_num_rows($kar))
  {
    $fd = fopen('../files/'.$file_name, "w");
     $header=array('id','iditem','name','space1','space2','price','manufected','category','keywords','image','vip','levl','public','chpu','h1','title','description','rating','share','view')   ;  
       fputcsv($fd, $header,$delimiter = ';');
    while($kart = mysql_fetch_array($kar))
       {  $query="SELECT name FROM manufekted WHERE id='".$kart['manufekted']."'";
        $result=mysql_query($query);
        $res=mysql_fetch_row($result);
        $query="SELECT name FROM catecory WHERE id='".$kart['category']."'";
         $result=mysql_query($query);
        $res1=mysql_fetch_row($result);
        // перекодировка и запись в файл для того что бы читалось в exel
        $order = 
              mb_convert_encoding (str_replace('"',' ',$kart['id']) , "Windows-1251", "UTF-8" ).";".
              mb_convert_encoding ($kart['iditem'] , "Windows-1251", "UTF-8" ).";".
              mb_convert_encoding (str_replace($search,' ',$kart['name']) , "Windows-1251", "UTF-8" ).";".
              mb_convert_encoding ('', "Windows-1251", "UTF-8" ).";".
              mb_convert_encoding ('', "Windows-1251", "UTF-8" ).";".
              mb_convert_encoding ($kart['price'] , "Windows-1251", "UTF-8" ).";".
              mb_convert_encoding (str_replace($search,' ',$res[0]), "Windows-1251", "UTF-8" ).";".
              mb_convert_encoding (str_replace($search,' ',$res1[0]), "Windows-1251", "UTF-8" ).";".
              mb_convert_encoding (str_replace($search,' ',$kart['keywords']) , "Windows-1251", "UTF-8" ).";".
              mb_convert_encoding (str_replace($search,' ',$kart['image'] ), "Windows-1251", "UTF-8" ).";".
              mb_convert_encoding (str_replace($search,' ',$kart['vip']) , "Windows-1251", "UTF-8" ).";".
              mb_convert_encoding (str_replace($search,' ',$kart['levl'] ), "Windows-1251", "UTF-8" ).";".
              mb_convert_encoding (str_replace($search,' ',$kart['publick'] ), "Windows-1251", "UTF-8" ).";".
              mb_convert_encoding (str_replace($search,' ',$kart['chpu']) , "Windows-1251", "UTF-8" ).";".
              mb_convert_encoding (str_replace($search,' ',$kart['h1'] ), "Windows-1251", "UTF-8" ).";".
              mb_convert_encoding (str_replace($search,' ',$kart['title']) , "Windows-1251", "UTF-8" ).";".
              mb_convert_encoding (str_replace($search,' ',$kart['description'] ), "Windows-1251", "UTF-8" ).";".
              mb_convert_encoding (str_replace($search,' ',$kart['rating'] ), "Windows-1251", "UTF-8" ).";". 
             str_replace($search,' ',$kart['share']).";".
             str_replace($search,' ',$kart['view'])."\r\n";
          fwrite($fd, $order);
    }
     
    fclose($fd);
     
      
  };
        return 1;
};
$db=mysql_connect("localhost", "garantma_user", "crKAyqBMMaEq");
mysql_select_db("garantma_db", $db);



//$db=mysql_connect("localhost", "root", "");
//mysql_select_db("garantmarket", $db);
$afields[]='name';
$afields[]='id';
$f_name='garant-'.date('dmY_G.i').'.csv';
if( export_csv($f_name)) { echo $f_name;};          
         