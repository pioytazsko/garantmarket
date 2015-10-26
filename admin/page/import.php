<div>
   <div class='export_files'>
<input type="button"  id="download" value="Скачать прайс из базы данных" onClick=exports()>
<?php include('dir.php');?></div>
    
    
    
    <script>
        function exports() {
//                 var name_file=document.getElementsByName('file')[0].value;
      document.getElementById('download').href='files/temp.csv';
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function (name) {
                if (xhttp.readyState == 4 && xhttp.status == 200) { 
                                                                   location='files/'+this.responseText;
                                                                
                }
            }
            xhttp.open("POST", "controller/expport.php", true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            var str='x=1';
            xhttp.send(str);
          };
    
        
  </script>
</div>
<br>
<div style="background:#c3c1c1;float:left;clear:left;margin-top:30px;width:100%;border:1px solid black;">
     <h2>Внимание! Внесение изменений может повредить базу данных</h2>
    <h4>Импорт базы данных</h>
    <form enctype="multipart/form-data" action="" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
        <input type="file" name="uploadFile" />
        <input type="submit" name="upload" value="Импортировать  в БД" />
        </form>
    
    
    
    
    <?php require('temp/converter.php');
if(isset($_POST['upload'])){ $folder='temp/' ;
                             $uploadedFile=$folder.basename($_FILES['uploadFile']['name']);
                             if(is_uploaded_file($_FILES['uploadFile']['tmp_name'])){ 
                                 if(move_uploaded_file($_FILES['uploadFile']['tmp_name'], $uploadedFile)) {
                                    convert_file($_FILES['uploadFile']['name']);
                                     if(import_csv()){echo "Загружено";};
                                 }
                                 else { echo 'Во время загрузки файла произошла ошибка'; } } else
                             { echo 'Файл не  загружен'; } } ?>
</div>

<!-- далее обработка загруженного файла , отправка его в бд. -->