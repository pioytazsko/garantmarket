<div class="center">
    <?php 
$id=$_GET['idn'];
$pageinfo=mysql_query("SELECT * FROM news WHERE id=$id");
$pageinforez=mysql_fetch_array($pageinfo);
?>
        <h1><?php echo "$pageinforez[name]"; ?></h1>
        <?php echo "$pageinforez[text]"; ?>

</div>
<div>
   
    <div style="float: left;" ><script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript">
        
        </script>
        <script type="text/javascript">
    var map = new ymaps.Map("map", {
            center: [53.83, 27.68], 
            zoom: 7
        });
</script>
        
<div id="map" style="width: 600px; height: 400px"></div>
</div>
   
</div>
<script type="text/javascript">
    ymaps.ready(init);
    var myMap;

    function init(){     
        myMap = new ymaps.Map("map", {
            center: [53.83580550,27.68453993],
            zoom: 12
        });
            myGeoObject = new ymaps.GeoObject({
            // Описание геометрии.
            geometry: {
                type: "Point",
                coordinates: [53.83580550,27.68432900]
            },
            // Свойства.
            properties: {
                // Контент метки.
                iconContent: 'Наш магазин: г.Минск,пер. Промышленный,14 ',
//                hintContent: 'Ну давай уже тащи'
            }
        }, {
            // Опции.
            // Иконка метки будет растягиваться под размер ее содержимого.
            preset: 'islands#redStretchyIcon',
            // Метку можно перемещать.
            draggable: false
        });
            
            myMap.geoObjects.add(myGeoObject);
    }
   
</script>