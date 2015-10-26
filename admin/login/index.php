<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
 
	<head>
    <title>Вход в административную панель</title>
	<link rel="stylesheet" type="text/css" href="css.css">
    <script type="text/javascript" src="http://bitby.net/wp-demo/files/jquery.js"></script>
	</head>
	<body>
<div id='top_start'>
	<div id='top_start_logo'><div id='preloader'></div></div>
</div>
<div id='mid_start'>
	<div class='mid_start_pic'>
    </div>
</div>
<div id='bot_start_bg'>
	<div id='bot_start_panel'>
   		<div id='bot_start_panel_top'>
        <p id='start_info'>Для входа введите свой логин и пароль</p>
        </div>
    	<div id='bot_start_panel_login'>
		<form action="../login.php" method="post">
        <input type="input" id='login' name="login"/>
    	<p id='start_login'>Логин</p>
    	</div>
        <div id='bot_start_panel_pass'>
        <input type="input" id='pass' name="pass"/>
        <p id='start_pass'>Пароль</p>
        </div>
        <input type="submit" value="Войти" id='enter'/>
		</form>

</div> 

<script>
  $(function(){
	$(".mid_start_pic").animate({opacity:'show'}, 700);
  });
</script>


	</body>