<div  class="import_interface" style="margin:auto">
    <h3>Экспорт в  таблицу  EXEL</h3>
    <input type="button" id="download_exel" value="Скачать">
    <div id="no_display" style="display:none;margin:10px;"><h3>Ждите!</h3></div>
</div>
<div class="import_interface">
     <h3>Импорт из EXEL</h3>
    <h4>Внимание ! Важно размещение столбцов в файле!!! </h4>
    <form action="controller/export/import_exel.php" method="post" enctype="multipart/form-data">
        <input name="importfile" type="file">
        <input id="send" type="submit" name="send" value="Отправить">
         <div id="no_display2" style="display:none;margin:10px;"><h3>Ждите!</h3></div>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('#download_exel').click(function() {
            $('#no_display').show();
            $.ajax({
                type: "POST",
                url: "http://garantmarket.by/admin/controller/export/test_exel.php",
//                url: "http://garant/admin/controller/export/test_exel.php",
                success: function(msg) {

                    window.location.href = "/admin/controller/export/" + msg;
                    $('#no_display').hide();

                }
            });
        });
        $('#send').click(function(){ 
         $('#no_display2').show();
        })
        
    });
</script>