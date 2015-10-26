<script type="text/javascript">

var email,
	password,
	emailStat,
	passwordStat;

$(function() {

	// Email
	$("#email").change(function(){
		email = $("#email").val();
		var expEmail = /[-0-9a-z_]+@[-0-9a-z_]+\.[a-z]{2,6}/i;
		var resEmail = email.search(expEmail);
		if(resEmail == -1){
			$("#email").next().hide().text("Неверный формат Email").css("color","red").fadeIn(400);
			$("#email").removeClass().addClass("inputRed");
			emailStat = 0;
			buttonOnAndOff();
		}else{
			
			$.ajax({
			url: "shop/testemail.php",
			type: "GET",
			data: "email=" + email,
			cache: false,			
			success: function(response){
				if(response == "no"){
					$("#email").next().hide().text("Email Занят").css("color","red").fadeIn(400);
					$("#email").removeClass().addClass("inputRed");					
				}else{					
					$("#email").removeClass().addClass("inputGreen");
					$("#email").next().text("");
				}					
			}
		});
			emailStat = 1;
			buttonOnAndOff();
		}
		
	});	
	$("#email").keyup(function(){
		$("#email").removeClass();
		$("#email").next().text("");
	});	
	
	
	//Пароль
	$("#password").change(function(){
		password = $("#password").val();
		if(password.length < 7){
			$("#password").next().hide().text("Неверно указан номер").css("color","red").fadeIn(400);
			$("#password").removeClass().addClass("inputRed");
			passwordStat = 0;
			buttonOnAndOff();
		}else{
			$("#password").removeClass().addClass("inputGreen");
			$("#password").next().text("");
			passwordStat = 1;
			buttonOnAndOff();
		}		
	});
	$("#password").keyup(function(){
		$("#password").removeClass();
		$("#password").next().text("");
	});
	

	function buttonOnAndOff(){
		if(passwordStat == 1){
			$(".submit").removeAttr("disabled");
			$(".compol").text(" ");
		}else{
			$(".submit").attr("disabled","disabled");
			
		}
	
	}
	
});


</script>



<form action="shop/newspeedzakaz.php" method="post">
<?php 
if($id_user<1)
{
?>

<div class="nameotziv">Укажите номер телефона</div>
<div class="otzivform"><input name="phone" type="text"></div>
<div class="nameotziv">Укажите e-mail</div>
<div class="otzivform"><input name="milo" type="text" id="email"></div>
<div class="nameotziv">Примечание</div>
<div class="otzivform"><input name="primechanie" type="text" id="password"></div>
<input name="id" type="hidden" value="<?php echo "$id"; ?>">
<input name="submit" type="submit" value="Оформить" class="submit" disabled>
<?php 
}
else
{
$infous=mysql_query("SELECT * FROM user WHERE id=$id_user");
$infousrez=mysql_fetch_array($infous);
?>
<div class="nameotziv">Укажите номер телефона</div>
<div class="otzivform"><input name="phone" type="text" value="<?php echo "$infousrez[phone]"; ?>"></div>
<div class="nameotziv">Укажите e-mail</div>
<div class="otzivform"><input name="milo" type="text" value="<?php echo "$infousrez[milo]"; ?>"></div>
<div class="nameotziv">Примечание</div>
<div class="otzivform"><input name="primechanie" type="text"></div>
<input name="id" type="hidden" value="<?php echo "$id"; ?>">
<input name="submit" type="submit" value="Оформить">
<?php 
}
?>
</form>