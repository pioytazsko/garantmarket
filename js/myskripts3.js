$(document).ready(function(){
$(document).mouseup(function(e){var container=$('#comentblock');if(container.has(e.target).length===0){container.hide();}});
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
    $('.shop_tovar2').last().css('margin-right', '0px');
 //    хрен его знае5т наследство из пе5рвоначального сайта
    $('#my-slide2').DrSlider({
        transitionSpeed: 1000,
        duration: 4000,
        showNavigation: false,
        showControl: false,
    });
   (function() {
  if (window.pluso)if (typeof window.pluso.start == "function") return;
  if (window.ifpluso==undefined) { window.ifpluso = 1;
    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
    var h=d[g]('body')[0];
    h.appendChild(s);
  }})();
    $().UItoTop({ easingType: 'easeOutQuart' });
 $("#gallery li img").hover(function(){
		$('#main-img').attr('src',$(this).attr('src').replace('thumb/', ''));
	});
	var imgSwap = [];
	 $("#gallery li img").each(function(){
		imgUrl = this.src.replace('thumb/', '');
		imgSwap.push(imgUrl);
	});
	$(imgSwap).preload();

})
$.fn.preload = function() {
    this.each(function(){
        $('<img/>')[0].src = this;
    });
}
			