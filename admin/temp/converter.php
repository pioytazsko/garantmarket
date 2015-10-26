   <?php function import_csv()

{ 
    
  $db=mysql_connect("localhost", "garantma_user", "crKAyqBMMaEq");
mysql_select_db("garantma_db", $db);
//$db=mysql_connect("localhost", "root", "");
//mysql_select_db("garantmarket", $db);

    // создание таблицы если ее нет... иначе проверяем и сравниваем данные в таблицах
    
    
    $query ='CREATE TABLE temp (
  id INT NOT NULL AUTO_INCREMENT,
  iditem  TEXT NOT NULL,
  name  TEXT NOT NULL,
  space1  TEXT ,
  space2 TEXT ,
  price  INT ,
  manufected  TEXT ,
  category  TEXT ,
  keywords TEXT ,
  image TEXT ,
  vip INT ,
  levl INT ,
  public TEXT ,
  chpu TEXT ,
  h1 TEXT ,
  title TEXT ,
  description TEXT,
  rating TEXT,
  share TEXT,
  view BOOL,
   PRIMARY KEY (id)
  )';
//   $query_insert= "LOAD DATA INFILE 'c:/OpenServer/domains/localhost/admin/temp/temp.csv' 
//INTO TABLE temp 
//FIELDS TERMINATED BY ';' 
//ENCLOSED BY '\"'
//LINES TERMINATED BY '\r\n' 
//IGNORE 1 ROWS
//(id,iditem,name,price,manufected,category,keywords,image,vip,levl,public,chpu,h1,title ,description,share)";
//   
    $query_update="UPDATE catalog as s, temp as n
SET 
s.name=n.name,
s.price=n.price,
s.keywords=n.keywords,
s.vip=n.vip,
s.levl=n.levl,
s.publick=n.public,
s.chpu=n.chpu,
s.h1=n.h1,
s.title=n.title,
s.description=n.description,
s.rating=n.rating,
s.share=n.share,
s.view=n.view
WHERE s.iditem=n.iditem";
 $query_drop="DROP TABLE temp";
  //___________________________________________ вставка в таблицу temp из файла   
    
    function insert_data(){
        if ( $file=fopen('temp/temp.csv','r')){
        while(!feof($file)){
             $line_csv=fgets($file);
           
            $line_csv=str_getcsv($line_csv,';'); 
            $query_insert="INSERT INTO temp( iditem,name,price, manufected,
            category,keywords,image,vip,levl,public,chpu,h1,title,description,rating,share,view) VALUES 
            ('".$line_csv[1]."','".$line_csv[2]."','".$line_csv[5]."','".$line_csv[6]."','".$line_csv[7]."','".$line_csv[8]."     ','".$line_csv[9]."','".$line_csv[10]."','".$line_csv[11]."','".$line_csv[12]."','".$line_csv[13]."','".$line_csv[14]."','".$line_csv[15]."','".$line_csv[16]."','".$line_csv[17]."','".$line_csv[18]."','".$line_csv[19]."')";
             if(!mysql_query($query_insert)){
                 echo mysql_errno().mysql_error();
             };
        };
            fclose($file);} else echo "ERROR READ FILE";
}    
    
    
    if(!mysql_query($query_drop)){
    echo mysql_errno().mysql_error();
    };    
    
    if(!mysql_query($query)){
    echo mysql_errno().mysql_error();
    };

    insert_data();  
    if(!mysql_query($query_update)){
    echo mysql_errno().mysql_error();
    };
    return true;
}

function convert_file($filename)
{
    if($file=fopen('temp/'.$filename,'r') and $temp=fopen('temp/temp.csv','w')){
    while (!feof($file)){
        $line=fgets($file);
        
        $line=mb_convert_encoding($line,"UTF-8","Windows-1251");
         fputs($temp, $line);
    }
fclose($file);
fclose($temp);    
    }   else {echo "Error read file!";};}