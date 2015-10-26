<div class="plus"><a href="catalog.php?idp=12"><img src="images/add.png"></a></div>
<?php $id_num=array();
$idcom=$_GET['idcom'];
if($idcom==1)
{
echo "<div class='yescoment'>Выполнено успешно</div>";
}
if($idcom==2)
{
echo "<div class='nocoment'>Произошла ошибка</div>";
}
if($idcom==3)
{
echo "<div class='nocoment'>Вы не ввели id товара, или же товар с таким id уже существует</div>";
}
$keyword= $_POST['keyword'];
?>
		<div class="pole_user">
			<div id="update">
<input type="button" value="Сохранить все изменения" style="float: right;"  id="" onClick=update() >
	</div>
			<div class="user"><form action="catalog.php?idp=5" method="post"><input name="keyword" type="text" value="<?php echo $keyword; ?>" />
			<select name="cat">
			<option value="0">Все</option>
			<?php 
			$catitems=mysql_query("SELECT * FROM catecory ORDER BY name");
			$catitemsrez=mysql_fetch_array($catitems);
			do
			{
			echo "<option value='$catitemsrez[id]'>$catitemsrez[name]</option>";
			}
			while($catitemsrez=mysql_fetch_array($catitems));
			?>
			</select>
			<input name="submit" type="submit" value="Поиск">
			</form></div>
			<form action="controller/update.php" method="post">
			
			
				
			
			</form>
			<div class="head">
				<div class="head_punct1">Название</div>
                <div class="head_rating">Рейтинг</div>
				<div class="head_punct2">Уровень</div>
				<div class="head_punct3">Действия</div>
			</div>
<?php 
$per_page=25;
if (isset($_GET['page'])) {$page=($_GET['page']-1);} else {$page=0;};
$start=abs($page*$per_page);

$result=mysql_query("SELECT * FROM catalog  ORDER BY levl LIMIT $start, $per_page");
$myrow=mysql_fetch_array($result);
if($_POST['keyword']!='')
{
$keyword = trim($keyword); 
 $keyword = stripslashes($keyword); 
 $keyword = htmlspecialchars($keyword); 
$result=mysql_query("SELECT * FROM catalog  WHERE name LIKE '%".strtoupper($keyword)."%' ORDER BY levl ");
$myrow=mysql_fetch_array($result); 
}
$catitem=$_POST['cat'];
if($catitem>0)
{
$result=mysql_query("SELECT * FROM catalog WHERE  category=$catitem  ORDER BY levl ");
$myrow=mysql_fetch_array($result);
}

