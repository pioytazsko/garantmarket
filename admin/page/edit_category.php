<?php 
$id=$_GET['idc'];
$idcom=$_GET['idcom'];
if($idcom==1)
{
echo "<div class='yescoment'>Выполнено успешно</div>";
}
if($idcom==2)
{
echo "<div class='nocoment'>Произошла ошибка</div>";
}
$result=mysql_query("SELECT * FROM catecory WHERE id=$id");
$myrow=mysql_fetch_array($result);
?>
    <form action="controller/up_category.php" method="post" ENCTYPE="multipart/form-data">
        <div class="new_cait">
            <div class="left">
                <div class="remark">
                    <div class="text">Название категории:</div>
                    <div class="text1">Максимальный размер - 100 символов</div>
                    <div class="name">
                        <input name="name" id="name" type="text" value="<?php echo "$myrow[name]"; ?>">
                    </div>
                </div>
                <div class="remark">
                    <div class="text">Тайтл:</div>
                    <div class="text1">meta тэг</div>
                    <div class="name">
                        <input name="title" type="text" value="<?php echo "$myrow[title]"; ?>">
                    </div>
                </div>
                <div class="remark">
                    <div class="text">H1:</div>
                    <div class="text1">Максимальный размер - 150 символов</div>
                    <div class="name">
                        <input name="h1" type="text" value="<?php echo "$myrow[h1]"; ?>">
                    </div>
                </div>
                <div class="remark">
                    <div class="text">Название пункта меню:</div>
                    <div class="text1">Максимальный размер - 100 символов</div>
                    <div class="name">
                        <input name="nameLink" type="text" value="<?php echo "$myrow[nameLink]"; ?>">
                    </div>
                </div>
                <div class="remark">
                    <div class="text">Описание(description):</div>
                    <div class="text1">Максимальный размер - 250 символов</div>
                    <div class="name">
                        <input name="description" type="text" value="<?php echo "$myrow[description]"; ?>">
                    </div>
                </div>
                <div class="remark" id="chpu">
                    <div class="text">Псевдоним:</div>
                    <div class="text1">Цифры, латинские буквы</div>
                    <div class="name">
                        <input name="chpu" type="text" value="<?php echo trim($myrow[chpu]); ?>">
                    </div>
                </div>
                <div class="remark">
                    <div class="text">Ключевые слова:</div>
                    <div class="text1">Максимальный размер - 255 символов</div>
                    <div class="name">
                        <input name="keywords" type="text" value="<?php echo "$myrow[keywords]"; ?>">
                    </div>
                </div>
                <div class="remark">
                    <div class="text">Изображение:</div>
                    <div class="text1">Рекомендуемый размер 90px на 90px</div>
                    <div class="name1">
                        <input name="image" type="file">
                    </div></div>
                    <div class="remark">
                    <div class="text">Изображение для меню:</div>
                    <div class="text1">Рекомендуемый размер 450px на 600px</div>
                    <div class="name1">
                        <input name="menu" type="file">
                    </div>
                </div>
               
                <div class="add_image"><img style="float:left;max-width:220px;max-height:220px;" src="../categoryimages/<?php echo "$myrow[img]"; ?>" /></div>
                <div class="add_image"><img  style="max-width:220px;max-height:220px;" src="../categoryimages/<?php echo "$myrow[menu_img]"; ?>" /></div>
             </div>
            <div class="right">
                <div class="remark">
                    <div class="text">Описание категории:</div>
                    <div class="text1">Максимальный размер 2000 символов</div>
                    <div class="edit">
                        <textarea name="deskripshn">
                            <?php echo "$myrow[deskripshn]"; ?>
                        </textarea>
                    </div>
                </div>
                <div class="remark">
                    <div class="text">Родительская категория:</div>
                    <div class="text1">Товар отображается также в родительских категориях</div>
                    <div class="name">
                        <select name="parent">
                            <?php 
include("controller/selectcatshop2.php");
?>
                        </select>
                    </div>
                </div>
                <div class="remark">
                    <div class="text">Уровень категории:</div>
                    <div class="text1">Максимально 3 символа</div>
                    <div class="name">
                        <input name="levl" type="text" value="<?php echo " $myrow[levl] "; ?>">
                    </div>
                </div>
                <div class="remark">
                    <div class="text">Спецификация(Описание)</div>
                    <div class="text1">Максимально 70 символов</div>
                    <div class="name">
                        <input name="specification" type="text" value="<?php echo " $myrow[specification] "; ?>">
                    </div>
                </div>

            </div>
            <input name="id" type="hidden" value="<?php echo " $myrow[id] "; ?>">
            <div class="update">
                <input name="submit" type="submit" value="Обновить">
            </div>
    </form>
<!--        далле представленг блок ввода сопутствующих товаров-->
        <span style="font-size:25px">Сопутствующие товары</span>
   <div style="border:1px solid black;width: 900px;
height:600px;
overflow-y: auto;overflow-x:hidden;margin:0 0 40px 0; cursor:pointer" >
            <?php $query="SELECT name,id FROM catecory WHERE parent=0";$result=mysql_query($query);
            while($result_arr=mysql_fetch_row($result)){
                    echo "<div style='margin: 10px 0;border-top:1px solid black;' class=\"category\" >".$result_arr[0];
                    requrce($result_arr[1]);  
                    echo"</div>"; 
                    };
    
  function requrce ($id){
      $query="SELECT id,name FROM catecory WHERE parent=".$id;
      $result=mysql_query($query);
      if(mysql_num_rows($result)){ 
          while($res_arr=mysql_fetch_row($result)){
              echo "<div class='subcategory' 
              style='position:relative;left:30px;margin:15px 10px;display:none'>".$res_arr[1];
              requrce($res_arr[0]);
              echo"</div>"; 
              
                    
                };
                     } else{$query="SELECT id,name FROM catalog WHERE category=".$id;
                           $result=mysql_query($query);
                            while($res_arr=mysql_fetch_row($result)){
                               echo "<div class='subcategory' 
               style='position:relative;left:20px;margin:15px 10px;display:none' ><input type='checkbox' name='product' value='".$res_arr[0]."'><span class='items_then_buy'>".$res_arr[1]."</span></div>"; 
                                
                                
                            };
                            
                           
                           
                           
                           
                           }
     
      
      
  };?>
        
           
        
        
        


    </div><div style="float: right;margin-bottom: 100px;" >
    <input type="button"  id="add_product" value="Сохранить изменения"></div>
     <div  class="check_items" id="num_of_cheked">Выбрано:0</div>   
<div class="select_items">
        
        </div>
        <input type="button" id="hide" value="Свернуть>>">
  <script>  id=<?php echo $id; ?></script>        
<script src="/js/admin-category.js">
              
                
</script>



    <script type="text/javascript">
        $('#name').live('keyup', function () {
            $.ajax({
                type: "POST",
                url: "chpu/categoryitem.php",
                data: $('#name').serialize(),
                cache: false,
                success: function (html) {
                    $("#chpu").html(html);
                }
            });
            return false;
        });
    </script>
        
