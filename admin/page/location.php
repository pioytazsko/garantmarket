<?php 
 define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
require_once(__ROOT__.'/medoo.min.php');
require_once(__ROOT__.'/config.php');

$database = new medoo(array(
	       // required
            'database_type' => $config_db['database_type'],
            'database_name'=> $config_db['database_name'],
            'server_name' => $config_db['server_name'],
            'username' => $config_db['username'],
            'password' => $config_db['password'],
            'charset'=>$config_db['charset']
        ));
// читаем список городов и выводим его
$datas = $database->select("location_discount", '*');
//print_r($datas);

?>
<div><div>Города и скидки в % </div>
<?php foreach($datas as $val){
echo "<div style='margin:10px 0 20px 20px;'><div style='width:100px'>".$val['city']."</div><input type='text' data='".$val['city']."' class='city' value='".$val['discount']."' ></div>";
};?>
<input type="button" id="send_location" name="send_location" value="Сохранить">
</div>
<script>
    function City(name, discount) {
        this.name = name;
        this.discount = discount;
    }



    $('#send_location').click(function() {
        var city = $('.city').toArray();

        var arr = [];
        for (var p in city) {
            cities = new City($(city[p]).attr('data'), city[p].value);
            arr.push(cities);
        }
              console.log(arr);
        arr = JSON.stringify(arr);
        $.post(
            "/admin/controller/location.php", 
            {
                data: arr
            },
            function(data) {
               if(data){alert('Сохранено!')}
            }
        );




    })
</script>