if($myrow>0)
{
do
{ 
?>			
			
		
			<div class="kategory">
				<form action="controller/uplevitem.php" method="post"><div class="kategory_punct1">
                    
                    <div class="item_id" ><a href="catalog.php?idp=6&id=<?php $id_num[]=$myrow[id]; echo "$myrow[id]"; ?>">
                        <?php echo $myrow['iditem'].'    '."$myrow[id]"; ?></a></div>
                    <input name="name" type="text" class='name' value="<?php echo "$myrow[name]"; ?>"> </div><div class="rating" >
                    <?php 
 for($i=3;$i<6;$i++){
                    if($i==$myrow[rating]){
                        echo'<input type=radio name="rating" checked value="'.$i.'" >'.$i
                      ;  } else {
                        echo '<input type=radio name="rating" value="'.$i.'" >'.$i;  }


};?>
                   
                    </div>
				<div class="kategory_punct2">
					<a href="controller/uplevitem.php?up=<?php echo "$myrow[id]"; ?>"><div class="up"><img src="images/5.png"></div></a>
					<div class="valuation">
                        
                        <input name="levl" type="text" class="levl" id="levl" value="<?php echo "$myrow[levl]"; ?>"></div>
					<a href="controller/uplevitem.php?dw=<?php echo "$myrow[id]"; ?>"><div class="down"><img src="images/6.png"</div></div></a>
					<div class="save"><input name="id" type="hidden" value="<?php echo "$myrow[id]"; ?>"><input name="price" id="priceval" type="text" class='price' value="<?php echo "$myrow[price]"; ?>"><input class="click<?php echo "$myrow[id]"; ?>" name="submit1" type="submit" id="save" value=" "></div>
                    
                    </form>
				</div>
				<div class="kategory_punct3">
                    
					<a href="catalog.php?idp=22&id=<?php echo "$myrow[id]"; ?>" target="_blank"><div class="stock"><img src="images/copy.png"></div></a>
					<a href="controller/up_publickitem.php?id=<?php echo "$myrow[id]"; ?>"><div class="stock"><img src="images/<?php if($myrow['publick']==1) {echo "1.png";} else {echo "4.png";}?>"></div></a>
					<a href="catalog.php?idp=15&id=<?php echo "$myrow[id]"; ?>"><div class="stock"><img src="images/2.png"></div></a>
					<a href="controller/delit_item.php?id=<?php echo "$myrow[id]"; ?>"><div class="stock"><img src="images/3.png"></div></a>
                    
				</div>
                <div style="float:left"><span>Отображать?:</span><?php if($myrow['view']==true){ echo'<input id="view" class="view" type="button" data="'.$myrow['id'].'" value="not">';}
 else {echo ' <input id="view" class="view" data="'.$myrow['id'].'" type="button" value="view">';};?></div>
			</div>
			
<?php
}
while($myrow=mysql_fetch_array($result));
?>			
		
<div class="button">
<?php 
//сами ссылки
$q="SELECT count(*) FROM catalog ORDER BY id";
if($_POST['keyword']!='')
{
$q="SELECT count(*) FROM catalog WHERE name LIKE '%".strtoupper($keyword)."%'";
}
if($catitem>0)
{
$q="SELECT count(*) FROM catalog WHERE  category=$catitem";
}



$res=mysql_query($q);
$row=mysql_fetch_row($res);
$total_rows=$row[0];
$num_pages=ceil($total_rows/$per_page);
$page=$_GET['page'];
if($page<1)
{
$page=1;
}
$page2=$page+6;
$page3=$page-6;
if($page3<1)
{
$page3=1;
}

if($page2>$num_pages)
{
$page2=$num_pages;
}

for($i=$page3;$i<$page;$i++) {
  if ($i == $page) {
    echo "<div class='push'>$i</div>";
  } else {
    echo '<div class="push"><a href="'.$_SERVER['PHP_SELF'].'?idp=5&page='.$i.'">'.$i."</a></div> ";
  }
}

for($i=$page;$i<=$page2;$i++) {
  if ($i == $page) {
    echo "<div class='push'>$i</div>";
  } else {
    echo '<div class="push"><a href="'.$_SERVER['PHP_SELF'].'?idp=5&page='.$i.'">'.$i."</a></div> ";
  }
}
}
else
{
echo "Нет товаров";
}
?>
		<div id="update" style="float: right;">
<input type="button" value="Сохранить все изменения"   onClick=update() >

         
	</div>		
			</div>			
		</div>
<div id="result">


</div><br>
<br><br>
<script>
  
    function check()
{ var rating= new Array();
    var inp = document.getElementsByName('rating');
    for (var i = 0; i < inp.length; i++) {
        if (inp[i].type == "radio" && inp[i].checked) {
        rating.push(inp[i].value);
            
        }
    }return rating;
}
	
				function update(){
                   var rating= new Array(); 
//                    rating= check().slice(0);
					var price=document.getElementsByClassName('price');
					 id_num=new Array();
					<?php for ($i=0;$i<count($id_num);$i++){echo "id_num.push(".$id_num[$i].");"; }   ?>
			     	var name=document.getElementsByClassName('name');
					var levl=document.getElementsByClassName('levl');
                   	var error="Сохранено";
                   
				  for(var i=0;i<price.length;i++) {
    						xhttp=new XMLHttpRequest();
                     
                     
							xhttp.onreadystatechange=function(name){
   																				if (xhttp.readyState==4 && xhttp.status==200){ x=this.responseText;}
   						 													}
                          
							xhttp.open("POST","controller/update.php",true);
							xhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
							var str='id='+id_num[i]+'&price='+price[i].value+'&name='+name[i].value+'&levl='+levl[i].value+'&rating='+check()[i];
							xhttp.send(str); }
                   alert(x);
	//alert(error);							  
 }
</script>
<script src="/admin/jscripts/view.js"></script>