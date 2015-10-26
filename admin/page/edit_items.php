<?php 
$id=$_GET['id'];
$result=mysql_query("SELECT * FROM catalog WHERE id=$id");
$myrow=mysql_fetch_array($result);

$idcom=$_GET['idcom'];
if($idcom==1)
{
echo "<div class='yescoment'>Выполнено успешно</div>";
}
if($idcom==2)
{
echo "<div class='nocoment'>Вы ввели ID который уже используется, либо не ввели id вовсе</div>";
}
?>
<form action="controller/up_item.php" method="post" ENCTYPE="multipart/form-data">
<div class="new_cait">
			<div class="left">
			<div class="remark">
					<div class="text">ID товара:</div>
					<div class="text1">Только числа </div>
					<div class="name"><input name="iditem"  type="text" value="<?php echo "$myrow[iditem]"; ?>" /></div>
				</div>

				<div class="remark">
					<div class="text">Название:</div>
					<div class="text1">Максимальный размер - 100 символов</div>
					<div class="name"><input name="name" id="name" type="text" value="<?php echo "$myrow[name]"; ?>" /></div>
				</div>
								<div class="remark">
					<div class="text">h1:</div>
					<div class="text1">Максимальный размер - 100 символов</div>
					<div class="name"><input name="h1" type="text" value="<?php echo "$myrow[h1]"; ?>" /></div>
				</div>
				<div class="remark">
					<div class="text">title:</div>
					<div class="text1">Максимальный размер - 100 символов</div>
					<div class="name"><input name="title" type="text" value="<?php echo "$myrow[title]"; ?>" /></div>
				</div>
				<div class="remark">
					<div class="text">description:</div>
					<div class="text1">Максимальный размер - 100 символов</div>
					<div class="name"><input name="description" type="text" value="<?php echo "$myrow[description]"; ?>" /></div>
				</div>	
								<div class="remark" id="chpu">
					<div class="text">Псевдоним:</div>
					<div class="text1">Только английские символы, цифры</div>
					<div class="name"><input name="chpu" type="text" value="<?php echo "$myrow[chpu]"; ?>" /></div>
				</div>
					<div class="remark">
					<div class="text">Цена:</div>
					<div class="text1">Только цифры</div>
					<div class="name"><input name="price" type="text" value="<?php echo "$myrow[price]"; ?>" /></div>
				</div>
					<div class="remark">
					<div class="text">Ссылка на обзор:</div>
					<div class="text1">Максимальное значение 255 символов</div>
					<div class="name"><input name="linkodzor" type="text" value="<?php echo "$myrow[linkodzor]"; ?>" /></div>
				</div>
					<div class="remark">
					<div class="text">Подпись ссылки на обзор:</div>
					<div class="text1">Максимум 60 символов</div>
					<div class="name"><input name="linkodzortitle" type="text" value="<?php echo "$myrow[linkodzortitle]"; ?>" /></div>
				</div>
					<div class="remark">
					<div class="text">Ключевые слова:</div>
					<div class="text1">Максимальный размер - 255 символов</div>
					<div class="name"><input name="keywords" type="text" value="<?php echo "$myrow[keywords]"; ?>" /></div>
				</div>
					<div class="remark">
					<div class="text">Ссылка на отзывы:</div>
					<div class="text1">Максимальный размер - 255 символов</div>
					<div class="name"><input name="linkotziv" type="text" value="<?php echo "$myrow[linkotziv]"; ?>" /></div>
				</div>
				<div class="remark">
					<div class="text">Подпись ссылки на отзывы:</div>
					<div class="text1">Максимальный размер - 60 символов</div>
					<div class="name"><input name="linkotzivtitle" type="text" value="<?php echo "$myrow[linkotzivtitle]"; ?>" /></div>
				</div>
				<div class="remark">
			<div class="text">Файловое приложение:</div>
			<div class="text1">Рекомендуемый размер не болие 3,5Мб</div>
			<div class="name1"><input name="file" type="file" /></div>
		</div>
		<div class="remark">
			<div class="text">Подпись файла:</div>
			<div class="text1">Рекомендуемый размер 90px на 90px</div>
			<div class="name1"><input name="filetitle" type="text" value="<?php echo "$myrow[filetitle]"; ?>" /></div>
		</div>
		<!--start dopparans-->
		<div class="remark"><hr>Дополнительные параметры</div><br><br>
		<?php 
		$doppar=mysql_query("SELECT * FROM paramskat WHERE idcat=$myrow[category] ORDER BY idpar");
		$dopparrez=mysql_fetch_array($doppar);
		$co=0;
		if($dopparrez>0)
		{
		do
		{
		$doppar2=mysql_query("SELECT * FROM params WHERE id=$dopparrez[idpar]");
		$dopparrez2=mysql_fetch_array($doppar2);
		$dop="dop$co";
		
		$doppar3=mysql_query("SELECT * FROM paramsitem WHERE idparams=$dopparrez[idpar] and iditem=$myrow[id]");
		$dopparrez3=mysql_fetch_array($doppar3);
		?>
		
		<div class="remark">
			<div class="text"><?php echo "$dopparrez2[name]"; ?>:</div>
			<div class="name1"><input name="<?php echo $dop; ?>" type="text" value="<?php echo "$dopparrez3[val]"; ?>" /></div>
		</div>
		<?php 
		$co++;
		}
		while($dopparrez=mysql_fetch_array($doppar));
		}
		else
		{
		echo "Нет дополнительных параметров";
		}
		?>
		<!--end dopparans-->
		
			</div>
			<div class="right">
			<div class="remark">
					<div class="text">Производитель:</div>
					<div class="text1">Выберите из списка</div>
					<div class="name"><select name="manufekted">
					<?php 
					$result2=mysql_query("SELECT * FROM manufekted WHERE id=$myrow[manufekted]");
					$myrow2=mysql_fetch_array($result2);
					if($myrow2>0)
					{
					echo "<option value='$myrow2[id]'>$myrow2[name]</option>";
					echo "<option value='0'>Нет производителя</option>";
					}
					else
					{
					echo "<option value='0'>Нет производителя</option>";
					}
					$result3=mysql_query("SELECT * FROM manufekted WHERE id!=$myrow[manufekted]");
					$myrow3=mysql_fetch_array($result3);
					if($myrow3>0)
					{
					do
					{
					echo "<option value='$myrow3[id]'>$myrow3[name]</option>";
					}
					while($myrow3=mysql_fetch_array($result3));
					}
					?>
					</select></div>
		</div>
		<div class="remark">
					<div class="text">Категория:</div>
					<div class="text1">Выберите из списка</div>
					<div class="name"><select name="category"><?php include("controller/cat_item.php"); ?></select></div>
		</div>
				<div class="remark">
					<div class="text">Описание:</div>
					<div class="text1">Рекомендуемое значение от 2 слов</div>
					<div class="edit"><textarea name="deskripshn"><?php echo "$myrow[deskripshn]"; ?></textarea></div>
				</div>
			
		<div class="remark">
					<div class="text">Скидка:</div>
					<div class="text1">В процентах, только число</div>
					<div class="name"><input name="spase" type="text" value="<?php echo "$myrow[spase]"; ?>" /></div>
		</div>
		<div class="remark">
					<div class="text">Уровень:</div>
					<div class="text1">Только число</div>
					<div class="name"><input name="levl" type="text" value="<?php echo "$myrow[levl]"; ?>" /></div>
		</div>
		<div class="remark">
					<div class="text">VIP статус:</div>
					<div class="text1">0 - нет, 1 - да.</div>
					<div class="name"><input name="vip" type="text" value="<?php echo "$myrow[vip]"; ?>" /></div>
		</div>
		<div class="remark">
					<div class="text">Еденица измерения:</div>
					<div class="text1">Максимум 10 символов</div>
					<div class="name"><input name="unit" type="text" value="<?php echo "$myrow[unit]"; ?>" /></div>
		</div>
		<div class="remark">
					<div class="text">Акция:</div>
					<div class="text1">0-нет акции 1-на акции</div>
					<div class="name"><input name="share" type="text" value="<?php echo "$myrow[share]"; ?>" /></div>
		</div>
		<div class="remark">
			<div class="text">Изображение:</div>
			<div class="text1">Рекомендуемый размер 90px на 90px</div>
			<div class="name1"><input name="image" type="file" /></div>
		</div>
		<div class="add_image"><img src="../shopimage/<?php $image = end(explode('/', $myrow['image'])); echo "$image"; ?>"></div>
		
<div class="update4"><input name="id" type="hidden" value="<?php echo "$myrow[id]"; ?>"><input name="submit" type="submit" value="Обновить позицию"></div>
		
</div>
	
	
	
	
	</div></form>
<div style="font-size:25px">Сопутствующие товары</div>
<!--сопутствующие т овары-->

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
      <div class="check_items" id="num_of_cheked">Выбрано:0</div>    
<div class="select_items">
      
        </div>
<input type="button" id="hide" value="Свернуть>>">
 <script>  id=<?php echo $id; ?></script>       
<script src="/js/admin-items.js" >
   
</script>


			<script type="text/javascript">
$('#name').live('keyup', function(){
        $.ajax({  
            type: "POST",
            url: "chpu/nameitem.php",
            data: $('#name').serialize(),
            cache:false,
            success: function(html){  
                $("#chpu").html(html);  
            }  
        });  
        return false;  
    });
</script>