<?php
//mysql_connect("localhost", "garantma_user", "crKAyqBMMaEq");
//mysql_select_db("garantma_db");
mysql_connect('localhost','root','');
mysql_select_db('garantmarket');
//mysql_connect('localhost','toolbyto_serj','kayman');
//mysql_select_db('toolbyto_garant');
$item=json_decode($_POST['id']);
$query="SELECT * FROM they_buy  WHERE id=".$item[0];
$result=mysql_query($query);echo mysql_error();
if(mysql_num_rows($result)){
 // если нашли такой уже в бд, тоо обнавляем,если нет, то вставляем
    $n=count($item);
    while($n<=30){
        $item[$n]='0';
        $n++;
    };
    
    $query="UPDATE they_buy SET prod1='".$item[1].
        "',prod2='".$item[2].
        "',prod3='".$item[3].
        "',prod4='".$item[4].
        "',prod5='".$item[5].
        "',prod6='".$item[6].
        "',prod7='".$item[7].
        "',prod8='".$item[8].
        "',prod9='".$item[9].
        "',prod10='".$item[10].
       "',prod11='".$item[11].
        "',prod12='".$item[12].
        "',prod13='".$item[13].
        "',prod14='".$item[14].
        "',prod15='".$item[15].
        "',prod16='".$item[16].
        "',prod17='".$item[17].
        "',prod18='".$item[18].
        "',prod19='".$item[19].
        "',prod20='".$item[20].
        "',prod21='".$item[21].
        "',prod22='".$item[22].
        "',prod23='".$item[23].
        "',prod24='".$item[24].
        "',prod25='".$item[25].
        "',prod26='".$item[26].
        "',prod27='".$item[27].
        "',prod28='".$item[28].
        "',prod29='".$item[29].
        "',prod30='".$item[30].
        "'WHERE id=".$item[0] ;
     $result=mysql_query($query);echo mysql_error();echo "OK";
    
}else{
    $n=count($item);
    while($n<=30){
        $item[$n]='0';
        $n++;
    };
    $query="INSERT INTO they_buy (id,prod1,prod2,prod3,prod4,prod5,prod6,prod7,prod8,prod9,prod10,
    prod11,prod12,prod13,prod14,prod15,prod16,prod17,prod18,prod19,prod20,
    prod21,prod22,prod23,prod24,prod25,prod26,prod27,prod28,prod29,prod30)
    VALUES ('".$item[0].
        "','".$item[1].
        "','".$item[2].
        "','".$item[3].
        "','".$item[4].
        "','".$item[5].
        "','".$item[6].
        "','".$item[7].
        "','".$item[8].
        "','".$item[9].
        "','".$item[10].
        "','".$item[11].
        "','".$item[12].
        "','".$item[13].
        "','".$item[14].
        "','".$item[15].
        "','".$item[16].
        "','".$item[17].
        "','".$item[18].
        "','".$item[19].
        "','".$item[20].
        "','".$item[21].
        "','".$item[22].
        "','".$item[23].
        "','".$item[24].
        "','".$item[25].
        "','".$item[26].
        "','".$item[27].
        "','".$item[28].
        "','".$item[29].
        "','".$item[30].
        "')";
    $result=mysql_query($query);echo mysql_error();
    }

//if(){}else{}